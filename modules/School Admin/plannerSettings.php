<?
/*
Gibbon, Flexible & Open School System
Copyright (C) 2010, Ross Parker

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

@session_start() ;

if (isActionAccessible($guid, $connection2, "/modules/School Admin/plannerSettings.php")==FALSE) {
	//Acess denied
	print "<div class='error'>" ;
		print "You do not have access to this action." ;
	print "</div>" ;
}
else {
	//Proceed!
	print "<div class='trail'>" ;
	print "<div class='trailHead'><a href='" . $_SESSION[$guid]["absoluteURL"] . "'>Home</a> > <a href='" . $_SESSION[$guid]["absoluteURL"] . "/index.php?q=/modules/" . getModuleName($_GET["q"]) . "/" . getModuleEntry($_GET["q"], $connection2, $guid) . "'>" . getModuleName($_GET["q"]) . "</a> > </div><div class='trailEnd'>Planner Settings</div>" ;
	print "</div>" ;
	
	if (isset($_GET["updateReturn"])) { $updateReturn=$_GET["updateReturn"] ; } else { $updateReturn="" ; }
	$updateReturnMessage ="" ;
	$class="error" ;
	if (!($updateReturn=="")) {
		if ($updateReturn=="fail0") {
			$updateReturnMessage ="Your request failed because you do not have access to this action." ;	
		}
		else if ($updateReturn=="fail1") {
			$updateReturnMessage ="Your request failed because your inputs were invalid." ;	
		}
		else if ($updateReturn=="fail2") {
			$updateReturnMessage ="Update of one or more fields failed due to a database error." ;	
		}
		else if ($updateReturn=="fail3") {
			$updateReturnMessage ="Your request failed because your inputs were invalid." ;	
		}
		else if ($updateReturn=="success0") {
			$updateReturnMessage ="Your request was successful. ." ;	
			$class="success" ;
		}
		print "<div class='$class'>" ;
			print $updateReturnMessage;
		print "</div>" ;
	} 
	?>
	
	<form method="post" action="<? print $_SESSION[$guid]["absoluteURL"] . "/modules/" . $_SESSION[$guid]["module"] . "/plannerSettingsProcess.php" ?>">
		<table class='smallIntBorder' cellspacing='0' style="width: 100%">	
			<tr class='break'>
				<td colspan=2> 
					<h3>Planner Templates</h3>
				</td>
			</tr>
			<tr>
				<?
				try {
					$data=array(); 
					$sql="SELECT * FROM gibbonSetting WHERE scope='Planner' AND name='lessonDetailsTemplate'" ;
					$result=$connection2->prepare($sql);
					$result->execute($data);
				}
				catch(PDOException $e) { }
				$row=$result->fetch() ;
				?>
				<td> 
					<b><? print $row["nameDisplay"] ?></b><br/>
					<span style="font-size: 90%"><i><? print $row["description"] ?></i></span>
				</td>
				<td class="right">
					<textarea name="<? print $row["name"] ?>" id="<? print $row["name"] ?>" type="text" style="width: 300px" rows=10><? print $row["value"] ?></textarea>
				</td>
			</tr>
			<tr>
				<?
				try {
					$data=array(); 
					$sql="SELECT * FROM gibbonSetting WHERE scope='Planner' AND name='teachersNotesTemplate'" ;
					$result=$connection2->prepare($sql);
					$result->execute($data);
				}
				catch(PDOException $e) { }
				$row=$result->fetch() ;
				?>
				<td> 
					<b><? print $row["nameDisplay"] ?></b><br/>
					<span style="font-size: 90%"><i><? print $row["description"] ?></i></span>
				</td>
				<td class="right">
					<textarea name="<? print $row["name"] ?>" id="<? print $row["name"] ?>" type="text" style="width: 300px" rows=10><? print $row["value"] ?></textarea>
				</td>
			</tr>
			<tr>
				<?
				try {
					$data=array(); 
					$sql="SELECT * FROM gibbonSetting WHERE scope='Planner' AND name='unitOutlineTemplate'" ;
					$result=$connection2->prepare($sql);
					$result->execute($data);
				}
				catch(PDOException $e) { }
				$row=$result->fetch() ;
				?>
				<td> 
					<b><? print $row["nameDisplay"] ?></b><br/>
					<span style="font-size: 90%"><i><? print $row["description"] ?></i></span>
				</td>
				<td class="right">
					<textarea name="<? print $row["name"] ?>" id="<? print $row["name"] ?>" type="text" style="width: 300px" rows=10><? print $row["value"] ?></textarea>
				</td>
			</tr>
			<tr>
				<?
				try {
					$data=array(); 
					$sql="SELECT * FROM gibbonSetting WHERE scope='Planner' AND name='smartBlockTemplate'" ;
					$result=$connection2->prepare($sql);
					$result->execute($data);
				}
				catch(PDOException $e) { }
				$row=$result->fetch() ;
				?>
				<td> 
					<b><? print $row["nameDisplay"] ?></b><br/>
					<span style="font-size: 90%"><i><? print $row["description"] ?></i></span>
				</td>
				<td class="right">
					<textarea name="<? print $row["name"] ?>" id="<? print $row["name"] ?>" type="text" style="width: 300px" rows=10><? print $row["value"] ?></textarea>
				</td>
			</tr>
			
			<tr class='break'>
				<td colspan=2> 
					<h3>Access Settings</h3>
				</td>
			</tr>
			<tr>
				<?
				try {
					$data=array(); 
					$sql="SELECT * FROM gibbonSetting WHERE scope='Planner' AND name='allowOutcomeEditing'" ;
					$result=$connection2->prepare($sql);
					$result->execute($data);
				}
				catch(PDOException $e) { 
					print "<div class='error'>" . $e->getMessage() . "</div>" ; 
				}
				$row=$result->fetch() ;
				?>
				<td> 
					<b><? print $row["nameDisplay"] ?> *</b><br/>
					<span style="font-size: 90%"><i><? print $row["description"] ?></i></span>
				</td>
				<td class="right">
					<select name="<? print $row["name"] ?>" id="<? print $row["name"] ?>" style="width: 302px">
						<option <? if ($row["value"]=="Y") {print "selected ";} ?>value="Y">Y</option>
						<option <? if ($row["value"]=="N") {print "selected ";} ?>value="N">N</option>
					</select>
				</td>
			</tr>
			<tr>
				<?
				try {
					$data=array(); 
					$sql="SELECT * FROM gibbonSetting WHERE scope='Planner' AND name='sharingDefaultParents'" ;
					$result=$connection2->prepare($sql);
					$result->execute($data);
				}
				catch(PDOException $e) { 
					print "<div class='error'>" . $e->getMessage() . "</div>" ; 
				}
				$row=$result->fetch() ;
				?>
				<td> 
					<b><? print $row["nameDisplay"] ?> *</b><br/>
					<span style="font-size: 90%"><i><? print $row["description"] ?></i></span>
				</td>
				<td class="right">
					<select name="<? print $row["name"] ?>" id="<? print $row["name"] ?>" style="width: 302px">
						<option <? if ($row["value"]=="Y") {print "selected ";} ?>value="Y">Y</option>
						<option <? if ($row["value"]=="N") {print "selected ";} ?>value="N">N</option>
					</select>
				</td>
			</tr>
			<tr>
				<?
				try {
					$data=array(); 
					$sql="SELECT * FROM gibbonSetting WHERE scope='Planner' AND name='sharingDefaultStudents'" ;
					$result=$connection2->prepare($sql);
					$result->execute($data);
				}
				catch(PDOException $e) { 
					print "<div class='error'>" . $e->getMessage() . "</div>" ; 
				}
				$row=$result->fetch() ;
				?>
				<td> 
					<b><? print $row["nameDisplay"] ?> *</b><br/>
					<span style="font-size: 90%"><i><? print $row["description"] ?></i></span>
				</td>
				<td class="right">
					<select name="<? print $row["name"] ?>" id="<? print $row["name"] ?>" style="width: 302px">
						<option <? if ($row["value"]=="Y") {print "selected ";} ?>value="Y">Y</option>
						<option <? if ($row["value"]=="N") {print "selected ";} ?>value="N">N</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<span style="font-size: 90%"><i>* denotes a required field</i></span>
				</td>
				<td class="right">
					<input type="hidden" name="address" value="<? print $_SESSION[$guid]["address"] ?>">
					<input type="submit" value="Submit">
				</td>
			</tr>
		</table>
	</form>
<?
}
?>
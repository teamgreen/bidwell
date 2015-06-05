<?php

@include_once 'includes/debugging-helper-functions.inc.php';

//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
// Line - abstract base class for the various line types.
//
//	Created by FVDS
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
abstract class Line
{
	//////////////////////////////////////
	// saveLine  - loads values to database
	// $a_dbc - the database
	// $a_sheetID  - sheet ID used if $sheetID is 0 (new line)
	// return: Returns true if successful, false if failed.
	// created by FVDS
	//////////////////////////////////////
	function saveLine($a_dbc, $a_sheetID)
	{
	}

	//////////////////////////////////////
	// loadLine  - sets values from database
	// $a_row  - result from datase.
	// created by FVDS
	//////////////////////////////////////
	function loadLine($a_row)
	{
	}

	//////////////////////////////////////
	// displayLine  - writes out table row for this line
	// $a_dbc - the database
	// $a_lineCount - which line this is. Not used here.
	// returns: null
	// created by FVDS
	//////////////////////////////////////
	function displayLine($a_dbc, $a_lineCount)
	{
	}

	static function generateTableHeaderHTML(){}
}

//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
// Line - abstract base class for the various line types.
//
//	Created by FVDS
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
class ExternalBidSheetLine extends Line
{
	protected $lineID=0;
	protected $sheetID = 0;
	protected $workDescription="";
	protected $amount=0;

	//////////////////////////////////////
	// saveLine  - loads values to database
	// $a_dbc - the database
	// $a_sheetID  - sheet ID used if $sheetID is 0 (new line)
	// return: Returns true if successful, false if failed.
	// created by FVDS
	//////////////////////////////////////
	function saveLine($a_dbc, $a_sheetID)
	{
		// if this is an existing line...
		if($this->sheetID){
			$sql = "UPDATE `externalbidsheetline`
				SET `WorkDescription`=$this->workDescription, `Amount`=$this->amount
				WHERE `LineID`=$this->lineID";

		} else{ // new line.
			$sql = "INSERT INTO `externalbidsheetline` (SheetID, WorkDescription, Amount)
				VALUES ('$this->sheetID', '$this->workDescription', '$this->amount')";
		}

		// update the database
		$result_form_project = @mysqli_query($a_dbc, $sql);

		// check how many rows were impacted.  If 0, it failed.
		if (@mysqli_num_rows($result_form_project) == 0)
		 	return false;
		else
			return true;
	}

	//////////////////////////////////////
	// loadLine  - sets values from database
	// $a_row  - result from datase.
	// created by FVDS
	//////////////////////////////////////
	function loadLine($a_row)
	{
		$this->lineID=$a_row['LineID'];
		$this->sheetID=$a_row['SheetID'];
		$this->workDescription=$a_row['WorkDescription'];
		$this->amount=$a_row['Amount'];
	}

	//////////////////////////////////////
	// generateTableHeaderHTML - generates the header row for the table.
	// created by FVDS
	//////////////////////////////////////
	static function generateTableHeaderHTML()
	{
		echo "<tr class='exTableRow'>\n";
		echo "<th class='exTableColLineNum'>Item #</th>\n";
		echo "<th class='exTableColDesc'>Description of Work</th>\n";
		echo "<th class='exTableColAmount'>Amount</th>\n";
		echo "</tr>\n";
	}

	//////////////////////////////////////
	// displayLine  - writes out table row for this line
	// $a_dbc - the database
	// $a_lineCount - which line this is.
	// returns: $this->amount
	// created by FVDS
	//////////////////////////////////////
	function displayLine($a_dbc, $a_lineCount)
	{
//varDump(__FUNCTION__, 'ExternalBidSheet: $a_row', $a_row);
		echo "<tr>\n";
		echo "<td>{$a_lineCount}</td>\n";
		echo "<td class='exTableData'><input class='exDescInput' type='text' maxlength='400' name='fname' value='" . $this->workDescription . "'></td>\n";
		echo "<td><input class='exAmtInput' type='number' name='fname' value='" . $this->amount . "'></td>\n";
		echo "</tr>\n";

		return $this->amount;
	}
}

//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
// InternalBidSheetLine - handles the lines for internal bid sheets
//
//	Created by FVDS
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
class InternalBidSheetLine extends Line
{
	protected $lineID=0;
	protected $sheetID=0;
	protected $constructionSpecID=0;
	protected $amount=0;
	protected $subcontractorBidUsed="";
	protected $generalNotes="";

	//////////////////////////////////////
	// saveLine  - loads values to database
	// $a_dbc - the database
	// $a_sheetID  - sheet ID used if $sheetID is 0 (new line)
	// return: Returns true if successful, false if failed.
	// created by FVDS
	//////////////////////////////////////
	function saveLine($a_dbc, $a_sheetID)
	{
		// if this is an existing line...
		if($this->sheetID){
			$sql = "UPDATE `internalbidsheetline`
				SET `ConstructionSpecID`=$this->constructionSpecID, `Amount`=$this->amount, `SubcontractorBidUsed`=$this->subcontractorBidUsed, `GeneralNotes`=$this->generalNotes
				WHERE `LineID`=$this->lineID";

		} else{ // new line.
			$sql = "INSERT INTO `internalbidsheetline` (SheetID, ConstructionSpecID, Amount, SubcontractorBidUsed, GeneralNotes)
				VALUES ('$this->sheetID', '$this->constructionSpecID', '$this->amount', '$this->subcontractorBidUsed', '$this->generalNotes')";
		}

		// update the database
		$result_form_project = @mysqli_query($a_dbc, $sql);

		// check how many rows were impacted.  If 0, it failed.
		if (@mysqli_num_rows($result_form_project) == 0)
		 	return false;
		else
			return true;
	}

	//////////////////////////////////////
	// loadLine  - sets values from database
	// $a_row  - result from datase.
	// created by FVDS
	//////////////////////////////////////
	function loadLine($a_row)
	{
		$this->lineID=$a_row['LineID'];
		$this->sheetID= $a_row['SheetID'];
		$this->constructionSpecID= $a_row['ConstructionSpecID'];
		$this->amount= $a_row['Amount'];
		$this->subcontractorBidUsed= $a_row['SubcontractorBidUsed'];
		$this->generalNotes= $a_row['GeneralNotes'];
	}

	//////////////////////////////////////
	// generateTableHeaderHTML - generates the header row for the table.
	// created by FVDS
	//////////////////////////////////////
	static function generateTableHeaderHTML()
	{
		echo "<tr class='inTableRow'>\n";
		echo "<th class='inTableColTaskID'>Task ID</th>\n";
		echo "<th class='inTableColTaskName'>Task Name</th>\n";
		echo "<th>Subcontractor</th>\n";
		echo "<th class='chTableColAmount'>Amount</th>\n";
		echo "<th>Notes</th>\n";
		echo "</tr>\n";
	}

	//////////////////////////////////////
	// displayLine  - writes out table row for this line
	// $a_dbc - the database
	// $a_lineCount - which line this is.  Not used for Internal lines.
	// returns: $this->amount
	// created by FVDS
	//////////////////////////////////////
	function displayLine($a_dbc, $a_lineCount)
	{
		echo "<tr>\n";
	 	echo "<td>{$this->constructionSpecID}</td>\n";
		echo "<td>";
	 	$this->taskIDSelectBox($a_dbc, $this->constructionSpecID);
		echo "</td>\n";
		echo "<td>{$this->subcontractorBidUsed}</td>\n";
		echo "<td><input class='exAmtInput' type='number' name='fname' value='" . $this->amount . "'></td>\n";
		echo "<td>{$this->generalNotes}<span class='ui-icon ui-icon-info' title='Notes about this task.'></span></td>\n";
		echo "</tr>\n";
		return $this->amount;
	}

	//////////////////////////////////////
	// taskIDSelectBox  - writes out select box
	// $a_dbc - the database
	// $a_specID - current value.
	// created by FVDS
	//////////////////////////////////////
	function taskIDSelectBox($a_dbc, $a_specID)
	{
//varDump(__FUNCTION__, 'a_specID', $a_specID);
 		$div =  (int)($a_specID/1000);
//varDump(__FUNCTION__, 'div', $div);

 		$sql = "SELECT * FROM `task` WHERE `taskDivision`=" . $div;
 		$result = @mysqli_query($a_dbc, $sql);
//varDump(__FUNCTION__, 'result', $result);

		echo "<select class='taskIDSelect'>\n";

 		while($row = @mysqli_fetch_array($result))
 		{
 			// if current value, make it selected.
 			if($row['TaskID'] == $a_specID){
 				echo "<option value='" . $row['TaskName'] . "' selected>{$row['TaskName']}</option>\n";
 			}
			else
  				echo "<option value='" . $row['TaskName'] . "'>{$row['TaskName']}</option>\n";
		}
		echo "</select>\n";
  		echo "<span class='ui-icon ui-icon-info' title='" . $row['TaskDescription'] . "'></span>";
	}
}

//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
// ProjectDescriptionLine - a line from a project description sheet.
//
//	Created by FVDS
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
class ProjectDescriptionLine extends Line
{
	protected $lineID=0;
	protected $sheetID=0;
	protected $text="";

	//////////////////////////////////////
	// saveLine  - loads values to database
	// $a_dbc - the database
	// $a_sheetID  - sheet ID used if $sheetID is 0 (new line)
	// return: Returns true if successful, false if failed.
	// created by FVDS
	//////////////////////////////////////
	function saveLine($a_dbc, $a_sheetID)
	{
		// if this is an existing line...
		if($this->sheetID){
			$sql = "UPDATE `projectdescriptionline`
				SET `Text`=$this->text
				WHERE `LineID`=$this->lineID";

		} else{ // new line.
			$sql = "INSERT INTO `projectdescriptionline` (`SheetID`, `Text`)
				VALUES ('$this->sheetID', '$this->text')";
		}

		// update the database
		$result_form_project = @mysqli_query($a_dbc, $sql);

		// check how many rows were impacted.  If 0, it failed.
		if (@mysqli_num_rows($result_form_project) == 0)
		 	return false;
		else
			return true;
	}

	//////////////////////////////////////
	// loadLine  - sets values from database
	// $a_row  - result from datase.
	// created by FVDS
	//////////////////////////////////////
	function loadLine($a_row)
	{
		$this->lineID=$a_row['LineID'];
		$this->sheetID=$a_row['SheetID'];
		$this->text=$a_row['Text'];
	}

	//////////////////////////////////////
	// displayLine  - writes out table row for this line
	// $a_dbc - the database
	// $a_lineCount - which line this is.  Not used for project description lines.
	// returns: $this->amount
	// created by FVDS
	//////////////////////////////////////
	function displayLine($a_dbc, $a_lineCount)
	{
	 	echo "<p>{$this->text}</p>\n";
		return null;
	}

	//////////////////////////////////////
	// generateTableHeaderHTML - Adds a starting paragraph header.
	// - NOTE: contrary to function name, does not make anything table related.
	// created by FVDS
	//////////////////////////////////////
	static function generateTableHeaderHTML()
	{
		echo "<p class='description-left-title'>Description:</p>\n";
	}
}

?>
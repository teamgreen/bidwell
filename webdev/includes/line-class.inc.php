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
	static function generateTableHeaderHTML(){}
	static function displayTotal($a_amount){}
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
	// saveLine  - saves  values to database
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

		} else if ( $this->amount != 0 || $this->workDescription != "" ) { // new line with content.
			$sql = "INSERT INTO `externalbidsheetline` (SheetID, WorkDescription, Amount)
				VALUES ('$a_sheetID', '$this->workDescription', '$this->amount')";
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
		// lines without an idea are new.  Class 'em so the js script knows it
		if($this->lineID)
			echo "<tr class='existingLine' data-lineID='". $this->lineID."'>\n";
		else
			echo "<tr class='newLine'>\n";
		echo "<td class='exLineNum'>{$a_lineCount}</td>\n";
		echo "<td class='exTableData'><input class='exDescInput' type='text' maxlength='400' name='fname' value='" . htmlspecialchars($this->workDescription, ENT_QUOTES) . "'></td>\n";
		echo "<td><input class='exAmtInput' type='number' name='fname' value='" . $this->amount . "'></td>\n";
		echo "</tr>\n";

		return $this->amount;
	}

	//////////////////////////////////////
	// displayTotal - builds a table row for a total amount.
	// $a_amount - the total to show
	// created by FVDS
	//////////////////////////////////////
	static function displayTotal($a_amount)
	{
		echo "<tr>\n";
		echo "<td></td>\n";
		echo "<td class='exTableTotal'>Total:</td>\n";
		echo '<td class="exTotal">$' . $a_amount . "</td>\n";
		echo "</tr>\n";
	}
}
// end ExternalBidSheetLine

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
	protected $taskID=0;
	protected $amount=0;
	protected $subcontractorBidUsed="";
	protected $generalNotes="";

	function setTaskID($a_value){$this->taskID = $a_value;}
	function getTaskID(){return $this->taskID;}


	//////////////////////////////////////
	// saveLine  - saves values to database
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
				SET `TaskID`=$this->taskcID, `Amount`=$this->amount, `SubcontractorBidUsed`=$this->subcontractorBidUsed, `GeneralNotes`=$this->generalNotes
				WHERE `LineID`=$this->lineID";

		} else if ( $this->generalNotes != "" || $this->subcontractorBidUsed != "" || $this->Amount != 0 || $this->taskID !=0) { // new line with content.
			$sql = "INSERT INTO `internalbidsheetline` (SheetID, TaskID, Amount, SubcontractorBidUsed, GeneralNotes)
				VALUES ('$a_sheetID', '$this->taskID', '$this->amount', '$this->subcontractorBidUsed', '$this->generalNotes')";
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
		$this->taskID= $a_row['TaskID'];
		$this->amount= $a_row['Amount'];
		$this->subcontractorBidUsed= $a_row['SubcontractorBidUsed'];
		$this->generalNotes= $a_row['GeneralNotes'];
	}

	//////////////////////////////////////
	// generateTableHeaderHTML - generates the header row for the table.
	// $a_div - the div we are on.
	// created by FVDS
	//////////////////////////////////////
	static function generateTableHeaderHTML($a_div)
	{
		echo "<tr class='inTableRow'>\n";
//		echo "<th class='inTableColTaskID'>Task ID</th>\n";
		echo "<th class='inTableColTaskName'>{$a_div}</th>\n";
		echo "<th>Subcontractor</th>\n";
		echo "<th class='chTableColAmount'>Amount</th>\n";
		echo "<th>Notes</th>\n";
		echo "</tr>\n";
	}

	//////////////////////////////////////
	// generateTableHeaderHTML - generates the header row for the table.
	// $a_div - the div we are on.
	// created by FVDS
	//////////////////////////////////////
	static function generateTotalHTML($a_amount)
	{
		echo "<tr class='inTableRow'>\n";
//		echo "<th class='inTableColTaskID'>Task ID</th>\n";
		echo "<th class='inTableColTaskName'></th>\n";
		echo "<th></th>\n";
		echo "<th class='chTableColAmount inTableTotal'>Total:</th>\n";
		echo "<th class='inTotal'>$a_amount</th>\n";
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
		// lines without an idea are new.  Class 'em so the js script knows it
		if($this->lineID)
			echo "<tr class='existingLine'>\n";
		else
			echo "<tr class='newLine'>\n";
//	 	echo "<td>{$this->taskID}</td>\n";
		echo "<td>";
	 	$this->taskIDSelectBox($a_dbc, $this->taskID);
		echo "</td>\n";
		echo "<td class='inTableData'><input class='inSubCon' type='text' maxlength='400' name='fname' value='" . htmlspecialchars($this->subcontractorBidUsed, ENT_QUOTES) . "'></td>\n";
		echo "<td><input class='inAmtInput' type='number' name='fname' value='" . $this->amount . "'></td>\n";
		//echo "<td>{$this->generalNotes}<span class='ui-icon ui-icon-info' title='Notes about this task.'></span></td>\n";
		echo "<td class='inTableData'><input class='inSubCon' type='text' maxlength='1000' name='fname' value='" . htmlspecialchars($this->generalNotes, ENT_QUOTES) . "'></td>\n";
		echo "</tr>\n";
		return $this->amount;
	}

	static function displayTotal($a_amount, $a_header)
	{
		echo "<tr>\n";
		echo "<td></td>\n";
		echo "<td></td>\n";
		echo "<td class='inTableTotal'>{$a_header}:</td>\n";
		echo '<td>$' . $a_amount . "</td>\n";
		echo "</tr>\n";	
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

 		if($div == 0)
 			$div = 1;
//varDump(__FUNCTION__, 'div', $div);

 		$sql = "SELECT * FROM `task` WHERE `taskDivision`=" . $div;
 		$result = @mysqli_query($a_dbc, $sql);
//varDump(__FUNCTION__, 'result', $result);

		echo "<select class='taskIDSelect'>\n";

 		while($row = @mysqli_fetch_array($result))
 		{
 			// if current value, make it selected.
 			if($row['TaskID'] == $a_specID){
 				echo "<option value='" . $row['TaskID'] . "' selected>" . $row['TaskID']. "-" . htmlspecialchars($row['TaskName'], ENT_QUOTES) . "</option>\n";
 			}
			else
  				echo "<option value='" . $row['TaskID'] . "'>" . $row['TaskID']. "-" . htmlspecialchars($row['TaskName'], ENT_QUOTES) . "</option>\n";
		}
		echo "</select>\n";
  		echo "<span class='ui-icon ui-icon-info' title='" .  htmlspecialchars($row['TaskDescription'], ENT_QUOTES) . "'></span>";
	}
}
// end InternalBidSheetLine

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
	// saveLine  - saves values to database
	// $a_dbc - the database
	// $a_sheetID  - sheet ID used if $sheetID is 0 (new line)
	// return: Returns true if successful, false if failed.
	// created by FVDS
	//////////////////////////////////////
	function saveLine($a_dbc, $a_sheetID)
	{
		// if this is an existing line...
		if($this->sheetID){
			// should do something with deleted lines.  However, don't want to delete them.  Rather flag them.
			if(1) { //$this->text != ""){
				$sql = "UPDATE `projectdescriptionline`
					SET `Text`=$this->text
					WHERE `LineID`=$this->lineID";
			}
		} else if( $this->text != "" ) { // new line with content
			$sql = "INSERT INTO `projectdescriptionline` (`SheetID`, `Text`)
				VALUES ('$a_sheetID', '$this->text')";
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
		if($this->lineID)
			echo "<textarea class='newLine'>{$this->text}</textarea>\n";
		else
		 	echo "<textarea class='newLine'>{$this->text}</textarea>\n";

		return null;
	}

	//////////////////////////////////////
	// generateTableHeaderHTML - Adds a starting paragraph header.
	// - NOTE: contrary to function name, does not make anything table related.
	// created by FVDS
	//////////////////////////////////////
	static function generateTableHeaderHTML()
	{
		echo "<p class=left>Description:</p>\n";
	}
}
// end ProjectDescriptionLine

?>

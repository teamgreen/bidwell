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
	// $a_lineCount - which line this is. Not used here.
	// returns: null
	// created by FVDS
	//////////////////////////////////////
	function displayLine($a_lineCount)
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
	// displayLine  - writes out table row for this line
	// $a_lineCount - which line this is.
	// returns: $this->amount
	// created by FVDS
	//////////////////////////////////////
	function displayLine($a_lineCount)
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
	// displayLine  - writes out table row for this line
	// $a_lineCount - which line this is.  Not used for Internal lines.
	// returns: $this->amount
	// created by FVDS
	//////////////////////////////////////
	function displayLine($a_lineCount)
	{
		echo "<tr>\n";
	 	echo "<td>{$this->constructionSpecID}</td>";
		echo "<td>Lorem Ipsum <span class='ui-icon ui-icon-info' title='Info about what type of things this task heading covers here.'></span></td>\n";
		echo "<td>{$this->subcontractorBidUsed}</td>\n";
		echo "<td><input class='exAmtInput' type='number' name='fname' value='" . $this->amount . "'></td>\n";
		echo "<td>{$this->generalNotes}<span class='ui-icon ui-icon-info' title='Notes about this task.'></span></td>\n";
		echo "</tr>\n";
		return $this->amount;
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
	// $a_lineCount - which line this is.  Not used for project description lines.
	// returns: $this->amount
	// created by FVDS
	//////////////////////////////////////
	function displayLine($a_lineCount)
	{
	 	echo "<p>{$this->text}</p>\n";
		return null;
	}
}

//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
// Sheet - base class for the various sheets.
//
//	Created by FVDS
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
class Sheet
{
	const eExternalBidSheet = "ExternalBidSheet";
	const eInternalBidSheet = "InternalBidSheet";
	const eChangeBidSheet = "ChangeBidSheet";
	const eProjectDescriptionSheet = "ProjectDescriptionSheet";

	protected $sheetID; 	//int(32) 	No  	  	 
	protected $date; 	//date 	No  	  	 
	protected $contractorFee; 	//decimal(16,0) 	No  	  	 
	protected $sheetType; 	//varchar(40) 	No  	  	 
	protected $name; 	//varchar(100) 	No  	  	 
	protected $description; 	//varchar(1000)
	protected $lastUpdate;  //timedate

	protected $sheetLinesResults = null;

	// the lines associated with this sheet
	protected $lines=array();

	// get functions
	function getSheetID(){ return $this->sheetID; }
	function getDate(){ return $this->date; }
	function getContractorFee(){ return $this->contractorFee; }
	function getSheetType(){ return $this->sheetType; }
	function getName(){ return $this->name; }
	function getDescription(){ return $this->description; }

	//set functions
	function setSheetID($var){ $this->sheetID=$var ; }
	function setDate($var){ $this->date=$var ; }
	function setContractorFee($var){ $this->contractorFee=$var ; }
	function setSheetType($var){ $this->sheetType=$var ; }
	function setName($var){ $this->name=$var ; }
	function setDescription($var){ $this->description=$var ; }

	// empty functions that any inheritors should define.
	function generateLineHMTL($a_row) {}
	function generateTableHeaderHTML() {}
	function displayTotal($a_amount){}
	function getLines($a_dbc){}
	function loadLinesFromDatabase($a_dbc){}

	//////////////////////////////////////
	// loadSheetFromDatabase - given a sheet ID, will initialize the class instance
	// 		with the variables from the database.
	// a_dbc - the database
	// a_sheetID - the ID number of the sheet we want to load.
	//////////////////////////////////////
	function loadSheetFromDatabase($a_dbc, $a_sheetID)
	{
//varDump(__FUNCTION__, "a_sheetID", $a_sheetID);

		$this->sheetID = $a_sheetID;

		if($this->sheetID){
			$sql="SELECT * FROM `sheet` WHERE `SheetID`=$this->sheetID";
			$result = @mysqli_query($a_dbc, $sql);
			$sheet = @mysqli_fetch_array($result);

			$this->date = $sheet['Date'];
			$this->contractorFee = $sheet['ContractorFee'];
			$this->sheetType = $sheet['SheetType'];
			$this->name = $sheet['Name'];
			$this->description = $sheet['Description'];
			$this->lastUpdate = $sheet['LastUpdate'];
//varDump(__FUNCTION__, "this sheet", $this);
//require_once('Doesnotexist.txt');

			//now load the lines.
			$this->loadLinesFromDatabase($a_dbc);
		}
	}

	//////////////////////////////////////
	// loadSheetFromResult - given a sheet result, will initialize the class instance
	// 		with the variables from the database.
	// a_dbc - the database
	// a_result - a result that is a sheet from the database
	//////////////////////////////////////
	function loadSheetFromResult($a_dbc, $a_result)
	{
//varDump(__FUNCTION__, '$a_dbc', $a_dbc );
//varDump(__FUNCTION__, '$a_result', $a_result );
		if($a_result){
			$this->sheetID = $a_result['SheetID'];
			$this->date = $a_result['Date'];
			$this->contractorFee = $a_result['ContractorFee'];
			$this->sheetType = $a_result['SheetType'];
			$this->name = $a_result['Name'];
			$this->description = $a_result['Description'];
			$this->lastUpdate = $a_result['LastUpdate'];
//varDump(__FUNCTION__, "this sheet", $this);

			//now load the lines.
			$this->loadLinesFromDatabase($a_dbc);
		}
	}

	//////////////////////////////////////
	// saveSheetToDatabase - will update the database with the sheet's current values,
	// 		including any lines associated with the sheet
	// a_dbc - the database
	// created by FVDS
	//////////////////////////////////////
	function saveSheetToDatabase($a_dbc)
	{
		// function not complete yet.

		// save the sheet
		// sql to set the current time to now.
		$sql = "UPDATE `Bid-well`.`sheet` SET `LastUpdate` =now() WHERE `sheet`.`SheetID` =1;";

		// and now its lines.
		foreach ($this->lines as $i) {
			$i->saveLine($this->sheetID);
		}
	}

	//////////////////////////////////////
	// returnLineRow  -fetches the next line for this sheet
	// returns: the next line.
	// created by FVDS
	//////////////////////////////////////
	function returnLineRow()
	{
//varDump(__FUNCTION__, 'sheetLinesResults', $this->sheetLinesResults);
		return @mysqli_fetch_array($this->sheetLinesResults);
	}

	//////////////////////////////////////
	// generateLinesTableHTML - builds a table using data grabbed from the database.
	// $a_dbc - the database
	// created by FVDS
	//////////////////////////////////////
	function generateLinesTableHTML($a_dbc)
	{
		// all of this in a form.
		echo "<form>\n";

		// start a table.
		echo "<table>\n";

		$lineCount=0;
		$total=0;

		//add the header
		$this->generateTableHeaderHTML();

		foreach ($this->lines as $i) {
			$i->displayLine(++$lineCount);
		}

		//now display the total if needed.
		$this->displayTotal($total);

		// and close the table
		echo "</table>\n";

		// and the form.
		echo "</form>\n";
	}
}

//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
//	ProjectDescriptionSheet - class to handle the various things PDS's need to do.
//	- inherits from Sheet
//	Created by FVDS
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
class ProjectDescriptionSheet extends Sheet
{
	//////////////////////////////////////
	// loadLinesFromDatabase  -fetches the next line for this sheet
	// a_dbc - the database
	//////////////////////////////////////
	function loadLinesFromDatabase($a_dbc)
	{
		$sql="SELECT * FROM `projectdescriptionline` WHERE `SheetID`=$this->sheetID";
		$results = @mysqli_query($a_dbc, $sql);

		while($row=@mysqli_fetch_array($results)){
			$newLine = new ProjectDescriptionLine();
			$newLine->loadLine($row);
			$this->lines[count($this->lines)] = $newLine;			
		}
	}

	//////////////////////////////////////
	// getLines - grabs the lines related to this sheet from the database.
	// 		Stores the results in sheetLinesResults.
	// created by FVDS
	//////////////////////////////////////
	function getLines($a_dbc)
	{
		$sql="SELECT * FROM `projectdescriptionline` WHERE `SheetID`=$this->sheetID";
		$this->sheetLinesResults = @mysqli_query($a_dbc, $sql);
	}

	//////////////////////////////////////
	// generateLinesTableHTML - builds the html data grabbed from the database.
	// - NOTE: contrary to the name, this is not a table for this sheet type
	// $a_dbc - the database
	// created by FVDS
	//////////////////////////////////////
	function generateLinesTableHTML($a_dbc)
	{

		$this->generateTableHeaderHTML();
		// all of this in a form.
		echo "<form>\n";
	 	echo "<div class='description-left'>\n";

	 	//write the paragraphs
		foreach ($this->lines as $i) {
			$i->displayLine(0);
		}

		// close the div
		echo "</div>";

		// and the form.
		echo "</form>\n";
	}

	//////////////////////////////////////
	// generateTableHeaderHTML - Adds a starting paragraph header.
	// - NOTE: contrary to function name, does not make anything table related.
	// created by FVDS
	//////////////////////////////////////
	function generateTableHeaderHTML()
	{
		echo "<p class='description-left-title'>Description:</p>\n";
	}

	//////////////////////////////////////
	// generateLineHTML - builds a table fow using data grabbed from the database.
	// $a_row - a row from a previous result
	// created by FVDS
	//////////////////////////////////////
	function generateLineHTML($a_row)
	{
//varDump(__FUNCTION__, '$a_row', $a_row);
	 	echo "<p>{$a_row['Text']}</p>\n";
	 	return 0;
	}
}

//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
// InternalBidSheet - class to handle functionality specific to IBS's
//	- Inherits from Sheet
//	Created by FVDS
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
class InternalBidSheet extends Sheet
{
	//////////////////////////////////////
	// loadLinesFromDatabase  -fetches the next line for this sheet
	// a_dbc - the database
	// created by FVDS
	//////////////////////////////////////
	function loadLinesFromDatabase($a_dbc)
	{
		$sql="SELECT * FROM `internalbidsheetline` WHERE `SheetID`=$this->sheetID";
		$results = @mysqli_query($a_dbc, $sql);
		// load the lines.
		while($row=@mysqli_fetch_array($results)){
			$newLine = new InternalBidSheetLine();
			$newLine->loadLine($row);
			$this->lines[count($this->lines)] = $newLine;
//varDump(__FUNCTION__, '$newLine', $newLine);
		}
//varDump(__FUNCTION__, '$this->lines', $this->lines);
	}

	//////////////////////////////////////
	// getLines - grabs the lines related to this sheet from the database.
	// 		Stores the results in sheetLinesResults.
	// created by FVDS
	//////////////////////////////////////
	function getLines($a_dbc)
	{
		$sql="SELECT * FROM `internalbidsheetline` WHERE `SheetID`=$this->sheetID";
		$this->sheetLinesResults = @mysqli_query($a_dbc, $sql);
	}

	//////////////////////////////////////
	// generateTableHeaderHTML - generates the header row for the table.
	// created by FVDS
	//////////////////////////////////////
	function generateTableHeaderHTML()
	{
		echo "<tr class='inTableRow'>\n";
		echo "<th class='inTableColTaskID'>Task ID</th>\n";
		echo "<th>Task Name</th>\n";
		echo "<th>Subcontractor</th>\n";
		echo "<th class='chTableColAmount'>Amount</th>\n";
		echo "<th>Notes</th>\n";
		echo "</tr>\n";
	}

	//////////////////////////////////////
	// displayTotal - builds a table row for a total amount.
	// $a_amount - the total to show
	// created by FVDS
	//////////////////////////////////////
	function displayTotal($a_amount){

	}

}

//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
// ChangeBidSheet - class to handle functionality of CBS's
//	- Inherits from Sheet
//	Created by FVDS
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
class ChangeBidSheet extends Sheet
{
	//////////////////////////////////////
	// loadLinesFromDatabase  -fetches the next line for this sheet
	// a_dbc - the database
	// created by FVDS
	//////////////////////////////////////
	function loadLinesFromDatabase($a_dbc)
	{
		$sql="SELECT * FROM `externalbidsheetline` WHERE `SheetID`=$this->sheetID";
		$results = @mysqli_query($a_dbc, $sql);
		// load the lines.
		while($row=@mysqli_fetch_array($results)){
			$newLine = new ExternalBidSheetLine();
			$newLine->loadLine($row);
			$this->lines[count($this->lines)] = $newLine;
//varDump(__FUNCTION__, '$newLine', $newLine);

		}
//varDump(__FUNCTION__, '$this->lines', $this->lines);
	}

	//////////////////////////////////////
	// getLines - grabs the lines related to this sheet from the database.
	// 		Stores the results in sheetLinesResults.
	// created by FVDS
	//////////////////////////////////////
	function getLines($a_dbc)
	{
		$sql="SELECT * FROM `externalbidsheetline` WHERE `SheetID`=$this->sheetID";
		$this->sheetLinesResults = @mysqli_query($a_dbc, $sql);
	}

	//////////////////////////////////////
	// generateTableHeaderHTML - generates the header row for the table.
	// created by FVDS
	//////////////////////////////////////
	function generateTableHeaderHTML()
	{
		echo "<tr class='chTableRow'>\n";
		echo "<th class='chTableColLineNum'>Item #</th>\n";
		echo "<th class='chTableColDesc'>Description of Work</th>\n";
		echo "<th class='chTableColAmount'>Amount</th>\n";
		echo "</tr>\n";
	}

	//////////////////////////////////////
	// displayTotal - builds a table row for a total amount.
	// $a_amount - the total to show
	// created by FVDS
	//////////////////////////////////////
	function displayTotal($a_amount)
	{
		echo "<tr>\n";
		echo "<td></td>\n";
		echo "<td class='chTableTotal'>Total:</td>\n";
		echo '<td>$' . $a_amount . "</td>\n";
		echo "</tr>\n";
	}
}

//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
//	ExternalBidSheet - class to handle functionality of EBS's
//	- Inherits from Sheet
//	Created by FVDS
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
class ExternalBidSheet extends Sheet
{
	//////////////////////////////////////
	// loadLinesFromDatabase  -fetches the next line for this sheet
	// a_dbc - the database
	// created by FVDS
	//////////////////////////////////////
	function loadLinesFromDatabase($a_dbc)
	{
		$sql="SELECT * FROM `externalbidsheetline` WHERE `SheetID`=$this->sheetID";
		$results = @mysqli_query($a_dbc, $sql);
		// load the lines.
		while($row=@mysqli_fetch_array($results)){
			$newLine = new ExternalBidSheetLine();
			$newLine->loadLine($row);
			$this->lines[count($this->lines)] = $newLine;
//varDump(__FUNCTION__, '$newLine', $newLine);

		}
//varDump(__FUNCTION__, '$this->lines', $this->lines);
	}

	//////////////////////////////////////
	// getLines - grabs the lines related to this sheet from the database.
	// 		Stores the results in sheetLinesResults.
	// created by FVDS
	//////////////////////////////////////
	function getLines($a_dbc)
	{
		$sql="SELECT * FROM `externalbidsheetline` WHERE `SheetID`=$this->sheetID";
		$this->sheetLinesResults = @mysqli_query($a_dbc, $sql);
	}

	//////////////////////////////////////
	// generateTableHeaderHTML - generates the header row for the table.
	// created by FVDS
	//////////////////////////////////////
	function generateTableHeaderHTML()
	{
		echo "<tr class='exTableRow'>\n";
		echo "<th class='exTableColLineNum'>Item #</th>\n";
		echo "<th class='exTableColDesc'>Description of Work</th>\n";
		echo "<th class='exTableColAmount'>Amount</th>\n";
		echo "</tr>\n";
	}

	//////////////////////////////////////
	// displayTotal - builds a table row for a total amount.
	// $a_amount - the total to show
	// created by FVDS
	//////////////////////////////////////
	function displayTotal($a_amount)
	{
		echo "<tr>\n";
		echo "<td></td>\n";
		echo "<td class='exTableTotal'>Total:</td>\n";
		echo '<td>$' . $a_amount . "</td>\n";
		echo "</tr>\n";
	}
}

//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
//	Project - class to store variables found in the project table, with the ability
// 		to grab values from the server, and to update the values found there.
//
//	Created by FVDS
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
class Project
{
	const eOwnerAddress = 1;
	const eArchitectAddress = 2;
	const eSiteAddress =3;

	private $projectID=0; 	//int(32)  	  	 
	private $projectName="projectclass"; 	//varchar(100)  	  	 
	private $projectDescription; 	//varchar(1000)  	  	 
	private $projectDateEntered; 	//date
	private $projectDueDate; 	//date  	  	 
	private $projectStatusID; 	//int(32)  	  	 
	private $owner; 	//varchar(100)  	  	 
	private $ownerPhone; 	//varchar(40)  	  	 
	private $ownerCellPhone; 	//varchar(40)  	  	 
	private $ownerEmail; 	//varchar(40)  	  	 
	private $ownerAddressID; 	//int(32)  	  	 
	private $architect; 	//varchar(100)  	  	 
	private $architectAddressID; 	//int(32)  	  	 
	private $architectPhone; 	//varchar(40)  	  	 
	private $architectCellPhone; 	//varchar(40)  	  	 
	private $architectEmail; 	//varchar(100)  	  	 
	private $siteAddressID; 	//int(32)  	  	 
	private $projectNotes; 	//varchar(4000)  	  	 
	private $companyID; 	//int(32)

	private $lastGetSheetIDsResults=null;
	private $lastSheetResult=null;
	private $curSheet=null;

	// constructor
	public function  __construct($a_id)
	{
		$this->projectID=$a_id;
	}

	//get functions
	function getProjectID(){	return $this->projectID; } 
	function getProjectName(){ return $this->projectName;} 	//varchar(100)  	  	 
	function getProjectDescription(){ return $this->projectDescription; }	  	 
	function getProjectDateEntered(){ return $this->projectDateEntered; }
	function getProjectDueDate(){ return $this->projectDueDate; }		  	 
	function getProjectStatusID(){ return $this->projectStatusID; } 	  	 
	function getOwner(){ return $this->owner; }
	function getOwnerPhone(){ return $this->ownerPhone; }
	function getOwnerCellPhone(){ return $this->ownerCellPhone; }
	function getOwnerEmail(){ return $this->ownerEmail; }
	function getOwnerAddressID(){ return $this->ownerAddressID; }  	  	 
	function getArchitect(){ return $this->architect; }
	function getArchitectAddressID(){ return $this->architectAddressID; }
	function getArchitectPhone(){ return $this->architectPhone; } 	  	 
	function getArchitectCellPhone(){ return $this->architectCellPhone; } 	  	 
	function getArchitectEmail(){ return $this->architectEmail; } 	  	 
	function getSiteAddressID(){ return $this->siteAddressID; } 	  	 
	function getProjectNotes(){ return $this->projectNotes; }
	function getCompanyID(){ return $this->companyID; } 

	//set functions
	function setProjectID($value){ $this->projectID = $value; } 
	function setProjectName($value){ $this->projectName = $value; }	  	 
	function setProjectDescription($value){ $this->projectDescription = $value; }	  	 
	function setProjectDateEntered($value){ $this->projectDateEntered = $value; }
	function setProjectDueDate($value){ $this->projectDueDate = $value; }  	 
	function setProjectStatusID($value){ $this->projectStatusID = $value; } 	  	 
	function setOwner($value){ $this->owner = $value; }
	function setOwnerPhone($value){ $this->ownerPhone = $value; }
	function setOwnerCellPhone($value){ $this->ownerCellPhone = $value; }
	function setOwnerEmail($value){ $this->ownerEmail = $value; }
	function setOwnerAddressID($value){ $this->ownerAddressID = $value; }  	  	 
	function setArchitect($value){ $this->architect = $value; }
	function setArchitectAddressID($value){ $this->architectAddressID = $value; }
	function setArchitectPhone($value){ $this->architectPhone = $value; } 	  	 
	function setArchitectCellPhone($value){ $this->architectCellPhone = $value; } 	  	 
	function setArchitectEmail($value){ $this->architectEmail = $value; } 	  	 
	function setSiteAddressID($value){ $this->siteAddressID = $value; } 	  	 
	function setProjectNotes($value){ $this->projectNotes = $value; }
	function setCompanyID($value){ $this->companyID = $value; }

	//////////////////////////////////////
	// displayProjectSheetOfType - displays the latest sheet of a given type or with
	//		a particular ID.
	// $a_dbc - the database.
	// $a_type - the type of sheet to get
	// $a_sheetID - the sheet to get.  If this is null, will get all sheets of the given type
	//		and use the most recently updated one.
	// created by FVDS
	//////////////////////////////////////
	function displayProjectSheetOfType($a_dbc, $a_type, $a_sheetID)
	{	
		if($a_sheetID == null)
			$this->getSheetsByType($a_dbc, $a_type);
		else
			$this->getSheetByID($a_dbc, $a_sheetID);

// varDump("project.php", 'getSheetsByType()', $project);

		$row = $this->returnSheetRow();

		echo "<h3>" . $row['Name'] . "</h3>\n";
		echo "<div>\n";

		switch ($a_type){
			case Sheet::eExternalBidSheet:
				$curSheet = new ExternalBidSheet();
				break;
			case Sheet::eChangeBidSheet:
				$curSheet = new ChangeBidSheet();
				break;
			case Sheet::eInternalBidSheet:
				$curSheet = new InternalBidSheet();
				break;
			case Sheet::eProjectDescriptionSheet:
				$curSheet = new ProjectDescriptionSheet();
				break;
			default:
				//Should not get here.
				break;
		}
		$curSheet->loadSheetFromResult($a_dbc, $row);
// varDump("project.php", "tab 4", $sheet);
		$curSheet->generateLinesTableHTML($a_dbc);
		echo "</div>\n";
	}	

	//////////////////////////////////////
	// loadProjectFromDatabase - grabs the values for the project's ID from the database
	// 		and stores them in the class's variables.
	// $a_dbc - the database
	// created by FVDS
	//////////////////////////////////////
	public function loadProjectFromDatabase($a_dbc)
	{
		if($this->projectID){
//echo "<p>Loading project " . $this->projectID . "</p>";
			$sql="SELECT * FROM `project` WHERE `ProjectID`=$this->projectID";
//echo "<p>" . $sql . "</p>";
			$result = @mysqli_query($a_dbc, $sql);
//echo "<p>result dump:</p>";
//var_dump($result);
			$project = @mysqli_fetch_array($result);
//echo "<p>project dump:</p>";
//var_dump($project);

			$this->projectName=$project['ProjectName']; 	//varchar(100) 	  	 
			$this->projectDescription=$project['ProjectDescription']; 	//varchar(1000) 	  	 
			$this->projectDateEntered=$project['ProjectDateEntered']; 	//date 
			$this->projectDueDate=$project['ProjectDueDate']; 	//date 	  	 
			$this->projectStatusID=$project['ProjectStatusID']; 	//int(32) 	  	 
			$this->owner=$project['Owner']; 	//varchar(100) 	  	 
			$this->ownerPhone=$project['OwnerPhone']; 	//varchar(40) 	  	 
			$this->ownerCellPhone=$project['OwnerCellPhone']; 	//varchar(40) 	  	 
			$this->ownerEmail=$project['OwnerEmail']; 	//varchar(40) 	  	 
			$this->ownerAddressID=$project['OwnerAddressID']; 	//int(32) 	  	 
			$this->architect=$project['Architect']; 	//varchar(100) 	  	 
			$this->architectAddressID=$project['ArchitectAddressID']; 	//int(32) 	  	 
			$this->architectPhone=$project['ArchitectPhone']; 	//varchar(40) 	  	 
			$this->architectCellPhone=$project['ArchitectCellPhone']; 	//varchar(40) 	  	 
			$this->architectEmail=$project['ArchitectEmail']; 	//varchar(100) 	  	 
			$this->siteAddressID=$project['SiteAddressID']; 	//int(32) 	  	 
			$this->projectNotes=$project['ProjectNotes']; 	//varchar(4000) 	  	 
			$this->companyID=$project['CompanyID']; 	//int(32) 
		}
	}

	//////////////////////////////////////
	// addProjectToDatabase - adds the project to the database
	// WARNING: out of date with some new values.  Check with Alex before using
	// created by FVDS
	//////////////////////////////////////
	function addProjectToDatabase($a_dbc)
	{
		// add the current date in there.
		$sql_form_project = "INSERT INTO `project` (ProjectName, ProjectDescription, ProjectDueDate, Owner, OwnerPhone, OwnerCellPhone, OwnerEmail, Architect, ArchitectPhone, ArchitectCellPhone, ArchitectEmail, ProjectNotes)
			VALUES ('$this->projectName', '$this->projectDescription', '$this->projectDueDate', '$this->ownerName', '$this->ownerPhone', '$this->ownerCellphone', '$this->ownerEmail', '$this->architectName', '$this->architectPhone', '$this->architectCellphone', '$this->architectEmail', '$this->projectNotes')";

		$result_form_project = @mysqli_query($a_dbc, $sql_form_project);

		$num_rows_form_project = @mysqli_num_rows($result_form_project);
		
		if ($num_rows_form_project == 0) {
		 	echo "<p>We apologize for the inconvenience, but the following information has not been received:\n";
		 	echo "Project Information\n</p>";
		}
	}

	//////////////////////////////////////
	// addAddress - This function should add an address to the database
	// created by FVDS
	//////////////////////////////////////
	function addAddress($a_dbc, $slot, $address1, $address2, $city, $state, $zipcode)
	{

	}

	//////////////////////////////////////
	// getAddress - this function gets an address from the database
	// $a_dbc - the database
	// $a_slot - the type of address.  Use the enum in Project for values.
	// return: the search result.
	// created by FVDS
	//////////////////////////////////////
	function getAddress($a_dbc, $a_slot)
	{
		$addressId = null;
		switch($slot){
			case Project::eOwnerAddress:
				$addressId = $this->ownerAddressID;
				break;
			case Project::eArchitectAddress:
				$addressId = $this->architectAddressID;
				break;
			case Project::eSiteAddress:
				$addressId = $this->siteAddressID;
				break;
			default:
				return null;
				break;
		}

		$sql = "SELECT * FROM `address` WHERE AddressID='" . $addressId . "'";
		return @mysqli_query($a_dbc, $sql);
	}

	private function getSheetIDs($a_dbc){
		$sql="SELECT * FROM `project|sheet` WHERE `ProjectID`=" . $this->projectID;
//varDump(__FUNCTION__, "sql", $sql);
		$this->lastGetSheetIDsResults = @mysqli_query($a_dbc, $sql);
//varDump(__FUNCTION__, "lastGetSheetIDsResults", $this->lastGetSheetIDsResults);
	}

	//////////////////////////////////////
	// getSheetByID - gets a sheet with a given ID.  stores the sheet in lastSheetResult
	// $a_dbc - the database.
	// $a_sheetID - the ID of the sheet to get.
	// return: the result of the search
	// created by FVDS
	//////////////////////////////////////
	function getSheetByID($a_dbc, $a_sheetID)
	{
		$sql = "SELECT * FROM `sheet` WHERE `SheetID`='" . $a_sheetID . "'";
		$this->lastSheetResult =  @mysqli_query($a_dbc, $sql);
		return $this->lastSheetResult;
	}

	//////////////////////////////////////
	// getSheetsByType - builds an sql result of all sheets of a given type for
	//		this project.  Save the value in lastSheetResult
	// $a_dbc - the database
	// $a_sheetType - the type of sheet.  Use the enum from the Sheet class.
	// return: the result of the search
	// created by FVDS
	//////////////////////////////////////
	function getSheetsByType($a_dbc, $a_sheetType)
	{
		// get the sheets that go with this project
		$this->getSheetIDs($a_dbc);
		$row_sheet = @mysqli_fetch_array($this->lastGetSheetIDsResults);
// varDump(__FUNCTION__, "row_sheet", $row_sheet);
		// if we found nothing...
		if(!$row_sheet)
			return null;

		// now we build our search string...
		$sql = "SELECT * FROM `sheet` WHERE `SheetType`='" . $a_sheetType . "' AND (";

		// stack on the first one.
		$sql = $sql . "`SheetID`=" . $row_sheet['SheetID'];

		// and now for any others...
		while($row_sheet = @mysqli_fetch_array($this->lastGetSheetIDsResults)){
			$sql = $sql . " OR `SheetID`=" . $row_sheet['SheetID'];
		}
		// add ending parentheses and sort it desc so last changed doc is first.
		$sql = $sql . ") ORDER BY `LastUpdate` DESC";
//varValue(__FUNCTION__,'$sql', $sql);
		$this->lastSheetResult = @mysqli_query($a_dbc, $sql);
//varDump(__FUNCTION__, '$this->lastSheetResult', $this->lastSheetResult);
		return $this->lastSheetResult;
	}

	//////////////////////////////////////
	// returnSheetRow - returns the next sheet row
	// return: the next sheet
	// created by FVDS
	//////////////////////////////////////
	function returnSheetRow(){
 //varDump(__FUNCTION__, 'lastSheetResult', $this->lastSheetResult);
		return @mysqli_fetch_array($this->lastSheetResult);
	}

	//////////////////////////////////////
	// generateLoadSelectHTML - builds html to display a select box to load EBSs from.
	// $a_dbc - the database
	// $a_sheetType - the type of sheet.  Use the enum from the Sheet class.
	// created by FVDS
	//////////////////////////////////////
	function generateLoadSelectHTML($a_dbc, $a_sheetType)
	{
		$this->getSheetsByType($a_dbc, $a_sheetType);
		echo "<div class='loadSheetDiv'>\n";
		echo "<select class='loadSheetSelect'>\n";
 		echo "<option value='-'>- Load different sheet -</option>";

 		while($row = $this->returnSheetRow())
 		{
 			echo "<option value='" . $row['SheetID'] . "'>{$row['Name']}</option>";
		}
		echo "</select>\n";
		echo "</div>\n";
	}

	//////////////////////////////////////
	// generateSaveHTML - builds html to display a button for saving.
	// $a_script - the script to call when button is pressed
	// created by FVDS
	//////////////////////////////////////
	function generateSaveHTML($a_script)
	{
		echo "<div class='saveSheetDiv'>\n";
		echo "<button type='button'>Save</button>";
		echo "</div>\n";
	}

}  // end project class.

?>
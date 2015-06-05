<?php

@include_once 'includes/debugging-helper-functions.inc.php';

// include other classes necessary for project class.
@include_once 'includes/sheet-class.inc.php';


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
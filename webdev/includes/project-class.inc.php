<?php

@include_once 'includes/debugging-helper-functions.inc.php';

class Sheet{
	const eExternalBidSheet = "ExternalBidSheet";
	const eInternalBidSheet = "InternalBidSheet";
	const eChangeBidSheet = "ChangeBidSheet";
	const eProjectDescriptionSheet = "ProjectDescriptionSheet";

	private $sheetID; 	//int(32) 	No  	  	 
	private $date; 	//date 	No  	  	 
	private $contractorFee; 	//decimal(16,0) 	No  	  	 
	private $sheetType; 	//varchar(40) 	No  	  	 
	private $name; 	//varchar(100) 	No  	  	 
	private $description; 	//varchar(1000)

	private $sheetLinesResults = null;

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

	function loadSheetFromDatabase($a_dbc, $a_sheetID)
	{
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
		}
	}

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
		}
	}

	function getLines($a_dbc)
	{
		switch ($this->sheetType){
			case Sheet::eExternalBidSheet:
			case Sheet::eChangeBidSheet:
				$sql="SELECT * FROM `externalbidsheetline` WHERE `SheetID`=$this->sheetID";
			break;
			case Sheet::eInternalBidSheet:
				$sql="SELECT * FROM `internalbidsheetline` WHERE `SheetID`=$this->sheetID";
			break;
			case Sheet::eProjectDescriptionSheet:
				$sql="SELECT * FROM `projectdescriptionline` WHERE `SheetID`=$this->sheetID";
			break;
			default:
				//should cause an error here, because we shouldn't be here.
			break;
		}
//varDump(__FUNCTION__, '$sql', $sql);

		$this->sheetLinesResults = @mysqli_query($a_dbc, $sql);
//varDump(__FUNCTION__, '$this->sheetLinesResults', $this->sheetLinesResults);
	}

	function returnLineRow()
	{
//varDump(__FUNCTION__, 'sheetLinesResults', $this->sheetLinesResults);
		return @mysqli_fetch_array($this->sheetLinesResults);
	}

	private function generateExternalTableHeaderHTML()
	{
		echo "<tr>\n";
		echo "<th>Item #</th>\n";
		echo "<th>Description of Work</th>\n";
		echo "<th>Amount</th>\n";
		echo "</tr>\n";
	}

	private function generateExternalLineHTML($a_row)
	{
//varDump(__FUNCTION__, '$a_row', $a_row);
		echo "<tr>\n";
		echo "<td>1</td>\n";
		echo '<td>' . $a_row['WorkDescription'] . "</td>\n";
//		echo '<td>' . $a_row['WorkDescription'] . '<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>' . "\n";
		echo '<td>$' . $a_row['Amount'] . "</td>\n";
		echo "</tr>\n";
	}

	private function generateInternalTableHeaderHTML()
	{
		echo "<tr>\n";
		echo "<th>Task ID</th>\n";
		echo "<th>Task Name</th>\n";
		echo "<th>Subcontractor</th>\n";
		echo "<th>Amount</th>\n";
		echo "<th>Notes</th>\n";
		echo "</tr>\n";
	}

	private function generateInternalLineHTML($a_row)
	{
//varDump(__FUNCTION__, '$a_row', $a_row);
		echo "<tr>\n";
	 	echo "<td>{$a_row['ConstructionSpecID']}</td>";
		echo "<td>Lorem Ipsum <span class='ui-icon ui-icon-info' title='Info about what type of things this task heading covers here.'></span></td>\n";
		echo "<td>{$a_row['SubcontractorBidUsed']}</td>\n";
		echo "<td>{$a_row['Amount']}</td>\n";
		echo "<td>{$a_row['GeneralNotes']}<span class='ui-icon ui-icon-info' title='Notes about this task.'></span></td>\n";
		echo "</tr>\n";
	}

	private function generateDescriptionTableHeaderHTML()
	{

	}

	private function generateDescriptionLineHTML($a_row)
	{

	}

	function generateLineHTML($a_row)
	{
		switch ($this->sheetType){
			case Sheet::eExternalBidSheet:
			case Sheet::eChangeBidSheet:
				$this->generateExternalLineHTML($a_row);
			break;
			case Sheet::eInternalBidSheet:
//varDump(__FUNCTION__, "a_row", $a_row);
				$this->generateInternalLineHTML($a_row);
			break;
			case Sheet::eProjectDescriptionSheet:
				$this->generateDescriptionLineHTML($a_row);
			break;
			default:
				//should cause an error here, because we shouldn't be here.
			break;
		}
	}

	function generateTableHeaderHTML()
	{
		switch ($this->sheetType){
			case Sheet::eExternalBidSheet:
			case Sheet::eChangeBidSheet:
				$this->generateExternalTableHeaderHTML();
			break;
			case Sheet::eInternalBidSheet:
				$this->generateInternalTableHeaderHTML();
			break;
			case Sheet::eProjectDescriptionSheet:
				$this->generateDescriptionTableHeaderHTML();
			break;
			default:
				//should cause an error here, because we shouldn't be here.
			break;
		}
	}

	function generateLinesTableHTML($a_dbc)
	{
		// get our lines.
		$this->getLines($a_dbc);

		// all of this in a form.
		echo "<form>\n";

		// start a table.
		echo "<table>\n";

		//add the header
		$this->generateTableHeaderHTML();
		while($row = $this->returnLineRow())
		{
			$this->generateLineHTML($row);
		}

		// and close the table
		echo "</table>\n";

		// and the form.
		echo "</form>\n";
	}
}

//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
//
//
//
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
class Project{
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
	private $lastGetSheetsByTypeResults = null;

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

	// need function to deal with the addresses
	function addAddress($a_dbc, $slot, $address1, $address2, $city, $state, $zipcode)
	{

	}

	function getAddress($a_dbc, $slot)
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

	function returnNextSheet($a_dbc){
		$row_sheet = @mysqli_fetch_array($this->lastGetSheetIDsResults);
		$sql_sheet = "SELECT * FROM `sheet` WHERE `SheetID`=" . $row_sheet['SheetID'];
		return @mysqli_query($a_dbc, $sql_sheet);
	}

	function getSheetsByType($a_dbc, $a_sheetType)
	{
		// get the sheets that go with this project
		$this->getSheetIDs($a_dbc);
		$row_sheet = @mysqli_fetch_array($this->lastGetSheetIDsResults);
//varDump(__FUNCTION__, "row_sheet", $row_sheet);
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
		// add ending parentheses.
		$sql = $sql . ")";
//varValue(__FUNCTION__,'$sql', $sql);
		$this->lastGetSheetsByTypeResults = @mysqli_query($a_dbc, $sql);
//varDump(__FUNCTION__, '$this->lastGetSheetsByTypeResults', $this->lastGetSheetsByTypeResults);
		return $this->lastGetSheetsByTypeResults;
	}

	function returnSheetRow(){
//varDump(__FUNCTION__, 'lastGetSheetsByTypeResults', $this->lastGetSheetsByTypeResults);
		return @mysqli_fetch_array($this->lastGetSheetsByTypeResults);
	}
}  // end project class.

?>
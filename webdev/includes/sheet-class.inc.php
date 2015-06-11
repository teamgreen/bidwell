<?php

// add the debug helper.
@include_once 'includes/debugging-helper-functions.inc.php';

// include other classes needed by Sheets.
@include_once 'includes/line-class.inc.php';


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

	// empty functions that any inheritors might need to define.
	function generateLineHMTL($a_row) {}
	function generateTableHeaderHTML() {}
	function displayTotal($a_amount){}
	function loadLinesFromDatabase($a_dbc){}
	function addNewLine($a_value){}
	
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

		}
		//now load the lines and/or add any needed empty lines.
		$this->loadLinesFromDatabase($a_dbc);
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
		}

		//now load the lines and/or create any needed empty lines.
		$this->CreateAndLoadLines($a_dbc);
	}

	//////////////////////////////////////
	// CreateAndLoadLines - creates and loads the lines for this sheet, as well as an additional
	// empty line at the appropriate place
	// $a_value - a value in case the new line needs a single thing set on creation
	// a_dbc - the database
	//////////////////////////////////////
	function CreateAndLoadLines($a_dbc)
	{
		$this->loadLinesFromDatabase($a_dbc);
		$this->addNewLine(0);
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
		echo "<form data-sheetID='".$this->sheetID."'>\n";

		// start a table.
		echo "<table>\n";

		$lineCount=0;
		$total=0;

		//add the header
		$this->generateTableHeaderHTML();

		// display the lines and keep track of the total
		foreach ($this->lines as $i) {
			$total+=$i->displayLine($a_dbc, ++$lineCount);
		}

		//now display the total if needed.
		$this->displayTotal($total);

		// and close the table
		echo "</table>\n";

		// and the form.
		echo "</form>\n";
	}
}
// end Sheet

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
	// addNewLine  - adds a new line for this sheet
	// $a_value - a value in case the new line needs a single thing set on creation
	// created by FVDS
	//////////////////////////////////////
	function addNewLine($a_value)
	{
		$newLine = new ProjectDescriptionLine();
		$this->lines[count($this->lines)] = $newLine;
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
		echo "<form data-sheetID='".$this->sheetID."'>\n";
	 	echo "<div class='description-left'>\n";

	 	//write the paragraphs
		foreach ($this->lines as $i) {
			$i->displayLine(null, 0);
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
		ProjectDescriptionLine::generateTableHeaderHTML();
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
// end ProjectDescriptionSheet

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
	// loadLinesFromDatabase - loads the lines for this sheet from the database
	// a_dbc - the database
	// created by FVDS
	//////////////////////////////////////
	function loadLinesFromDatabase($a_dbc)
	{
		$sql="SELECT * FROM `internalbidsheetline` WHERE `SheetID`=$this->sheetID ORDER BY `TaskID`";
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
	// CreateAndLoadLines - creates and loads the lines for this sheet, as well as an additional
	// empty lines at the appropriate place, one for each division.
	// a_dbc - the database
	//////////////////////////////////////
	function CreateAndLoadLines($a_dbc)
	{
		$this->loadLinesFromDatabase($a_dbc);

		// display the lines and keep track of the total
		for($i=0;$i<17;){
			// we want ones for 1-17, so increment before pass in
			$this->addNewLine(++$i);
		}

		// and now sort the array so the blink lines appear in the proper places.
		usort($this->lines, function($a, $b)
		{
   			return $a->getTaskID() > $b->getTaskID();
		});
	}


	//////////////////////////////////////
	// addNewLine  - adds a new line for this sheet
	// $a_value - this * 1000 + 999 becomes the taskID.  needed for blank lines.  Gets reset for other ones.
	// created by FVDS
	//////////////////////////////////////
	function addNewLine($a_value)
	{
		$newLine = new InternalBidSheetLine();
		$newLine->setTaskID($a_value*1000 + 999);
		$this->lines[count($this->lines)] = $newLine;
	}

	//////////////////////////////////////
	// generateTableHeaderHTML - generates the header row for the table.
	// $a_div - the div we are on.
	// created by FVDS
	//////////////////////////////////////
	function generateTableHeaderHTML($a_div)
	{
		InternalBidSheetLine::generateTableHeaderHTML($a_div);
	}

		//////////////////////////////////////
	// generateLinesTableHTML - builds a table using data grabbed from the database.
	// $a_dbc - the database
	// created by FVDS
	//////////////////////////////////////
	function generateLinesTableHTML($a_dbc)
	{
		// all of this in a form.
		echo "<form data-sheetID='".$this->sheetID."'>\n";

		$sql="SELECT `DivisionName` FROM `division`";
		$result = @mysqli_query($a_dbc, $sql);
		$lineCount=0;
		$total=0;
		$subtotal=0;
		$lastDiv=999;
		$tableStarted=false;
		//$div=0;

		// display the lines and keep track of the total
		foreach ($this->lines as $i) {
			if( $i->getTaskID() > $lastDiv ){
				if($tableStarted){
					// add subtotal line
					InternalBidSheetLine::displayTotal($subtotal, "Subtotal");

					//update total and reset subtotal.
					$total +=$subtotal;
					$subtotal=0;

					// close the previous table.
					echo "</table>\n";
				}

				// start a table.
				$tableStarted=true;
				echo "<table>\n";

				//add the header
				//$div++;
				$row = mysqli_fetch_row($result);
//varDump(__FUNCTION__, __LINE__, $row);
				$this->generateTableHeaderHTML($row[0]);

				// increment the lastDiv by 1000 (one div)
				$lastDiv+=1000;
			}
			// add lines
			$subtotal+=$i->displayLine($a_dbc, ++$lineCount);
		}

		// close the result
		$result->close();

		// finish off the last table with its subtotal and close it
		InternalBidSheetLine::displayTotal($subtotal, "Subtotal");
		$total +=$subtotal;
		echo "</table>\n";
		
		// show the total.
		echo "<table>\n";
		InternalBidSheetLine::generateTotalHTML($total);
		echo "</table>\n";

		// and the form.
		echo "</form>\n";

	}
} 
// end InternalBidSheet

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
	// loadLinesFromDatabase - loads the lines for this sheet from the database
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
	// addNewLine  - adds a new line for this sheet
	// $a_value - a value in case the new line needs a single thing set on creation
	// created by FVDS
	//////////////////////////////////////
	function addNewLine($a_value)
	{
		$newLine = new ExternalBidSheetLine();
		$this->lines[count($this->lines)] = $newLine;
	}

	//////////////////////////////////////
	// generateTableHeaderHTML - generates the header row for the table.
	// created by FVDS
	//////////////////////////////////////
	function generateTableHeaderHTML()
	{
		ExternalBidSheetLine::generateTableHeaderHTML();
	}

	//////////////////////////////////////
	// displayTotal - builds a table row for a total amount.
	// $a_amount - the total to show
	// created by FVDS
	//////////////////////////////////////
	function displayTotal($a_amount)
	{
		ExternalBidSheetLine::displayTotal($a_amount);

		// echo "<tr>\n";
		// echo "<td></td>\n";
		// echo "<td class='chTableTotal'>Total:</td>\n";
		// echo '<td>$' . $a_amount . "</td>\n";
		// echo "</tr>\n";
	}
} 
// end ChangeBidSheet

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
	// loadLinesFromDatabase - loads the lines for this sheet from the database
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
	// addNewLine  - adds a new line for this sheet
	// $a_value - a value in case the new line needs a single thing set on creation
	// created by FVDS
	//////////////////////////////////////
	function addNewLine($a_value)
	{
		$newLine = new ExternalBidSheetLine();
		$this->lines[count($this->lines)] = $newLine;
	}

	//////////////////////////////////////
	// generateTableHeaderHTML - generates the header row for the table.
	// created by FVDS
	//////////////////////////////////////
	function generateTableHeaderHTML()
	{
		ExternalBidSheetLine::generateTableHeaderHTML();
	}

	//////////////////////////////////////
	// displayTotal - builds a table row for a total amount.
	// $a_amount - the total to show
	// created by FVDS
	//////////////////////////////////////
	function displayTotal($a_amount)
	{
		ExternalBidSheetLine::displayTotal($a_amount);
	}
}
// ExternalBidSheet

?>
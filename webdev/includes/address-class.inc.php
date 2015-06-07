<?php

@include_once 'includes/debugging-helper-functions.inc.php';

class Address {

	protected $addressID = 0;
	protected $address1 = "";
	protected $address2 = "";
	protected $city = "";
	protected $state="";
	protected $zipCode="";

	function getAddress1(){return $this->address1;}
	function getAddress2(){return $this->address2;}
	function getCity(){return $this->city;}
	function getState(){return $this->state;}
	function getZipCode1(){return $this->zipCode;}

	function setAddress1($value){$this->address1=$value;}
	function setAddress2($value){$this->address2=$value;}
	function setCity($value){$this->city=$value;}
	function setState($value){$this->state=$value;}
	function setZipCode1($value){$this->zipCode=$value;}

	//////////////////////////////////////
	// addAddress - This function should add an address to the database
	// created by FVDS
	//////////////////////////////////////
	function setEntireAddress($address1, $address2, $city, $state, $zipCode)
	{
		$this->setAddress1($address1);
		$this->setAddress2($address2);
		$this->setCity($city);
		$this->setState($state);
		$this->setZipCode($zipCode);
	}

	function loadFromDatabase($a_dbc, $a_addressID) 
	{
		// $address1 = null;

		$sql = "SELECT * FROM `address` WHERE AddressID='" . $a_addressID . "'";
		$result = @mysqli_query($a_dbc, $sql);
		if ($result != false) {
			$row = @mysqli_fetch_array($result);

			// set variables.
			$this->addressID= $row['AddressID'];
			$this->address1 = $row["Address1"];
			$this->address2 = $row["Address2"];
			$this->city = $row["City"];
			$this->state=$row["State"];
			$this->zipCode=$row["ZipCode"];
		}
	} 

	// function saveToDatabase($a_dbc)
	// {
	// 	// save the address to the database.
	// 	if($this->addressID) { // if this is set, we need to update
	// 		//stuff here to update the address in the database.
	// 	} else { //not set, so a new one.
	// 		//stuff here to insert this address into the database.
	// 	}

	// }

	function createStateSelect($a_dbc)
	{
		echo "<select name='state_location' class='state_location'>\n";
		echo "<option value=''>Select a State</option>\n";

		// SQL statement to select everything from state table to populate options in select form element
		$sql_states = "SELECT * FROM `state`";
//varDump(__FUNCTION__, __LINE__, $result_states);
		$result_states = @mysqli_query($a_dbc, $sql_states);
//varDump(__FUNCTION__, __LINE__, $result_states);

		while($row_states = @mysqli_fetch_array($result_states)) {
			if( $this->state == $row_states['fullStateName']){
				echo "<option value='" . $row_states['abbrevName'] . "' selected>" .$row_states['fullStateName'] . "</option>\n";
			}
			else{
				echo "<option value='" . $row_states['abbrevName'] . "'>" .$row_states['fullStateName'] . "</option>\n";
			}
		}

		echo "</select>\n";
	}
}

?>
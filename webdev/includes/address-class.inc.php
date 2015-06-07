
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

	function loadFromDatabase($a_dbc, $a_addressID) 
	{

		// $address1 = null;

		$sql = "SELECT * FROM `address` WHERE AddressID='" . $address1 . "'";
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
}

?>
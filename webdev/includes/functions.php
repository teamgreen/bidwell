
	<!-- 
	
	///////////////////////////////////////
	// Functions PHP File
	// Authored by Alex Chaudoin
	// Created 5/25/2015
	// Purpose: To provide a file with
	// 			additional PHP functions
	//			that can be called when 
	//			necessary.
	///////////////////////////////////////

	-->

<?php

# PHP file for additional functions

	function assignIfNotEmpty($field, $default) {
		return (!isset($_POST[$field])) ? $_POST[$field] : $default;
	} // end function

	function addAddress($name, $address1, $address2, $city, $state, $zip, $message) {
		$sql = "INSERT INTO `address` (Name, Address1, Address2, City, State, ZipCode)
				VALUES ('$name', '$address1', '$address2', '$city', '$state', '$zip')";
		$result = @mysqli_query($dbc, $sql);
		
		$num_rows = @mysqli_num_rows($result);
		if ($num_rows == 0) {
		 	echo "<p>We apologize for the inconvenience, but the following information has not been received:\n";
		 	echo $message . "\n</p>";
		};
	} // end function

	function addAddressID($name, $message) {
		$sql = "SELECT 'AddressID' FROM `address` WHERE Name = '$name';
				UPDATE `project` SET project.OwnerAddressID = address.AddressID WHERE Name = '$name'";
		$result = @mysqli_multi_query($dbc, $sql);

		$num_rows = @mysqli_num_rows($result);
		if ($num_rows == 0) {
		 	echo "<p>We apologize for the inconvenience, but the following information has not been received:\n";
		 	echo $message . "\n</p>";
		};
	} // end function


?>
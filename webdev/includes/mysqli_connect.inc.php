<?php 

	//////////////////////////////////////
	// mysqli_connect.inc.php
	// file to connect to the database.
	// 5/24/2015
	// Created by Frank van der Salm
	//////////////////////////////////////

	///////////////////////////////////////
	// SQLConnect - function to connect to the database
	// return: the connection to the database.
	// 5/24/2015
	// Frank van der Salm
	///////////////////////////////////////
	function SQLConnect()
	{
		$host = "http://107.22.222.166";
		$username = "ctecadmin";
		$password = "ctec227*user";
		$db = "Bid-well";

		$dbc = mysqli_connect($host, $username, $password, $db) OR die("<p>Could not connect to Database.</p>");
		mysqli_set_charset($dbc, 'utf8');

		return $dbc;
	}
?>
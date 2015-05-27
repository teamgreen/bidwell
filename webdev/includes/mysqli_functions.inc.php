<?php

////////////////////////////////////////////////
// mysqli_functions.inc.php
// This file contains functions and support in order to make working
// with the database easier.
// Crated by Frank van der Salm
// 5/25/2015
///////////////////////////////////////////////

	abstract class Permissions
	{
		// these MUST match the permission table, plus have the terminator at the end, which must always be
		// at least one bigger than the previous entry.
		// note that all of these are bit flags... 2^0, 2^1, 2^2...
		const ePROJECT_CREATE = 1; //	user can create new projects
		const ePROJECT_VIEW_INTERNAL = 2; //  	user can see internal project files
		const ePROJECT_VIEW_EXTERNAL = 4; // user can see external project files
		const ePROJECT_VIEW_ALL = 8; // user can view any project
		const ePROJECT_EDIT_ALL = 16; // user can edit any project
		const ePROJECT_DELETE = 32; // user can delete projects they own (hide them)
		const ePROJECT_DELETE_ALL = 64; //user can delete any project
		const ePROJECT_APPROVE = 128; //user can approve projects they own
		const ePROJECT_APPROVE_ALL = 256; //user can approve any project
		const ePROJECT_ASSIGN = 512; //user can assign projects they own to other people
		const ePROJECT_ASSIGN_ALL = 1024; //user can assign any project
		const ePROJECT_TRANSFER = 2048; //user can transfer ownership of projects they own
		const ePROJECT_TRANSFER_ALL = 4096; // 	user can transfer ownership of any project
		const eCOMMENT_VIEW_INTERNAL = 8192; // Can see internal comments
		const eCOMMENT_VIEW_EXTERNAL = 16384; //Can see external comments
		const eCOMMENT_WRITE_INTERNAL = 32768; //user can make internal comments
		const eCOMMENT_WRITE_EXTERNAL = 65536; //user can make external comments
		const eACCOUNT_MANAGE_GREENWELL = 131072; //Can create, manage, and delete Greenwell accounts
		const eACCOUNT_MANAGE = 262144; //User can create, manage, and delete non-admin, non...
		const eACCOUNT_MANAGE_TEMP = 524288; //Can create, manage, and delete temporary accounts
		const eACCOUNT_MANAGE_ADMIN = 1048576; //can create, manage, and delete Admin level account...
		const eTERMINATOR = 1048577;
	}

	////////////////////////////////////////////
	// HasPermission - checks if an account has the permission to do something.
	// a_dbc - the database.
	// a_AccountID - the ID of the account we're checking for.
	// a_ePermissions - Permissions values.  Can be more than one | together.
	// return: returns true if account has permission, false otherwise.
	// created by Frank van der Salm
	////////////////////////////////////////////
	function HasPermission($a_dbc, $a_AccountID, $a_ePermissions)
	{
		// fetch our account
		$sql = "SELECT * FROM account WHERE AccountID='" . $a_AccountID . "'";
		$result = @mysqli_query($a_dbc, $sql);
		$permissions = null;

		// if we have an account...
		if(mysqli_num_rows($result) == 1){
			$account = @mysqli_fetch_array($result);

			// if not custom, we'll use the preset permissions.
			$table = 'preset|permission';
			$check = $account['PresetName'];
			$column = 'PresetName';

			// if the preset name is custom, we'll use the account|permission table.
			if($account['PresetName'] == 'Custom'){
				$table = 'account|permission';
				$check = $a_AccountID;
				$column = 'AccountID';
			}

			$return = true;
			for($i=1;$i < Permissions::eTERMINATOR;$i*=2)
			{
				$permission = $i & $a_ePermissions;
				// if this is a permission we need to check for, check.
				if ($permission){
					$sql = "SELECT * FROM `" . $table . "` WHERE $column='" . $check . "' AND `PermissionID`='" . $permission . "'";

					$result = @mysqli_query($a_dbc, $sql);

					// no rows means no permission, return false
					if(!$result || mysqli_num_rows($result) == 0){
						return false;
					}
				}
			}
			// loop completed, return results.			
			return $return;
		}

		// if we haven't returned true, then we don't have permission.  false it is.
		return false;			
	}



	///////////////////////////////////////
	// Additional PHP functions
	// Authored by Alex Chaudoin
	// Created 5/25/2015
	// Purpose: To provide a file with
	// 			additional PHP functions
	//			that can be called when 
	//			necessary.
	///////////////////////////////////////

# PHP file for additional functions

	function assignIfNotEmpty($field, $default) {
		return (isset($_POST[$field])) ? $_POST[$field] : $default;
	} // end function

	function addAddress($name, $address1, $address2, $city, $state, $zip) {
		$sql = "INSERT INTO `address` (Name, Address1, Address2, City, State, ZipCode)
				VALUES ('$name', '$address1', '$address2', '$city', '$state', '$zip')";
		$result = @mysqli_query($dbc, $sql);
		
		$num_rows = @mysqli_num_rows($result);
		if ($num_rows == 0) {
			return 0;
		} else {
			$id = mysqli_query('SELECT LAST_INSERT_ID()');
			addAddress($id);
		};
	} // end function

	function addAddressID($id) {
		$sql = "SELECT 'AddressID' FROM `address` WHERE AddressID = '$id';
				UPDATE `project` SET project.OwnerAddressID = address.AddressID WHERE address.AddressID = '$id'";
		$result = @mysqli_store_result($dbc, $sql);
	} // end function


?>
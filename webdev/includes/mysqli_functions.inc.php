<?php

////////////////////////////////////////////////
// mysqli_functions.inc.php
// This file contains functions and support in order to make working
// with the database easier.
// Crated by Frank van der Salm
// 5/25/2015
///////////////////////////////////////////////

	abstract class Permissions{
		// these MUST match the permission table, plus have the terminator at the end, which must always be
		// at least one bigger than the previous entry.
		// note that all of these are bit flags... 2^0, 2^1, 2^2...
		constant $ePROJECT_CREATE = 1; //	user can create new projects
		constant $ePROJECT_VIEW_INTERNAL = 2; //  	user can see internal project files
		constant $ePROJECT_VIEW_EXTERNAL = 4; // user can see external project files
		constant $ePROJECT_VIEW_ALL = 8; // user can view any project
		constant $ePROJECT_EDIT_ALL = 16; // user can edit any project
		constant $ePROJECT_DELETE = 32; // user can delete projects they own (hide them)
		constant $ePROJECT_DELETE_ALL = 64; //user can delete any project
		constant $ePROJECT_APPROVE = 128; //user can approve projects they own
		constant $ePROJECT_APPROVE_ALL = 256; //user can approve any project
		constant $ePROJECT_ASSIGN = 512; //user can assign projects they own to other people
		constant $ePROJECT_ASSIGN_ALL = 1024; //user can assign any project
		constant $ePROJECT_TRANSFER = 2048; //user can transfer ownership of projects they own
		constant $ePROJECT_TRANSFER_ALL = 4096; // 	user can transfer ownership of any project
		constant $eCOMMENT_VIEW_INTERNAL = 8192; // Can see internal comments
		constant $eCOMMENT_VIEW_EXTERNAL = 16384; //Can see external comments
		constant $eCOMMENT_WRITE_INTERNAL = 32768; //user can make internal comments
		constant $eCOMMENT_WRITE_EXTERNAL = 65536; //user can make external comments
		constant $eACCOUNT_MANAGE_GREENWELL = 131072; //Can create, manage, and delete Greenwell accounts
		constant $eACCOUNT_MANAGE = 262144; //User can create, manage, and delete non-admin, non...
		constant $eACCOUNT_MANAGE_TEMP = 524288; //Can create, manage, and delete temporary accounts
		constant $eACCOUNT_MANAGE_ADMIN = 1048576; //can create, manage, and delete Admin level account...
		constant $eTERMINATOR = 1048577;
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
		$sql = "SELECT * FROM account WHERE AccountID='$a_AccountID'";
		$result = @mysqli_query($dbc, $sql);
		$permissions = null;

		// if we have an account...
		if(mysqli_num_rows($result) == 1){
			$account = @mysqli_fetch_array($result);

			// if the preset name is custom, we'll use the account|permission table.
			$table = 'preset|permission';
			$check = $account['PresetName'];
			$column = 'PresetName';

			// if not custome, we'll use the preset permissions.
			if($account['PresetName'] !== 'Custom'){
				$table = 'account|permission';
				$check = $a_AccountID;
				$column = 'AccountID';
			}

			$return = true;
			for($i=1;i < Permissions::eTERMINATOR;$i*=2)
			{
				// if this is a permission we need to check for, check.
				if (i & $a_ePermissions){
					$sql = "SELECT * FROM $table WHERE $column='{$check}'";
					$result = @mysqli_query($dbc, $sql);

					// no rows means no permission, return false
					if(mysqli_num_rows($result) < 1){
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

?>
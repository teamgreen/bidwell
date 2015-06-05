
					<script type="text/javascript">

						$('.admin-table').attr('disabled', 'disabled');

						$('.admin-buttons').click(function(){

							if ($(this).hasClass('add-account') === true) { 
								// $('#add-form').show();
								// $('#edit-form').hide();
								// $('#pass-form').hide();
								// $('#admin-form-default').hide();
							} else if ($(this).hasClass('edit-account') === true) {
								$('.admin-table').removeAttr('disabled');
								// $('#edit-form').show();
								// $('#add-form').hide();
								// $('#pass-form').hide();
								// $('#admin-form-default').hide();
							} else if ($(this).hasClass('reset-pass') === true) {
								// $('#pass-form').show();
								// $('#add-form').hide();
								// $('#edit-form').hide();
								// $('#admin-form-default').hide();
							} else {
								// $('#admin-form-default').show();
								// $('#add-form').hide();
								// $('#edit-form').hide();
								// $('#pass-form').hide();
							};

							// make else if for .delete-account

							return false;

						}); // end click

						$('input[type="text"].admin-table').click(function(){
							$('.save-cancel').show(); // get specificity to work by having the nearest .save-cancel buttons to $this show up
						}); // end focus

					</script>

					<?php @include_once "includes/admin-add-account.php"; ?>

					<?php @include_once "includes/admin-edit-account.php"; ?>

					<?php @include_once "includes/admin-reset-password.php"; ?>

					<p id="admin-form-default">In this section, you can add accounts, update account information, and reset passwords. There is no form here currently, so why don't you go back to the first tab and click on either "Add New Account", "Edit" (under Account ID), or "Reset" (under Password) to start your work in this tab?</p>
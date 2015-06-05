
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

							return false;

						}); // end click

						$('.admin-table').focus(function(){
							$(this).append('#save-change');
							$('#save-change').show();
						}); // end focus

					</script>

					<?php @include_once "includes/admin-add-account.php"; ?>

					<?php @include_once "includes/admin-edit-account.php"; ?>

					<?php @include_once "includes/admin-reset-password.php"; ?>

					<p id="admin-form-default">In this section, you can add accounts, update account information, and reset passwords. There is no form here currently, so why don't you go back to the first tab and click on either "Add New Account", "Edit" (under Account ID), or "Reset" (under Password) to start your work in this tab?</p>
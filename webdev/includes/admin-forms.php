
					<script type="text/javascript">

						$('input[type="button"]').click(function(){

							var buttonVal = $(this).prop('value');

							if (buttonVal === "Add New Account") { 
								$('#add-form').show();
								$('#edit-form').hide();
								$('#pass-form').hide();
								$('#admin-form-default').hide();
							} else if (buttonVal === "Edit") {
								$('#edit-form').show();
								$('#add-form').hide();
								$('#pass-form').hide();
								$('#admin-form-default').hide();
							} else if (buttonVal === "Reset") {
								$('#pass-form').show();
								$('#add-form').hide();
								$('#edit-form').hide();
								$('#admin-form-default').hide();
							} else {
								$('#admin-form-default').show();
								$('#add-form').hide();
								$('#edit-form').hide();
								$('#pass-form').hide();
							};

						}); // end click

					</script>

					<?php @include_once "includes/admin-add-account.php"; ?>

					<?php @include_once "includes/admin-edit-account.php"; ?>

					<?php @include_once "includes/admin-reset-password.php"; ?>

					<p id="admin-form-default">In this section, you can add accounts, update account information, and reset passwords. There is no form here currently, so why don't you go back to the first tab and click on either "Add New Account", "Edit" (under Account ID), or "Reset" (under Password) to start your work in this tab?</p>
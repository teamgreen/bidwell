
					<script type="text/javascript">

						$('.admin-table').attr('disabled', 'disabled');

						$('.admin-buttons').click(function(){

							if ($(this).hasClass('add-account') === true) { 
								$('#add-reset_bg').show();
								$('#add-reset_dialog').show();
								$('#add-dialog').show();
								$('#reset-dialog').hide();
								$('#delete-dialog').hide();
							} else if ($(this).hasClass('edit-account') === true) {
								$('.admin-table').removeAttr('disabled');
							} else if ($(this).hasClass('reset-pass') === true) {
								$('#add-reset_bg').show();
								$('#add-reset_dialog').show();
								$('#add-dialog').hide();
								$('#reset-dialog').show();
								$('#delete-dialog').hide();
							} else if ($(this).hasClass('delete-account') === true) {
								$('#add-reset_bg').show();
								$('#add-reset_dialog').show();
								$('#add-dialog').hide();
								$('#reset-dialog').hide();
								$('#delete-dialog').show();
							};

							return false;

						}); // end click

						$('input[type="text"].admin-table').click(function(){
							$('.save-cancel').show(); // get specificity to work by having the nearest .save-cancel buttons to $this show up
						}); // end focus

					</script>

					<?php @include_once "includes/admin-edit-account.php"; ?>
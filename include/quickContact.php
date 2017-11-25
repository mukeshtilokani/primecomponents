<script src="<?=SITEURL?>js/formValidation.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/jquery.formvalidation/0.6.1/js/framework/bootstrap.min.js"></script>
		<div id="alertContainer"></div>
		<form accept-charset="UTF-8" id="contactForm" class="contact-form " action="#" method="post">
			<div class="row">
				<div class="col-sm-12 form-group">
					<label class="col-xs-12 control-label">Your Name:</label>
					<input type="text" class="col-xs-12 form-control hint" name="txtName" id="txtName"  />
				</div>
				<div class="col-sm-12 form-group">
					<label class="col-xs-12 control-label">Company:</label>
					<input type="text" name="txtCompany" id="txtCompany" class="col-xs-12 form-control hint">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 form-group">
					<label class="col-xs-12 control-label">Email:</label>
					<input type="email" name="txtEmail" id="txtEmail" class="col-xs-12 form-control hint">
				</div>
				<div class="col-sm-12 form-group">
					<label class="col-xs-12 control-label">Phone Number:</label>
					<input type="telephone" name="txtPhone" id="txtPhone" class="col-xs-12 form-control hint">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 form-group">
					<label class="col-xs-12 control-label">Message:</label>
					<textarea  name="txtMessage" id="txtMessage" cols="75" rows="5" class="col-xs-12 form-control hint"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 form-group">
					<div class="form-group">
						<label class="col-xs-12 control-label">Security Code :</label>
					</div>
					<div class="form-group row align-items-center">
				    	<label for="inputPassword" class="col-sm-6 h4 mb-sm-0" id="captchaOperation"></label>
				    	<div class="col-sm-6">
				      		<input type="text" class="form-control" name="captcha"/>
				    	</div>
				  	</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 form-group">
					<button type="submit" title="Subscribe" class="btn subscribe w-100"><span>Submit</span></button>
				</div>
			</div>
		</form>
<script>
	$(document).ready(function() {
		// Generate a simple captcha
		function randomNumber(min, max) {
			return Math.floor(Math.random() * (max - min + 1) + min);
		}
		function stringGen(len)
		{
			var text = " ";
			var charset = "abcdefghijklmnopqrstuvwxyz0123456789";
			for( var i=0; i < len; i++ )
				text += charset.charAt(Math.floor(Math.random() * charset.length));
			return text;
		}
		function generateCaptcha() {
			//$('#captchaOperation').html([randomNumber(1, 9), '+', randomNumber(1, 9), '='].join(' '));
			$('#captchaOperation').html([ stringGen(4), '='].join(' '));
		}
		generateCaptcha();
		$('#contactForm')
			.formValidation({
				framework: 'bootstrap',
				icon: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				fields: {
					txtName: {
						validators: {
							notEmpty: {
								message: 'Your Name is required'
							}
						}
					},
					txtCompany: {
						validators: {
							notEmpty: {
								message: 'Company Name is required'
							}
						}
					},
					txtPhone: {
						validators: {
							notEmpty: {
								message: 'The phone number is required'
							},
							regexp: {
								message: 'The phone number can only contain the digits, spaces, -, (, ), + and .',
								regexp: /^[0-9\s\-()+\.]+$/
							}
						}
					},
					txtEmail: {
						validators: {
							notEmpty: {
								message: 'The email address is required'
							},
							emailAddress: {
								message: 'The input is not a valid email address'
							}
						}
					},
					txtMessage: {
						validators: {
							notEmpty: {
								message: 'The message is required'
							},
							stringLength: {
								max: 700,
								message: 'The message must be less than 700 characters long'
							}
						}
					},
					captcha: {
						validators: {
							callback: {
								message: 'Input captcha',
								callback: function (value, validator, $field) {
//									var items = $('#captchaOperation').html().split(' '),
//										sum = parseInt(items[0]) + parseInt(items[2]);
//									return value == sum;
									var items = $('#captchaOperation').html().split(' '),
										sum = items[1];
									//alert(sum);
									return value == sum;
								}
							}
						}
					}
				}
			})
			.on('err.form.fv', function (e) {
				// Regenerate the captcha
				generateCaptcha();
			})
			.on('success.form.fv', function (e) {
				// Prevent default form submission
				e.preventDefault();
				var $form = $(e.target);
				var email = $form.find('[name="txtEmail"]').val(); // get email field value
				var name = $form.find('[name="txtName"]').val(); // get name field value
				var msg = $form.find('[name="txtMessage"]').val(); // get message field value
				var phone = $form.find('[name="txtPhone"]').val(); // get phone field value
				var company = $form.find('[name="txtCompany"]').val(); // get company field value
				$.ajax(
					{
						type: "POST",
						url: "/api/email/quickEmail.php",
						data: {
							name: name,
							email: email,
							phone : phone,
							company: company,
							comments : msg,
						}
					})
					.done(function (response) {
						// Clear the form
						$form.formValidation('resetForm', true);
						$form.find('[name="txtMessage"]').val('');
						// Regenerate the captcha
						generateCaptcha();
						// Show the message
						response.status === 'error'
							? $('#alertContainer')
							.removeClass('alert-success')
							.addClass('alert-warning')
							.html('Sorry, cannot send the message')
							.show()
							: $('#alertContainer')
							.removeClass('alert-warning')
							.addClass('alert-success')
							.html('Your message has been successfully sent')
							.show();
						setTimeout(function(){ 
							$('#alertContainer').fadeOut("slow"); 
						}, 3000);
					}).fail(function (jqXHR, textStatus, errorThrown) {
						$('#alertContainer')
							.removeClass('alert-success')
							.addClass('alert-warning')
							.html('Sorry, cannot send the message')
							.show();
						setTimeout(function(){ 
							$('#alertContainer').fadeOut("slow"); 
						}, 3000);
					});
			});
	});
</script>
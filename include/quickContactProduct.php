
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>

<link rel="stylesheet" href="<?=SITEURL?>css/formValidation.min.css">

<script src="<?=SITEURL?>js/formValidation.min.js" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/jquery.formvalidation/0.6.1/js/framework/bootstrap.min.js"></script>


		<div id="alertContainer"></div>


		<form accept-charset="UTF-8" id="contactForm" class="contact-form " action="#" method="post">





			<div class="row">

				<div class="col-sm-12 form-group" style="margin-bottom: 0;">

					<label class="control-label">Your Name:</label>



					<input type="text" class="col-xs-12 form-control hint" name="txtName" id="txtName"  />



				</div>

				<div class="col-sm-12 form-group" style="margin-bottom: 0;">

					<label class="control-label">Company:</label>

					<input type="text" name="txtCompany" id="txtCompany" class="col-xs-12 form-control hint">

				</div>

			</div>



			<div class="row">

				<div class="col-sm-12 form-group" style="margin-bottom: 0;">

					<label class="control-label">Email:</label>

					<input type="email" name="txtEmail" id="txtEmail" class="col-xs-12 form-control hint">

				</div>

				<div class="col-sm-12 form-group" style="margin-bottom: 0;">

					<label class="control-label">Phone Number:</label>

					<input type="telephone" name="txtPhone" id="txtPhone" class="col-xs-12 form-control hint">

				</div>

			</div>













			<div class="row">

				<div class="col-sm-12 form-group" style="margin-bottom: 0;">

					<label class="control-label">Message:</label>

					<textarea  name="txtMessage" id="txtMessage" cols="75" rows="5" class="col-xs-12 form-control hint"></textarea>

				</div>

			</div>



			<div class="row">

				<div class="col-sm-12 form-group" style="margin-bottom: 0;">







					<label class="control-label">Security Code :</label>

					<label class="col-xs-6 control-label" id="captchaOperation" style="font-size: 22px; width: 75px;" ></label>

					<input type="text" class="form-control" name="captcha" style="width: 100px;" />



				</div>

			</div>



			<div class="row">



				<div class="col-sm-12 form-group" style="margin-bottom: 0;">

					<div class="col-xs-12 ">

						<button type="submit" title="Subscribe" style="width: 100%" class="subscribe"><span>Submit</span></button>
					</div>

				</div>

			</div>

		</form>









<script>

	$(document).ready(function() {

		jQuery.noConflict();
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

					message: {

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

								message: 'Wrong answer',

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

				var category = $('#pc_title1').val(); // get category field value

				var subcategory = $('#psubc_title1').val(); // get subcategory field value

				var product = $('#p_title1').val(); // get product field value


				$.ajax(

					{

						type: "POST",

						url: "/api/email/quickEmailProduct.php",

						data: {

							name: name,
							email: email,
							phone : phone,
							company: company,
							category: category,
							subcategory: subcategory,
							product: product,
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
<?php include( "include/header.php" ); ?>
<?php include( "include/body.php" ); ?>

<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<ul>
				<li class="home"><a title="Go to Home Page"
				                    href="<?=SITEURL?>">Home</a><span>&mdash;</span></li>
				<li class="category13"><strong>Contact Us</strong></li>
			</ul>
		</div>
	</div>
</div>
<!-- main-container -->
<div class="main-container col2-right-layout">
	<div class="main container">
		<div class="row">
			<section class="col-main col-lg-8 wow bounceInUp animated">
				<div class="page-title">
					<h2>Contact Us</h2>
				</div>
				<fieldset class="group-select">
					<ul>
						<li id="billing-new-address-form">
							<fieldset>
								<legend>New Address</legend>
								<input type="hidden" name="billing[address_id]" value="" id="billing:address_id">
								<ul>
									<li>
										<div class="customer-name">
											<div class="input-box name-firstname">
												<label for="billing:firstname"> First Name<span
														class="required">*</span></label>
												<br>
												<input type="text" id="billing:firstname" name="billing[firstname]"
												       value="" title="First Name" class="input-text ">
											</div>
											<div class="input-box name-lastname">
												<label for="billing:lastname"> Email Address <span class="required">*</span>
												</label>
												<br>
												<input type="text" id="billing:lastname" name="billing[lastname]"
												       value="" title="Last Name" class="input-text">
											</div>
										</div>
									</li>
									<li>
										<div class="input-box">
											<label for="billing:company">Company</label>
											<br>
											<input type="text" id="billing:company" name="billing[company]" value=""
											       title="Company" class="input-text">
										</div>
										<div class="input-box">
											<label for="billing:email">Telephone <span
													class="required">*</span></label>
											<br>
											<input type="text" name="billing[email]" id="billing:email" value=""
											       title="Email Address" class="input-text validate-email">
										</div>
									</li>
									<li>
										<label>Address <span class="required">*</span></label>
										<br>
										<input type="text" title="Street Address" name="billing[street][]"
										       id="billing:street1" value="" class="input-text required-entry">
									</li>
									<li>
										<input type="text" title="Street Address 2" name="billing[street][]"
										       id="billing:street2" value="" class="input-text required-entry">
									</li>
									<li class="">
										<label for="comment">Comment<em class="required">*</em></label>
										<br>

										<div style="float:none" class="">
											<textarea name="comment" id="comment" title="Comment"
											          class="required-entry input-text" cols="5"
											          rows="3"></textarea>
										</div>
									</li>
								</ul>
							</fieldset>
						</li>
						<li><p class="require"><em class="required">* </em>Required Fields</p>
							<input type="text" name="hideit" id="hideit" value="" style="display:none !important;">

							<div class="buttons-set">
								<button type="submit" title="Submit" class="button submit"><span> Submit </span>
								</button>
							</div>
						</li>
					</ul>
				</fieldset>
			</section>
			<aside class="col-right sidebar col-lg-4 wow bounceInUp animated">
				<div class="block block-company">
					<div class="block-title">Contact Information</div>
					<div class="block-content" style="padding: 15px !important;">
						<p class="button"><i class="icon-location-arrow">&nbsp;</i> ADDRESS</p>

						<p>830, GIDC Estate</br>
						Makarpura, Vadodara</br>
						Gujarat, India</br>
						Pin : 390010</p>
						<p class="button"><i class="icon-mobile-phone">&nbsp;</i> PHONE</p>
						<p>0265-6642566 </br> +91 90990 56200</p>
						<p class="button"><i class="icon-envelope">&nbsp;</i> EMAIL</p>
						<p><strong>Sales/Inquiry :</strong></br> sales@primecomponents.net</p>
						<p><strong>Account :</strong></br> dimple@primecomponents.net</p>
						<p><strong>Purchase :</strong></br> chirayu@primecomponents.net</p>
						<p><strong>Technical :</strong></br> rajan@primecomponents.net</p>

					</div>
				</div>
			</aside>
		</div>
	</div>
</div>
<!--End main-container -->


<?php include( "include/footer.php" ); ?>






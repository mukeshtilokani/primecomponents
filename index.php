<?php include("include/header.php"); ?>
<?php include("include/body.php"); ?>

	<!-- main-container -->
	<div class="main-container col2-right-layout">
		<div class="main container">
			<div class="row">
				<section class="col-main col-sm-9 wow bounceInUp animated">

					<div class="static-contain">

						<?php



							pageContent( 'home');



						?>


					</div>
				</section>
				<aside class="col-right sidebar col-sm-3 wow bounceInUp animated">
					<div class="block block-company">
						<div class="block-title">Inquire Now!</div>
						<div class="block-content" style="padding: 20px !important;">
							<?php include("include/quickContact.php"); ?>
						</div>
					</div>
				</aside>
			</div>
		</div>
	</div>
	<!--End main-container -->
	<div class="brand-logo ">
		<div class="container">
			<div class="row">
				<div class="slider-items-products col-lg-12">
					<div class="new_title">Our Products</div>
					<div id="brand-logo-slider" class="product-flexslider hidden-buttons">
						<div class="slider-items slider-width-col6">

<?php

	$dbh  = new PDO( $dsn, $username, $password );

	$sql1 = $dbh->prepare( "SELECT * FROM p_categories

                                               WHERE pc_active='Y' ORDER BY pc_order ASC " );

	$sql1->execute();

	$rows1 = $sql1->fetchAll();

	//print_r($rows) ;

	for ( $j = 0; $j < count( $rows1 ); $j ++ ) { ?>

							<!-- Item -->
							<div class="item" style="border: 1px solid #ccc">
								<a href="<?= SITEURL ?>products/<?= $rows1[ $j ]['pc_alias'] ?> " >
								<img src="<?= SITEURL ?>images/cat/thumb/<?= $rows1[ $j ]['pc_image'] ?>" alt="Image" style="max-width: 130px;max-height: 175px;" >
								</a>
<div style="background: #F0AA21; color: #fff; width: 100%; padding-top: 5px; padding-bottom: 5px;">
								<a href="<?= SITEURL ?>products/<?= $rows1[ $j ]['pc_alias'] ?>" style="color: #323232;text-shadow: 0 1px 0 rgba(255, 255, 255, 0.4); font-weight: bold ">
									<?= urldecode( $rows1[ $j ]['pc_title'] ) ?>
								</a>
</div>
							</div>

							<!-- End Item -->

	<?php } ?>



						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include("include/footer.php"); ?>
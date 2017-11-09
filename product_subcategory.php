<?php include( "include/header.php" ); ?>
<?php include( "include/body.php" ); ?>

<?php

	$subCatData     = prodSubCategoryDataBySubCatAlias( $pageAlias[3] );
	$jsonSubCatData = json_decode( $subCatData );
	foreach ( $jsonSubCatData as $valueSubCatData ) {
		?>

		<!-- Breadcrumbs -->

		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<ul>
						<li class="home"><a title="Go to Home Page" href="<?= SITEURL ?>">Home</a><span>&raquo;</span>
						</li>
						<li class="home"><a title="Products"
						                    href="<?= SITEURL ?>products">Products</a><span>&raquo;</span></li>

						<li class="home">
							<a href="<?= SITEURL ?>category/<?php echo urldecode( htmlspecialchars_decode( $valueSubCatData->pc_alias ) ); ?>"

							   title="Back to <?php echo urldecode( htmlspecialchars_decode( $valueSubCatData->pc_title ) ); ?>">

								<?php echo urldecode( htmlspecialchars_decode( $valueSubCatData->pc_title ) ); ?></a><span>&raquo;</span>
						</li>

						<li>

						<li class="category13">
							<strong><?php echo urldecode( htmlspecialchars_decode( $valueSubCatData->psubc_title ) ); ?></strong>
						</li>
					</ul>
				</div>
			</div>
		</div>


		<!-- MAIN CONTENT -->

		<!-- Two columns content -->
		<div class="main-container col2-right-layout">
			<div class="main container">
				<div class="row">
					<section class="col-main col-sm-9 col-sm-push-3">


						<div
							style="background: #ecf0f1 none repeat scroll 0 0;border-bottom: 3px solid #2d5290;border-radius: 3px 3px 0 0;color: #000;font-size: 16px;font-weight:normal;padding: 14px 15px;text-transform: uppercase;margin-bottom: 10px;">
							<span
								style="font-size: 22px;font-style: italic;font-weight: 400;letter-spacing: 1px;padding: 0;">  <?php echo urldecode( htmlspecialchars_decode( $valueSubCatData->psubc_title ) ); ?></span>
							<span style="font-size: 16px; float: right;text-transform: capitalize;">
								<?php echo "in " . urldecode( htmlspecialchars_decode( $valueSubCatData->pc_title ) ); ?>
							</span>
						</div>


						<?php


							$prodData = prodData( $valueSubCatData->pc_id, $valueSubCatData->psubc_id );

							$jsonProdData = json_decode( $prodData );

							foreach ( $jsonProdData as $valueProdData ) {


								?>

								<ul class="products-grid">


									<li class="col-lg-4 col-md-4 col-sm-6 col-xs-12">


										<div class="item">
											<div class="col-item">

												<div class="item-inner">
													<div class="product-wrapper">
														<div class="thumb-wrapper">
															<a href="<?= SITEURL ?>product/<?= urldecode( $valueProdData->pc_alias ) ?>/<?= urldecode( $valueProdData->psubc_alias ) ?>/<?= urldecode( $valueProdData->p_alias ) ?>" class="thumb flip">
																<span class="face">
																<?php

																	$image = getProductMainImg( urldecode( $valueProdData->p_id ), urldecode( $valueProdData->p_featured_img ));

																	if ( strlen( $image ) > 0 ) { ?>

																		<img

																			src="<?= SITEURL ?>images/products/medium/<?= urldecode( htmlspecialchars_decode( $image ) ) ?>"

																			alt=""  />

																	<?php } else { ?>

																		<img src="<?= SITEURL ?>images/no-image.jpg"

																		     alt="" style="max-height: 150px;max-width: 210px;"/>

																	<?php } ?>


																</span>
																</a>
														</div>
													</div>

													<div class="item-info">

														<div class="actions">

															<a   href="<?= SITEURL ?>product/<?= urldecode( $valueProdData->pc_alias ) ?>/<?= urldecode( $valueProdData->psubc_alias ) ?>/<?= urldecode( $valueProdData->p_alias ) ?> "  title="<?= urldecode( $valueProdData->p_title ) ?>">
																<button class="button btn-clear" title="View Details" type="button">
																	<span><?= urldecode( $valueProdData->p_title ) ?></span>
																</button>
															</a>
														</div>
													</div>



												</div>
											</div>
										</div>
									</li>


								</ul>


							<?php } ?>


					</section>
					<aside class="col-right sidebar col-sm-3 col-xs-12 col-sm-pull-9">
						<?php include( "include/sidebar.php" ); ?>
					</aside>
				</div>
			</div>
		</div>
		<!-- End Two columns content -->


		<!-- MAIN CONTENT -->
	<?php } ?>

<?php include( "include/footer.php" ); ?>
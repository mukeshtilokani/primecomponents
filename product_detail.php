<?php include( "include/header.php" ); ?>
<?php include( "include/body.php" ); ?>


<?php

 

	if ( $pageAlias[3] != "all" ) {
		$prodData = prodDataByProdAlias( $pageAlias[2], $pageAlias[3], $pageAlias[4] );

	} else {
		$prodData = prodDataByProdAliasAll( $pageAlias[2], $pageAlias[4] );
	}


	$jsonProdData = json_decode( $prodData );
	foreach ( $jsonProdData as $valueProdData ) {
		?>


		<!-- end breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<ul>
						<li class="home"><a href="<?= SITEURL ?>" title="Go to Home Page">Home</a><span>&raquo; </span>
						</li>
						<li class=""><a href="<?= SITEURL ?>products"
						                title="Back to the Products">Products</a><span>&raquo; </span></li>

						<li class=""><a
								href="<?= SITEURL ?>category/<?php echo urldecode( htmlspecialchars_decode( $valueProdData->pc_alias ) ); ?>"
								title="Back to <?php echo urldecode( htmlspecialchars_decode( $valueProdData->pc_title ) ); ?>">
								<?php echo urldecode( htmlspecialchars_decode( $valueProdData->pc_title ) ); ?></a><span>&raquo; </span>
						</li>

						<?php if ( $pageAlias[3] != "all" ) { ?>

							<li class=""><a
									href="<?= SITEURL ?>sub-category/<?php echo urldecode( htmlspecialchars_decode( $valueProdData->pc_alias ) ); ?>/<?php echo urldecode( htmlspecialchars_decode( $valueProdData->psubc_alias ) ); ?>"
									class="homepage-link"
									title="Back to <?php echo urldecode( htmlspecialchars_decode( $valueProdData->psubc_title ) ); ?>">
									<?php echo urldecode( htmlspecialchars_decode( $valueProdData->psubc_title ) ); ?>

								</a><span>&raquo; </span></li>

						<?php } ?>


						<li class="category13">
							<strong> <?= urldecode( htmlspecialchars_decode( $valueProdData->p_title ) ) ?> </strong>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- end breadcrumbs -->
		<!-- main-container -->


		<section class="main-container">
			<div class="main container">
				<div class="col-main">
					<div class="row">

						<section class="col-main col-sm-9 wow bounceInUp animated">
							<div class="product-view">
								<div class="product-essential">
									<form action="#" method="post" id="product_addtocart_form">

										<div class="product-img-box col-sm-6 col-xs-12">
											<!--										<div class="new-label new-top-left"> New </div>-->
											<div class="product-image">
												<div class="large-image">


													<?php

														$prodMainImage = getProductMainImg( $valueProdData->p_id, $valueProdData->p_featured_img );


														if ( strlen( $prodMainImage ) > 0 ) { ?>

															<a href="<?= SITEURL ?>images/products/<?= $prodMainImage ?>"
															   class="cloud-zoom" id="zoom1"
															   rel="useWrapper: false, adjustY:0, adjustX:20"> <img
																	src="<?= SITEURL ?>images/products/medium/<?= $prodMainImage ?>">
															</a>
														<?php } ?>

												</div>
												<div class="flexslider flexslider-thumb">
													<ul class="previews-list slides">

														<?php
															$prodImage   = getProductImgAll( $valueProdData->p_id );
															$jsonImgData = json_decode( $prodImage, true );
															if ( count( $jsonImgData ) > 0 ) { ?>
																<?php
																for ( $k = 0; $k < count( $jsonImgData ); $k ++ ) {
																	?>
																	<li>
																		<a href='<?= SITEURL ?>images/products/<?= $jsonImgData[ $k ]['pi_image'] ?>'
																		   class='cloud-zoom-gallery'
																		   rel="useZoom: 'zoom1', smallImage: '/images/products/medium/<?= $jsonImgData[ $k ]['pi_image'] ?>' "><img
																				src="<?= SITEURL ?>images/products/medium/<?= $jsonImgData[ $k ]['pi_image'] ?>"
																				alt="Thumbnail 1"/></a></li>
																<?php } ?>
															<?php } ?>


													</ul>
												</div>
											</div>

											<!-- end: more-images -->

											<div class="clear"></div>
										</div>
										<div class="product-shop col-sm-6 col-xs-12">
											<div class="product-name">
												<h1><?= urldecode( htmlspecialchars_decode( $valueProdData->p_title ) ) ?></h1>
											</div>

											<div style="float: right" id="purchase">
												<a class="btn" style="background: #fff !important; border:1px solid #eee !important; font-size: 20px !important;"
												   title="PDF"
												   href="<?= SITEURL ?>images/pdf/<?= urldecode( htmlspecialchars_decode( $valueProdData->p_catalog_file ) ) ?>"
												   ><i style="color: #BB0706" class="fa fa-file-pdf-o"></i> </a>
												<a class="btn" id="btnPrint" style="background: #fff !important;border:1px solid #eee !important; font-size: 20px !important;"
												   title="Print" target="_blank" href="<?= SITEURL ?>images/pdf/<?= urldecode( htmlspecialchars_decode( $valueProdData->p_catalog_file ) ) ?>"><i style="color: #333"  class="fa fa-print"></i> </a>
												<a class="btn" style="background: #fff !important;border:1px solid #eee !important; font-size: 20px !important;"
												   title="Email"
												   href="mailto:sales@netlink-india.com?subject=Order <?= urldecode( htmlspecialchars_decode( $valueProdData->p_code ) ) ?> :: <?= urldecode( htmlspecialchars_decode( $valueProdData->p_title ) ) ?> from Netlink Technologies"><i style="color: #4285F4"
												                                                                                                                                                                                                                                    class="fa fa-envelope"> </i> </a>
											</div>
											<div class="product_details">

												<div class="product_type">Series:
																				<span style="color: #ef8210">
										<?= urldecode( htmlspecialchars_decode( $valueProdData->p_code ) ) ?></span>
												</div>
												<div class="product_type">Category:
													<a href="
										<?= SITEURL ?>category/
										<?= urldecode( htmlspecialchars_decode( $valueProdData->pc_alias ) ) ?>"
													   title="">
														<?= urldecode( htmlspecialchars_decode( $valueProdData->pc_title ) ) ?></a>
												</div>

												<?php if($valueProdData->psubc_id > 0) {  ?>
												<div class="product_vendor">Sub-Category:
													<a href="
										<?= SITEURL ?>sub-category/
										<?= urldecode( htmlspecialchars_decode( $valueProdData->pc_alias ) ) ?>/
										<?= urldecode( htmlspecialchars_decode( $valueProdData->psubc_alias ) ) ?> "
													   title="">
														<?= urldecode( htmlspecialchars_decode( $valueProdData->psubc_title ) ) ?></a>
												</div>
										<?php }  ?>

											</div>


											<div class="short-description">
												<h4 style="color: #EF8210">Product Overview :</h4>
												<?= urldecode( htmlspecialchars_decode( $valueProdData->p_intro ) ) ?>
											</div>


										</div>

									</form>
								</div>
								<div class="product-collateral col-xs-12">
									<div class="add_info">
										<ul id="product-detail-tab" class="nav nav-tabs product-tabs">
											<li class="active"><a href="#product_tabs_description" data-toggle="tab">
													Technical Specs </a></li>
											<!--										<li><a href="#product_tabs_tags" data-toggle="tab">Key Features</a></li>-->

										</ul>
										<div id="productTabContent" class="tab-content">
											<div class="tab-pane fade in active" id="product_tabs_description">
												<div class="std">

													<?= urldecode( htmlspecialchars_decode( $valueProdData->p_technical ) ) ?>

												</div>
											</div>
											<!--										<div class="tab-pane fade" id="product_tabs_tags">-->
											<!--											<div class="box-collateral box-tags">-->
											<!--												<div class="tags">-->
											<!--													-->

											<!--												</div>-->
											<!--tags-->

											<!--											</div>-->
											<!--										</div>-->


										</div>
									</div>
								</div>
							</div>
						</section>
						<aside class="col-right sidebar col-sm-3 wow bounceInUp animated">
							<div class="block block-company">
								<div class="block-title">Inquire Now!</div>
								<div class="block-content" style="padding: 20px !important;">
									<?php include( "include/quickContact.php" ); ?>
								</div>
							</div>
						</aside>
					</div>
				</div>
			</div>
		</section>


		<!--End main-container -->

	<?php } ?>
<?php include( "include/footer.php" ); ?>
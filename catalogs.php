<?php include( "include/header.php" ); ?>
<?php include( "include/body.php" ); ?>
<!-- Breadcrumbs -->
<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<ul>
				<li class="home"><a title="Go to Home Page" href="<?= SITEURL ?>">Home</a><span>&raquo;</span></li>
				<li class="category13"><strong>PDF Catalogs</strong></li>
			</ul>
		</div>
	</div>
</div>
<!-- Two columns content -->
<div class="main-container col2-right-layout">
	<div class="main container">
		<div class="row">
			<section class="col-main col-lg-9">
            <div style="background-color: #F0AA21 ;
    font-size: 22px;
    font-style: italic;
    font-weight: 400;
    letter-spacing: 1px;
    margin-bottom: 10px;
    margin-top: 0;
    padding: 10px 20px;">
            <a href="<?=SITEURL?>images/pdf/Broucher.pdf" style="color:#222b34;">Download Brochure!</a>
            </div> 
				<?php
					$catData = prodCategories();
					$jsonCatData = json_decode( $catData );
					//print_r($jsonCatData);
					foreach ( $jsonCatData as $valueCatData ) {
				?>
				<div id="<?php echo urldecode( htmlspecialchars_decode( $valueCatData->pc_id ) ); ?>"
					style="background: #ecf0f1 none repeat scroll 0 0;border-bottom: 3px solid #2d5290;border-radius: 3px 3px 0 0;color: #000;font-size: 16px;font-weight:normal;padding: 14px 15px;text-transform: uppercase;margin-bottom: 10px;">
							<span
								style="font-size: 22px;font-style: italic;font-weight: 400;letter-spacing: 1px;padding: 0;"><?php echo urldecode( htmlspecialchars_decode( $valueCatData->pc_title ) ); ?></span>
				</div>
				<?php
					//echo $valueCatData->pc_id;
					$subCatData     = prodSubCategoryData( $valueCatData->pc_id );
					$jsonSubCatData = json_decode( $subCatData );
					//print_r($jsonSubCatData);
					if( count($jsonSubCatData) > 0)
					{
					foreach ( $jsonSubCatData as $valueSubCatData ) {
						?>
						<div class="category-products">
							<h1 style="background: #F0EFED none repeat scroll 0 0; color: #333; font-size: 22px; font-style: italic; font-weight: 400; letter-spacing: 1px; margin-bottom: 10px; margin-top: 0; padding: 10px 20px;">
								<?= urldecode( htmlspecialchars_decode( $valueSubCatData->psubc_title ) ) ?>
							</h1>
							<ul class="products-grid row">
								<?php $dbh = new PDO( $dsn, $username, $password );
									$sql3  = $dbh->prepare( "SELECT * FROM products WHERE p_pc_id='" . $valueCatData->pc_id . "' and psubc_id='" . $valueSubCatData->psubc_id . "' " );
									$sql3->execute();
									$rows3 = $sql3->fetchAll();
								?>
								<?php for ( $l = 0; $l < count( $rows3 ); $l ++ ) {
									$uploadFileOrgName = urldecode( $rows3[ $l ]['p_catalog_file'] );
									?>
									<li class="col-md-3 col-sm-4 col-6 d-flex flex-wrap">
										<div class="item d-flex flex-column align-items-center pb-0 w-100">
											<div class="col-item mb-0">
												<div class="item-inner d-flex flex-column justify-content-between">
													<div class="product-wrapper">
														<div class="thumb-wrapper">
															<a href="<?= SITEURL ?>images/pdf/<?= $uploadFileOrgName ?>" >
																<span class="pdf pdf d-flex align-items-center justify-content-center"><i class="fa fa-file-pdf-o"></i></span>
															</a>
														</div>
													</div>
													<div class="item-info">
														<div class="info-inner">
															<div class="item-title">
																<a href="<?= SITEURL ?>images/pdf/<?= $uploadFileOrgName ?>" target="_blank"
																	title="<?= urldecode( $rows3[ $l ]['p_title'] ) ?>" class="d-flex flex-wrap align-items-center justify-content-center pt-0 mb-0"> <?= urldecode( $rows3[ $l ]['p_title'] ) ?> </a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</li>
								<?php } ?>
							</ul>
						</div>
					<?php }
					} else {?>
						<div class="category-products">
							<ul class="products-grid row">
								<?php $dbh = new PDO( $dsn, $username, $password );
									$sql3  = $dbh->prepare( "SELECT * FROM products WHERE p_pc_id='" . $valueCatData->pc_id . "' " );
									$sql3->execute();
									$rows3 = $sql3->fetchAll();
								?>
								<?php for ( $l = 0; $l < count( $rows3 ); $l ++ ) {
									$uploadFileOrgName = urldecode( $rows3[ $l ]['p_catalog_file'] );
									?>
									<li class="col-md-3 col-sm-4 col-6 d-flex flex-wrap">
										<div class="item d-flex flex-column align-items-center pb-0 w-100">
											<div class="col-item mb-0">
												<div class="item-inner d-flex flex-column justify-content-between">
													<div class="product-wrapper">
														<div class="thumb-wrapper">
															<a href="<?= SITEURL ?>images/pdf/<?= $uploadFileOrgName ?>" target="_blank">
																<span class="pdf pdf d-flex align-items-center justify-content-center"><i class="fa fa-file-pdf-o"></i></span>
															</a>
														</div>
													</div>
													<div class="item-info">
														<div class="info-inner">
															<div class="item-title">
																<a href="<?= SITEURL ?>images/pdf/<?= $uploadFileOrgName ?>" target="_blank"
																	title="<?= urldecode( $rows3[ $l ]['p_title'] ) ?>" class="d-flex flex-wrap align-items-center justify-content-center pt-0 mb-0"> <?= urldecode( $rows3[ $l ]['p_title'] ) ?> </a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</li>
								<?php } ?>
							</ul>
						</div>
					<?php }
					}?>
			</section>
			<aside class="col-right sidebar col-lg-3">
				<?php include( "include/sidebar-catalog.php" ); ?>
			</aside>
		</div>
	</div>
</div>
<!-- End Two columns content -->
<?php include( "include/footer.php" ); ?>

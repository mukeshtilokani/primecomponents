<?PHP
	require_once '../../data/config.php';
	try {


		$dbh = new PDO($dsn, $username, $password);
		$sql = $dbh->prepare("SELECT * FROM products WHERE
                                p_active='Y' and p_id ='".$_POST['p_id']."' ");

		$sql->execute();
		$result = $sql->fetchAll();


		$prodData = json_encode($result);
		$jsonProdData = json_decode( $prodData );

		if( count($jsonProdData)>0) {
			?>


			<div class="row">

				<div class="col-lg-12">
					<h1 class="page-header"><?= urldecode( htmlspecialchars_decode( $jsonProdData[0]->p_title ) ) ?></h1>
				</div>

				<?php
					$sql1 = $dbh->prepare("SELECT * FROM products_images pi LEFT JOIN
                                products p ON pi.p_id = p.p_id
                                WHERE
                                p.p_active='Y' and p.p_id ='".$_POST['p_id']."' ");

					$sql1->execute();
					$result1 = $sql1->fetchAll();


					$prodData1 = json_encode($result1);
					$jsonProdData1 = json_decode( $prodData1 );

					if( count($jsonProdData1)>0) {

						foreach ( $jsonProdData1 as $valueProdData1 ) { ?>

							<div class="col-lg-3 col-md-4 col-xs-6 thumb">
								<a href="#" class="thumbnail">
									<img alt=""
									     src="<?= SITEURLFRONT ?>images/products/medium/<?= urldecode( htmlspecialchars_decode( $valueProdData1->pi_image ) ) ?>"
									     class="img-responsive">
								</a>
								<div>
									<a  data-id="<?=$valueProdData1->pi_id?>" data-pid="<?=$valueProdData1->p_id?>"   class="btn btn-primary mainImg" ><span class="fa fa-pencil"></span> Set Main Image</a>

								</div>
							</div>


						<?php } ?>
<script>
						$('.mainImg').on('click',   function () {

						var pi_id = $(this).data('id');
						var p_id = $(this).data('pid');
							//alert(pi_id);

						$.ajax({
						type: 'POST',
						data: {
							pi_id: pi_id,
							p_id: p_id
						},
						url: '../../api/product/setMainImage.php',
						success: function (data) {


							$.alert('Set Successfully!', {
								title: 'Main Image',
								autoClose: true,
								type: 'success'
							});




						}

						});


						});
</script>
				<?php	}
					else
						{ ?>
				<div class="col-lg-12 col-md-12 col-xs-12">
						<div class="alert alert-danger">
							No images uploaded.
						</div>
					</div>

					<?php 	} ?>

			</div>




	<?php }
		$dbh = null;

	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
?>


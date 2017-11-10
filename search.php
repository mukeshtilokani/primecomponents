<?php include( "include/header.php" ); ?>

<?php include( "include/body.php" );


	function encodeURIComponent( $str ) {

		$revert = array( '%21' => '!', '%2A' => '*', '%27' => "'", '%28' => '(', '%29' => ')' );

		return strtr( rawurlencode( $str ), $revert );

	}

	$sText = "";
	if ( isset( $_POST['search'] ) ) {


		$sText = encodeURIComponent( $_POST['search'] );
	}


?>


<!-- BREADCRUMBS -->


<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<ul>
				<li class="home"> <a title="Go to Home Page" href="<?=SITEURL?>">Home</a><span>&mdash;</span></li>
				<li class="category13"><strong>Search</strong></li>
			</ul>
		</div>
	</div>
</div>

<!-- main-container -->
<div class="main-container col2-right-layout">
	<div class="main container">
		<div class="row">
			<section class="col-main col-sm-9 wow bounceInUp animated">
				<div class="page-title">
					<h2>Search Results</h2>
				</div>
				<div class="static-contain">
					<div class="about">
						<?php

							$dbh = new PDO( $dsn, $username, $password );




							$sql = $dbh->prepare( "SELECT * FROM products p LEFT JOIN

p_categories pc ON p.p_pc_id = pc.pc_id

LEFT JOIN

p_subcategories psc ON p.psubc_id = psc.psubc_id

WHERE

p.p_active='Y' and pc.pc_active='Y' and  psc.psubc_active ='Y' and ( p.p_code  like '%" . $sText . "%'

or p.p_title  like '%" . $sText . "%'

or pc.pc_title like '%" . $sText . "%'

or psc.psubc_title like '%" . $sText . "%'



) order by p.p_id " );

							$sql->execute();

							$rows = $sql->fetchAll();

							if(count($rows) > 0 && strlen($sText) > 0 )
							{

							$sql1 = $dbh->prepare( "SELECT * FROM products p LEFT JOIN

p_categories pc ON p.p_pc_id = pc.pc_id

LEFT JOIN

p_subcategories psc ON p.psubc_id = psc.psubc_id

WHERE

p.p_active='Y' and pc.pc_active='Y' and  psc.psubc_active ='Y' and ( p.p_code  like '%" . $sText . "%'

or p.p_title  like '%" . $sText . "%'

or pc.pc_title like '%" . $sText . "%'

or psc.psubc_title like '%" . $sText . "%'



) order by p.p_id " );
							}
							else if(strlen($sText) > 0 )
							{
								$sql1 = $dbh->prepare( "SELECT * FROM products p LEFT JOIN

p_categories pc ON p.p_pc_id = pc.pc_id

WHERE

p.p_active='Y' and pc.pc_active='Y' and   ( p.p_code  like '%" . $sText . "%'

or p.p_title  like '%" . $sText . "%'

or pc.pc_title like '%" . $sText . "%'



) order by p.p_id " );
							}
							else
							{
								$sql1 = $dbh->prepare( "SELECT * FROM products WHERE p_active='Y') order by p.p_id " );
							}

							$sql1->execute();

							$rows1 = $sql1->fetchAll();

							//print_r($rows) ; ?>


						<table class="table table-bordered table-hover">

							<tr class="success">

								<th>

									<strong>

										Series</strong>


								</th>


								<th><strong>

										Category</strong>

								</th>


								<th><strong>

										Sub-Category</strong>

								</th>


								<th><strong>

										Product Name</strong>

								</th>

							</tr>


							<?php

								for ( $j = 0; $j < count( $rows1 ); $j ++ ) { ?>


									<tr>

										<td>

											<?php /*
											<a href="<?= SITEURL ?>category/<?= urldecode( htmlspecialchars_decode( $rows1[ $j ]['pc_alias'] ) ) ?>/<?php if(isset($rows1[ $j ]['psubc_alias']) && strlen(trim($rows1[ $j ]['psubc_alias']))> 0 ) {echo urldecode( htmlspecialchars_decode( $rows1[ $j ]['psubc_alias'] ) ); } else { echo "all"; } ?>/<?= urldecode( htmlspecialchars_decode( $rows1[ $j ]['p_alias'] ) ) ?>"> */ ?>
												
												<?= urldecode( htmlspecialchars_decode( $rows1[ $j ]['p_code'] ) ) ?>


											<?php /*</a>*/ ?>


										</td>


										<td>

											<a href="<?= SITEURL ?>category/<?= urldecode( htmlspecialchars_decode( $rows1[ $j ]['pc_alias'] ) ) ?>">

												<?= urldecode( htmlspecialchars_decode( $rows1[ $j ]['pc_title'] ) ) ?>


											</a>

										</td>


										<td>
											<?php if(isset($rows1[ $j ]['psubc_alias']) && strlen(trim($rows1[ $j ]['psubc_alias']))> 0 ) { ?>






											<a href="<?= SITEURL ?>sub-category/<?= urldecode( htmlspecialchars_decode( $rows1[ $j ]['pc_alias'] ) ) ?>/<?= urldecode( htmlspecialchars_decode( $rows1[ $j ]['psubc_alias'] ) ) ?>">

												<?= urldecode( htmlspecialchars_decode( $rows1[ $j ]['psubc_title'] ) ) ?>


											</a>
											<?php }
											else { echo "All"; } ?>

										</td>


										<td>

											<a href="<?= SITEURL ?>product/<?= urldecode( htmlspecialchars_decode( $rows1[ $j ]['pc_alias'] ) ) ?>/<?php echo isset($rows1[ $j ]['psubc_alias']) ?  urldecode( htmlspecialchars_decode( $rows1[ $j ]['psubc_alias'] ) ) : 'all' ?>/<?= urldecode( htmlspecialchars_decode( $rows1[ $j ]['p_alias'] ) ) ?>">

												<?= urldecode( htmlspecialchars_decode( $rows1[ $j ]['p_title'] ) ) ?>


											</a>

										</td>


									</tr>


								<?php } ?>


						</table>

					</div>
				</div>
			</section>
			<aside class="col-right sidebar col-sm-3 wow bounceInUp animated">
				<?php include( "include/sidebar.php" ); ?>
			</aside>
		</div>
	</div>
</div>
<!--End main-container -->









<?php include( "include/footer.php" ); ?>




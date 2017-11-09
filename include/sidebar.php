	<div class="block block-layered-nav">
		<div class="block-title">Products</div>
		<div class="block-content">

			<?php $dbh = new PDO( $dsn, $username, $password );
				$sql1  = $dbh->prepare( "SELECT * FROM p_categories WHERE pc_active='Y' order by pc_order asc" );
				$sql1->execute();
				$rows1 = $sql1->fetchAll();
				for ( $j = 0; $j < count( $rows1 ); $j ++ ) {
					?>

					<p class="button button-clear"> <a href="<?= SITEURL ?>category/<?= urldecode( $rows1[ $j ]['pc_alias'] ) ?>" >  <?=urldecode( $rows1[ $j ]['pc_title']) ?> </a></p>
					<dl id="narrow-by-list">
						<?php $dbh = new PDO( $dsn, $username, $password );
							$sql2  = $dbh->prepare( "SELECT * FROM p_subcategories WHERE pc_id='" . $rows1[ $j ]['pc_id'] . "' " );
							$sql2->execute();
							$rows2 = $sql2->fetchAll(); ?>

						<?php if ( count( $rows2 ) > 0 ) {
							for ( $k = 0; $k < count( $rows2 ); $k ++ ) { ?>

								<dt class="odd" style="color: #fff; background: #f0aa21; padding-left: 20px; margin-bottom: 10px;" > <a href="<?= SITEURL ?>sub-category/<?= urldecode( $rows1[ $j ]['pc_alias'] ) ?>/<?= urldecode( $rows2[ $k ]['psubc_alias'] ) ?>"> <?= urldecode($rows2[ $k ]['psubc_title']) ?></a> </dt>
								<dd class="odd">
									<ol>
										<?php $dbh = new PDO( $dsn, $username, $password );
											$sql3  = $dbh->prepare( "SELECT * FROM products WHERE p_pc_id='" . $rows1[ $j ]['pc_id'] . "' and psubc_id='" . $rows2[ $k ]['psubc_id'] . "' " );
											$sql3->execute();
											$rows3 = $sql3->fetchAll();
										?>

										<?php for ( $l = 0; $l < count( $rows3 ); $l ++ ) { ?>

											<li><a href="<?= SITEURL ?>product/<?= urldecode( $rows1[ $j ]['pc_alias'] ) ?>/<?= urldecode( $rows2[ $k ]['psubc_alias'] ) ?>
											/<?= urldecode( $rows3[ $l ]['p_alias'] ) ?>">
													<span class="price"><?= urldecode($rows3[ $l ]['p_title']) ?></span> </a>
											</li>
										<?php } ?>
									</ol>
								</dd>

							<?php } ?>
						<?php } else { ?>
							<!--for products with no sub-category-->
							<dd class="odd">
								<ol>
									<?php $dbh = new PDO( $dsn, $username, $password );
										//$sql3  = $dbh->prepare( "SELECT * FROM products WHERE p_pc_id='" . $rows1[ $j ]['pc_id'] . "' " );


										$sql3  = $dbh->prepare( "SELECT * FROM products p LEFT JOIN
                                p_categories pc ON p.p_pc_id = pc.pc_id

                                WHERE
                                p.p_active='Y' and pc.pc_active='Y'  and p.p_pc_id='" .$rows1[ $j ]['pc_id']. "'");



										$sql3->execute();
										$rows3 = $sql3->fetchAll();
									?>

									<?php for ( $l = 0; $l < count( $rows3 ); $l ++ ) { ?>

										<li><a href="<?= SITEURL ?>product/<?= urldecode( $rows3[ $l ]['pc_alias'] ) ?>/all/<?= urldecode( $rows3[ $l ]['p_alias'] ) ?>"><span class="price"><?= urldecode($rows3[ $l ]['p_title']) ?></span> </a>
										</li>
									<?php } ?>
								</ol>
							</dd>
						<?php } ?>

					</dl>
				<?php } ?>

		</div>
	</div>

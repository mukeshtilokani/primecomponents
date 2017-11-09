<div class="block block-layered-nav">
	<div class="block-title">Products</div>
	<div class="block-content">

		<?php $dbh = new PDO( $dsn, $username, $password );
			$sql1  = $dbh->prepare( "SELECT * FROM p_categories WHERE pc_active='Y' order by pc_order asc" );
			$sql1->execute();
			$rows1 = $sql1->fetchAll();
			for ( $j = 0; $j < count( $rows1 ); $j ++ ) {
				?>

				<p class="button button-clear"> <a href="#<?=urldecode( $rows1[ $j ]['pc_id']) ?>"> <?=urldecode( $rows1[ $j ]['pc_title']) ?> </a></p>

			<?php } ?>

	</div>
</div>

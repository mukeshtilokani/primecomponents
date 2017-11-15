<?php include( "include/header.php" ); ?>
<?php include( "include/body.php" ); ?>


<!-- Breadcrumbs -->

<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col">
				<ul>
					<li class="home"> <a title="Go to Home Page" href="<?=SITEURL?>">Home</a><span>&mdash;</span></li>
					<li class="category13"><strong>About Us</strong></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- main-container -->
<div class="main-container col2-right-layout">
	<div class="main container">
		<div class="row">
			<section class="col-main col-sm-9 wow bounceInUp animated">
				<div class="page-title">
					<h2>About Us</h2>
				</div>
				<div class="static-contain">
					<div class="about">
					<?php
						pageContent('about-us');
					?>
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

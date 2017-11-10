<body class="cms-index-index">



<div class="page">
	<!-- Header -->
	<header class="header-container">

		<div class="header container">
			<div class="row">
				<div class="col-lg-3 col-sm-6 col-md-3">
					<!-- Header Logo -->
					<a class="logo" title="Prime Components" href="<?= SITEURL ?>"><img alt="Prime Components" src="<?=SITEURL?>images/logo.png"></a>
					<!-- End Header Logo -->
				</div>
				<div class="col-lg-9 col-sm-6 col-md-9">
					<!-- Search-col -->
					<div class="search-box pull-right">

						<form action="<?=SITEURL?>search" method="post" id="search_mini_form" name="Categories">

							<input type="text" placeholder="Search entire store here..." value="" maxlength="70" name="search" id="search">

							<button id="search-submit" type="submit" class="btn btn-default  search-btn-bg"> <span class="glyphicon glyphicon-search"></span>&nbsp;</button>

						</form>



					</div>


					<!-- End Search-col -->
				</div>
			</div>
		</div>
	</header>
	<!-- end header -->


 
		<?php include("include/menu.php"); ?>
          
           
    
   <?php  if($pageName=="index.php")
	{ 
	include("include/slider.php");
	}
	else
	{ ?>
    
    
    
 
	<?php }
	?>
  
  
  
    
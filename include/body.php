<body class="cms-index-index">
<div class="page">
	<!-- Header -->
	<header class="header-container">
		<div class="header container">
			<div class="row">
				<div class="d-flex flex-wrap align-items-center justify-content-between">
					<div class="col-md-4 col-sm-6">
						<!-- Header Logo -->
						<a class="logo" title="Prime Components" href="<?= SITEURL ?>">
							<img alt="Prime Components" src="<?=SITEURL?>images/logo.png" class="img-fluid">
						</a>
						<!-- End Header Logo -->
					</div>
					<div class="col-md-4 col-sm-6">
						<!-- Search-col -->
						<div class="search-box pull-right">
							<form action="<?=SITEURL?>search" method="post" id="search_mini_form" name="Categories">
								<div class="input-group">
	                                <input type="text" class="form-control" placeholder="Search entire store here..." value="" maxlength="70" name="search" id="search">
	                                <span class="input-group-btn">
	                                    <button id="search-submit" type="submit" class="btn round btn-primary search-btn-bg " type="button">Search</button>
	                                </span>
	                            </div>
							</form>
						</div>
						<!-- End Search-col -->
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- end header -->
	<?php include("include/menu.php"); ?>
		<?php  /* if($pageName=="index.php")
		{ 
			include("include/slider.php");
		}
		else
		{ ?>
		<?php }*/
	?>
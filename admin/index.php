<?php
ob_start();$sess_name = session_name();if (session_start()) {	setcookie($sess_name, session_id(), null, '/', null, null, true);}if(isset($_SESSION['wf_id']) && $_SESSION['wf_id'] != ''){	require_once 'data/config.php';	$dbh = new PDO($dsn, $username, $password);	require_once 'include/header.php';  	require_once 'include/body.php';?>

<div class="main-content" >
  <div class="wrap-content container" id="container"> <!-- start: DASHBOARD TITLE -->
    <section id="page-title" class="padding-top-15 padding-bottom-15">
      <div class="row">
        <div class="col-sm-7">
          <h1 class="mainTitle">Dashboard</h1>
          <span class="mainDescription">overview &amp; stats </span> </div>
        <div class="col-sm-5"> <!-- start: MINI STATS WITH SPARKLINE -->
          <ul class="mini-stats pull-right">
            <li>
              <div class="values"> <strong class="text-dark">50</strong>
                <p class="text-small no-margin"> Products </p>
              </div>
            </li>
            <li>
              <div class="values"> <strong class="text-dark">10</strong>
                <p class="text-small no-margin"> Categories </p>
              </div>
            </li>
            <li>
              <div class="values"> <strong class="text-dark">6</strong>
                <p class="text-small no-margin"> Sub-Categories </p>
              </div>
            </li>
          </ul>
          <!-- end: MINI STATS WITH SPARKLINE --> </div>
      </div>
    </section>
    <!-- end: DASHBOARD TITLE --> <!-- start: FEATURED BOX LINKS -->
    <div class="container-fluid container-fullw bg-white">
      <div class="row">
        <div class="col-sm-4">
          <div class="panel panel-white no-radius text-center">
            <div class="panel-body"> <a href="<?=SITEURL?>views/product/frmProductList.php"> <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-smile-o fa-stack-1x fa-inverse"></i> </span>
              <h2 class="StepTitle">Manage Products</h2>
              <p class="text-small"> To manage products, click here. </p>
              </a> </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="panel panel-white no-radius text-center">
            <div class="panel-body"> <a href="<?=SITEURL?>views/category/frmCategoryList.php"> <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
              <h2 class="StepTitle">Manage Categories</h2>
              <p class="text-small"> To manage categories, click here. </p>
              </a> </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="panel panel-white no-radius text-center">
            <div class="panel-body"> <a href="<?=SITEURL?>views/subcategory/frmSubCategoryList.php"> <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-terminal fa-stack-1x fa-inverse"></i> </span>
              <h2 class="StepTitle">Manage Sub-Categories</h2>
              <p class="text-small"> To manage sub-categories, click here. </p>
              </a> </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end: FEATURED BOX LINKS --> </div>
</div>
<?php	require_once 'include/footer.php';}else{	    header('Location: login.php');}?>
<script>    jQuery(document).ready(function() {        Main.init();    });</script>
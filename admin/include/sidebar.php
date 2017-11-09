<!-- sidebar -->

<div class="sidebar app-aside" id="sidebar">
  <div class="sidebar-container perfect-scrollbar">
    <nav> 
      <!-- start: MAIN NAVIGATION MENU -->
      <ul class="main-navigation-menu">
        <li class="active open"> <a href="<?=SITEURL?>index.php">
          <div class="item-content">
            <div class="item-media"> <i class="ti-home"></i> </div>
            <div class="item-inner"> <span class="title"> Dashboard </span> </div>
          </div>
          </a> </li>
        <li id="liWebpage"> <a href="javascript:void(0)">
          <div class="item-content">
            <div class="item-media"> <i class="ti-settings"></i> </div>
            <div class="item-inner"> <span class="title"> Website Pages</span><i class="icon-arrow"></i> </div>
          </div>
          </a>
          <ul class="sub-menu">
            <li><a href="<?= SITEURL ?>views/webpage/frmWebpage.php"> <span class="title">Add New </span> </a></li>
            <li><a href="<?= SITEURL ?>views/webpage/frmWebpageList.php"> <span class="title">View List / Edit / Update </span> </a></li>
          </ul>
        </li>
        <li id="liProductCategory"> <a href="javascript:void(0)">
          <div class="item-content">
            <div class="item-media"> <i class="ti-layout-grid2"></i> </div>
            <div class="item-inner"> <span class="title"> Categories </span><i class="icon-arrow"></i> </div>
          </div>
          </a>
          <ul class="sub-menu">
            <li><a href="<?= SITEURL ?>views/category/frmCategory.php"> <span class="title">Add New</a> </span> </li>
            <li><a href="<?= SITEURL ?>views/category/frmCategoryList.php"> <span class="title">View List / Edit / Update</span> </a> </li>
          </ul>
        </li>
        <li id="liProductSubCategory"> <a href="javascript:void(0)">
          <div class="item-content">
            <div class="item-media"> <i class="ti-pencil-alt"></i> </div>
            <div class="item-inner"> <span class="title"> Sub-Categories </span><i class="icon-arrow"></i> </div>
          </div>
          </a>
          <ul class="sub-menu">
            <li><a href="<?= SITEURL ?>views/subcategory/frmSubCategory.php"> <span class="title">Add New </a></span> </li>
            <li><a href="<?= SITEURL ?>views/subcategory/frmSubCategoryList.php"> <span class="title">View List / Edit / Update</a></span> </li>
          </ul>
        </li>
        <li id="liProduct"> <a href="javascript:void(0)">
          <div class="item-content">
            <div class="item-media"> <i class="ti-user"></i> </div>
            <div class="item-inner"> <span class="title"> Products </span><i class="icon-arrow"></i> </div>
          </div>
          </a>
          <ul class="sub-menu">
            <li><a href="<?= SITEURL ?>views/product/frmProduct.php"> <span class="title"> Add New </a> </span> </li>
            <li><a href="<?= SITEURL ?>views/product/frmProductList.php"> <span class="title">View List / Edit / Update</a> </span> </li>
          </ul>
        </li>

<!--        <li id="liNews"> <a href="javascript:void(0)">-->
<!--          <div class="item-content">-->
<!--            <div class="item-media"> <i class="ti-layers-alt"></i> </div>-->
<!--            <div class="item-inner"> <span class="title"> News </span><i class="icon-arrow"></i> </div>-->
<!--          </div>-->
<!--          </a>-->
<!--          <ul class="sub-menu">-->
<!--            <li><a href="--><?//= SITEURL ?><!--views/news/frmNews.php"> <span class="title">Add New</a> </span> </li>-->
<!--            <li><a href="--><?//= SITEURL ?><!--views/news/frmNewsList.php"> <span class="title">View List / Edit / Update</a></span> </li>-->
<!--          </ul>-->
<!--        </li>-->


<!--        <li id="liPDFGallery" style="display: none" > <a href="javascript:void(0)">-->
<!--          <div class="item-content">-->
<!--            <div class="item-media"> <i class="ti-layers-alt"></i> </div>-->
<!--            <div class="item-inner"> <span class="title"> PDF Gallery </span><i class="icon-arrow"></i> </div>-->
<!--          </div>-->
<!--          </a>-->
<!--          <ul class="sub-menu">-->
<!--            <li><a href="--><?//= SITEURL ?><!--views/pdfgallery/frmPDFGallery.php"> <span class="title">Add New</a> </span> </li>-->
<!--            <li><a href="--><?//= SITEURL ?><!--views/pdfgallery/frmPDFGalleryList.php"> <span class="title">View List / Edit / Update</a></span> </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--        <li id="liClients"> <a href="javascript:void(0)">-->
<!--          <div class="item-content">-->
<!--            <div class="item-media"> <i class="ti-layers-alt"></i> </div>-->
<!--            <div class="item-inner"> <span class="title"> Clients </span><i class="icon-arrow"></i> </div>-->
<!--          </div>-->
<!--          </a>-->
<!--          <ul class="sub-menu">-->
<!--            <li><a href="--><?//= SITEURL ?><!--views/clients/frmClients.php"> <span class="title">Add New</a> </span> </li>-->
<!--            <li><a href="--><?//= SITEURL ?><!--views/clients/frmClientsList.php"> <span class="title">View List / Edit / Update</a></span> </li>-->
<!---->
<!---->
<!--           </ul>-->
<!--        </li>-->
<!---->
<!--         -->
<!---->
<!--        <li id="liAppraisals"> <a href="javascript:void(0)">-->
<!--            <div class="item-content">-->
<!--              <div class="item-media"> <i class="ti-layers-alt"></i> </div>-->
<!--              <div class="item-inner"> <span class="title"> Appraisals Photos</span><i class="icon-arrow"></i> </div>-->
<!--            </div>-->
<!--          </a>-->
<!--          <ul class="sub-menu">-->
<!---->
<!--            <li><a href="--><?//= SITEURL ?><!--views/appraisals/frmAppraisals.php"> <span class="title">Add Photos</a> </span> </li>-->
<!--            <li><a href="--><?//= SITEURL ?><!--views/appraisals/frmAppraisalsList.php"> <span class="title">View List / Edit / Update  Appraisals Photos</a></span> </li>-->
<!--          </ul>-->
<!--        </li>-->




        <li id="liTestimonials"> <a href="javascript:void(0)">
          <div class="item-content">
            <div class="item-media"> <i class="ti-layers-alt"></i> </div>
            <div class="item-inner"> <span class="title"> Testimonials </span><i class="icon-arrow"></i> </div>
          </div>
          </a>
          <ul class="sub-menu">
            <li><a href="<?= SITEURL ?>views/testimonials/frmTestimonials.php"> <span class="title">Add New</a> </span> </li>
            <li><a href="<?= SITEURL ?>views/testimonials/frmTestimonialsList.php"> <span class="title">View List / Edit / Update</a></span> </li>
          </ul>
        </li>
        <li id="liHomeBanner"> <a href="javascript:void(0)">
          <div class="item-content">
            <div class="item-media"> <i class="ti-layers-alt"></i> </div>
            <div class="item-inner"> <span class="title"> Home Banner </span><i class="icon-arrow"></i> </div>
          </div>
          </a>
          <ul class="sub-menu">
            <li><a href="<?= SITEURL ?>views/homebanners/frmHomeBanners.php"> <span class="title">Add New</a> </span> </li>
            <li><a href="<?= SITEURL ?>views/homebanners/frmHomeBannersList.php"> <span class="title">View List / Edit / Update</a></span> </li>
          </ul>
        </li>
      </ul>
      <!-- end: MAIN NAVIGATION MENU --> 
      
      <!-- start: DOCUMENTATION BUTTON -->
      <div class="wrapper"> <a href="<?=SITEURL?>documentation.html" class="button-o" target="_blank"> <i class="ti-help"></i> <span>Documentation</span> </a> </div>
      <!-- end: DOCUMENTATION BUTTON --> 
    </nav>
  </div>
</div>
<!-- / sidebar -->
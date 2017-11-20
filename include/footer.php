<!-- Footer -->
<footer class="footer">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer-logo">
                        <a href="<?=SITEURL?>" title="Logo">
                            <img src="/images/footer-logo.png" alt="logo" class="img-fluid" style="width: 150px">
                        </a>
                    </div>
                    <p>Manufacturer of PCB Terminal Blocks, Edge Connectors, Fuse Holders, Rotary Switches, Rocker Switches, Push Connectors, Sub-Miniature, Ballasts, etc. </p>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h4>Menu</h4>
                    <ul class="links">
                        <?php
                            $dbh = new PDO( $dsn, $username, $password );
                            $sql = $dbh->prepare( "SELECT wp_title, wp_alias, wp_id FROM webpages WHERE wp_active='Y' AND wp_menu='Y' ORDER BY wp_order" );
                            $sql->execute();
                            $rows = $sql->fetchAll();
                            //print_r($rows) ;
                            //echo $pageAlias;
                            for ( $i = 0; $i < count( $rows ); $i ++ ) {?>
                        <li>
                            <a href="<?= SITEURL ?><?= $rows[ $i ]['wp_alias'] ?>" > <?= urldecode( $rows[ $i ]['wp_title'] ) ?>
                            </a>
                        </li>
                        <?php  } ?>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h4>Products</h4>
	                <ul class="links">
		                <?php  $dbh = new PDO($dsn, $username, $password);
			                $sql1 = $dbh->prepare("SELECT * FROM p_categories WHERE pc_active='Y' order by pc_order asc");
			                $sql1->execute();
			                $rows1 = $sql1->fetchAll();
			                for($j=0;$j < count($rows1); $j++)
			                { ?>
		                <li>
                            <a href="<?=SITEURL?>category/<?=$rows1[$j]['pc_alias']?>">
				                <?= urldecode(html_entity_decode( $rows1[$j]['pc_title']))?>
			                </a>
		                </li>
		                <?php } ?>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h4>Get in Touch</h4>
                    <ul class="contact-info">
                        <li><i class="icon-mobile-phone">&nbsp;</i><span>  0265-6642566</span></li>
                        <li><i class="icon-envelope">&nbsp;</i><span>  <a href="mailto:sales@primecomponents.net">sales@primecomponents.net</a></span></li>
                        <li class="last"><i class="icon-location-arrow">&nbsp;</i><span>830, GIDC Estate, Makarpura, Vadodara, Gujarat, India - 390010</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-primary-bottom">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-4 social">
                    <ul class="d-flex justify-content-center">
                        <li class="fb"><a href="#"></a></li>
                        <li class="tw"><a href="#"></a></li>
                        <li class="googleplus"><a href="#"></a></li>
                    </ul>
                </div>
                <!-- <div class="col-lg-8 block-subscribe">
                    <div class="newsletter my-3">
                        <form class="form-group d-flex flex-wrap justify-content-center">
                            <h4>Sign up for emails</h4>
                            <div class="input-group">
                                <input type="text" class="form-control required-entry validate-email" placeholder="Enter your email address" title="Sign up for our newsletter" id="newsletter1" name="email">
                                <span class="input-group-btn">
                                    <button id=""  title="Subscribe" type="submit" class="btn round btn-primary search-btn-bg">Subscribe</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row my-2">
                <div class="col-lg-4 coppyright"> &copy; <?php echo date("Y"); ?> Prime Components. All Rights Reserved.</div>
                <div class="col-lg-8 company-links d-flex d-sm-block justify-content-center">
                    <ul class="links">
                        <li>Website maintained by : <a href="http://www.pixelperfection.in" title="Shivam Network" target="_blank" >Pixel Perfection</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->

</div>
<!-- JavaScript -->
<script type="text/javascript" src="<?=SITEURL?>js/parallax.js"></script>
<script type="text/javascript" src="<?=SITEURL?>js/common.js"></script>
<script type="text/javascript" src="<?=SITEURL?>js/slider.js"></script>
<script type="text/javascript" src="<?=SITEURL?>js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?=SITEURL?>js/jquery.flexslider.js"></script>
<script type="text/javascript" src="<?=SITEURL?>js/cloud-zoom.js"></script>
</body>
</html>
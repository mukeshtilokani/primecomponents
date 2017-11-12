<!-- Footer -->
<footer class="footer">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="footer-logo">
                        <a href="<?=SITEURL?>" title="Logo">
                            <img src="images/footer-logo.png" alt="logo" class="img-fluid">
                        </a>
                    </div>
                    <p>Manufacturer of PCB Terminal Blocks, Edge Connectors, Fuse Holders, Rotary Switches, Rocker Switches, Push Connectors, Sub-Miniature, Ballasts, etc. </p>
                </div>
                <div class="col-md-2 col-sm-4">
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
                <div class="col-md-2 col-sm-3">
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
                <div class="col-md-4 col-sm-5">
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
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12 social">
                    <ul>
                        <li class="fb"><a href="#"></a></li>
                        <li class="tw"><a href="#"></a></li>
                        <li class="googleplus"><a href="#"></a></li>
                    </ul>
                </div>
                <div class="col-md-8 col-sm-6 col-xs-12 block-subscribe">
                    <div class="newsletter">
                        <form>
                            <h4>Sign up for emails</h4>
                            <input type="text" placeholder="Enter your email address" class="input-text required-entry validate-email" title="Sign up for our newsletter" id="newsletter1" name="email">
                            <button class="subscribe" title="Subscribe" type="submit"><span>Subscribe</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-xs-12 coppyright"> &copy; 2015 Prime Components. All Rights Reserved.</div>
                <div class="col-sm-8 col-xs-12 company-links">
                    <ul class="links">
                        <li><a href="http://www.shivamnetwork.com" title="Shivam Network" target="_blank" >Website Design : Shivam Network</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->

</div>
<!-- JavaScript -->
<script type="text/javascript" src="<?=SITEURL?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?=SITEURL?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=SITEURL?>js/parallax.js"></script>
<script type="text/javascript" src="<?=SITEURL?>js/common.js"></script>
<script type="text/javascript" src="<?=SITEURL?>js/slider.js"></script>
<script type="text/javascript" src="<?=SITEURL?>js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?=SITEURL?>js/jquery.flexslider.js"></script>
<script type="text/javascript" src="<?=SITEURL?>js/cloud-zoom.js"></script>
</body>
</html>
<?php 
include("include/functions.php");
    $active = "";
?>

<!-- Navbar -->
<nav>
    <div class="container">
        <div class="nav-inner">
            <!-- mobile-menu -->
            <div class="hidden-desktop" id="mobile-menu">
                <ul class="navmenu">
                    <li>
                        <div class="menutop">
                            <div class="toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></div>
                            <h2>Categories</h2>
                        </div>
                        <ul style="display:none;" class="submenu">
                            <li>
                                <ul class="topnav">
                                    <li class="level0 nav-1 level-top first parent"> <a href="grid.html" class="level-top"> <span>Women</span> </a>
                                        <ul class="level0">
                                            <li class="level1 nav-1-1 first parent"> <a href="grid.html"> <span>Stylish Bag</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-1-1-1 first"> <a href="grid.html"> <span>Clutch Handbags</span> </a> </li>
                                                    <li class="level2 nav-1-1-2"> <a href="grid.html"> <span>Diaper Bags</span> </a> </li>
                                                    <li class="level2 nav-1-1-3"> <a href="grid.html"> <span>Bags</span> </a> </li>
                                                    <li class="level2 nav-1-1-4 last"> <a href="grid.html"> <span>Hobo Handbags</span> </a> </li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-1-2 parent"> <a href="grid.html"> <span>Material Bag</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-1-2-5 first"> <a href="grid.html"> <span>Beaded Handbags</span> </a> </li>
                                                    <li class="level2 nav-1-2-6"> <a href="grid.html"> <span>Fabric Handbags</span> </a> </li>
                                                    <li class="level2 nav-1-2-7"> <a href="grid.html"> <span>Handbags</span> </a> </li>
                                                    <li class="level2 nav-1-2-8 last"> <a href="grid.html"> <span>Leather Handbags</span> </a> </li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-1-3 parent"> <a href="grid.html"> <span>Shoes</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-1-3-9 first"> <a href="grid.html"> <span>Flat Shoes</span> </a> </li>
                                                    <li class="level2 nav-1-3-10"> <a href="grid.html"> <span>Flat Sandals</span> </a> </li>
                                                    <li class="level2 nav-1-3-11"> <a href="grid.html"> <span>Boots</span> </a> </li>
                                                    <li class="level2 nav-1-3-12 last"> <a href="grid.html"> <span>Heels</span> </a> </li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-1-4 parent"> <a href="grid.html"> <span>Jwellery</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-1-4-13 first"> <a href="grid.html"> <span>Bracelets</span> </a> </li>
                                                    <li class="level2 nav-1-4-14"> <a href="grid.html"> <span>Necklaces &amp; Pendants</span> </a> </li>
                                                    <li class="level2 nav-1-4-15"> <a href="grid.html"> <span>Pendants</span> </a> </li>
                                                    <li class="level2 nav-1-4-16 last"> <a href="grid.html"> <span>Pins &amp; Brooches</span> </a> </li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-1-5 parent"> <a href="grid.html"> <span>Dresses</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-1-5-17 first"> <a href="grid.html"> <span>Casual Dresses</span> </a> </li>
                                                    <li class="level2 nav-1-5-18"> <a href="grid.html"> <span>Evening</span> </a> </li>
                                                    <li class="level2 nav-1-5-19"> <a href="grid.html"> <span>Designer</span> </a> </li>
                                                    <li class="level2 nav-1-5-20 last"> <a href="grid.html"> <span>Party</span> </a> </li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-1-6 last parent"> <a href="grid.html"> <span>Swimwear</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-1-6-21 first"> <a href="grid.html"> <span>Swimsuits</span> </a> </li>
                                                    <li class="level2 nav-1-6-22"> <a href="grid.html"> <span>Beach Clothing</span> </a> </li>
                                                    <li class="level2 nav-1-6-23"> <a href="grid.html"> <span>Clothing</span> </a> </li>
                                                    <li class="level2 nav-1-6-24 last"> <a href="grid.html"> <span>Bikinis</span> </a> </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="level0 nav-2 level-top parent"> <a href="grid.html" class="level-top"> <span>Men</span> </a>
                                        <ul class="level0">
                                            <li class="level1 nav-2-1 first parent"> <a href="grid.html"> <span>Shoes</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-2-1-1 first"> <a href="grid.html"> <span>Sport Shoes</span> </a> </li>
                                                    <li class="level2 nav-2-1-2"> <a href="grid.html"> <span>Casual Shoes</span> </a> </li>
                                                    <li class="level2 nav-2-1-3"> <a href="grid.html"> <span>Leather Shoes</span> </a> </li>
                                                    <li class="level2 nav-2-1-4 last"> <a href="grid.html"> <span>canvas shoes</span> </a> </li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-2-2 parent"> <a href="grid.html"> <span>Dresses</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-2-2-5 first"> <a href="grid.html"> <span>Casual Dresses</span> </a> </li>
                                                    <li class="level2 nav-2-2-6"> <a href="grid.html"> <span>Evening</span> </a> </li>
                                                    <li class="level2 nav-2-2-7"> <a href="grid.html"> <span>Designer</span> </a> </li>
                                                    <li class="level2 nav-2-2-8 last"> <a href="grid.html"> <span>Party</span> </a> </li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-2-3 parent"> <a href="grid.html"> <span>Jackets</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-2-3-9 first"> <a href="grid.html"> <span>Coats</span> </a> </li>
                                                    <li class="level2 nav-2-3-10"> <a href="grid.html"> <span>Formal Jackets</span> </a> </li>
                                                    <li class="level2 nav-2-3-11"> <a href="grid.html"> <span>Leather Jackets</span> </a> </li>
                                                    <li class="level2 nav-2-3-12 last"> <a href="grid.html"> <span>Blazers</span> </a> </li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-2-4 parent"> <a href="grid.html"> <span>Watches</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-2-4-13 first"> <a href="grid.html"> <span>Fastrack</span> </a> </li>
                                                    <li class="level2 nav-2-4-14"> <a href="grid.html"> <span>Casio</span> </a> </li>
                                                    <li class="level2 nav-2-4-15"> <a href="grid.html"> <span>Titan</span> </a> </li>
                                                    <li class="level2 nav-2-4-16 last"> <a href="grid.html"> <span>Tommy-Hilfiger</span> </a> </li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-2-5 parent"> <a href="grid.html"> <span>Sunglasses</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-2-5-17 first"> <a href="grid.html"> <span>Ray Ban</span> </a> </li>
                                                    <li class="level2 nav-2-5-18"> <a href="grid.html"> <span>Fastrack</span> </a> </li>
                                                    <li class="level2 nav-2-5-19"> <a href="grid.html"> <span>Police</span> </a> </li>
                                                    <li class="level2 nav-2-5-20 last"> <a href="grid.html"> <span>Oakley</span> </a> </li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-2-6 last parent"> <a href="grid.html"> <span>Accessories</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-2-6-21 first"> <a href="grid.html"> <span>Backpacks</span> </a> </li>
                                                    <li class="level2 nav-2-6-22"> <a href="grid.html"> <span>Wallets</span> </a> </li>
                                                    <li class="level2 nav-2-6-23"> <a href="grid.html"> <span>Laptop Bags</span> </a> </li>
                                                    <li class="level2 nav-2-6-24 last"> <a href="grid.html"> <span>Belts</span> </a> </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="level0 nav-3 level-top parent"> <a href="grid.html" class="level-top"> <span>Electronics</span> </a>
                                        <ul class="level0">
                                            <li class="level1 nav-3-1 first parent"> <a href="grid.html"> <span>Mobiles</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-3-1-1 first"> <a href="grid.html"> <span>Samsung</span> </a> </li>
                                                    <li class="level2 nav-3-1-2"> <a href="grid.html"> <span>Nokia</span> </a> </li>
                                                    <li class="level2 nav-3-1-3"> <a href="grid.html"> <span>iPhone</span> </a> </li>
                                                    <li class="level2 nav-3-1-4 last"> <a href="grid.html"> <span>Sony</span> </a> </li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-3-2 parent"> <a href="grid.html"> <span>Accessories</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-3-2-5 first"> <a href="grid.html"> <span>Mobile Memory Cards</span> </a> </li>
                                                    <li class="level2 nav-3-2-6"> <a href="grid.html"> <span>Cases &amp; Covers</span> </a> </li>
                                                    <li class="level2 nav-3-2-7"> <a href="grid.html"> <span>Mobile Headphones</span> </a> </li>
                                                    <li class="level2 nav-3-2-8 last"> <a href="grid.html"> <span>Bluetooth Headsets</span> </a> </li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-3-3 parent"> <a href="grid.html"> <span>Cameras</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-3-3-9 first"> <a href="grid.html"> <span>Camcorders</span> </a> </li>
                                                    <li class="level2 nav-3-3-10"> <a href="grid.html"> <span>Point &amp; Shoot</span> </a> </li>
                                                    <li class="level2 nav-3-3-11"> <a href="grid.html"> <span>Digital SLR</span> </a> </li>
                                                    <li class="level2 nav-3-3-12 last"> <a href="grid.html"> <span>Camera Accessories</span> </a> </li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-3-4 parent"> <a href="grid.html"> <span>Audio &amp; Video</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-3-4-13 first"> <a href="grid.html"> <span>MP3 Players</span> </a> </li>
                                                    <li class="level2 nav-3-4-14"> <a href="grid.html"> <span>iPods</span> </a> </li>
                                                    <li class="level2 nav-3-4-15"> <a href="grid.html"> <span>Speakers</span> </a> </li>
                                                    <li class="level2 nav-3-4-16 last"> <a href="grid.html"> <span>Video Players</span> </a> </li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-3-5 parent"> <a href="grid.html"> <span>Computer</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-3-5-17 first"> <a href="grid.html"> <span>External Hard Disks</span> </a> </li>
                                                    <li class="level2 nav-3-5-18"> <a href="grid.html"> <span>Pendrives</span> </a> </li>
                                                    <li class="level2 nav-3-5-19"> <a href="grid.html"> <span>Headphones</span> </a> </li>
                                                    <li class="level2 nav-3-5-20 last"> <a href="grid.html"> <span>PC Components</span> </a> </li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-3-6 last parent"> <a href="grid.html"> <span>Appliances </span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-3-6-21 first"> <a href="grid.html"> <span>Vacuum Cleaners</span> </a> </li>
                                                    <li class="level2 nav-3-6-22"> <a href="grid.html"> <span>Indoor Lighting</span> </a> </li>
                                                    <li class="level2 nav-3-6-23"> <a href="grid.html"> <span>Kitchen Tools</span> </a> </li>
                                                    <li class="level2 nav-3-6-24 last"> <a href="grid.html"> <span>Water Purifiers</span> </a> </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="level0 nav-4 level-top parent"> <a href="grid.html" class="level-top"> <span>Furniture</span> </a>
                                        <ul class="level0">
                                            <li class="level1 nav-4-1 first parent"> <a href="grid.html"> <span>Living Room</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-4-1-1 first"> <a href="grid.html"> <span>Racks &amp; Cabinets</span> </a> </li>
                                                    <li class="level2 nav-4-1-2"> <a href="grid.html"> <span>Sofas</span> </a> </li>
                                                    <li class="level2 nav-4-1-3"> <a href="grid.html"> <span>Chairs</span> </a> </li>
                                                    <li class="level2 nav-4-1-4 last"> <a href="grid.html"> <span>Tables</span> </a> </li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-4-2 parent"> <a href="grid.html"> <span>Dining &amp; Bar</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-4-2-5 first"> <a href="grid.html"> <span>Dining Table Sets</span> </a> </li>
                                                    <li class="level2 nav-4-2-6"> <a href="grid.html"> <span>Serving Trolleys</span> </a> </li>
                                                    <li class="level2 nav-4-2-7"> <a href="grid.html"> <span>Bar Counters</span> </a> </li>
                                                    <li class="level2 nav-4-2-8 last"> <a href="grid.html"> <span>Dining Cabinets</span> </a> </li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-4-3 parent"> <a href="grid.html"> <span>Bedroom</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-4-3-9 first"> <a href="grid.html"> <span>Beds</span> </a> </li>
                                                    <li class="level2 nav-4-3-10"> <a href="grid.html"> <span>Chest of Drawers</span> </a> </li>
                                                    <li class="level2 nav-4-3-11"> <a href="grid.html"> <span>Wardrobes &amp; Almirahs</span> </a> </li>
                                                    <li class="level2 nav-4-3-12 last"> <a href="grid.html"> <span>Nightstands</span> </a> </li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-4-4 last parent"> <a href="grid.html"> <span>Kitchen</span> </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-4-4-13 first"> <a href="grid.html"> <span>Kitchen Racks</span> </a> </li>
                                                    <li class="level2 nav-4-4-14"> <a href="grid.html"> <span>Kitchen Fittings</span> </a> </li>
                                                    <li class="level2 nav-4-4-15"> <a href="grid.html"> <span>Wall Units</span> </a> </li>
                                                    <li class="level2 nav-4-4-16 last"> <a href="grid.html"> <span>Benches &amp; Stools</span> </a> </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="level0 nav-5 level-top last"> <a href="grid.html" class="level-top"> <span>Fashion</span> </a> </li>
                                    <li class="level0 nav-6 level-top first parent"> <a class="level-top" href="#"> <span>Pages</span> </a>
                                        <ul class="level0">
                                            <li class="level1 first"><a href="grid.html"><span>Grid</span></a></li>
                                            <li class="level1 nav-10-2"> <a href="list.html"> <span>List</span> </a> </li>
                                            <li class="level1 nav-10-3"> <a href="product_detail.html"> <span>Product Detail</span> </a> </li>
                                            <li class="level1 nav-10-4"> <a href="shopping_cart.html"> <span>Shopping Cart</span> </a> </li>
                                            <li class="level1 first"><a href="checkout.html"><span>Checkout</span></a> </li>
                                            <li class="level1 nav-10-4"> <a href="wishlist.html"> <span>Wishlist</span> </a> </li>
                                            <li class="level1"> <a href="dashboard.html"> <span>Dashboard</span> </a> </li>
                                            <li class="level1"> <a href="multiple_addresses.html"> <span>Multiple Addresses</span> </a> </li>
                                            <li class="level1"> <a href="about_us.html"> <span>About us</span> </a> </li>
                                            <li class="level1"> <a href="login.html"> <span>Login</span> </a> </li>
                                            <li class="level1"> <a href="sitemap.html"> <span>Sitemap</span> </a> </li>
                                            <li class="level1"> <a href="compare.html"> <span>Compare</span> </a> </li>
                                            <li class="level1"> <a href="delivery.html"> <span>Delivery</span> </a> </li>
                                            <li class="level1"> <a href="faq.html"> <span>FAQ</span> </a> </li>
                                            <li class="level1"> <a href="quick_view.html"> <span>Quick View</span> </a> </li>
                                            <li class="level1"> <a href="newsletter.html"> <span>Newsletter</span> </a> </li>
                                            <li class="level1"> <a href="sitemap.html"> <span>Sitemap</span> </a> </li>
                                            <li class="level1"><a href="blog.html"><span>Blog</span></a> </li>
                                            <li class="level1"><a href="contact_us.html"><span>Contact us</span></a> </li>
                                            <li class="level1"><a href="404error.html"><span>404 Error Page</span></a> </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!--navmenu-->
            </div>

            <!--End mobile-menu -->
            <ul id="nav" class="hidden-xs">

<?php

    $dbh = new PDO( $dsn, $username, $password );

    $sql = $dbh->prepare( "SELECT wp_title, wp_alias, wp_id FROM webpages WHERE wp_active='Y' AND wp_menu='Y' ORDER BY wp_order" );

    $sql->execute();

    $rows = $sql->fetchAll();

    //print_r($rows) ;
	//echo $pageAlias;

    for ( $i = 0; $i < count( $rows ); $i ++ ) {

    if ( ( $rows[ $i ]['wp_alias'] == "products" )  ) {
        $has_sub = "drop-menu";
    }


    if($pageAlias == $rows[ $i ]['wp_alias'] )
    {
        $active = "active";

    }
?>

                <li class="level0 parent drop-menu <?= $active?>"><a href="<?= SITEURL ?><?= $rows[ $i ]['wp_alias'] ?>"><span><?= urldecode( $rows[ $i ]['wp_title'] ) ?></span> </a>

                    <?php

                        if ( $rows[ $i ]['wp_alias'] == "products" ) { ?>

                    <ul class="level1" style="display: none;">
                        <?php

                            $dbh  = new PDO( $dsn, $username, $password );

                            $sql1 = $dbh->prepare( "SELECT * FROM p_categories

		                                               WHERE pc_active='Y' ORDER BY pc_order ASC " );

                            $sql1->execute();

                            $rows1 = $sql1->fetchAll();

                            //print_r($rows) ;

                            for ( $j = 0; $j < count( $rows1 ); $j ++ ) { ?>

                        <li class="level1 parent"><a href="<?= SITEURL ?>category/<?= $rows1[ $j ]['pc_alias'] ?>"><span><?= urldecode( $rows1[ $j ]['pc_title'] ) ?></span></a>


                                <?php

                                    $pc_id = $rows1[ $j ]['pc_id'];

                                    $dbh   = new PDO( $dsn, $username, $password );

                                    $sql2  = $dbh->prepare( "SELECT * FROM p_subcategories psc LEFT JOIN

														                                                p_categories pc on psc.pc_id = pc.pc_id

														                                                WHERE psc.pc_id= $pc_id AND psc.psubc_active ='Y'" );

                                    $sql2->execute();

                                    $rows2 = $sql2->fetchAll();  //print_r($rows) ;

                                if(count( $rows2 ) > 0) {?>

	                            <ul class="level2">

	                                <?php for ( $k = 0; $k < count( $rows2 ); $k ++ ) { ?>
                                        <li  class="level2" >

                                            <a href="<?= SITEURL ?>sub-category/<?= $rows1[ $j ]['pc_alias'] ?>/<?= $rows2[ $k ]['psubc_alias'] ?>">

                                                <span> <?= urldecode( $rows2[ $k ]['psubc_title'] ) ?> </span></a>

                                        </li>

                                    <?php } ?>

                            </ul>
	                        <?php } ?>

                        </li>
                            <?php } ?>

                    </ul>
                            <?php

                        }

                    ?>


                </li>
    <?php } ?>


            </ul>

        </div>
    </div>
</nav>
<!-- end nav --> 
<?php 
include("include/functions.php");
    $active = "";
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg p-lg-0">
    <div class="container">
        <div class="nav-inner">
            <!-- mobile-menu -->
            <div class="hidden-desktop" id="mobile-menu">
                <ul class="navmenu">
                    <li>
                        <div class="menutop d-flex align-items-center justify-content-between">
                            <h2>Menu</h2>
                            <div class="toggle">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </div>
                        </div>

                        <ul style="display:none;" class="submenu">
                            <li>
                                <ul class="topnav">
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
                                                            $sql1 = $dbh->prepare( "SELECT * FROM p_categories WHERE pc_active='Y' ORDER BY pc_order ASC " );
                                                            $sql1->execute();
                                                            $rows1 = $sql1->fetchAll();
                                                            //print_r($rows) ;
                                                            for ( $j = 0; $j < count( $rows1 ); $j ++ ) { ?>
                                                                <li class="level1 parent"><a href="<?= SITEURL ?>category/<?= $rows1[ $j ]['pc_alias'] ?>"><span><?= urldecode( $rows1[ $j ]['pc_title'] ) ?></span></a>
                                                                        <?php
                                                                            $pc_id = $rows1[ $j ]['pc_id'];
                                                                            $dbh   = new PDO( $dsn, $username, $password );
                                                                            $sql2  = $dbh->prepare( "SELECT * FROM p_subcategories psc LEFT JOIN p_categories pc on psc.pc_id = pc.pc_id WHERE psc.pc_id= $pc_id AND psc.psubc_active ='Y'" );
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
                                            <?php }?>
                                        </li>
                                    <?php } ?>
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
                                        $sql1 = $dbh->prepare( "SELECT * FROM p_categories WHERE pc_active='Y' ORDER BY pc_order ASC " );
                                        $sql1->execute();
                                        $rows1 = $sql1->fetchAll();
                                        //print_r($rows) ;
                                        for ( $j = 0; $j < count( $rows1 ); $j ++ ) { ?>
                                            <li class="level1 parent"><a href="<?= SITEURL ?>category/<?= $rows1[ $j ]['pc_alias'] ?>"><span><?= urldecode( $rows1[ $j ]['pc_title'] ) ?></span></a>
                                                    <?php
                                                        $pc_id = $rows1[ $j ]['pc_id'];
                                                        $dbh   = new PDO( $dsn, $username, $password );
                                                        $sql2  = $dbh->prepare( "SELECT * FROM p_subcategories psc LEFT JOIN p_categories pc on psc.pc_id = pc.pc_id WHERE psc.pc_id= $pc_id AND psc.psubc_active ='Y'" );
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
                        <?php }?>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<!-- end nav --> 
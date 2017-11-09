<?php
ob_start();
$sess_name = session_name();
if (session_start()) {
    setcookie($sess_name, session_id(), null, '/', null, null, true);
}
require_once '../../data/config.php';
$dbh = new PDO($dsn, $username, $password);

if (isset($_SESSION['wf_id']) && $_SESSION['wf_id'] != '') {
    require_once '../../include/header.php';
    require_once '../../include/body.php';

    ?>


    <div class="main-content">
        <div id="container" class="wrap-content container">
            <!-- start: PAGE TITLE -->
            <section id="page-title">
                <div class="row">
                    <div class="col-sm-8">
                        <h1 class="mainTitle">Manage Photo Gallery </h1>
                    </div>
                    <ol class="breadcrumb">
                        <li>
                            <span>Dashboard</span>
                        </li>
                        <li class="active">
                            <span>Manage Photo Gallery </span>
                        </li>
                    </ol>
                </div>
            </section>
            <!-- end: PAGE TITLE -->

            <div class="container-fluid container-fullw bg-white">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" id="wf_id1" name="wf_id1" value="<?= $_SESSION['wf_id'] ?>"/>


                        <div class="tabbable">
                            <ul id="myTab1" class="nav nav-tabs">

                                <?php
                                $rows = "";
                                $sql = $dbh->prepare("SELECT * FROM photo_galleries pgl LEFT JOIN
                                p_categories c ON pgl.pc_id = c.pc_id
                                WHERE pgl.pgl_active='Y' ");
                                $sql->execute();
                                $rows = $sql->fetchAll();
                                //print_r($rows); exit;
                                for ($i = 0; $i < count($rows); $i++) {
                                    $active = "class='active'";
                                    ?>
                                    <li <?php if ($i == 0) {
                                        echo $active;
                                    } ?> >
                                        <a href="#cat_tabs<?= $i + 1 ?>" data-toggle="tab">
                                            <?= $rows[$i]['pc_title'] ?>
                                        </a>
                                    </li>
                                <?php } ?>

                            </ul>
                            <div class="tab-content">

                                <?php
                                $rows1 = "";
                                $sql1 = $dbh->prepare("SELECT * FROM photo_galleries pgl LEFT JOIN
                                p_categories c ON pgl.pc_id = c.pc_id
                                WHERE pgl.pgl_active='Y' ");
                                $sql1->execute();
                                $rows1 = $sql1->fetchAll();
                                //print_r($rows); exit;
                                for ($j = 0; $j < count($rows1); $j++) {
                                    $active1 = "active";
                                    ?>
                                    <div class="tab-pane fade in <?php if ($j == 0) {
                                        echo $active1;
                                    } ?>" id="#cat_tabs<?= $j + 1 ?>">


                                        <div id="links">

                                            <?php
                                            $pgl_id= $rows1[$j]['pgl_id'] ;
                                            $rows2 = "";
                                            $sql2 = $dbh->prepare("SELECT * FROM photo_gallery_images
                                                    WHERE pgl_id = $pgl_id ");
                                            $sql2->execute();
                                            $rows2 = $sql2->fetchAll();

                                            for ($k = 0; $k < count($rows2); $k++) {
                                            ?>
                                                <div style="display: table-cell; padding-right: 5px;" >

                                                        <div  style="height: 100px; width: 100px;">
                                                            <a href="<?=SITEURLFRONT?>images/photogallery/<?=$rows2[$k]['pgli_image']?>"
                                                               title="<?= $rows1[$j]['pc_title'] ?>" data-gallery="" >
                                                                <img src="<?=SITEURLFRONT?>images/photogallery/<?=$rows2[$k]['pgli_image']?>"
                                                                     style="max-height: 100px; max-width: 100px;" >
                                                            </a>
                                                        </div>

                                                        <div style="text-align: center">
                                                            <a class="btn btn-xs btn-danger btnDelete"  >
                                                                <i class="glyphicon glyphicon-trash"></i> Delete
                                                            </a>
                                                        </div>

                                                </div>



                                            <?php } ?>

                                        </div>

                                        <div id="blueimp-gallery" class="blueimp-gallery">
                                            <!-- The container for the modal slides -->
                                            <div class="slides"></div>
                                            <!-- Controls for the borderless lightbox -->
                                            <h3 class="title"></h3>
                                            <a class="prev">‹</a>

                                            <a class="next">›</a>
                                            <a class="close">×</a>
                                            <a class="play-pause"></a>
                                            <ol class="indicator"></ol>
                                            <!-- The modal dialog, which will be used to wrap the lightbox content -->
                                            <div class="modal fade">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close"
                                                                    aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title"></h4>
                                                        </div>
                                                        <div class="modal-body next"></div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                    class="btn btn-default pull-left prev">
                                                                <i class="glyphicon glyphicon-chevron-left"></i>
                                                                Previous
                                                            </button>

                                                            <button type="button" class="btn btn-primary next">
                                                                Next
                                                                <i class="glyphicon glyphicon-chevron-right"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                <?php } ?>


                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    require_once '../../include/footer.php';
} else {
    header('Location: ../../login.php');
}
?>

<script src="<?=SITEURL?>vendor/bootstrap-image-gallery/js/jquery.blueimp-gallery.min.js"></script>
<script src="<?=SITEURL?>vendor/bootstrap-image-gallery/js/bootstrap-image-gallery.js"></script>
<script>
    jQuery(document).ready(function () {

        $(".main-navigation-menu li").removeClass("active open");
        $("#liProduct").addClass("active open");
        Main.init();



    });
</script>

<!-- Dialog show event handler -->
<script type="text/javascript">

    $('.btnDelete').on('click', function(e) {
        e.preventDefault();

        bootbox.alert({
            title: 'Delete Image',
            message: "Do you really want to delete this image?",
            buttons: {
                ok: {
                    label: 'Delete Image',
                    className: "btn-danger",
                    callback: function () {
                    }
                }
            }
        })


    });
</script>

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
          <li> <span>Dashboard</span> </li>
          <li class="active"> <span>Manage Photo Gallery </span> </li>
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
                                $sql = $dbh->prepare("SELECT * FROM p_categories

                                               WHERE pc_active='Y' ORDER BY pc_order ASC ");
                                $sql->execute();
                                $rows = $sql->fetchAll();
                                //print_r($rows); exit;
                                for ($i = 0; $i < count($rows); $i++) {
                                    $active = "class='active'";
                                    ?>
              <li <?php if ($i == 0) {
                                        echo $active;
                                    } ?> > <a href="#myTab1_example<?= $i + 1 ?>" data-toggle="tab">
                <?=urldecode($rows[$i]['pc_title']) ?>
                </a> </li>
              <?php } ?>
            </ul>
            <div class="tab-content">
              <?php
                                $rows = "";
                                $sql1 = $dbh->prepare("SELECT * FROM p_categories

                                               WHERE pc_active='Y' ORDER BY pc_order ASC ");
                                $sql1->execute();
                                $rows1 = $sql1->fetchAll();
                                $active1 = "class='tab-pane fade active in'";
                                for ($j = 0; $j < count($rows1); $j++) {

                                    ?>
              <div <?php if ($j == 0) {
                                        echo $active1;
                                    } else {
                                        echo "class='tab-pane'";
                                    } ?> id="myTab1_example<?= $j + 1 ?>">
                <div class="row">
                  <?php
                                            $pc_id = $rows1[$j]['pc_id'];
                                            $rows2 = "";
                                            $sql2 = $dbh->prepare("SELECT * FROM photo_gallery_images
                                                    WHERE pc_id = $pc_id ");
                                            $sql2->execute();
                                            $rows2 = $sql2->fetchAll();

                                            for ($k = 0; $k < count($rows2); $k++) {
                                                ?>
                  <div class="col-xs-6 col-md-3" style="text-align: center" > <a href="#" class="thumbnail"> <img src="<?= SITEURLFRONT ?>images/photogallery/<?= $rows2[$k]['pgli_image'] ?>"> </a>
                    <p>
                      <button class="btn btn-danger btnDelete" data-src="<?= $rows2[$k]['pgli_image'] ?>"
                                                                data-id="<?= $rows2[$k]['pgli_id'] ?>" data-gid="<?=$rows1[$j]['pc_id']?>"
                                                                > <span class="fa fa-times"></span> delete </button>
                      
                      <!--                                                        <button class="btn btn-danger btnDelete" data-src="-->
                      <?//= $rows2[$k]['pgli_image'] ?>
                      <!--"-->
                      <!--                                                                data-id="-->
                      <?//= $rows2[$k]['pgli_id'] ?>
                      <!--" data-gid="-->
                      <?//=$rows1[$j]['pgl_id']?>
                      <!--"-->
                      <!--                                                            >-->
                      <!--                                                            <span class="fa fa-times"></span> delete-->
                      <!--                                                        </button>-->
                      
                    </p>
                  </div>
                  <?php } ?>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
          
          <!-- Default Modal -->
          <!--                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">-->
          <!--                            <div class="modal-dialog">-->
          <!--                                <div class="modal-content">-->
          <!--                                    <div class="modal-header">-->
          <!--                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
          <!--                                            <span aria-hidden="true">&times;</span>-->
          <!--                                        </button>-->
          <!--                                        <h4 class="modal-title" id="myModalLabel">Delete Image</h4>-->
          <!--                                    </div>-->
          <!--                                    <div class="modal-body">-->
          <!--                                        Are you sure?-->
          <!---->
          <!--                                        <input type="hidden" name="pgli_id" id="pgli_id" value=""/>-->
          <!--                                        <input type="hidden" name="pgl_id" id="pgl_id" value=""/>-->
          <!--                                        <input type="hidden" name="imgName" id="imgName" value=""/>-->
          <!---->
          <!--                                    </div>-->
          <!--                                    <div class="modal-footer">-->
          <!--                                        <button type="button" class="btn btn-primary" data-dismiss="modal">-->
          <!--                                            Close-->
          <!--                                        </button>-->
          <!--                                        <button type="button" class="btn btn-danger" id="btnDeleteConfirm">-->
          <!--                                            Delete Image-->
          <!--                                        </button>-->
          <!--                                    </div>-->
          <!--                                </div>-->
          <!--                            </div>-->
          <!--                        </div>-->
          <!-- /Default Modal -->
          
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

<!--<script src="-->
<? //=SITEURL?>
<!--vendor/bootstrap-image-gallery/js/jquery.blueimp-gallery.min.js"></script>-->
<!--<script src="-->
<? //=SITEURL?>
<!--vendor/bootstrap-image-gallery/js/bootstrap-image-gallery.js"></script>-->
<script>
    jQuery(document).ready(function () {

        $(".main-navigation-menu li").removeClass("active open");
        $("#liPhotoGallery").addClass("active open");
        Main.init();


    });
</script> 

<!-- Dialog show event handler --> 
<script type="text/javascript">




    $('.btnDelete').on('click', function () {

        var pgli_id =  $(this).data('id');
        var pc_id =  $(this).data('gid');
        var imgName = $(this).data('src');

        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        type:'POST',
                        data: {
                            pgli_id: pgli_id,
                            pc_id: pc_id,
                            imgName: imgName
                        },
                        url:'../../api/photogallery/deleteImage.php',
                        success:function(data) {
                            swal("Deleted!", "Your image file has been deleted.", "success");

                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        }

                    });


                } else {
                    swal("Cancelled", "Your image file is safe :)", "error");
                }
            });




    });


//    $('.btnDelete').on('click', function () {
//
//        var pgli_id =  $(this).data('id');
//        var pgl_id =  $(this).data('gid');
//        var imgName = $(this).data('src');
//
//        $("#myModal #pgli_id").val( pgli_id );
//        $("#myModal #pgl_id").val( pgl_id );
//        $("#myModal #imgName").val( imgName );
//        $('#myModal').modal('show');
//
//    });
//
//
//    $('#btnDeleteConfirm').on('click', function (e) {
//
//        var pgli_id =  $('#pgli_id').val();
//        var pgl_id =  $('#pgl_id').val();
//        var imgName = $('#imgName').val();
//        e.preventDefault();
//
//                $.ajax({
//                    type:'POST',
//                    data: {
//                        pgli_id: pgli_id,
//                        pgl_id: pgl_id,
//                        imgName: imgName
//                    },
//
//                    url:'../../api/photogallery/deleteImage.php',
//
//                    success:function(data) {
//
//                        $('#myModal').modal('hide');
//
//                        swal({
//                            title: "Image",
//                            text: "Deleted Successfully!",
//                            type: "success",
//                            confirmButtonColor: "#007AFF"
//                        });
//                    }
//
//                });
//
//    });



</script> 

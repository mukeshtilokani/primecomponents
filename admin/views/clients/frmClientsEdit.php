<?php
ob_start();
$sess_name = session_name();
if (session_start()) {
	setcookie($sess_name, session_id(), null, '/', null, null, true);
}
require_once '../../data/config.php'; 

if(isset($_SESSION['wf_id']) && $_SESSION['wf_id'] != '')
{ 
    require_once '../../include/header.php';  
	require_once '../../include/body.php';
    $dbh = new PDO($dsn, $username, $password);
?>

    <div class="main-content">
    <div id="container" class="wrap-content container">
    <!-- start: PAGE TITLE -->
    <section id="page-title">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="mainTitle">Edit Client
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a class="btn btn-primary" href="<?=SITEURL?>views/clients/frmClientsList.php" >View List / Edit / Update</a></h1>
            </div>
            <ol class="breadcrumb">
                <li>
                    <span>Dashboard</span>
                </li>
                <li class="active">
                    <span>Edit Client</span>
                </li>
            </ol>
        </div>
    </section>
    <!-- end: PAGE TITLE -->
    <!-- start: FIELDSET -->
    <div class="container-fluid container-fullw bg-white">
    <div class="row">
    <div class="col-md-12">
        <?php $sql = $dbh->prepare("SELECT * FROM
                                clients WHERE
                                cl_active='Y' AND cl_id='".$_GET['cl_id']."'");
        $sql->execute();
        $rows = $sql->fetchAll();
        for($i=0;$i < count($rows); $i++)
        {
        ?>

<form action="#" role="form" id="frmClient">
                            <fieldset>
                                <legend>
                                    Add Client
                                </legend>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div>
                                            <span class="symbol required" aria-required="true"></span>Required Fields
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Client Name <span class="symbol required" aria-required="true"></span>
                                            </label>
                                            <input type="text" placeholder="Client Name" class="form-control"   id="cl_title" name="cl_title" onblur="printAlias()" onKeyPress="printAlias()" onKeyUp="printAlias()"  value="<?=urldecode($rows[$i]['cl_title'])?>">
                                    <input type="hidden" id="cl_id1" name="cl_id1" value="<?=$rows[$i]['cl_id']?>" />

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Alias [SEO]
                                            </label>
                                            <input type="text" placeholder="SEO URL" class="form-control" id="cl_alias" name="cl_alias" value="<?=urldecode($rows[$i]['cl_alias'])?>">
                                        </div>


                                    </div>
                                    <div class="col-md-8">
                                        <div class="col-md-12">
                                        <div class="form-group">
                                              <label>
                                        Original Uploaded Image
                                    </label>
                                    <img src="<?=SITEURLFRONT?>images/clients/thumb/<?=$rows[$i]['cl_image']?>" alt=""/> <br>
                                    <label>
                                        Replace Image
                                    </label>
                                            <input id="cl_image" name="cl_image" type="file" accept="image/*" class="file-loading">
                                            <input type="hidden" id="cl_imageName" name="cl_imageName" value="" />


                                        </div>
                                    </div>

                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary"  id="btnSave" style="width: 100%" >Save</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>

        <?php } ?>
     </div>
    </div>
    </div>
        <!-- end: FIELDSET -->
    </div>
    </div>



<?php
    require_once '../../include/footer.php';
}
else
{
header('Location: ../../login.php');
}
?>
<script src="<?=SITEURL?>assets/js/form-text-editor.js"></script>
<script src="<?=SITEURL?>assets/js/form-validation-client-update.js"></script>
<script>
    jQuery(document).ready(function() {


        $('#cl_image').fileinput({
            previewFileType: "image",
            browseClass: "btn btn-success btn-block",
            browseLabel: "Image",
            browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
            removeClass: "btn btn-danger",
            removeLabel: "Delete",
            removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
            uploadClass: "btn btn-info",
            uploadLabel: "Upload",
            uploadIcon: "<i class=\"glyphicon glyphicon-upload\"></i> ",
            uploadUrl: "../../api/clients/asyncImg.php?type=save", // server upload action
            uploadAsync: true,
            allowedFileExtensions: ["jpg", "png", "gif"],
            fileTypeSettings:['image']
        });

        $('.file-caption').hide();

        $('#cl_image').on('fileuploaded', function(event, data, previewId, index) {
            var form = data.form, files = data.files, extra = data.extra,
               response = data.response, reader = data.reader;
            //alert(response);
            //$("#cl_imageName").val(response);

            var arr =  $("#cl_imageName").val();

            if(arr.length>0)
            {
                arr = arr + "," + response;
            }
            else
            {
                arr =  response;
            }

            $("#cl_imageName").val(arr);
        });


        $(".main-navigation-menu li").removeClass("active open");
        $("#liClients").addClass("active open");
        Main.init();

        FormValidator.init();
        FormElements.init();
    });
</script>

<script>
    function printAlias()
    {

        var txtTitle = document.getElementById("cl_title");
        var txtAlias = document.getElementById("cl_alias");
        var slug;
        slug = getSlug(txtTitle.value);
        txtAlias.value = slug;

    }

</script>

 

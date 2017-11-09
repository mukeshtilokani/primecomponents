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
?>

    <div class="main-content">
    <div id="container" class="wrap-content container">
    <!-- start: PAGE TITLE -->
    <section id="page-title">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="mainTitle">Add Product Category
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a class="btn btn-primary" href="<?=SITEURL?>views/category/frmCategoryList.php" >View List / Edit / Update</a></h1>
            </div>
            <ol class="breadcrumb">
                <li>
                    <span>Dashboard</span>
                </li>
                <li class="active">
                    <span>Add Product Category</span>
                </li>
            </ol>
        </div>
    </section>
    <!-- end: PAGE TITLE -->
    <!-- start: FIELDSET -->
    <div class="container-fluid container-fullw bg-white">
    <div class="row">
    <div class="col-md-12">
                    <form action="#" role="form" id="frmProductCategory">
                        <a class="btn btn-primary"  id="btnReset" style="display: none" >Reset</a>
                    <fieldset>
                        <legend>
                            Add Product Category
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">
                                        Category Name <span class="symbol required" aria-required="true"></span>
                                    </label>
                                    <input type="text" placeholder="Category Name" class="form-control"   id="pc_title" name="pc_title" onblur="printAlias()" onKeyPress="printAlias()" onKeyUp="printAlias()">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        Alias [SEO]
                                    </label>
                                    <input type="text" placeholder="SEO URL" class="form-control" id="pc_alias" name="pc_alias" >
                                </div>


                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        Image Upload
                                    </label>
                                    <input id="pc_image" name="pc_image" type="file" accept="image/*" class="file-loading" >
                                    <input type="hidden" id="pc_imageName" name="pc_imageName" value="" />
<!--                                    <div class="fileinput fileinput-new" data-provides="fileinput">-->
<!--                                        <div class="fileinput-new thumbnail"><img src="--><?//=SITEURL?><!--assets/images/avatar-1-xl.jpg" alt="">-->
<!--                                        </div>-->
<!--                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>-->
<!--                                        <div class="user-edit-image-buttons">-->
<!--																			<span class="btn btn-azure btn-file"><span class="fileinput-new"><i class="fa fa-picture"></i> Select image</span><span class="fileinput-exists"><i class="fa fa-picture"></i> Change</span>-->
<!--																				<input type="file">-->
<!--																			</span>-->
<!--                                            <a href="#" class="btn fileinput-exists btn-red" data-dismiss="fileinput">-->
<!--                                                <i class="fa fa-times"></i> Remove-->
<!--                                            </a>-->
<!--                                        </div>-->
<!--                                        <span class="fileinput-filename" style="display:none"  id="pc_imageName" name="pc_imageName" ></span>-->
<!--                                        <span class="fileinput-filepath" style="display:none"  id="pc_imagePath" name="pc_imagePath" ></span>-->
<!--                                    </div>-->


                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        Description
                                    </label>
                                    <textarea class="ckeditor form-control" cols="10" rows="10"  id="pc_desc" name="pc_desc" ></textarea>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary"  id="btnSave" style="width: 100%" >Save</button>
                            </div>
                        </div>
                    </fieldset>
                        </form>
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
<script src="<?=SITEURL?>assets/js/form-validation-product-category.js"></script>
<script>
    jQuery(document).ready(function() {

        $("#btnReset").click(function() {
            $("#pc_image").fileinput("clear");
            $("#pc_imageName").val('');
            //reset form
            //reset form
            $("#frmProductCategory").trigger('reset');
            // Set the editor data.
            $( 'textarea.ckeditor' ).val( '' );

        });

        $("#pc_image").fileinput({
            previewFileType: "image",
            browseClass: "btn btn-success btn-block",
            browseLabel: "Replace Image",
            browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
            removeClass: "btn btn-danger",
            removeLabel: "Delete",
            removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
            uploadClass: "btn btn-info",
            uploadLabel: "Upload",
            uploadIcon: "<i class=\"glyphicon glyphicon-upload\"></i> ",
            uploadUrl: "../../api/category/asyncImg.php?type=save", // server upload action
            uploadAsync: true,
            allowedFileExtensions: ["jpg", "png", "gif"],
            fileTypeSettings:['image']
        });

        $('.file-caption').hide();

        $('#pc_image').on('fileuploaded', function(event, data, previewId, index) {
            var form = data.form, files = data.files, extra = data.extra,
                response = data.response, reader = data.reader;
            //alert(response);
            $("#pc_imageName").val(response);
        });



        $(".main-navigation-menu li").removeClass("active open");
        $("#liProductCategory").addClass("active open");
        Main.init();
        TextEditor.init();
        FormValidator.init();
    });
</script>

<script>
    function printAlias()
    {
        var txtTitle = document.getElementById("pc_title");
        var txtAlias = document.getElementById("pc_alias");
        var slug;
        slug = getSlug(txtTitle.value);
        txtAlias.value = slug;


    }

</script>
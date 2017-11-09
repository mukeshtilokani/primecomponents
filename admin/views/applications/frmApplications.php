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
                <h1 class="mainTitle">Add Applications
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a class="btn btn-primary" href="<?=SITEURL?>views/category/frmApplicationsList.php" >View List / Edit / Update</a></h1>
            </div>
            <ol class="breadcrumb">
                <li>
                    <span>Dashboard</span>
                </li>
                <li class="active">
                    <span>Add Applications</span>
                </li>
            </ol>
        </div>
    </section>
    <!-- end: PAGE TITLE -->
    <!-- start: FIELDSET -->
    <div class="container-fluid container-fullw bg-white">
    <div class="row">
    <div class="col-md-12">
                    <form action="#" role="form" id="frmApplications">
                        <a class="btn btn-primary"  id="btnReset" style="display: none" >Reset</a>
                    <fieldset>
                        <legend>
                            Add Applications
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
                                        Category Name <span class="symbol required"></span>
                                    </label>
                                    <select class="js-example-placeholder-single form-control" id="pc_title" name="pc_title">
                                        <option></option>
                                    </select>
                                    <input type="hidden" id="pc_title1" name="pc_title1" value="" />
                                    <input type="hidden" id="pc_id1" name="pc_id1" value="" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">
                                        Application Title<span class="symbol required" aria-required="true"></span>
                                    </label>
                                    <input type="text" placeholder="Application Title" class="form-control"
                                           id="app_title" name="app_title" onblur="printAlias()" onKeyPress="printAlias()" onKeyUp="printAlias()">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        Alias [SEO]
                                    </label>
                                    <input type="text" placeholder="SEO URL" class="form-control" id="app_alias" name="app_alias" >
                                    <a class="btn btn-primary"  id="btnReset" style="display: none" >Reset</a>
                                </div>


                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        Image Upload
                                    </label>
                                    <input id="app_image" name="app_image" multiple type="file" accept="image/*" class="file-loading" >
                                    <input type="hidden" id="app_imageName" name="app_imageName" value="" />

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        Description
                                    </label>
                                    <textarea class="ckeditor form-control" cols="10" rows="10"  id="app_desc" name="app_desc" ></textarea>
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
<script src="<?=SITEURL?>assets/js/form-validation-applications.js"></script>
<script>
    jQuery(document).ready(function() {


        $("#btnReset").click(function() {
            $("#app_image").fileinput("clear");
            //reset form
            $("#frmApplications").trigger('reset');
            // Set the editor data.
            $( 'textarea.ckeditor' ).val( '' );

        });

        $("#pc_title").change(function(){
            var selectedValue = $("#pc_title option:selected").val();
            var selectedText = $("#pc_title option:selected").text();
            $("#pc_title1").val(selectedText);
            $("#pc_id1").val(selectedValue);
            //alert("You have selected value - " + selectedValue + "You have selected text -" + selectedText);
        });


        $(function(){
            var items="<option>Select One</option>";
            $.getJSON("../../api/category/getProductCategory.php",function(data){
                //alert(JSON.stringify(data));
                var myJSONObject = data;
                $.each(myJSONObject,function(index,item)
                {
                    items+="<option value='"+item.pc_id+"'>"+decodeURIComponent(item.pc_title)+"</option>";
                });
                $("#pc_title").html(items);
            });
        });

        $("#app_image").fileinput({
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
            uploadUrl: "../../api/applications/asyncImg.php?type=save", // server upload action
            uploadAsync: true,
            allowedFileExtensions: ["jpg", "png", "gif"],
            fileTypeSettings:['image']
        });

        $('.file-caption').hide();

        $('#app_image').on('fileuploaded', function(event, data, previewId, index) {
            var form = data.form, files = data.files, extra = data.extra,
                response = data.response, reader = data.reader;
            //alert(response);
            //$("#app_imageName").val(response);
            var arr =  $("#app_imageName").val();

            if(arr.length>0)
            {
                arr = arr + "," + response;
            }
            else
            {
                arr =  response;
            }

            $("#app_imageName").val(arr);
        });



        $(".main-navigation-menu li").removeClass("active open");
        $("#liApplications").addClass("active open");
        Main.init();
        TextEditor.init();
        FormValidator.init();
        FormElements.init();
    });
</script>

<script>




    function printAlias()
    {
        var txtTitle = document.getElementById("app_title");
        var txtAlias = document.getElementById("app_alias");
        var slug;
        slug = getSlug(txtTitle.value);
        txtAlias.value = slug;


    }

</script>
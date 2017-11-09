<?php
ob_start();
$sess_name = session_name();
if (session_start()) {
    setcookie($sess_name, session_id(), null, '/', null, null, true);
}
require_once '../../data/config.php';
$dbh = new PDO($dsn, $username, $password);
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
                        <h1 class="mainTitle">Add PDF Gallery

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a class="btn btn-primary" href="<?=SITEURL?>views/pdfgallery/frmPDFGalleryList.php" >View List / Edit / Update</a>
                        </h1>
                    </div>
                    <ol class="breadcrumb">
                        <li>
                            <span>Dashboard</span>
                        </li>
                        <li class="active">
                            <span>Add PDF Gallery</span>
                        </li>
                    </ol>
                </div>
            </section>
            <!-- end: PAGE TITLE -->
            <!-- start: FIELDSET -->
            <div class="container-fluid container-fullw bg-white">
                <div class="row">
                    <div class="col-md-12">
                        <form action="#" role="form" id="frmPDFGallery">
                            <fieldset>
                                <legend>
                                    Add PDF Gallery
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
                                                Category Name <span class="symbol required"></span>
                                            </label>
                                            <select class="js-example-placeholder-single form-control" id="pc_title" name="pc_title" >
                                                <option></option>
                                            </select>
                                            <input type="hidden" id="pc_title1" name="pc_title1" value="" />
                                            <input type="hidden" id="pc_alias1" name="pc_alias1" value="" />
                                            <input type="hidden" id="pc_id1" name="pc_id1" value="" />
                                        </div>


                                    </div>
                                    <div class="col-md-8">


                                        <div class="col-md-12">
                                        <div class="form-group">
                                            <label>
                                                PDF Upload
                                            </label>
                                            <input id="pdf_files" name="pdf_files" multiple  type="file" accept="pdf/*"  class="file-loading">

                                            <input type="hidden" id="pdf_filesName" name="pdf_filesName" value="" />


                                        </div>
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

<script src="<?=SITEURL?>assets/js/form-validation-pdfgallery.js"></script>
<script>
    jQuery(document).ready(function() {


        $("#pdf_files").fileinput({
            previewFileType: "pdf",
            browseClass: "btn btn-primary btn-block",
            browseLabel: "PDF",
            browseIcon: "<i class=\"glyphicon glyphicon-file\"></i> ",
            removeClass: "btn btn-danger",
            removeLabel: "Delete",
            removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
            uploadClass: "btn btn-info",
            uploadLabel: "Upload",
            uploadIcon: "<i class=\"glyphicon glyphicon-upload\"></i> ",
            uploadUrl: "../../api/pdfgallery/asyncDatasheet.php?type=save", // server upload action
            uploadAsync: true,
            allowedFileExtensions: ["pdf"]
        });
        $('.file-caption').hide();

        $('#pdf_files').on('fileuploaded', function(event, data, previewId, index) {
            var form = data.form, files = data.files, extra = data.extra,
                response = data.response, reader = data.reader;
            //alert(response);

            var arr =  $("#pdf_filesName").val();

            if(arr.length>0)
            {
                arr = arr + "," + response;
            }
            else
            {
                arr =  response;
            }

            $("#pdf_filesName").val(arr);
        });




        $("#pc_title").change(function(){
            var selectedValue = $("#pc_title option:selected").val();
            var selectedText = $("#pc_title option:selected").text();
            $("#pc_title1").val(selectedText);
            $("#pc_id1").val(selectedValue);
            printAlias();

            //alert("You have selected value - " + selectedValue + "You have selected text -" + selectedText);
        });



        $(function(){
            var items="<option>Select One</option>";
            $.getJSON("../../api/category/getProductCategory.php",function(data){
                //alert(JSON.stringify(data));
                var myJSONObject = data;
                $.each(myJSONObject,function(index,item)
                {
                    items+="<option value='"+item.pc_id+"'>"+ decodeURIComponent(item.pc_title) +"</option>";
                });
                $("#pc_title").html(items);
            });
        });


        $(".main-navigation-menu li").removeClass("active open");
        $("#liPDFGallery").addClass("active open");
        Main.init();

        FormValidator.init();
        FormElements.init();
    });
</script>

<script>
    function printAlias()
    {
        var txtTitle = document.getElementById("pc_title1");
        var txtAlias = document.getElementById("pc_alias1");
        var slug;
        slug = getSlug(txtTitle.value);
        txtAlias.value = slug;


    }

</script>

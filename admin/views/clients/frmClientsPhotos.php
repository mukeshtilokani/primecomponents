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
                        <h1 class="mainTitle">Add Client Photos
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a class="btn btn-primary" href="<?=SITEURL?>views/clients/frmClientsPhotosList.php" >View List / Edit / Update</a>
                        </h1>
                    </div>
                    <ol class="breadcrumb">
                        <li>
                            <span>Dashboard</span>
                        </li>
                        <li class="active">
                            <span>Add Client Photos</span>
                        </li>
                    </ol>
                </div>
            </section>
            <!-- end: PAGE TITLE -->
            <!-- start: FIELDSET -->
            <div class="container-fluid container-fullw bg-white">
                <div class="row">
                    <div class="col-md-12">
                        <form action="#" role="form" id="frmClientPhotos">
	                        <a class="btn btn-primary"  id="btnReset" style="display: none" >Reset</a>
                            <fieldset>
                                <legend>
                                    Add Client Photos
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
                                                Client Name <span class="symbol required"></span>
                                            </label>
                                            <select class="js-example-placeholder-single form-control" id="cl_title" name="cl_title" >
                                                <option></option>
                                            </select>
                                            <input type="hidden" id="cl_title1" name="cl_title1" value="" />
                                            <input type="hidden" id="cl_alias1" name="cl_alias1" value="" />
                                            <input type="hidden" id="cl_id1" name="cl_id1" value="" />
                                        </div>


                                    </div>
                                    <div class="col-md-8">


                                        <div class="col-md-12">
                                        <div class="form-group">
                                            <label>
                                                Photos Upload
                                            </label>
                                            <input id="cl_image" name="cl_image" multiple type="file" accept="image/*" class="file-loading">
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

<script src="<?=SITEURL?>assets/js/form-validation-clientPhotos.js"></script>
<script>
    jQuery(document).ready(function() {


        $("#btnReset").click(function() {
            $("#cl_image").fileinput("clear");
            //reset form
            $("#frmClientPhotos").trigger('reset');
            // Set the editor data.
	        $("#cl_imageName").val('');

        });



        $("#cl_image").fileinput({
            previewFileType: "image",
            overwriteInitial: false,
            browseClass: "btn btn-success btn-block",
            browseLabel: "Image",
            browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
            removeClass: "btn btn-danger",
            removeLabel: "Delete",
            removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
            uploadClass: "btn btn-info",
            uploadLabel: "Upload",
            uploadIcon: "<i class=\"glyphicon glyphicon-upload\"></i> ",
            uploadUrl: "../../api/clients/asyncClientPhotos.php?type=save", // server upload action
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




        $("#cl_title").change(function(){
            var selectedValue = $("#cl_title option:selected").val();
            var selectedText = $("#cl_title option:selected").text();
            $("#cl_title1").val(selectedText);
            $("#cl_id1").val(selectedValue);
            printAlias();

            //alert("You have selected value - " + selectedValue + "You have selected text -" + selectedText);
        });



        $(function(){
            var items="<option>Select One</option>";
            $.getJSON("../../api/clients/getClients.php",function(data){
                //alert(JSON.stringify(data));
                var myJSONObject = data;
                $.each(myJSONObject,function(index,item)
                {
                    items+="<option value='"+item.cl_id+"'>"+ decodeURIComponent( item.cl_title)+"</option>";
                });
                $("#cl_title").html(items);
            });
        });


        $(".main-navigation-menu li").removeClass("active open");
        $("#liClientsWork").addClass("active open");
        Main.init();

        FormValidator.init();
        FormElements.init();
    });
</script>

<script>
    function printAlias()
    {
        var txtTitle = document.getElementById("cl_title1");
        var txtAlias = document.getElementById("cl_alias1");
        var slug;
        slug = getSlug(txtTitle.value);
        txtAlias.value = slug;
    }

</script>

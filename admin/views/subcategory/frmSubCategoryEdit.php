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

    function preparer( $vTexte ) {
        $aTexte = explode( "\n", $vTexte );
        for ( $i = 0; $i < count( $aTexte ) - 1; $i ++ ) {
            $aTexte[ $i ] .= '\\';
        }

        return implode( "\n", $aTexte );
    }

    
    ?>

    <style>
        .progress-bar.animate {
            width: 100%;
        }
    </style>

    <div class="main-content">
        <div id="container" class="wrap-content container">
            <!-- start: PAGE TITLE -->
            <section id="page-title">
                <div class="row">
                    <div class="col-sm-8">
                        <h1 class="mainTitle">Edit / Update Product Sub-Category
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a class="btn btn-primary" href="<?=SITEURL?>views/subcategory/frmSubCategoryList.php" >View List / Edit / Update</a>
                        </h1>
                    </div>
                    <ol class="breadcrumb">
                        <li>
                            <span>Dashboard</span>
                        </li>
                        <li class="active">
                            <span>Edit / Update Product Sub-Category</span>
                        </li>
                    </ol>
                </div>
            </section>
            <!-- end: PAGE TITLE -->
            <!-- start: FIELDSET -->
            <div class="container-fluid container-fullw bg-white">
                <div class="row">
                    <div class="col-md-12">
                        <div class="modal js-loading-bar">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="progress progress-popup">
                                            <div class="progress-bar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        //unset($rows);
                        $sql = $dbh->prepare("SELECT * FROM
                               p_subcategories psc LEFT JOIN
							  p_categories pc on psc.pc_id = pc.pc_id
							  WHERE psc.psubc_active ='Y' AND psc.psubc_id='".$_GET['psubc_id']."'");
                        $sql->execute();
                        $rows = $sql->fetchAll();
                       // print_r($rows);
                        for($i=0;$i < count($rows); $i++)
                        {
                        ?>

                        <form action="#" role="form" id="frmProductSubCategory">
                            <fieldset>
                                <legend>
                                    Edit / Update Product Sub-Category
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

                                            <input type="hidden" id="pc_id1" name="pc_id1" value="<?=$rows[$i]['pc_id']?>"  />
                                            <input type="hidden" id="pc_title1" name="pc_title1" value="<?=$rows[$i]['pc_title']?>"  />
                                            <input type="hidden" id="pc_alias1" name="pc_alias1" value="<?=$rows[$i]['pc_alias']?>"  />

                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">
                                                Sub-Category Name <span class="symbol required" aria-required="true"></span>
                                            </label>
                                            <input type="text" placeholder="Sub-Category Name" class="form-control"   id="psubc_title"
                                                   name="psubc_title" onblur="printAlias()" onKeyPress="printAlias()" onKeyUp="printAlias()"
                                                   value="<?=urldecode($rows[$i]['psubc_title'])?>" >
                                            <input type="hidden" id="psubc_id1" name="user" value="<?=$rows[$i]['psubc_id']?>"  />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Alias [SEO]
                                            </label>
                                            <input type="text" placeholder="SEO URL" class="form-control" id="psubc_alias" name="psubc_alias" value="<?=$rows[$i]['psubc_alias']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Original Uploaded Image
                                            </label>
                                            <img src="<?=SITEURLFRONT?>images/subcat/thumb/<?=$rows[$i]['psubc_image']?>" alt="""/> <br>
                                            <label>
                                                Replace Image
                                            </label>
                                            <input id="psubc_image" name="psubc_image" type="file" accept="image/*" class="file-loading" >
                                            <input type="hidden" id="psubc_imageName" name="psubc_imageName" value="<?=$rows[$i]['psubc_image']?>" />



                                        </div>


                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>
                                                Description
                                            </label>
                                            <textarea class="ckeditor form-control" cols="10" rows="10"  id="psubc_desc" name="psubc_desc" >
                                                 <?= urldecode( htmlspecialchars_decode($rows[ $i ]['psubc_desc'] )) ?>
                                               </textarea>
                                            <?php $psubc_desc11 = urldecode( htmlspecialchars_decode ($rows[$i]['psubc_desc'])); ?>
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary"  id="btnSave" style="width: 100%" >Save</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                    <?php  } ?>
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
<script src="<?=SITEURL?>assets/js/form-validation-product-subcategory-update.js"></script>
<script>
    jQuery(document).ready(function() {

        $("#psubc_image").fileinput({
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
            uploadUrl: "../../api/subcategory/asyncImg.php?type=save", // server upload action
            uploadAsync: true,
            allowedFileExtensions: ["jpg", "png", "gif"],
            fileTypeSettings:['image']
        });

        $('.file-caption').hide();

        $('#psubc_image').on('fileuploaded', function(event, data, previewId, index) {
            var form = data.form, files = data.files, extra = data.extra,
                response = data.response, reader = data.reader;
            //alert(response);
            $("#psubc_imageName").val(response);
        });


        $("#pc_title").change(function(){
            var selectedValue = $("#pc_title").val();
            var selectedText = $("#pc_title option:selected").text();
            $("#pc_title1").val(selectedText);
            $("#pc_id1").val(selectedValue);
            //alert("You have selected value - " + selectedValue + "You have selected text -" + selectedText);
        });


       $(function(){
            var items="";
            $.getJSON("../../api/category/getProductCategory.php",function(data){
                //alert(JSON.stringify(data));
                var myJSONObject = data;
                $.each(myJSONObject,function(index,item)
                {
                    items+="<option value='"+item.pc_id+"'>"+ decodeURIComponent( item.pc_title)+"</option>";
                });
                $("#pc_title").html(items);
            });


        });


        $(".main-navigation-menu li").removeClass("active open");
        $("#liProductSubCategory").addClass("active open");
        Main.init();
        TextEditor.init();
        FormValidator.init();
        FormElements.init();
    });




    // Setup
    this.$('.js-loading-bar').modal({
        backdrop: 'static',
        show: false
    });





</script>

<script>
    function printAlias()
    {
        var txtTitle = document.getElementById("psubc_title");
        var txtAlias = document.getElementById("psubc_alias");
        var slug;
        slug = getSlug(txtTitle.value);
        txtAlias.value = slug;

    }

</script>

<script>
    $(window).load(function() {

        CKEDITOR.instances.psubc_desc.setData('<?=preparer(trim(html_entity_decode($psubc_desc11))) ?>');
       // alert($("#pc_id1").val());
        var pc_id = $("#pc_id1").val();



        var $modal = $('.js-loading-bar'),
            $bar = $modal.find('.progress-bar');

        $modal.modal('show');
        $bar.addClass('animate');

        setTimeout(function() {
            $bar.removeClass('animate');
            $modal.modal('hide');
            $('#pc_title').val(pc_id).trigger('change');
        }, 1500);

    });
</script>

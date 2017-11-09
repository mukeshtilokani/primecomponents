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
    $dbh = new PDO($dsn, $username, $password);

    function preparer($vTexte)
    {
        $aTexte = explode("\n",$vTexte);
        for ($i=0;$i<count($aTexte)-1;$i++)
        {$aTexte[$i] .= '\\';}
        return implode("\n",$aTexte);
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
                        <h1 class="mainTitle">Edit / Update Product</h1>
                    </div>
                    <ol class="breadcrumb">
                        <li>
                            <span>Dashboard</span>
                        </li>
                        <li class="active">
                            <span>Add Product</span>
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
                        $rows="";
                        $sql = $dbh->prepare("SELECT * FROM products p LEFT JOIN
                                p_categories c ON p.p_pc_id = c.pc_id LEFT JOIN
                                p_subcategories subc ON p.psubc_id = subc.psubc_id
								WHERE p.p_active='Y' AND p.p_id ='".$_GET['p_id']."'");
                        $sql->execute();
                        $rows = $sql->fetchAll();
                        //print_r($rows); exit;
                        for($i=0;$i < count($rows); $i++)
                        {
                        ?>
                        <form action="#" role="form" id="frmProduct" name="frmProduct">
                            <fieldset>
                                <legend>
                                    Edit / Update Product
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
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Category Name <span class="symbol required"></span>
                                            </label>
                                            <select class="js-example-placeholder-single form-control" id="pc_title" name="pc_title">
                                                <option></option>
                                            </select>
                                            <input type="hidden" id="pc_id1" name="pc_id1" value="<?=$rows[$i]['p_pc_id']?>"  />
                                            <input type="hidden" id="pc_title1" name="pc_title1" value="<?=$rows[$i]['pc_title']?>"  />
                                            <input type="hidden" id="pc_alias1" name="pc_alias1" value="<?=$rows[$i]['pc_alias']?>"  />
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">
                                                Sub-Category Name
                                            </label>
                                            <select class="js-example-placeholder-single form-control" id="psubc_title" name="psubc_title">
                                                <option></option>
                                            </select>

                                            <input type="hidden" id="psubc_id1" name="psubc_id1" value="<?=$rows[$i]['psubc_id']?>"  />
                                            <input type="hidden" id="psubc_title1" name="psubc_title1" value="<?=$rows[$i]['psubc_title']?>"  />
                                            <input type="hidden" id="psubc_alias1" name="psubc_alias1" value="<?=$rows[$i]['psubc_alias']?>"  />


                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Product Name <span class="symbol required" aria-required="true"></span>
                                            </label>
                                            <input type="text" placeholder="Product Name" class="form-control"   id="p_title" name="p_title" onblur="printAlias()" onKeyPress="printAlias()" onKeyUp="printAlias()" value="<?=$rows[$i]['p_title']?>">
                                            <input type="hidden" id="p_id1" name="p_id1" value="<?=$rows[$i]['p_id']?>" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Alias [SEO]
                                            </label>
                                            <input type="text" placeholder="SEO URL" class="form-control" id="p_alias" name="p_alias" value="<?=$rows[$i]['p_alias']?>">
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Pitch
                                                    </label>
                                                    <input type="text" placeholder="Pitch" class="form-control" id="p_pitch" name="p_pitch" value="<?=$rows[$i]['p_pitch']?>" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Current
                                                    </label>
                                                    <input type="text" placeholder="Current" class="form-control" id="p_current" name="p_current" value="<?=$rows[$i]['p_current']?>" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Voltage
                                                    </label>
                                                    <input type="text" placeholder="Voltage" class="form-control" id="p_voltage" name="p_voltage" value="<?=$rows[$i]['p_voltage']?>" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">


                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Original Uploaded Image
                                            </label>
                                            <img src="<?=SITEURLFRONT?>images/products/<?=$rows[$i]['p_image']?>" alt=""/> <br>
                                            <label>
                                                Replace Image
                                            </label>
                                            <input id="p_image" name="p_image" type="file" accept="image/*" class="file-loading">
                                            <input type="hidden" id="p_imageName" name="p_imageName" value="<?=$rows[$i]['p_image']?>" />
<!--                                            <input id="p_image" class="file" type="file" data-min-file-count="1">-->

<!--                                            <div class="fileinput fileinput-new" data-provides="fileinput">-->
<!--                                                <div class="fileinput-new thumbnail"><img src="--><?//=SITEURL?><!--assets/images/avatar-1-xl.jpg" alt="">-->
<!--                                                </div>-->
<!--                                                <div class="fileinput-preview fileinput-exists thumbnail"></div>-->
<!--                                                <div class="user-edit-image-buttons">-->
<!--																			<span class="btn btn-azure btn-file"><span class="fileinput-new"><i class="fa fa-picture"></i> Select image</span><span class="fileinput-exists"><i class="fa fa-picture"></i> Change</span>-->
<!--																				<input type="file">-->
<!--																			</span>-->
<!--                                                    <a href="#" class="btn fileinput-exists btn-red" data-dismiss="fileinput">-->
<!--                                                        <i class="fa fa-times"></i> Remove-->
<!--                                                    </a>-->
<!--                                                </div>-->
<!--                                                <span class="fileinput-filename" style="display:none"  id="p_imageName" name="p_imageName" ></span>-->
<!--                                                <span class="fileinput-filepath" style="display:none"  id="p_imagePath" name="p_imagePath" ></span>-->
<!--                                            </div>-->


                                        </div>
                                    </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Original Uploaded Datasheet
                                                </label>
                                                <a href="<?=SITEURLFRONT?>images/pdf/<?=$rows[$i]['p_catalog_file']?>" target="_blank">
                                                    <img src="<?=SITEURL?>images/pdf.png" alt=""/>
                                                </a> <br>
                                                <label>
                                                    Replace Datasheet
                                                </label>
                                                <input id="p_catalog_file" name="p_catalog_file" type="file" class="file-loading">
                                                <input type="hidden" id="p_catalogName" name="p_catalogName" value="<?=$rows[$i]['p_catalog_file']?>" />
<!--                                                <div class="fileinput fileinput-new" data-provides="fileinput">-->
<!--                                                    <span class="btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="..."></span>-->
<!--                                                    <span class="fileinput-filename"   id="p_catalogName" name="p_catalogName" ></span>-->
<!--                                                    <span class="fileinput-filepath" style="display:none"  id="p_catalogPath" name="p_catalogPath" ></span>-->
<!--                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>-->
<!--                                                </div>-->


                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="block">
                                                    Upcoming?
                                                </label>
                                                <div class="clip-radio radio-primary">
                                                    <input type="radio" id="p_upcomingY" name="p_upcoming" value="Yes">
                                                    <label for="p_upcomingY">
                                                        Yes
                                                    </label>
                                                    <input type="radio" id="p_upcomingN" name="p_upcoming" value="No" >
                                                    <label for="p_upcomingN">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                            <input type="hidden" id="p_upcomingValue" name="p_upcomingValue" value="<?=$rows[$i]['p_upcoming']?>" />

                                            <div class="form-group">
                                                <label class="control-label">
                                                    Approvals :
                                                </label>

                                                <input type="hidden" id="ai_id" name="ai_id" value="<?=$rows[$i]['ai_id']?>" />


                                                <?php $sql = $dbh->prepare("SELECT * FROM approval_icons WHERE
                                ai_active='Y' ");
                                                $sql->execute();
                                                $rows2 = $sql->fetchAll();  ?>
                                                <input type="hidden" id="i_value" name="i_value" value="<?=count($rows2)?>" />
                                                <?php for($j=0;$j < count($rows2); $j++)
                                                {
                                                    ?>


                                                    <div class="checkbox clip-check check-primary check-md checkbox-inline">
                                                        <input type="checkbox" data-ids="<?=$rows2[$j]['ai_id']?>" id="chk<?=$j+1?>" value="<?=$rows2[$j]['ai_id']?>" >
                                                        <label for="chk<?=$j+1?>">
                                                            <img src="<?=SITEURLFRONT?>images/icons/<?=$rows2[$j]['ai_icon']?>" title="<?=$rows2[$j]['ai_title']?>" alt="<?=$rows2[$j]['ai_title']?>" />
                                                        </label>
                                                    </div>

                                                <?php }

                                                if(strlen($rows[$i]['ai_id']) > 0)
                                                {
                                                    $ai_ids = explode(",",$rows[$i]['ai_id']);
                                                }
                                                for($m=0;$m < count($rows2); $m++)
                                                {
                                                    for($k=0;$k < count($ai_ids); $k++)
                                                    {

                                                        ?>
                                                        <script>
                                                            if(<?=$rows2[$m]['ai_id']?> == <?=$ai_ids[$k]?>)
                                                            {
                                                                var checkbox = $('#chk'+<?=$m+1?>);
                                                                checkbox.prop("checked", true);
                                                            }
                                                        </script>
                                                    <?php }
                                                }
                                                ?>




                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>
                                                Intro
                                            </label>
                                            <textarea class="ckeditor form-control" cols="10" rows="5"  id="p_intro" name="p_intro" ><?=$rows[$i]['p_intro']?></textarea>



                                            <?php $p_intro = $rows[$i]['p_intro']; ?>
                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>
                                                Description
                                            </label>
                                            <textarea class="ckeditor form-control" cols="10" rows="10"  id="p_desc" name="p_desc" ><?=$rows[$i]['p_description']?></textarea>



                                            <?php $p_desc = $rows[$i]['p_description']; ?>
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
<script src="<?=SITEURL?>assets/js/form-validation-product-update.js"></script>
<script>

    // Setup
    this.$('.js-loading-bar').modal({
        backdrop: 'static',
        show: false
    });

    jQuery(document).ready(function() {


        $("#p_image").fileinput({
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
            uploadUrl: "../../api/product/asyncImg.php?type=save", // server upload action
            uploadAsync: true,
            allowedFileExtensions: ["jpg", "png", "gif"],
            fileTypeSettings:['image']
        });

        $('.file-caption').hide();

        $('#p_image').on('fileuploaded', function(event, data, previewId, index) {
            var form = data.form, files = data.files, extra = data.extra,
               response = data.response, reader = data.reader;
            //alert(response);
            $("#p_imageName").val(response);
        });


        $("#p_catalog_file").fileinput({
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
            uploadUrl: "../../api/product/asyncDatasheet.php?type=save", // server upload action
            uploadAsync: true,
            allowedFileExtensions: ["pdf"]
        });
        $('.file-caption').hide();

        $('#p_catalog_file').on('fileuploaded', function(event, data, previewId, index) {
            var form = data.form, files = data.files, extra = data.extra,
                response = data.response, reader = data.reader;
            //alert(response);
            $("#p_catalogName").val(response);
        });

        $("#pc_title").change(function(){
            var selectedValue = $("#pc_title").val();
            var selectedText = $("#pc_title option:selected").text();
            $("#pc_title1").val(selectedText);
            $("#pc_id1").val(selectedValue);

            var items="";
            $.post("../../api/subcategory/getSubCategoryByCatId.php",{pc_id:selectedValue},function(data){
                //alert(JSON.stringify(data));
                var myJSONObject = data;
                $.each(myJSONObject,function(index,item)
                {
                    items+="<option value='"+item.psubc_id+"'>"+item.psubc_title+"</option>";
                });
                $("#psubc_title").html(items);
            });

            var psubc_id = $("#psubc_id1").val();

            if(psubc_id.length > 0)
            {
                var $modal = $('.js-loading-bar'),
                    $bar = $modal.find('.progress-bar');

                $modal.modal('show');
                $bar.addClass('animate');

                setTimeout(function() {
                    $bar.removeClass('animate');
                    $modal.modal('hide');
                    $('#psubc_title').val(psubc_id).trigger('change');

                }, 1500);
            }



            //alert("You have selected value - " + selectedValue + "You have selected text -" + selectedText);
        });

        $("#psubc_title").change(function(){
            var selectedValue = $("#psubc_title").val();
            var selectedText = $("#psubc_title option:selected").text();
            $("#psubc_title1").val(selectedText);
            $("#psubc_id1").val(selectedValue);
            //alert("You have selected value - " + selectedValue + "You have selected text -" + selectedText);
        });


        $(function(){
            var items="";
            $.getJSON("../../api/category/getProductCategory.php",function(data){
                //alert(JSON.stringify(data));
                var myJSONObject = data;
                $.each(myJSONObject,function(index,item)
                {
                    items+="<option value='"+item.pc_id+"'>"+item.pc_title+"</option>";
                });
                $("#pc_title").html(items);
            });
        });


        $(".main-navigation-menu li").removeClass("active open");
        $("#liProduct").addClass("active open");
        Main.init();
        TextEditor.init();
        FormValidator.init();
        FormElements.init();

    });



</script>

<script>
    function printAlias()
    {
        var txtTitle = document.getElementById("p_title");
        var txtAlias = document.getElementById("p_alias");
        var str = txtTitle.value;
        var replace = new Array(" ", "[\?]", "\!", "\%", "\&", "\/");
        var by = new Array("-", "", "", "", "-", "");

        for (var i=0; i<replace.length; i++) {
            str = str.replace(new RegExp(replace[i], "g"), by[i]);
        }
        txtAlias.value = str.toLowerCase();

    }

</script>

<script>
    $(window).load(function() {

        CKEDITOR.instances.p_intro.setData('<?=preparer(trim(html_entity_decode($p_intro))) ?>');
        CKEDITOR.instances.p_desc.setData('<?=preparer(trim(html_entity_decode($p_desc))) ?>');
        // alert($("#pc_id1").val());

        if ($("#p_upcomingValue").val()=='Y')
        {
            $("#p_upcomingN").prop('checked', false);
            $("#p_upcomingY").prop('checked', true);
        }
        else
        {
            $("#p_upcomingY").prop('checked', false);
            $("#p_upcomingN").prop('checked', true);
        }





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

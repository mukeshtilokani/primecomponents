<?php
ob_start();
session_start();
require_once '../../data/config.php';
$dbh = new PDO($dsn, $username, $password);
if(isset($_SESSION['wf_id']) && $_SESSION['wf_id'] != '')
{
    $mode = "add";
    if (isset($_GET['wp_id']))
    {
        $mode = "update";
    }
    require_once '../../include/header.php';

        require_once '../../include/body.php';


?>
<div class="main-content">
    <div id="container" class="wrap-content container">
        <!-- start: PAGE TITLE -->
        <section id="page-title">
            <div class="row">
                <div class="col-sm-8">
                    <h1 class="mainTitle">Website Pages
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       <a class="btn btn-primary" href="<?=SITEURL?>views/webpage/frmWebpageList.php" >View List / Edit / Update</a> </h1>

                </div>
                <ol class="breadcrumb">
                    <li>
                        <span>Dashboard</span>
                    </li>
                    <li class="active">
                        <span>Website Pages</span>
                    </li>
                </ol>
            </div>
        </section>
        <!-- end: PAGE TITLE -->


        <!-- start: FIELDSET -->
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-12">
                    <form action="#" role="form" id="frmWebpage">

                        <a class="btn btn-primary"  id="btnReset" style="display: none" >Reset</a>

                        <?php if ($mode=="add")
                        { ?>
                            <h5 class="over-title">Add  a <span class="text-bold">Website Page</span></h5>
                        <?php } else { ?>
                            <h5 class="over-title">Edit / Update  a <span class="text-bold">Website Page</span></h5>
                        <?php } ?>

                    <div class="row">
                        <div class="col-md-12">
                            <fieldset>
                                <legend>
                                    Website Page Information
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
                                            <label>
                                                Page Name <span class="symbol required" aria-required="true"></span>
                                            </label>
                                            <input type="text"  id="wp_title" name="wp_title" placeholder="Title" class="form-control" onKeyPress="printAlias()" onKeyUp="printAlias()"
                                                   onblur="printAlias()">
                                            <?php if ($mode=="update")
                                            { ?>
                                                <input type="hidden" id="wp_id1" name="wp_id1" value="<?=$_GET['wp_id']?>" />
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Alias [SEO]
                                            </label>
                                            <input type="text"   id="wp_alias" name="wp_alias" placeholder="SEO URL" class="form-control"  >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="block">
                                                Intro Text
                                            </label>
                                            <textarea class="ckeditor form-control" cols="10" rows="10" id="wp_intro" name="wp_intro"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>
                                                Description
                                            </label>
                                            <textarea class="ckeditor form-control" cols="10" rows="10" id="wp_description" name="wp_description"></textarea>
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary"  id="btnSave" style="width: 100%" >Save</button>
                                        </div>
                                </div>
                            </fieldset>

                        </div>
                    </div>
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
<script src="<?=SITEURL?>assets/js/form-validation-webpage.js"></script>
<script>
    jQuery(document).ready(function() {

        $("#btnReset").click(function() {
            //reset form
            $("#frmWebpage").trigger('reset');
            // Set the editor data.
            $( 'textarea.ckeditor' ).val( '' );



        });

        $(".main-navigation-menu li").removeClass("active open");
        $("#liWebpage").addClass("active open");
        Main.init();
        TextEditor.init();
        FormValidator.init();
    });
</script>

<script>

    function printAlias()
    {
        var txtTitle = document.getElementById("wp_title");
        var txtAlias = document.getElementById("wp_alias");
        var slug;
        slug = getSlug(txtTitle.value);
        txtAlias.value = slug;


    }



</script>
<script>
    $(window).load(function() {



        <?php if ($mode=="update")
        {
            $sql = $dbh->prepare("SELECT * FROM webpages WHERE
            wp_active='Y' AND wp_id='".$_GET['wp_id']."'");
            $sql->execute();
            $rows = $sql->fetchAll();
            for($i=0;$i < count($rows); $i++)
            {
                ?>

        $('#wp_title').val( decodeURIComponent('<?=$rows[$i]['wp_title']?>')) ;
        $('#wp_alias').val(decodeURIComponent('<?=$rows[$i]['wp_alias']?>'));

        $('#btnSave').html('Update');

        CKEDITOR.instances.wp_intro.setData( decodeURIComponent( '<?=str_replace("\n", "\\n", trim(html_entity_decode($rows[$i]['wp_intro']))) ?>'));
        CKEDITOR.instances.wp_description.setData( decodeURIComponent('<?=str_replace("\n", "\\n", trim(html_entity_decode($rows[$i]['wp_description']))) ?>'));

        <?php }
    } ?>
    });
</script>
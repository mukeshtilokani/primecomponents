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
    $mode = "add";
    if (isset($_GET['nws_id']))
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
                        <h1 class="mainTitle">Add News
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a class="btn btn-primary" href="<?=SITEURL?>views/news/frmNewsList.php" >View List / Edit / Update</a>

                        </h1>
                    </div>
                    <ol class="breadcrumb">
                        <li>
                            <span>Dashboard</span>
                        </li>
                        <li class="active">
                            <span>Add News</span>
                        </li>
                    </ol>
                </div>
            </section>
            <!-- end: PAGE TITLE -->
            <!-- start: FIELDSET -->
            <div class="container-fluid container-fullw bg-white">
                <div class="row">
                    <div class="col-md-12">
                        <form action="#" role="form" id="frmNews">
                            <fieldset>
                                <?php if ($mode=="add")
                                { ?>
                                <legend> Add  News </legend>
                                <?php } else { ?>
                                    <legend>Edit / Update  News </legend>
                                <?php } ?>

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
                                                News Title <span class="symbol required"></span>
                                            </label>
                                            <input type="text" placeholder="News Title" class="form-control"   id="nws_title" name="nws_title" onblur="printAlias()" onKeyPress="printAlias()" onKeyUp="printAlias()">
                                            <?php if ($mode=="update")
                                            { ?>
                                                <input type="hidden" id="nws_id1" name="nws_id1" value="<?=$_GET['nws_id']?>" />
                                            <?php } ?>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Alias [SEO]
                                            </label>
                                            <input type="text" placeholder="SEO URL" class="form-control" id="nws_alias" name="nws_alias" >
                                        </div>


                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>
                                                Description
                                            </label>
                                            <textarea class="ckeditor form-control" cols="10" rows="10"  id="nws_description" name="nws_description" ></textarea>
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
<script src="<?=SITEURL?>assets/js/form-validation-news.js"></script>
<script>
    jQuery(document).ready(function() {


        $(".main-navigation-menu li").removeClass("active open");
        $("#liNews").addClass("active open");
        Main.init();
        TextEditor.init();
        FormValidator.init();
        FormElements.init();
    });
</script>

<script>
    function printAlias()
    {
        var txtTitle = document.getElementById("nws_title");
        var txtAlias = document.getElementById("nws_alias");
        var slug;
        slug = getSlug(txtTitle.value);
        txtAlias.value = slug;

    }

</script>
<script>
    $(window).load(function() {

        <?php if ($mode=="update")
        {
            $sql = $dbh->prepare("SELECT * FROM news WHERE
            nws_active='Y' AND nws_id='".$_GET['nws_id']."'");
            $sql->execute();
            $rows = $sql->fetchAll();

            for($i=0;$i < count($rows); $i++)
            {
                ?>

        $('#nws_title').val( decodeURIComponent('<?=$rows[$i]['nws_title']?>')) ;
        $('#nws_alias').val(decodeURIComponent('<?=$rows[$i]['nws_alias']?>'));

        $('#btnSave').html('Update');


        CKEDITOR.instances.nws_description.setData( decodeURIComponent('<?=str_replace("\n", "\\n", trim(html_entity_decode($rows[$i]['nws_description']))) ?>'));

        <?php }
    } ?>
    });
</script>
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
    if (isset($_GET['t_id']))
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
          <h1 class="mainTitle">Add Testimonials
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="btn btn-primary" href="<?=SITEURL?>views/testimonials/frmTestimonialsList.php" >View List / Edit / Update</a> </h1>
        </div>
        <ol class="breadcrumb">
          <li> <span>Dashboard</span> </li>
          <li class="active"> <span>Add Testimonials</span> </li>
        </ol>
      </div>
    </section>
    <!-- end: PAGE TITLE --> 
    <!-- start: FIELDSET -->
    <div class="container-fluid container-fullw bg-white">
      <div class="row">
        <div class="col-md-12">
          <form action="#" role="form" id="frmTestimonials">
          <a class="btn btn-primary"  id="btnReset" style="display: none" >Reset</a>
            <fieldset>
              <?php if ($mode=="add")
                                { ?>
              <legend> Add  Testimonials </legend>
              <?php } else { ?>
              <legend>Edit / Update  Testimonials </legend>
              <?php } ?>
              <div class="row">
                <div class="col-md-12">
                  <div> <span class="symbol required" aria-required="true"></span>Required Fields
                    <hr>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label"> Customer Name <span class="symbol required" aria-required="true"></span> </label>
                    <input type="text" placeholder="Customer Name" class="form-control"   id="t_title" name="t_title" onblur="printAlias()" onKeyPress="printAlias()" onKeyUp="printAlias()">
                    <?php if ($mode=="update")
                                            { ?>
                    <input type="hidden" id="t_id1" name="t_id1" value="<?=$_GET['t_id']?>" />
                    <?php } ?>
                  </div>
                  </div>
                   <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label"> Company Name </label>
                    <input type="text" placeholder="Company Name" class="form-control"   id="t_co_name" name="t_co_name"  >
                    
                  </div>
                  
                  </div>
                   <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label"> Designation</label>
                    <input type="text" placeholder="Designation" class="form-control"   id="t_designation" name="t_designation"  >
                    
                  </div>
                  
                  </div>
                   <div class="col-md-4">
                   <div class="form-group">
                    <label class="control-label"> City</label>
                    <input type="text" placeholder="City" class="form-control"   id="t_city" name="t_city"  >
                    
                  </div>
                  
                  
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label"> Alias [SEO] </label>
                    <input type="text" placeholder="SEO URL" class="form-control" id="t_alias" name="t_alias" >
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label> Description </label>
                    <textarea class="ckeditor form-control" cols="10" rows="10"  id="t_desc" name="t_desc" ></textarea>
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
<script src="<?=SITEURL?>assets/js/form-validation-testimonials.js"></script> 
<script>
    jQuery(document).ready(function() {
		
		 $("#btnReset").click(function() {
           
            //reset form
            $("#frmTestimonials").trigger('reset');
            // Set the editor data.
            $( 'textarea.ckeditor' ).val( '' );

        });
		
		   
				
				

        $(".main-navigation-menu li").removeClass("active open");
        $("#liTestimonials").addClass("active open");
        Main.init();
        TextEditor.init();
        FormValidator.init();
        FormElements.init();
    });
</script> 
<script>
    function printAlias()
    {
        var txtTitle = document.getElementById("t_title");
        var txtAlias = document.getElementById("t_alias");
        var slug;
        slug = getSlug(txtTitle.value);
        txtAlias.value = slug;

    }

</script> 
<script>
    $(window).load(function() {

        <?php if ($mode=="update")
        {
            $sql = $dbh->prepare("SELECT * FROM testimonials WHERE
            t_active='Y' AND t_id='".$_GET['t_id']."'");
            $sql->execute();
            $rows = $sql->fetchAll();

            for($i=0;$i < count($rows); $i++)
            {
                ?>

        $('#t_title').val( decodeURIComponent('<?=$rows[$i]['t_title']?>')) ;
        $('#t_alias').val(decodeURIComponent('<?=$rows[$i]['t_alias']?>'));
        $('#t_designation').val(decodeURIComponent('<?=$rows[$i]['t_designation']?>'));
        $('#t_co_name').val(decodeURIComponent('<?=$rows[$i]['t_co_name']?>'));
        $('#t_city').val(decodeURIComponent('<?=$rows[$i]['t_city']?>'));

        $('#btnSave').html('Update');


        CKEDITOR.instances.t_desc.setData( decodeURIComponent('<?=str_replace("\n", "\\n", trim(html_entity_decode($rows[$i]['t_desc']))) ?>'));

        <?php }
    } ?>
    });
</script>
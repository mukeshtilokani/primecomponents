<?php
ob_start();
session_start();
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
                    <h1 class="mainTitle">Manage Website Pages
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-primary" href="<?=SITEURL?>views/webpage/frmWebpage.php" >Add new</a>
                    </h1>
                </div>
                <ol class="breadcrumb">
                    <li>
                        <span>Dashboard</span>
                    </li>
                    <li class="active">
                        <span>Manage Website Pages</span>
                    </li>
                </ol>
            </div>
        </section>
        <!-- end: PAGE TITLE -->


        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" id="wf_id1" name="wf_id1" value="<?=$_SESSION['wf_id']?>" />


                    <table id="gvWebpage" class="table table-striped table-bordered table-hover table-full-width">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Title</th>
<!--                            <th>Description</th>-->
                            <th>Edit </th>

                        </tr>
                        </thead>


                    </table>


                </div>
            </div>
        </div>
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
<script>
    jQuery(document).ready(function() {

        $(".main-navigation-menu li").removeClass("active open");
        $("#liWebpage").addClass("active open");
        Main.init();

    });
</script>

<script>
    // Create a comma separated list from an array of objects
    jQuery(document).ready( function() {

            var oTable = $('#gvWebpage').DataTable({
                "bProcessing": true,
                "sAjaxSource": "../../api/webpage/read.php",
                "sPaginationType": "full_numbers",
                "aoColumnDefs" : [
                    {  "bSortable": false,"sWidth": "3%", "aTargets": [ 0 ]},
                    {  "sWidth": "80%", "aTargets": [ 1 ],"mData": "wp_title" , "sType": "html",
                        "render": function ( data, type, full, meta ) {
                            return '<span>'+ decodeURIComponent(data) +'</span>';
                        }
                    },
                   // { "bSortable": false,"sWidth": "55%", "aTargets": [ 2 ],"mData": "wp_description" },
                    { "bSortable": false, "sWidth": "5%", "aTargets": [ 2 ],"mData": "wp_id"  , "render": function ( data, type, full, meta ) {
                        return '<a  href="<?=SITEURL?>views/webpage/frmWebpage.php?wp_id='+data+'" class="btn btn-primary" ><span class="fa fa-pencil"></span> Edit</span>';
                        }
                    }
//
//                    {
//                        "aTargets":[ 3 ]
//                        , "sType": "date"
//                        , "mRender": function(date, type, full) {
//                        return (full[2] == "Blog")
//                            ? new Date(date).toDateString()
//                            : "N/A" ;
//                    }
//                    }
                ],
                "order": [[ 0, 'asc' ]],

                "aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "iDisplayLength" : 20,
            });
    } );
</script>


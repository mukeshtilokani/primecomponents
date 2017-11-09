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
                    <h1 class="mainTitle">Manage Product Sub-Categories
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-primary" href="<?=SITEURL?>views/subcategory/frmSubCategory.php" >Add New</a>
                    </h1>
                </div>
                <ol class="breadcrumb">
                    <li>
                        <span>Dashboard</span>
                    </li>
                    <li class="active">
                        <span>Manage Product SubCategories</span>
                    </li>
                </ol>
            </div>
        </section>
        <!-- end: PAGE TITLE -->

        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" id="wf_id1" name="wf_id1" value="<?=$_SESSION['wf_id']?>" />


                    <table id="gvSubCategory" class="table table-striped table-bordered table-hover table-full-width">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Image</th>
                            <th>Category Name </th>
                            <th>Title</th>
                            <th>List Order</th>
                            <th>Edit </th>
                            <th>Delete</th>
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
        $("#liProductSubCategory").addClass("active open");
        Main.init();

    });
</script>

<script>
    // Create a comma separated list from an array of objects
    jQuery(document).ready( function() {




        var oTable = $('#gvSubCategory').DataTable({
            "bProcessing": true,
            "sAjaxSource": "../../api/subcategory/read.php",
            "sPaginationType": "full_numbers",
            "aoColumnDefs" : [
                { "bSortable": false,  "sWidth": "3%", "aTargets": [ 0]},
                {
                    "bSortable": false,
                    "sWidth": "10%",
                    "aTargets": [1],
                    "mData": "psubc_image",
                    "render": function (data, type, full, meta) {
                        return '<image  src="<?=SITEURLFRONT?>images/subcat/thumb/' + data + '" style="height:50px;" />';
                    }
                },
                {  "sWidth": "20%", "aTargets": [ 2], "mData": "pc_title" , "sType": "html",
                    "render": function ( data, type, full, meta ) {
                        return '<span>'+ decodeURIComponent(data) +'</span>';
                    }
                },
                {  "sWidth": "45%", "aTargets": [ 3], "mData": "psubc_title", "sType": "html",
                    "render": function ( data, type, full, meta ) {
                        return '<span>'+ decodeURIComponent(data) +'</span>';
                    }
                },
                { "bSortable": false, "sWidth": "10%", "aTargets": [ 4], "mData": "psubc_order" , "render": function ( data, type, full, meta ) {
                    return '<input type="text" value="'+data+'" style="width:35px; height:23px;" />';}
                },
                { "bSortable": false, "sWidth": "5%", "aTargets": [ 5] ,  "mData": "psubc_id" , "render": function ( data, type, full, meta ) {
                    return '<a  href="<?=SITEURL?>views/subcategory/frmSubCategoryEdit.php?psubc_id='+data+'" class="btn btn-primary" ><span class="fa fa-pencil"></span> Edit</span>';
                }
                },
                { "bSortable": false, "sWidth": "5%", "aTargets": [ 6 ],  "mData": "psubc_id" , "render": function ( data, type, full, meta ) {
                    return '<a  data-id="'+data+'" class="btn btn-danger btnDelete" ><span class="fa fa-times"></span>  Delete</span>';
                }
                }
            ],
            "order": [[ 3, 'asc' ]],

            "aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength" : 20,
        });

        $('#gvSubCategory').on('click', '.btnDelete', function(){

            var psubc_id =  $(this).data('id');
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover the deleted entry!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        $.ajax({
                            type:'POST',
                            data: {
                                psubc_id: psubc_id
                            },
                            url:'../../api/subcategory/delete.php',
                            success:function(data) {
                                swal("Deleted!", "Your entry has been deleted.", "success");

                                setTimeout(function() {
                                    window.location.reload();
                                }, 2000);
                            }

                        });


                    } else {
                        swal("Cancelled", "Your entry is safe :)", "error");
                    }
                });


        });


    } );
</script>


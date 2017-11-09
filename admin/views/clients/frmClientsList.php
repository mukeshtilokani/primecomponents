<?php
ob_start();
session_start();
require_once '../../data/config.php';

if (isset($_SESSION['wf_id']) && $_SESSION['wf_id'] != '') {
    require_once '../../include/header.php';
    require_once '../../include/body.php';
    ?>

<div class="main-content">
  <div id="container" class="wrap-content container"> 
    <!-- start: PAGE TITLE -->
    <section id="page-title">
      <div class="row">
        <div class="col-sm-8">
          <h1 class="mainTitle">Manage Clients
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a class="btn btn-primary" href="<?=SITEURL?>views/clients/frmClients.php" >Add New</a>
          </h1>
        </div>
        <ol class="breadcrumb">
          <li> <span>Dashboard</span> </li>
          <li class="active"> <span>Manage Clients </span> </li>
        </ol>
      </div>
    </section>
    <!-- end: PAGE TITLE -->
    
    <div class="container-fluid container-fullw bg-white">
      <div class="row">
        <div class="col-md-12">
          <input type="hidden" id="wf_id1" name="wf_id1" value="<?= $_SESSION['wf_id'] ?>"/>
          <table id="gvClients" class="table table-striped table-bordered table-hover table-full-width">
            <thead>
              <tr>
                <th></th>
                <th>Image</th>
                <th>Title</th>
                <th>Edit</th>
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
} else {
    header('Location: ../../login.php');
}
?>


<script>
    jQuery(document).ready(function() {

         $(".main-navigation-menu li").removeClass("active open");
        $("#liClients").addClass("active open");
        Main.init();

    });
</script>

<script>
    // Create a comma separated list from an array of objects
    jQuery(document).ready( function() {

        var oTable = $('#gvClients').DataTable({
            "bProcessing": true,
            "sAjaxSource": "../../api/clients/read.php",
            "sPaginationType": "full_numbers",
            "aoColumnDefs" : [
                {"bSortable": false, "sWidth": "3%", "aTargets": [0]},

                {
                    "bSortable": false,
                    "sWidth": "10%",
                    "aTargets": [1],
                    "mData": "cl_image",
                    "render": function (data, type, full, meta) {
                        return '<image  src="<?=SITEURLFRONT?>images/clients/thumb/' + decodeURIComponent(data)  + '" style="max-height:70px;" />';
                    }
                },

                {"sWidth": "30%", "aTargets": [2], "mData": "cl_title", "sType": "html",
                    "render": function ( data, type, full, meta ) {
                        return '<span>'+ decodeURIComponent(data) +'</span>';
                    }
                },



                {
                    "bSortable": false,
                    "sWidth": "5%",
                    "aTargets": [3],
                    "mData": "cl_id",
                    "render": function (data, type, full, meta) {
                        return '<a  href="<?=SITEURL?>views/clients/frmClientsEdit.php?cl_id=' + data + '" class="btn btn-primary" ><span class="fa fa-pencil"></span> Edit</span>';
                    }
                },
                {
                    "bSortable": false,
                    "sWidth": "5%",
                    "aTargets": [4],
                    "mData": "cl_id",
                    "render": function (data, type, full, meta) {
                         return '<a  data-id="'+data+'" class="btn btn-danger btnDelete" ><span class="fa fa-times"></span>  Delete</a>';
                    }
                }
            ],
            "order": [[ 3, 'asc' ]],

            "aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength" : 20,
        });


        $('#gvClients').on('click', '.btnDelete', function(){

            var cl_id =  $(this).data('id');
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
                                cl_id: cl_id
                            },
                            url:'../../api/clients/delete.php',
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



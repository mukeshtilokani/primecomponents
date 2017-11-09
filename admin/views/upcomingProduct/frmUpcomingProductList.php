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
                        <h1 class="mainTitle">Manage Upcoming Products </h1>
                    </div>
                    <ol class="breadcrumb">
                        <li>
                            <span>Dashboard</span>
                        </li>
                        <li class="active">
                            <span>Manage Upcoming Products </span>
                        </li>
                    </ol>
                </div>
            </section>
            <!-- end: PAGE TITLE -->

            <div class="container-fluid container-fullw bg-white">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" id="wf_id1" name="wf_id1" value="<?= $_SESSION['wf_id'] ?>"/>

                        <!-- Large Modal -->
                        <div id="modal-7" class="modal fade bs-example-modal-lg"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">Product Images</h4>
                                    </div>
                                    <div class="modal-body">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary btn-o" data-dismiss="modal">
                                            Close
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Large Modal -->


                        <table id="gvProduct" class="table table-striped table-bordered table-hover table-full-width">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category Name</th>
                                <th>Sub-Category Name</th>
                                <th>List Order</th>
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
    jQuery(document).ready(function () {

        $(".main-navigation-menu li").removeClass("active open");
        $("#liUpcomingProduct").addClass("active open");
        Main.init();

    });
</script>

<script>
    // Create a comma separated list from an array of objects
    jQuery(document).ready(function () {

        var oTable = $('#gvProduct').DataTable({
            "bProcessing": true,
            "sAjaxSource": "../../api/upcomingProduct/read.php",
            "sPaginationType": "full_numbers",
            "aoColumnDefs": [
                {"bSortable": false, "sWidth": "3%", "aTargets": [0]},
                {
                    "bSortable": false,
                    "sWidth": "3%",
                    "aTargets": [1],
                    "mData": "p_image",
                    "render": function (data, type, row) {

                        return '<a data-id="'+ row.p_id +'" class="modalLink"  > <i class="fa fa-picture-o" title="Click to view Product Images" style="font-size: 30px;" ></i> </a> ';


                    }
                },
                {"sWidth": "20%", "aTargets": [2], "mData": "p_title", "sType": "html",
                    "render": function ( data, type, full, meta ) {
                        return '<span>'+ decodeURIComponent(data) +'</span>';
                    }
                },

                {"sWidth": "20%", "aTargets": [3], "mData": "pc_title", "sType": "html",
                    "render": function ( data, type, full, meta ) {
                        return '<span>'+ decodeURIComponent(data) +'</span>';
                    }
                },
                {"sWidth": "20%", "aTargets": [4], "mData": "psubc_title", "sType": "html",
                    "render": function ( data, type, full, meta ) {
                        return '<span>'+ decodeURIComponent(data) +'</span>';
                    }
                },

                { "bSortable": false, "sWidth": "10%", "aTargets": [5], "mData": "p_order" , "render": function ( data, type, full, meta ) {
                    return '<input type="text" value="'+data+'" style="width:35px; height:23px;" />';}
                },
                {
                    "bSortable": false,
                    "sWidth": "5%",
                    "aTargets": [6],
                    "mData": "p_id",
                    "render": function (data, type, full, meta) {
                        return '<a  href="<?=SITEURL?>views/upcomingProduct/frmUpcomingProductEdit.php?p_id=' + data + '">Edit</a>';
                    }
                },
                {
                    "bSortable": false,
                    "sWidth": "5%",
                    "aTargets": [7],
                    "mData": "p_id",
                    "render": function (data, type, full, meta) {
                        return '<a  href="<?=SITEURL?>views/upcomingProduct/frmUpcomingProductEdit.php?p_id=' + data + '">Delete</a>';
                    }
                }
            ],
            "order": [[ 2, 'asc' ]],

            "aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength" : 20,
        });


        $('#gvProduct').on('click', '.modalLink', function () {

            var p_id = $(this).data('id');

            $.ajax({
                type: 'POST',
                data: {
                    p_id: p_id
                },
                url: '../../api/product/getImages.php',
                success: function (data) {

                    $('#modal-7 .modal-body').html(data);
                    $('#modal-7').modal('show', {backdrop: 'static'});

                }

            });


        });



    });
</script>


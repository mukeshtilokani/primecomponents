<?php
	ob_start();
	session_start();

	require_once '../../data/config.php';


	if ( isset( $_SESSION['wf_id'] ) && $_SESSION['wf_id'] != '' ) {

		require_once '../../include/header.php';

		require_once '../../include/body.php';

		?>

<div class="main-content">
  <div id="container" class="wrap-content container"> 
    
    <!-- start: PAGE TITLE -->
    
    <section id="page-title">
      <div class="row">
        <div class="col-sm-8">
          <h1 class="mainTitle">Manage Products
            
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="btn btn-primary" href="<?= SITEURL ?>views/product/frmProduct.php">Add New</a> </h1>
        </div>
        <ol class="breadcrumb">
          <li> <span>Dashboard</span> </li>
          <li class="active"> <span>Manage Products </span> </li>
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

          <table id="gvProduct"
							       class="table table-striped table-bordered table-hover table-full-width">
            <thead>
              <tr>
                <th></th>
                <th>Image</th>
                <th>PDF</th>
                <th>Title</th>
                <th>Code</th>
                <th>Category Name</th>
                <th>Sub-Category Name</th>
	              <th>Latest</th>
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

		header( 'Location: ../../login.php' );

	}

?>
<script>

	jQuery(document).ready(function () {


		$(".main-navigation-menu li").removeClass("active open");

		$("#liProduct").addClass("active open");

		Main.init();


	});

</script> 
<script>


	jQuery(document).ready(function () {




		var oTable;
		oTable = $('#gvProduct').DataTable({

			"bProcessing": true,

			"sAjaxSource": "../../api/product/read.php",

			"sPaginationType": "full_numbers",

			"aoColumnDefs": [

				{"bSortable": false, "sWidth": "3%", "aTargets": [0]},


				{

					"bSortable": false,

					"sWidth": "3%",

					"aTargets": [1],

					"mData": "p_image",

					"render": function (data, type,row) {



						return '<a data-id="'+ row.p_id +'" class="modalLink"  > <i class="fa fa-picture-o" title="Click to view Product Images" style="font-size: 30px;" ></i> </a> ';




//						var res="";
//						var str="";
//						str = decodeURI(decodeURIComponent(data)) ;
//
//						if(str.length>0)
//						{
//
//							res = str.split(",");
//							document.write(res);
//							var finalStr='';
//
//							for(i=0;i < res.length;i++ )
//							{
//
//								if(finalStr.length > 0)
//								{
//									finalStr = finalStr + ' ' + '<image  src="<?//=SITEURLFRONT?>//images/products/thumb/' + decodeURIComponent( res[i]) + '" style="height:50px;" />';
//								}
//								else
//								{
//									finalStr = '<image  src="<?//=SITEURLFRONT?>//images/products/thumb/' + decodeURIComponent( res[i]) + '" style="height:50px;" />';
//								}
//
//							}
//							return finalStr;
//						}
//						else
//						{
//							return '<image  src="<?//=SITEURLFRONT?>//images/no-image.jpg" style="height:50px;" />';
//						}




						

					}

				},

				{

					"bSortable": false,

					"sWidth": "3%",

					"aTargets": [2],

					"mData": "p_catalog_file",

					"render": function (data, type, full, meta) {

						return '<a target="_blank"  href="<?=SITEURLFRONT?>images/pdf/' + decodeURIComponent(data) + '"   >  <i class="fa fa-file-pdf-o" title="Click to view PDF " style="font-size: 30px; color: red" ></i>  </a>';

					}

				},

				{"sWidth": "20%", "aTargets": [3], "mData": "p_title", "sType": "html",
					"render": function ( data, type, full, meta ) {
						return '<span>'+ decodeURIComponent(data) +'</span>';
					}
				},

				{"sWidth": "5%", "aTargets": [4], "mData": "p_code", "sType": "html",
					"render": function ( data, type, full, meta ) {
						return '<span>'+ decodeURIComponent(data) +'</span>';
					}
				},


				{"sWidth": "17%", "aTargets": [5], "mData": "pc_title", "sType": "html",
					"render": function ( data, type, full, meta ) {
						return '<span>'+ decodeURIComponent(data) +'</span>';
					}
				},

				{"sWidth": "18%", "aTargets": [6], "mData": "psubc_title", "sType": "html",
					"render": function ( data, type, full, meta ) {
						return '<span>'+ decodeURIComponent(data) +'</span>';
					}
				},


				{

					"bSortable": false,

					"sWidth": "5%",

					"aTargets": [7],

					"mData": "p_upcoming",

					"render": function (data, type,row) {

						var color = 'blue';
						if(data=='Y')
						{
							color = 'green';
						}


						return '<a  data-id="'+ row.p_id +'" data-upcoming="'+  decodeURIComponent(data)  +'" class="latestLink" style="font-size: 20px;color:'+color+';"  > <i class="fa fa-retweet" title="Latest Y / N" style="font-size: 15px;" > </i> '+ decodeURIComponent(data) +'</a> ';




					}

				},


				{

					"bSortable": false,

					"sWidth": "5%",

					"aTargets": [8],

					"mData": "p_id",

					"render": function (data, type, full, meta) {

						return '<a  href="<?=SITEURL?>views/product/frmProductEdit.php?p_id=' + data + '" class="btn btn-primary" ><span class="fa fa-pencil"></span> Edit</a> ' ;

					}

				},

				{

					"bSortable": false,

					"sWidth": "5%",

					"aTargets": [9],

					"mData": "p_id",

					"render": function (data, type, full, meta) {

						return '<a  data-id="' + data + '" class="btn btn-danger btnDelete" ><span class="fa fa-times"></span>  Delete</a>';

					}

				},

				{

					"aTargets": [10], "mData": "pc_order",

					"visible": false,

					"searchable": false

				},

				{

					"aTargets": [11], "mData": "psubc_id",

					"visible": false,

					"searchable": false

				}

			],

			"order": [[9, 'asc'], [10, 'asc'],],

			"aLengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here

			],

			// set the initial value

			"iDisplayLength": 50,

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

		$('#gvProduct').on('click', '.latestLink', function () {

			var p_id = $(this).data('id');
			var p_upcoming = $(this).data('upcoming');

			$.ajax({
				type: 'POST',
				data: {
					p_id: p_id,
					p_upcoming: p_upcoming
				},
				url: '../../api/product/setLatest.php',
				success: function (data) {

					$.alert('Set Successfully!', {
						title: 'Latest Product',
						autoClose: true,
						type: 'success'
					});
					oTable.ajax.reload();
				}

			});


		});




		$('#gvProduct').on('click', '.btnDelete', function () {

			var p_id = $(this).data('id');
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
				function (isConfirm) {
					if (isConfirm) {
						$.ajax({
							type: 'POST',
							data: {
								p_id: p_id
							},
							url: '../../api/product/delete.php',
							success: function (data) {
								swal("Deleted!", "Your entry has been deleted.", "success");

								setTimeout(function () {
									window.location.reload();
								}, 2000);
							}

						});


					} else {
						swal("Cancelled", "Your entry is safe :)", "error");
					}
				});


		});


	});

</script> 

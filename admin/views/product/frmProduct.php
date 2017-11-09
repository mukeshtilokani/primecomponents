<?php
	ob_start();

	$sess_name = session_name();

	if ( session_start() ) {

		setcookie( $sess_name, session_id(), null, '/', null, null, true );

	}

	require_once '../../data/config.php';

	$dbh = new PDO( $dsn, $username, $password );

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
			  <h1 class="mainTitle">Add Product
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="btn btn-primary" href="<?=SITEURL?>views/product/frmProductList.php" >View List / Edit / Update</a> </h1>
			</div>
			<ol class="breadcrumb">
			  <li> <span>Dashboard</span> </li>
			  <li class="active"> <span>Add Product</span> </li>
			</ol>
		  </div>
		</section>

		<!-- end: PAGE TITLE -->

		<!-- start: FIELDSET -->

		<div class="container-fluid container-fullw bg-white">
		  <div class="row">
			<div class="col-md-12">
			<form action="#" role="form" id="frmProduct">
			  <a class="btn btn-primary"  id="btnReset" style="display: none" >Reset</a>
			  <fieldset>
				<legend> Add Product </legend>
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
					  <label class="control-label"> Category Name <span class="symbol required"></span> </label>
					  <select class="js-example-placeholder-single form-control" id="pc_title" name="pc_title" >
						<option></option>
					  </select>
					  <input type="hidden" id="pc_title1" name="pc_title1" value="" />
					  <input type="hidden" id="pc_id1" name="pc_id1" value="" />
					</div>
					<div class="form-group">
					  <label class="control-label"> Sub-Category Name </label>
					  <select class="js-example-placeholder-single form-control" id="psubc_title" name="psubc_title">
						<option></option>
					  </select>
					  <input type="hidden" id="psubc_title1" name="psubc_title1" value="" />
					  <input type="hidden" id="psubc_id1" name="psubc_id1" value="" />
					</div>
					<div class="form-group">
					  <label class="control-label"> Product Code / Name <span class="symbol required" aria-required="true"></span> </label>
					  <input type="text" placeholder="Product Name" class="form-control"   id="p_title" name="p_title" onblur="printAlias()" onKeyPress="printAlias()" onKeyUp="printAlias()">
					</div>
					<div class="form-group">
					  <label class="control-label"> Series <span class="symbol required" aria-required="true"></span> </label>
					  <input type="text" placeholder="Series" class="form-control"   id="p_code" name="p_code" >
					</div>
					<div class="form-group">
					  <label class="control-label"> Alias [SEO] </label>
					  <input type="text" placeholder="SEO URL" class="form-control" id="p_alias" name="p_alias" >
					</div>
				  </div>
				  <div class="col-md-8">
					<div class="col-md-12">
					  <div class="form-group">
						<label> Image Upload </label>
						<input id="p_image" name="p_image" multiple type="file" accept="image/*" class="file-loading">
						<input type="hidden" id="p_imageName" name="p_imageName" value="" />
					  </div>
					</div>
					<div class="col-md-12">
					  <div class="form-group">
						<label> PDF Upload </label>
						<input id="p_catalog_file" name="p_catalog_file" type="file" class="file-loading">
						<input type="hidden" id="p_catalogName" name="p_catalogName" value="" />
					  </div>
					</div>
				  </div>
				</div>
                
                <div class="col-md-12">

													<div class="form-group">

														<label> Ordering Information </label> <br />

                    <textarea cols="10" rows="5" id="p_order_info" style="width:100%"

                              name="p_order_info">                                                

</textarea>

													 

													</div>

												</div>
                                                
                                                
				<div class="col-md-12">
				  <div class="form-group">
					<label> Overview </label>
					<textarea class="ckeditor form-control" cols="10" rows="5"  id="p_intro" name="p_intro" ></textarea>
				  </div>
				</div>
				<div class="col-md-12" style="display: none">
				  <div class="form-group">
					<label> Key Features </label>
					<textarea class="ckeditor form-control" cols="10" rows="10"  id="p_desc" name="p_desc" ></textarea>
				  </div>
				</div>
				<div class="col-md-12">
				  <div class="form-group">
					<label> Technical Specifications </label>
					<textarea class="ckeditor form-control" cols="10" rows="10"  id="p_technical" name="p_technical" ></textarea>
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
<script src="<?= SITEURL ?>assets/js/form-text-editor.js"></script>
<script src="<?= SITEURL ?>assets/js/form-validation-product.js"></script>
<script>

	jQuery(document).ready(function () {

		$("#btnReset").click(function () {
			$("#p_image").fileinput("clear");

			$("#p_imageName").val('');
			$("#p_catalogName").val('');

			$("#p_catalog_file").fileinput("clear");
			//reset form
			$("#frmProduct").trigger('reset');
			// Set the editor data.
			$('textarea.ckeditor').val('');

		});


		$("#p_image").fileinput({

			previewFileType: "image",

			validateInitialCount: true,

			overwriteInitial: false,

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

			fileTypeSettings: ['image']

		});


		$('.file-caption').hide();


		$('#p_image').on('fileuploaded', function (event, data, previewId, index) {

			var form = data.form, files = data.files, extra = data.extra,

				response = data.response, reader = data.reader;

			//alert(response);

			//$("#p_imageName").val(response);


			var arr = $("#p_imageName").val();


			if (arr.length > 0) {

				arr = arr + "," + response;

			}

			else {

				arr = response;

			}


			$("#p_imageName").val(arr);

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


		$('#p_catalog_file').on('fileuploaded', function (event, data, previewId, index) {

			var form = data.form, files = data.files, extra = data.extra,

				response = data.response, reader = data.reader;

			//alert(response);


			var arr = $("#p_catalogName").val();


			$("#p_catalogName").val(response);

		});


		$("#pc_title").change(function () {

			var selectedValue = $("#pc_title option:selected").val();

			var selectedText = $("#pc_title option:selected").text();

			$("#pc_title1").val(selectedText);

			$("#pc_id1").val(selectedValue);


			var items = "<option>Select One</option>";

			$.post("../../api/subcategory/getSubCategoryByCatId.php", {pc_id: selectedValue}, function (data) {

				//alert(JSON.stringify(data));

				var myJSONObject = data;

				$.each(myJSONObject, function (index, item) {

					items += "<option value='" + item.psubc_id + "'>" + decodeURIComponent(item.psubc_title) + "</option>";

				});

				$("#psubc_title").html(items);

			});


			//alert("You have selected value - " + selectedValue + "You have selected text -" + selectedText);

		});


		$("#psubc_title").change(function () {

			var selectedValue = $("#psubc_title option:selected").val();

			var selectedText = $("#psubc_title option:selected").text();

			$("#psubc_title1").val(selectedText);

			$("#psubc_id1").val(selectedValue);

			//alert("You have selected value - " + selectedValue + "You have selected text -" + selectedText);

		});


		$(function () {

			var items = "<option>Select One</option>";

			$.getJSON("../../api/category/getProductCategory.php", function (data) {

				//alert(JSON.stringify(data));

				var myJSONObject = data;

				$.each(myJSONObject, function (index, item) {

					items += "<option value='" + item.pc_id + "'>" + decodeURIComponent(item.pc_title) + "</option>";

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

	function printAlias() {

		var txtTitle = document.getElementById("p_title");

		var txtAlias = document.getElementById("p_alias");

		var slug;

		slug = getSlug(txtTitle.value);
		txtAlias.value = slug;

		//
//		$.ajax({
//			type: 'POST',
//			data: {
//				p_alias: slug
//			},
//			url: '../../api/product/checkSlug.php',
//			success: function (data) {
//				txtAlias.value = data;
//			}
//
//		});


	}


</script> 

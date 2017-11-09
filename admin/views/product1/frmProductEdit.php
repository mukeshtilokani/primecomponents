<?php
	ob_start();
	$sess_name = session_name();
	if ( session_start() ) {
		setcookie( $sess_name, session_id(), null, '/', null, null, true );
	}
	require_once '../../data/config.php';
	$dbh = new PDO( $dsn, $username, $password );

	if ( isset( $_SESSION['wf_id'] ) && $_SESSION['wf_id'] != '' ) {

		require_once '../../include/header.php';
		require_once '../../include/body.php';
		$dbh = new PDO( $dsn, $username, $password );

	function preparer( $vTexte ) {
			$aTexte = explode( "\n", $vTexte );
			for ( $i = 0; $i < count( $aTexte ) - 1; $i ++ ) {
				$aTexte[ $i ] .= '\\';
			}

			return implode( "\n", $aTexte );
		}

		?>

		<style>
			.progress-bar.animate {
				width: 100%;
			}
		</style>
		<div class="main-content">
			<div id="container" class="wrap-content container"> <!-- start: PAGE TITLE -->
				<section id="page-title">
					<div class="row">
						<div class="col-sm-8">
							<h1 class="mainTitle">Edit / Update Product &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a
									class="btn btn-primary" href="<?= SITEURL ?>views/product/frmProductList.php">View
									List /
									Edit / Update</a></h1>
						</div>
						<ol class="breadcrumb">
							<li><span>Dashboard</span></li>
							<li class="active"><span>Add Product</span></li>
						</ol>
					</div>
				</section>
				<!-- end: PAGE TITLE --> <!-- start: FIELDSET -->
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
								$rows = "";
								$sql  = $dbh->prepare( "SELECT * FROM products p LEFT JOIN
                                				p_categories c ON p.p_pc_id = c.pc_id LEFT JOIN
                                				p_subcategories subc ON p.psubc_id = subc.psubc_id
                                				WHERE p.p_active='Y' AND p.p_id ='" . $_GET['p_id'] . "'" );
								$sql->execute();
								$rows = $sql->fetchAll();
								//print_r($rows); exit;
								for ( $i = 0; $i < count( $rows ); $i ++ ) {
									?>
									<form action="#" role="form" id="frmProduct" name="frmProduct">
										<fieldset>
											<legend> Edit / Update Product</legend>
											<div class="row">
												<div class="col-md-12">
													<div><span class="symbol required" aria-required="true"></span>Required
														Fields
														<hr>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-5">
													<div class="form-group">
														<label class="control-label"> Category Name <span
																class="symbol required"></span> </label>
														<select class="js-example-placeholder-single form-control"
														        id="pc_title"
														        name="pc_title">
															<option></option>
														</select>
														<input type="hidden" id="pc_id1" name="pc_id1"
														       value="<?= $rows[ $i ]['p_pc_id'] ?>"/>
														<input type="hidden" id="pc_title1" name="pc_title1"
														       value="<?= $rows[ $i ]['pc_title'] ?>"/>
														<input type="hidden" id="pc_alias1" name="pc_alias1"
														       value="<?= $rows[ $i ]['pc_alias'] ?>"/>
													</div>
													<div class="form-group">
														<label class="control-label"> Sub-Category Name </label>
														<select class="js-example-placeholder-single form-control"
														        id="psubc_title"
														        name="psubc_title">
															<option></option>
														</select>
														<input type="hidden" id="psubc_id1" name="psubc_id1"
														       value="<?= $rows[ $i ]['psubc_id'] ?>"/>
														<input type="hidden" id="psubc_title1" name="psubc_title1"
														       value="<?= $rows[ $i ]['psubc_title'] ?>"/>
														<input type="hidden" id="psubc_alias1" name="psubc_alias1"
														       value="<?= $rows[ $i ]['psubc_alias'] ?>"/>
													</div>
													<div class="form-group">
														<label class="control-label"> Product Name <span
																class="symbol required"
																aria-required="true"></span>
														</label>
														<input type="text" placeholder="Product Name"
														       class="form-control" id="p_title"
														       name="p_title" onblur="printAlias()"
														       onKeyPress="printAlias()"
														       onKeyUp="printAlias()"
														       value='<?= urldecode($rows[ $i ]['p_title']) ?>'>
														<input type="hidden" id="p_id1" name="p_id1"
														       value="<?= $rows[ $i ]['p_id'] ?>"/>
													</div>
													<div class="form-group">
														<label class="control-label"> Product Code <span
																class="symbol required"
																aria-required="true"></span>
														</label>
														<input type="text" placeholder="Product Code"
														       class="form-control" id="p_code"
														       name="p_code"
														       value="<?= urldecode( $rows[ $i ]['p_code'] ) ?>">
													</div>
													<div class="form-group">
														<label class="control-label"> Alias [SEO] </label>
														<input type="text" placeholder="SEO URL" class="form-control"
														       id="p_alias"
														       name="p_alias" value="<?= $rows[ $i ]['p_alias'] ?>">
													</div>
												</div>
												<div class="col-md-7">
													<div class="col-md-12">
														<div class="form-group">
															<label> <strong>Uploaded Images </strong> </label>
															<table>
																<tr>
																	<?php $rows2 = "";
																		$sql2    = $dbh->prepare( "SELECT * FROM products_images pi LEFT JOIN
																				   products p ON pi.p_id = p.p_id
																				   WHERE p.p_active='Y' AND p.p_id ='" . $_GET['p_id'] . "'" );
																		$sql2->execute();
																		$rows2 = $sql2->fetchAll();
																		for ( $k = 0; $k < count( $rows2 ); $k ++ ) {
																			?>
																			<td><img
																					src="<?= SITEURLFRONT ?>images/products/<?= $rows2[ $k ]['pi_image'] ?>"
																					alt=""
																					style=" float: left; max-height: 100px;  max-width: 100px;"/>
																				<br></td>
																		<?php } ?>
																</tr>
															</table>
															<label> Replace Image </label>
															<input id="p_image" multiple name="p_image" type="file"
															       accept="image/*"
															       class="file-loading">

															<input type="hidden" id="p_imageNameOld" name="p_imageNameOld"
															       value="<?= $rows[ $i ]['p_image'] ?>"/>

															<input type="hidden" id="p_imageName" name="p_imageName"
															       value=""/>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label> <strong>Uploaded PDF </strong> </label>
															<a href="<?= SITEURLFRONT ?>images/pdf/<?= $rows[ $i ]['p_catalog_file'] ?>"
															   target="_blank"> <img src="<?= SITEURL ?>images/pdf.png"
															                         alt=""
															                         style="max-width: 50px; max-height: 50px;"/>
															</a>
															<br>
															<label> Replace Datasheet </label>
															<input id="p_catalog_file" name="p_catalog_file" type="file"
															       class="file-loading">
															<input type="hidden" id="p_catalogName" name="p_catalogName"
															       value="<?= $rows[ $i ]['p_catalog_file'] ?>"/>
														</div>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label> Ordering Information</label>
														<input type="text" placeholder="Ordering Information" class="form-control" id="p_order_info" name="p_order_info"
														       value="<?= $rows[ $i ]['p_order_info'] ?>" />
													</div>
												</div>


												<div class="col-md-12">
													<div class="form-group">
														<label> Product Small Text </label>
                    <textarea class="ckeditor form-control" cols="10" rows="5" id="p_intro"
                              name="p_intro">                                                <?= urldecode( $rows[ $i ]['p_intro'] ) ?>
</textarea>
														<?php $p_intro = urldecode( $rows[ $i ]['p_intro'] ); ?>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label> Key Features </label>
                    <textarea class="ckeditor form-control" cols="10" rows="10" id="p_desc"
                              name="p_desc">                                                <?= urldecode( $rows[ $i ]['p_description'] ) ?>
</textarea>
														<?php $p_desc = urldecode( $rows[ $i ]['p_description'] ); ?>
													</div>
												</div>


												<div class="col-md-12">
													<div class="form-group">
														<label> Technical Specifications </label>
                    <textarea class="ckeditor form-control" cols="10" rows="10" id="p_technical"
                              name="p_technical">                                                <?= urldecode( $rows[ $i ]['p_technical'] ) ?>
</textarea>
														<?php $p_technical = urldecode( $rows[ $i ]['p_technical'] ); ?>
													</div>
												</div>


												<div class="col-md-12">
													<button type="submit" class="btn btn-primary" id="btnSave"
													        style="width: 100%">
														Save
													</button>
												</div>
											</div>
										</fieldset>
									</form>
								<?php } ?>
						</div>
					</div>
				</div>
				<!-- end: FIELDSET --> </div>
		</div>
		<?php
		require_once '../../include/footer.php';
	} else {
		header( 'Location: ../../login.php' );
	} ?>
<script src="<?= SITEURL ?>assets/js/form-text-editor.js">
</script>
<script src="<?= SITEURL ?>assets/js/form-validation-product-update.js"></script>

<script>

	jQuery(document).ready(function () {




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

			var psubc_id = $("#psubc_id1").val();
			if (psubc_id.length > 0) {
				var $modal = $('.js-loading-bar'), $bar = $modal.find('.progress-bar');
				$modal.modal('show');
				$bar.addClass('animate');
				setTimeout(function () {
					$bar.removeClass('animate');
					$modal.modal('hide');
					$('#psubc_title').val(psubc_id).trigger('change');
				}, 1500);
			}



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



	this.$('.js-loading-bar').modal({backdrop: 'static', show: false});
</script>

<script>
	function printAlias() {
		var txtTitle = document.getElementById("p_title");
		var txtAlias = document.getElementById("p_alias");
		var slug;
		slug = getSlug(txtTitle.value);
		txtAlias.value = slug;
	}</script>

<script>
	$(window).load(function () {
		CKEDITOR.instances.p_intro.setData('<?=preparer(trim(html_entity_decode($p_intro))) ?>');
		CKEDITOR.instances.p_desc.setData('<?=preparer(trim(html_entity_decode($p_desc))) ?>');
		CKEDITOR.instances.p_technical.setData('<?=preparer(trim(html_entity_decode($p_technical))) ?>');

		var pc_id = $("#pc_id1").val();
		var $modal = $('.js-loading-bar'), $bar = $modal.find('.progress-bar');
		$modal.modal('show');
		$bar.addClass('animate');
		setTimeout(function () {
			$bar.removeClass('animate');
			$modal.modal('hide');
			$('#pc_title').val(pc_id).trigger('change');
		}, 1500);
	});</script>
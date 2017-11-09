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
		require_once '../../include/header.php';
		require_once '../../include/body.php';
		?>

		<div class="main-content">
			<div id="container" class="wrap-content container">
				<!-- start: PAGE TITLE -->
				<section id="page-title">
					<div class="row">
						<div class="col-sm-8">
							<h1 class="mainTitle">Add Appraisals</h1>
						</div>
						<ol class="breadcrumb">
							<li>
								<span>Dashboard</span>
							</li>
							<li class="active">
								<span>Add Appraisals</span>
							</li>
						</ol>
					</div>
				</section>
				<!-- end: PAGE TITLE -->
				<!-- start: FIELDSET -->
				<div class="container-fluid container-fullw bg-white">
					<div class="row">
						<div class="col-md-12">
							<form action="#" role="form" id="frmAppraisals">
								<fieldset>
									<legend>
										Add Appraisals
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

										<div class="col-md-12">


											<div class="col-md-12">
												<div class="form-group">
													<label>
														Image Upload
													</label>
													<input id="a_image" name="a_image" multiple type="file" accept="image/*" class="file-loading">
													<input type="hidden" id="a_imageName" name="a_imageName" value="" />


												</div>
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

<script src="<?=SITEURL?>assets/js/form-validation-appraisals.js"></script>
<script>
	jQuery(document).ready(function() {


		$("#a_image").fileinput({
			previewFileType: "image",
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
			uploadUrl: "../../api/appraisals/asyncImg.php?type=save", // server upload action
			uploadAsync: true,
			allowedFileExtensions: ["jpg", "png", "gif"],
			fileTypeSettings:['image']
		});

		$('.file-caption').hide();

		$('#a_image').on('fileuploaded', function(event, data, previewId, index) {
			var form = data.form, files = data.files, extra = data.extra,
				response = data.response, reader = data.reader;
			//alert(response);
			//$("#p_imageName").val(response);

			var arr =  $("#a_imageName").val();

			if(arr.length>0)
			{
				arr = arr + "," + response;
			}
			else
			{
				arr =  response;
			}

			$("#a_imageName").val(arr);
		});








		$(".main-navigation-menu li").removeClass("active open");
		$("#liAppraisals").addClass("active open");
		Main.init();

		FormValidator.init();
		FormElements.init();
	});
</script>


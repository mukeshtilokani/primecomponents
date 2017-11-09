<?php
	ob_start();
	$sess_name = session_name();
	if (session_start()) {
		setcookie($sess_name, session_id(), null, '/', null, null, true);
	}
	require_once '../../data/config.php';
	$dbh = new PDO($dsn, $username, $password);

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
							<h1 class="mainTitle">Manage Appraisals Photos </h1>
						</div>
						<ol class="breadcrumb">
							<li> <span>Dashboard</span> </li>
							<li class="active"> <span>Manage Appraisals Photos</span> </li>
						</ol>
					</div>
				</section>
				<!-- end: PAGE TITLE -->

				<div class="container-fluid container-fullw bg-white">
					<div class="row">
						<div class="col-md-12">
							<input type="hidden" id="wf_id1" name="wf_id1" value="<?= $_SESSION['wf_id'] ?>"/>
							<div class="tabbable">
								<ul id="myTab1" class="nav nav-tabs">

											<li class='active'  > <a href="#myTab1_example1" data-toggle="tab">
													Appraisals Photos
												</a> </li>

								</ul>
								<div class="tab-content">

											<div class='tab-pane fade active in' id="myTab1_example1">
												<div class="row">
													<?php
														$rows2 = "";
														$sql2 = $dbh->prepare("SELECT * FROM appraisals");
														$sql2->execute();
														$rows2 = $sql2->fetchAll();

														for ($k = 0; $k < count($rows2); $k++) {
															?>
															<div class="col-xs-6 col-md-3" style="text-align: center" > <a href="#" class="thumbnail">
																	<img src="<?= SITEURLFRONT ?>images/appraisals/<?= $rows2[$k]['a_image'] ?>"> </a>
																<p>
																	<button class="btn btn-danger btnDelete" data-src="<?= $rows2[$k]['a_image'] ?>"
																	        data-id="<?= $rows2[$k]['a_id'] ?>"
																		> <span class="fa fa-times"></span> delete </button>


																</p>
															</div>
														<?php } ?>
												</div>
											</div>

								</div>
							</div>



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
		$("#liAppraisals").addClass("active open");
		Main.init();


	});
</script>

<!-- Dialog show event handler -->
<script type="text/javascript">
	$('.btnDelete').on('click', function () {

		var a_id =  $(this).data('id');
		var imgName = $(this).data('src');

		swal({
				title: "Are you sure?",
				text: "You will not be able to recover this imaginary file!",
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
							a_id: a_id,
							imgName: imgName
						},
						url:'../../api/appraisals/deleteImage.php',
						success:function(data) {
							swal("Deleted!", "Your image file has been deleted.", "success");

							setTimeout(function() {
								window.location.reload();
							}, 2000);
						}

					});
				} else {
					swal("Cancelled", "Your image file is safe :)", "error");
				}
			});
	});
</script>

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
							<h1 class="mainTitle">Manage Client Work Photos
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<a class="btn btn-primary" href="<?=SITEURL?>views/clients/frmClientsPhotos.php" >Add New</a>
							</h1>
						</div>
						<ol class="breadcrumb">
							<li> <span>Dashboard</span> </li>
							<li class="active"> <span>Manage Client Work Photos </span> </li>
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
									<?php
										$rows = "";
										$sql = $dbh->prepare("SELECT * FROM clients
                                WHERE cl_active='Y' ");
										$sql->execute();
										$rows = $sql->fetchAll();
										//print_r($rows); exit;
										for ($i = 0; $i < count($rows); $i++) {
											$active = "class='active'";
											?>
											<li <?php if ($i == 0) {
												echo $active;
											} ?> > <a href="#myTab1_example<?= $i + 1 ?>" data-toggle="tab">
													<?=urldecode($rows[$i]['cl_title']) ?>
												</a> </li>
										<?php } ?>
								</ul>
								<div class="tab-content">
									<?php
										$rows = "";
										$sql1 = $dbh->prepare("SELECT * FROM clients
                                WHERE cl_active='Y' ");
										$sql1->execute();
										$rows1 = $sql1->fetchAll();
										$active1 = "class='tab-pane fade active in'";
										for ($j = 0; $j < count($rows1); $j++) {

											?>
											<div <?php if ($j == 0) {
												echo $active1;
											} else {
												echo "class='tab-pane'";
											} ?> id="myTab1_example<?= $j + 1 ?>">
												<div class="row">
													<?php
														$cl_id = $rows1[$j]['cl_id'];
														$rows2 = "";
														$sql2 = $dbh->prepare("SELECT * FROM client_galleries
                                                    WHERE cl_id = $cl_id ");
														$sql2->execute();
														$rows2 = $sql2->fetchAll();

														for ($k = 0; $k < count($rows2); $k++) {
															?>
															<div class="col-xs-6 col-md-3" style="text-align: center" > <a href="#" class="thumbnail">
																	<img src="<?= SITEURLFRONT ?>images/clientphotos/<?= $rows2[$k]['cgl_images'] ?>"> </a>
																<p>
																	<button class="btn btn-danger btnDelete"
																	        data-src="<?= $rows2[$k]['cgl_images'] ?>"
																	        data-id="<?= $rows2[$k]['cgl_id'] ?>"
																	        data-clid="<?=$rows1[$j]['cl_id']?>"
																		> <span class="fa fa-times"></span> delete </button>



																</p>
															</div>
														<?php } ?>
												</div>
											</div>
										<?php } ?>
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
		$("#liClientsWork").addClass("active open");
		Main.init();


	});
</script>

<!-- Dialog show event handler -->
<script type="text/javascript">




	$('.btnDelete').on('click', function () {

		var cgl_id =  $(this).data('id');
		var cl_id =  $(this).data('clid');
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
							cgl_id: cgl_id,
							cl_id: cl_id,
							imgName: imgName
						},
						url:'../../api/clients/deleteImage.php',
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

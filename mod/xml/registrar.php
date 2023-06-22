<?php
include "../../cnf/app.php";
include "../../cnf/session.php";
include "../../conn/conn.php";
include "../../inc/head.php";
include "../../inc/header_nav.php";
include "../../inc/header_nav_menu.php";
?> 
<!-- BEGIN: Content-->
<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-body">
			<!-- section datatable -->
			<section id="section-datatable">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-content collapse show">
								<div class="card-body card-dashboard">
								<form id="form" name="form" class="form-horizontal" action="../../ws/xml/ws_add_xml.php" method="POST" enctype="multipart/form-data">
										<div class="container-fluid justify-content-center col-12">
											<h5 class="mb-1" style="font-weight: 500;"><i class="icon-screen-tablet mr-25"></i>Registrar Nota Fiscal</h5>
											<div class="row">
												<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
													<div class="form-group validate">
														<p><label for="file"><i class="fa fa-upload mr-1"></i><span>Arquivo XML</span></label></p>
														<input type="file" name="file" id="file">
													</div>
												</div>
											</div>
										</div>
										<div class="row col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
											<button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Registrar</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			
		</div>
	</div>
</div>
<!-- END: Content-->
<?php 
include "../../inc/footer.php";
?>
<script>
$(document).ready(function() {
	<?php
	if(isset($_GET['s']) && $_GET['s'] == 1)
	{
		?>
		let id = <?php echo (isset($_GET['id'])) ? $_GET['id'] : "''"; ?>;
		
		var timerInterval;
		Swal.fire({
		  title: "Sucesso!",
		  type: "success",
		  timer: 5000,
		  confirmButtonClass: "btn btn-primary",
		  buttonsStyling: false,
		  onClose: function() {
			clearInterval(timerInterval);
		  }
		})
		<?php
	}
	
	if(isset($_GET['er']) && $_GET['er'] == 1)
	{
		?>
		var timerInterval;
		Swal.fire({
		  title: "Registro duplicado ou incorreto.",
		  type: "error",
		  timer: 2200,
		  confirmButtonClass: "btn btn-danger",
		  buttonsStyling: false,
		  onClose: function() {
			clearInterval(timerInterval);
		  }
		})
		<?php
	}
?>
});
</script>
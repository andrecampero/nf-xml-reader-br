<?php
include "../../cnf/app.php";
session_start();
include "../../conn/conn.php";
include "../../inc/head.php";
?>
<!-- BEGIN: Body-->
<style>
html body
{
	background-image: url(../../imgs/imagem_fundo_login.png) !important;
    background-size: cover !important;
    background-position:0em -13.1em !important;
}
.lg_center
{
	margin-top: 20vh;
}

.lg_transp
{
	opacity: 0.96;
}

.border_radius 
{
	border-radius: 7px !important;
}
.bloco
{
	margin-left: 7% !important; 
	margin-top: 18vh;
}
.borda 
{
	border-radius: 16px !important;
}
.inverter_img
{
	transform: scaleX(-1);
}
.termo
{
	color: #31944a !important;
}
.termo:hover
{
	color: #84be93 !important;
}
.p_aviso
{
	 color: #d93025;
	 display: none;
	 float: left; 
}
</style>
<body class="horizontal-layout horizontal-menu 1-column  bg-full-screen-image blank-page blank-page" data-open="hover" data-menu="horizontal-menu" data-col="1-column">
<!-- BEGIN: Content-->
<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body">
			<section class="row flexbox-container">
				<div class="col-12 d-flex align-items-center bloco">
					<div class="col-lg-4 col-md-8 col-10 p-0 ">
						<div class="card border-grey border-lighten-3 px-1 py-1 m-0 borda lg_transp">
							<div class="card-header border-0">
								<div class="card-title text-center">
									<h4>XML Reader</h4>
								</div>
							</div>
							<div class="card-content">
								<div class="card-body">
									<form id="form" name="form" class="form-horizontal" action="../../ws/login/ws_login.php" method="POST" novalidate>
										<fieldset class="form-group position-relative has-icon-left">
											<input type="text" class="form-control" id="login" name="login" placeholder="E-mail" required>
											<div class="form-control-position">
												<i class="feather icon-user"></i>
											</div>
										</fieldset>
										<fieldset class="form-group position-relative has-icon-left">
											<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
											<div class="form-control-position">
												<i class="fa fa-key"></i>
											</div>
										</fieldset>
										<button type="submit" class="btn btn-outline-primary btn-block"><i class="feather icon-unlock"></i> Login</button>
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
		var timerInterval;
		Swal.fire({
		  title: "Sucesso!",
		  type: "success",
		  timer: 5200,
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
	
	if(isset($_GET['a']) && $_GET['a'] == 1)
	{
		?>
		var timerInterval;
		Swal.fire({
		  title: "Você deseja realmente apagar esse usuário ?.",
		  type: "warning",
		  // timer: 2200,
		  confirmButtonClass: "btn btn-warning",
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
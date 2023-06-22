<!-- BEGIN: Header-->
<?php
$id_usuario_logado = $_SESSION['id_usuario']; //PEGA ID DO USUARIO LOGADO
?>
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-static-top navbar-dark bg-gradient-x-grey-blue navbar-border navbar-brand-center">
	<div class="navbar-wrapper">
		<div class="navbar-header">
			<ul class="nav navbar-nav flex-row">
				<li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="feather icon-menu font-large-1"></i></a></li>
				<li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
			</ul>
		</div>
		<div class="navbar-container content">
			<div class="collapse navbar-collapse" id="navbar-mobile">
				<ul class="nav navbar-nav mr-auto float-left">
					<li class="nav-item"><a class="navbar-brand" href="#" style="padding-top: 1em;"><h4>XML Reader</h4></a></li>
					<li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon feather icon-maximize"></i></a></li>
				</ul>
				
				<ul class="nav navbar-nav float-right">
					<li class="dropdown dropdown-user nav-item">
						<a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
							<span class="user-name"><?php echo $_SESSION['nome_usuario']; ?></span>
							<span class="user-name">
								<?php echo ($apelido) ? " | ".$apelido : ""; ?>
							</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="<?php echo $GLOBALS['app_url']; ?>/mod/login/logout.php"><i class="feather icon-power"></i> Sair</a>
						</div>
					</li> 
				</ul>
			</div>
		</div>
	</div>
</nav>
<!-- END: Header-->
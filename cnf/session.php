<?php
session_start();

function login()
{
	echo "<script>location.href = '".$GLOBALS['app_url']."/mod/login/login.php';</script>";
}

// Valida login op
if(!isset($_SESSION['id_usuario']))
{	
	login();
}
?>
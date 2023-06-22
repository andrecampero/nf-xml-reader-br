<?php
include "../../cnf/app.php";
include "../../conn/conn.php";

session_start();

$login = $_POST['login']; //real_escape_string
$senha = $_POST['senha'];

$stmt = $conn->prepare('
	SELECT 
		xu.id, 
		xu.nome, 
		xu.login, 
		xp.perfil, 
		xp.permissao,
		xp.admin
		
	FROM xr_usuario xu
	
	LEFT JOIN xr_perfil xp
	ON xp.id = xu.id_perfil
	
	WHERE xu.ativo = 1
	AND xu.login = :login 
	AND xu.senha = md5(:senha);
');
$stmt->bindParam(':login', $login);
$stmt->bindParam(':senha', $senha);
$stmt->execute();
$res = $stmt->fetch(PDO::FETCH_ASSOC);

if($res)
{	
	// login ok
	$_SESSION['id_usuario'] = $res['id'];
	$_SESSION['login_usuario'] = $login;
	$_SESSION['nome_usuario'] = $res['nome'];
	$_SESSION['pass_usuario'] = $senha;
	
	// perfil
	$_SESSION['perfil_usuario'] = $res['perfil'];
	$_SESSION['permissao_usuario'] = $res['permissao'];
	$_SESSION['admin'] = $res['admin'];
	
	echo "<script>location.href = '".$GLOBALS['app_url']."/mod/home/home.php';</script>";
	
}
else
{
	// login wr
	echo "<script>location.href = '".$GLOBALS['app_url']."/mod/login/login.php?wr=1';</script>";
}
?>
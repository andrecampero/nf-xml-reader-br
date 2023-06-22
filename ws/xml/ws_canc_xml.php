<?php
include "../../cnf/app.php";
include "../../cnf/session.php";
include "../../conn/conn.php";

// get dt
if (isset($_GET["act"]) && $_GET["act"] == 'apg_dt')
{	
	if(isset($_GET["id"]) && $_GET["id"] != "")
	{
		$id_usuario_logado = $_SESSION['id_usuario'];
		$data_hora = date('Y-m-d H:i:s', time());
		$id = $_GET["id"];
		$sql="
			UPDATE xr_mod_xml SET
				status = 'Cancelado'
			WHERE id = $id
		";
		$sql = htmlspecialchars($sql);
		$sql = str_replace(";", "", $sql);
		if($conn->query($sql))
		{
			echo "ok";
		}
	}
}
?>
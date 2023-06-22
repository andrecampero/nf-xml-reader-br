<?php
include "../../cnf/app.php";
include "../../cnf/session.php";
include "../../conn/conn.php";

// get dt
if (isset($_GET["act"]) && $_GET["act"] == 'get_dt')
{
	$filtro_datatable = "";
	
	if(isset($_GET["busca"]) && $_GET["busca"] != "")
	{
		$busca = $_GET["busca"];
		$filtro_datatable .= " 
			and (
				xmx.numero_nf like '%$busca%' OR
				xmx.destinatario_cpf_cnpj like '%$busca%' OR
				xmx.destinatario_nome like '%$busca%' OR
				xmx.destinatario_end_municipio like '%$busca%' OR
				xmx.status like '%$busca%'
			) 
		";
	}
	
	if(isset($_GET["de"]) && $_GET["de"] != "" && isset($_GET["ate"]) && $_GET["ate"] != "")
	{
		$de = $_GET["de"];
		$de_exp = explode("/", $de);
		$de_us = $de_exp[2]."-".$de_exp[1]."-".$de_exp[0];
		
		$ate = $_GET["ate"];
		$ate_exp = explode("/", $ate);
		$ate_us = $ate_exp[2]."-".$ate_exp[1]."-".$ate_exp[0];
		
		$filtro_datatable .=" 
			AND (
				DATE(xmx.data_registro) BETWEEN '$de_us' AND '$ate_us'
			)
		";
	}
		
	$sql="
		SELECT 
			xmx.*,
			DATE_FORMAT(xmx.data_registro,'%d/%m/%Y %H:%i:%s') AS data_registro,
			DATE_FORMAT(xmx.data_nf,'%d/%m/%Y %H:%i:%s') AS data_nf,
			xu.nome AS usuario_responsavel
		FROM xr_mod_xml xmx

		LEFT JOIN xr_usuario xu
		ON xu.id = xmx.id_usuario

		WHERE 1 = 1
		
		$filtro_datatable
		
		ORDER BY xmx.id desc
		LIMIT 5000
	";
	$sql = htmlspecialchars($sql);
	$sql = str_replace(";", "", $sql);
	$data = $conn->query($sql);
	$data_res = $data->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($data_res);
}
?>
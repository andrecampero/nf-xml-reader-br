<?php
include "../../cnf/app.php";
include "../../cnf/session.php";
include "../../conn/conn.php";
include "../../lib/utils/utils.php";

function proc_nf_xml($file)
{
	$dom = new DOMDocument;
	$dom->validateOnParse = true;
	if($dom->load($file))
	{
		$nf_xml = simplexml_load_file($file) or die('Failed to create an object');
		if(
			isset($nf_xml->NFe->infNFe->emit->CNPJ) &&
			$nf_xml->NFe->infNFe->emit->CNPJ == "09066241000884" &&
			isset($nf_xml->protNFe->infProt->nProt) &&
			$nf_xml->protNFe->infProt->nProt != ""
		)
		{
			return $nf_xml;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}

$proc = 1;
if (isset($_FILES["file"]))
{
	// Cab
	$id_usuario = $_SESSION['id_usuario']; //PEGA ID DO USUARIO LOGADO
	
	$file = $_FILES['file']['tmp_name'];
	if ($file != "")
	{
		// Proc. e Valida XML
		$nf_xml = proc_nf_xml($file);
		if($nf_xml != false)
		{
			// Upload NF Xml
			$datetime_ymdh = date("YmdH");
			$milliseconds = floor(microtime(true) * 1000);
			$file_name_original = $_FILES['file']['name'];
			$file_name = $datetime_ymdh.$milliseconds."_".$file_name_original;
			
			//Setup our new file path
			$nf_xml_arquivo = "../../uploads/nfs_xml/".$file_name;
			
			//Upload the file into the temp dir
			if(move_uploaded_file($file, $nf_xml_arquivo)) 
			{
				try 
				{
					// Def val
					$protocolo_autorizacao_nf = $nf_xml->protNFe->infProt->nProt;
					
					$numero_nf = $nf_xml->NFe->infNFe->ide->nNF;
					
					$data_nf_org = $nf_xml->NFe->infNFe->ide->dhEmi;
					$data_nf_exp = explode("T", $data_nf_org);
					$data_nf_exp_h = explode("-", $data_nf_exp[1]);
					$data_nf = $data_nf_exp[0]." ".$data_nf_exp_h[0];

					$valor_nf = $nf_xml->NFe->infNFe->total->ICMSTot->vNF;
					
					$emitente_cnpj = $nf_xml->NFe->infNFe->emit->CNPJ;
					
					$destinatario_cpf_cnpj = (isset($nf_xml->NFe->infNFe->dest->CNPJ)) ? $nf_xml->NFe->infNFe->dest->CNPJ : $nf_xml->NFe->infNFe->dest->CPF;
					$destinatario_nome = $nf_xml->NFe->infNFe->dest->xNome;
					$destinatario_end_logradouro = $nf_xml->NFe->infNFe->dest->enderDest->xLgr;
					$destinatario_end_numero = $nf_xml->NFe->infNFe->dest->enderDest->nro;
					$destinatario_end_bairro = $nf_xml->NFe->infNFe->dest->enderDest->xBairro;
					$destinatario_end_cod_municipio = $nf_xml->NFe->infNFe->dest->enderDest->cMun;
					$destinatario_end_municipio = $nf_xml->NFe->infNFe->dest->enderDest->xMun;
					$destinatario_end_estado = $nf_xml->NFe->infNFe->dest->enderDest->UF;
					$destinatario_end_cep = $nf_xml->NFe->infNFe->dest->enderDest->CEP;
					$destinatario_end_cod_pais = $nf_xml->NFe->infNFe->dest->enderDest->cPais;
					
					// Valida NF Canc.
					$sql="
						SELECT 
							xmx.id
						FROM xr_mod_xml xmx
						WHERE 1 = 1
						AND xmx.numero_nf = '$numero_nf'
						AND xmx.status = 'Cancelado'
						LIMIT 1
					";
					$sql = htmlspecialchars($sql);
					$sql = str_replace(";", "", $sql);
					$data = $conn->query($sql);
					$data_res = $data->fetchAll(PDO::FETCH_ASSOC);
					if($data_res)
					{
						$id_nf_xml_canc = $data_res[0]['id'];
						$sql="
							DELETE FROM xr_mod_xml WHERE id = $id_nf_xml_canc
						";
						$sql = htmlspecialchars($sql);
						$sql = str_replace(";", "", $sql);
						if($conn->query($sql))
						{
							// ok
						}
					}
					
					// Ins - NF Xml
					$sql="
					INSERT INTO xr_mod_xml (
							id_usuario,
							protocolo_autorizacao_nf,
							numero_nf,
							data_nf,
							valor_nf,
							emitente_cnpj,
							destinatario_cpf_cnpj,
							destinatario_nome,
							destinatario_end_logradouro,
							destinatario_end_numero,
							destinatario_end_bairro,
							destinatario_end_cod_municipio,
							destinatario_end_municipio,
							destinatario_end_estado,
							destinatario_end_cep,
							destinatario_end_cod_pais,
							nf_xml_arquivo
						) VALUES (
							$id_usuario, 
							'$protocolo_autorizacao_nf', 
							'$numero_nf', 
							'$data_nf', 
							$valor_nf, 
							'$emitente_cnpj', 
							'$destinatario_cpf_cnpj', 
							'$destinatario_nome', 
							'$destinatario_end_logradouro', 
							'$destinatario_end_numero', 
							'$destinatario_end_bairro', 
							'$destinatario_end_cod_municipio', 
							'$destinatario_end_municipio', 
							'$destinatario_end_estado', 
							'$destinatario_end_cep', 
							'$destinatario_end_cod_pais',
							'$nf_xml_arquivo'
						);
					";
					$sql = htmlspecialchars($sql); // " => &quot;
					$sql = str_replace(";", "", $sql);
					if($conn->query($sql)) 
					{
						$id_nf_xml = $conn->lastInsertId();
					}
				} 
				catch(Exception $e) 
				{
					$proc = 0;
				}
			}
			else
			{
				$proc = 0;
			}
		}
		else
		{
			$proc = 0;
		}
	}
	
	if($proc == 1)
	{
		echo "ok";
		echo "<script>location.href='../../mod/xml/registrar.php?s=1';</script>";
	}
	else
	{
		echo "<script>location.href='../../mod/xml/registrar.php?er=1';</script>";
	}
}
?>
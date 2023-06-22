<?php
//Converte string de data em formato BR para formato de data US que é aceito pelo BDD
function conv_data_br_us($data)
{
	if(strstr($data, "/"))
	{
		$d = explode("/", $data);
		$rtdata = "$d[2]-$d[1]-$d[0]";		
	} 	
	return $rtdata;
}
?>
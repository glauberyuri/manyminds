<?php

function retornoJson($retorno=[]){
	header('Content-Type: application/json');
	echo json_encode($retorno, TRUE);
	exit(0);
}


function getClientIP():string{
	$keys=array('HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR');
	foreach($keys as $k)
	{
		if (!empty($_SERVER[$k]) && filter_var($_SERVER[$k], FILTER_VALIDATE_IP))
		{
			return $_SERVER[$k];
		}
	}
	return "UNKNOWN";
}

?>

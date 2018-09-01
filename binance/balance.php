<?php
/*
    Clase para conectarce a Binance Rest API
    Documentación: https://github.com/binance-exchange/binance-official-api-docs/blob/master/rest-api.md
    Creado por: Gerson Morales - moralesgersonpa@gmail.com
*/


include('../class/API.php');


/*
	Obtener la hora actual del servidor
	
	Response:
	{
  		"serverTime": 1499827319559
	}
*/
$ServerTimeUrl='https://api.binance.com/api/v1/time'; 
$ClassServerTime = new APIREST($ServerTimeUrl);
$CallServerTime = $ClassServerTime->call(array());
$DecodeCallTime= json_decode($CallServerTime);
$Time = $DecodeCallTime->serverTime;

/*
	Generar firma con algoritmo SHA256
*/
$ApiKey='########';
$ApiSecret='########';
$Timestamp = 'timestamp='.$Time;
$Signature = hash_hmac('SHA256',$Timestamp ,$ApiSecret);


/*
	@BalanceUrl   :
	@ClassBalance :
	@CallBalance  :
*/
$BalanceUrl='https://api.binance.com/api/v3/account?timestamp='.$Time.'&signature='.$Signature;
$ClassBalance = new APIREST($BalanceUrl);
$CallBalance= $ClassBalance->call(array('X-MBX-APIKEY:'.$ApiKey));
echo "$CallBalance";
?>
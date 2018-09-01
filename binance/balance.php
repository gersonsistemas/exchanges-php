<?php
include('../class/API.php');
ini_set('display_errors', 'Off');

$url_time='https://api.binance.com/api/v1/time';
$clase_time = new APIJSON($url_time);
$call_time= $clase_time->call(array());
$search_time= json_decode($call_time);
$time = $search_time->serverTime;


$apikey='#####';
$apisecret='####';

$timestamp = 'timestamp='.$time;
$signature = hash_hmac('SHA256',$timestamp ,$apisecret);

$url='https://api.binance.com/api/v3/account?timestamp='.$time.'&signature='.$signature;

$clase = new APIJSON($url);
$call= $clase->call(array('X-MBX-APIKEY:'.$apikey));
$search_bittrex= json_decode($call);

echo "$call";
?>
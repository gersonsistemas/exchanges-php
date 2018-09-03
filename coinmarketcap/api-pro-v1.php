<?php

include('../class/API.php');

/**
 * Get list all cryptocurrencies
 * @var CoinsUrl is the url of the request
 * @var APIREST initializes the APIREST class
 * @var CallCoins list all cryptocurrencies, X-CMC_PRO_API_KEY is required by CoinMarketCap
 * @var the Api key provided by CoinMarketCap
 */
$ApiKey='You-API-KEY';
$CoinsUrl='https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
$APIREST = new APIREST($CoinsUrl);
$CallCoins= $APIREST->call(
	array('X-CMC_PRO_API_KEY:'.$ApiKey)
);
echo $CallCoins;
?>
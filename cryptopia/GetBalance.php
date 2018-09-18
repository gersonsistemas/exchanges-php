<?php
/*
 * ============================================================
 * @package exchanges-php
 * @link https://github.com/moralesgersonpa/exchanges-php
 * ============================================================
 * @author Gerson Morales
 * @website https://moralesgerson.com.ve/
 * @email moralesgersonpa@gmail.com
 * ============================================================
 * Get Balance Cryptopia Exchange
 * Documentation https://support.cryptopia.co.nz/csm
 */

include('API.php');


$privateKey = '########'; // the private key provided by Cryptopia
$publicKey = '########'; // the public key provided by Cryptopia

/**
 * GetBalance
 * @var class initializes the CRYPTOPIA class
 * @var call request GetBalance specified currency
 */

$class = new CRYPTOPIA($privateKey, $publicKey );
$call= $class->apiCall("GetBalance", array( 'Currency'=> 'DASH' ));

echo "$call";
?>
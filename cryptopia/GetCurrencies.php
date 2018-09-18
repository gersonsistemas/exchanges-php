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
 * Get Currencies Cryptopia Exchange
 * Documentation https://support.cryptopia.co.nz/csm
 */

include('API.php');


/**
 * GetCurrencies
 * @var class initializes the CRYPTOPIA class, the method is public and does not require keys
 * @var call request GetCurrencies
 */
$class = new CRYPTOPIA(null, null);
$call= $class->apiCall("GetCurrencies", array());

echo "$call";
?>
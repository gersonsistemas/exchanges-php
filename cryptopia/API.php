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
 * Request CRYPTOPIA
 * Documentation https://support.cryptopia.co.nz/csm
 *
 * Example Usage:
 * require 'API.php';
 * $api = new CRYPTOPIA($privateKey, $publicKey); //construct class
 * $call = $api->call($method, array()); //METHOD API | POSTFIELDS REQUEST
 */
class CRYPTOPIA
{
    /**
     * Constructor for the class,
     * you must send the privateKey and publicKey to initialize the class, send null if the method is public
     *
     * @return privateKey | publicKey
     */
	public function __construct($privateKey, $publicKey) 
	{
      	$this->privateKey = $privateKey;
      	$this->publicKey = $publicKey;
    }

	/**
	 * @param $method request api documentation
	 * @param $req array POSTFIELDS
	 * @return res (JSON)
	 */
    public function apiCall($method, array $req = array()) 
    {

		$public_set = array( 
			"GetCurrencies", 
			"GetTradePairs", 
			"GetMarkets", 
			"GetMarket", 
			"GetMarketHistory", 
			"GetMarketOrders"
		);

		$private_set = array( 
			"GetBalance", 
			"GetDepositAddress", 
			"GetOpenOrders", 
			"GetTradeHistory", 
			"GetTransactions", 
			"SubmitTrade", 
			"CancelTrade", 
			"SubmitTip" 
		);


	    static $ch = null;
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	    if(in_array( $method ,$public_set))
	    {
			$url = "https://www.cryptopia.co.nz/api/" . $method;

			if($req)
			{ 
				foreach($req as $r ) 
				{ 
					$url = $url . '/' . $r; 
				} 
			}

			curl_setopt($ch, CURLOPT_URL, $url);
	    } 
	    elseif(in_array( $method, $private_set )) 
	    {
			$url = "https://www.cryptopia.co.nz/api/" . $method;
			$nonce = explode(' ', microtime())[1];
			$post_data = json_encode( $req );
			$m = md5( $post_data, true );
			$requestContentBase64String = base64_encode($m);
			$signature = $this->publicKey . "POST" . strtolower( urlencode( $url ) ) . $nonce . $requestContentBase64String;

			$hmacsignature = base64_encode(hash_hmac("sha256", $signature, base64_decode( $this->privateKey ), true ));

			$header_value = "amx " . $this->publicKey . ":" . $hmacsignature . ":" . $nonce;
			$headers = array("Content-Type: application/json; charset=utf-8", "Authorization: $header_value");

			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_URL, $url );
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $req ) );
	    }

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
		$res = curl_exec($ch);
		if ($res === false) throw new Exception('Could not get reply: '.curl_error($ch));
		return $res;
   	}
}
?>
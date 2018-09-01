<?php 
/*
    Clase para conectarce a API Rest
    Creado por: Gerson Morales - moralesgersonpa@gmail.com
*/
class APIREST
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function call($httpheader)
    {
        try
        {
            $curl = curl_init();
            if (FALSE === $curl)
                throw new Exception('Failed to initialize');
            
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => $httpheader,
            ));

            $response = curl_exec($curl);
            if (FALSE === $response)
                throw new Exception(curl_error($curl), curl_errno($curl));

            $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if (200 != $http_status)
                throw new Exception($response, $http_status);
            curl_close($curl);
        } 
        catch(Exception $e) 
        {
            $response= $e->getCode() . $e->getMessage(); 

            echo $response;   
        }  
        return $response;      
    }  
}
?>
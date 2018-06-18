<?php

class NarnooApiAuthenticate {

	public $authenticate_url = 'https://apis.narnoo.com/api/v1/authenticate/token';
    public $accessKey;
    public $secretKey;

	public function __construct($access_key,$secret_key) {

        $this->accessKey = $access_key;
        $this->secretKey = $secret_key;
    }


    public function authenticate(){

    	$api_settings = array(
				"API-KEY:".$this->accessKey,
				"API-SECRET-KEY:".$this->secretKey
		);

		
		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $this->authenticate_url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $api_settings);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$response = curl_exec($ch);
		curl_close($ch);
		
		if(!empty( $response )){
			$token = json_decode( $response );
			
			if($token->token){
				return $token->token;
			}else{
				error_log('Narnoo API - No authenticate token');
				
			}
			
		}else{
			error_log('Narnoo API - No authenticate returned. Authorization error!');
			
		}

    }


}

?>
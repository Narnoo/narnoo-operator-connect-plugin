<?php

class Narnoo_api {

	public $restful_url = 'https://apis.narnoo.com/api/v1/';
    public $authentication;

	public function __construct($authen) {

        $this->authentication = $authen;
    }


    public function findOperators($page){

    	$method  	= "connect/";
    	$request 	= "find";
    	$_url 		= $this->restful_url.$method.$request;

		$response 	= $this->post($_url);

		return $response;

    }



    public function get( $url ){

    	//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->authentication);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$response = curl_exec($ch);
		curl_close($ch);
		
		if(!empty( $response )){

			$result = json_decode( $response );
			
			if($result){
				return $result;
			}else{
				error_log('Narnoo API - No authenticate token');
				
			}
			
		}else{
			error_log('Narnoo API - No authenticate returned. Authorization error!');
			
		}

    }

    public function post( $url ){

    	//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->authentication);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$response = curl_exec($ch);
		curl_close($ch);
		
		if(!empty( $response )){

			$result = json_decode( $response );
			
			if($result){
				return $result;
			}else{
				error_log('Narnoo API - No authenticate token');
				
			}
			
		}else{
			error_log('Narnoo API - No authenticate returned. Authorization error!');
			
		}

    }


}

?>
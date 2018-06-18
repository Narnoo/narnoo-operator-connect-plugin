<?php
/**
 * Helper functions used throughout plugin.
 **/
class Narnoo_Operator_Connect_Helper {


	/**
	 * Inits and returns operator request object with user's access and secret keys.
	 * If either app or secret key is empty, returns null.
	 * @date_modified: 28.09.2017
	 * @change_log: Added authentication via token.
	 *   			Split out the token from authentication keys
	 **/
	static function init_api() {
		$options  = get_option( 'narnoo_operator_settings' );

		/**
		*
		*	Store keys in a different setting option
		*
		*/
		$token   = get_option( 'narnoo_api_token' );

		if ( empty( $options['access_key'] ) || empty( $options['secret_key'] ) ) {
			return null;
		}
		/**
		*
		*	Check to see if we have access keys and a token.
		*
		*/
		if( !empty( $options['access_key'] ) && !empty( $options['secret_key'] ) && empty($token) ){
			/**
			*
			*	Call the Narnoo authentication to return our access token
			*
			*/
			$requestToken = new NarnooApiAuthenticate( $options['access_key'],$options['secret_key'] );
			$token 		  =  $requestToken->authenticate();
			if(!empty($token)){
				/**
				*
				*	Update Narnoo access token
				*
				*/
				update_option( 'narnoo_api_token', $token, 'yes' );
				
			}else{
				return null;
			}


		}
		/**
		*	Create authentication Header to access the API.
		**/
		$api_settings = array(
			
			"Authorization: bearer ".$token
		);


		$request = new Narnoo_api( $api_settings );

		return $request;
	}

}
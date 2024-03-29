<?php
/**
 * Google strategy for Opauth
 * based on https://developers.google.com/accounts/docs/OAuth2
 * 
 * More information on Opauth: http://opauth.org
 * 
 * @copyright    Copyright © 2012 U-Zyn Chua (http://uzyn.com)
 * @link         http://opauth.org
 * @package      Opauth.GoogleStrategy
 * @license      MIT License
 */

/**
 * Google strategy for Opauth
 * based on https://developers.google.com/accounts/docs/OAuth2
 * 
 * @package			Opauth.Google
 */
class GoogleStrategy extends OpauthStrategy{
	
	/**
	 * Compulsory config keys, listed as unassociative arrays
	 */
	public $expects = array('client_id', 'client_secret');
	
	/**
	 * Optional config keys, without predefining any default values.
	 */
	public $optionals = array('redirect_uri', 'scope', 'state', 'access_type', 'approval_prompt');
	
	/**
	 * Optional config keys with respective default values, listed as associative arrays
	 * eg. array('scope' => 'email');
	 */
	public $defaults = array(
		'redirect_uri' => '{complete_url_to_strategy}oauth2callback',
		'scope' => 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email'
		// 'scope'=> 'email'
	);
	
	/**
	 * Auth request
	 */
	public function request(){
		$url = 'https://accounts.google.com/o/oauth2/auth';
		$params = array(
			'client_id' => $this->strategy['client_id'],
			'redirect_uri' => $this->strategy['redirect_uri'],
			'response_type' => 'code',
			'scope' => $this->strategy['scope']
		);

		foreach ($this->optionals as $key){
			if (!empty($this->strategy[$key])) $params[$key] = $this->strategy[$key];
		}
		
		$this->clientGet($url, $params);
	}
	
	/**
	 * Internal callback, after OAuth
	 */
	public function oauth2callback(){
		if (array_key_exists('code', $_GET) && !empty($_GET['code'])){
			$code = $_GET['code'];
			$url = 'https://accounts.google.com/o/oauth2/token';
			$params = array(
				'code' => $code,
				'client_id' => $this->strategy['client_id'],
				'client_secret' => $this->strategy['client_secret'],
				'redirect_uri' => $this->strategy['redirect_uri'],
				'grant_type' => 'authorization_code'
			);
			$response = $this->serverPost($url, $params, null, $headers);
			
			$results = json_decode($response);
			
			if (!empty($results) && !empty($results->access_token)){
				$userinfo = $this->userinfo($results->access_token);
				date_default_timezone_set('UTC');
				$this->auth = array(
					'provider' => 'Google',
					'uid' => $userinfo->id,
					'info' => array(
						'name' => $userinfo->name,
						'email' => $userinfo->email,
						'first_name' => $userinfo->given_name,
						'last_name' => $userinfo->family_name,
						'image' => $userinfo->picture,
						'emai' => $userinfo->email
					),
					'credentials' => array(
						'token' => $results->access_token,
						'expires' => date('c', time() + $results->expires_in)
					),
					'raw' => $userinfo
				);
				
				if (!empty($userinfo->link)) $this->auth['info']['urls']['google'] = $userinfo->link;
				
				$this->callback();
			}
			else{
				$error = array(
					'provider' => 'Google',
					'code' => 'access_token_error',
					'message' => 'Failed when attempting to obtain access token',
					'raw' => array(
						'response' => $response,
						'headers' => $headers
					)
				);

				$this->errorCallback($error);
			}
		}
		else{
			$error = array(
				'provider' => 'Google',
				'code' => 'oauth2callback_error',
				'raw' => $_GET
			);
			
			$this->errorCallback($error);
		}
	}
	
	/**
	 * Queries Google API for user info
	 *
	 * @param string $access_token 
	 * @return array Parsed JSON results
	 */
	private function userinfo($access_token){
		$userinfo = $this->serverGet('https://www.googleapis.com/oauth2/v1/userinfo', array('access_token' => $access_token), null, $headers);
		if (!empty($userinfo)){
			return json_decode($userinfo);
		}
		else{
			$error = array(
				'provider' => 'Google',
				'code' => 'userinfo_error',
				'message' => 'Failed when attempting to query for user information',
				'raw' => array(
					'response' => $userinfo,
					'headers' => $headers
				)
			);

			$this->errorCallback($error);
		}
	}
}
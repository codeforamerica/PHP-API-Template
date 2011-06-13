<?php

/**
 The most bare bones API library example
 
 */

 
class yourApi extends APIBaseClass{
	// move this to an external config file for best pratice
	//
	public static $api_key = '';
	public static $api_url = 'http://yourapiurl.com';
	public function __construct($url=NULL,$api_key=NULL)
	{
	// api key for now is optional, but will probably need to look into new_request to ensure the key
	// is handled properly
		self::new_request(($url?$url:self::$api_url));
	}

}

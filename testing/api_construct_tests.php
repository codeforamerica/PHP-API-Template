<?php
require_once('simpletest/autorun.php');
// load baseclass 
require_once('../APIBaseClass.php');
// load your class here...
require_once('../api_class_template.php');
// the name of the api class is 'yourApi'
class TestOfApiConnect extends UnitTestCase {
    function testApiConstructs() {
        // create the object and use the assertFalse assertTrue to check to see what happened
        $this->api = new yourApi();
        self::check_class_params('_http _root url');
    }
    function testApiConstructsWithPassedUrl($url){
    	$api = new yourApi($url);
    	self::check_class_params('_http _root url');
    }
    
    function check_class_params($params=NULL){
    	// look up parameters inside of class and see if they are set/ true
    	// also allow to only check for certain parameters by passing in an array with the names of those variables or a space seperated string
    	// parameters to look for in the object
    	if($params != null){
    		if(is_string($params))
    			$params = explode(' ',$params);
    		foreach($params as $key_name)
    			$api_vars [$key_name] = '';
    		}
    	else
    		$api_vars = get_class_vars(get_class($this->api));
    		
    	foreach($api_vars as $key=>$value)
    		$this->assertTrue($this->api->$key);
    }
}
?>

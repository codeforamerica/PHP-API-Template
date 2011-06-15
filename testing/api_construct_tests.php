<?php
require_once('simpletest/autorun.php');
// load baseclass 
require_once('../APIBaseClass.php');
// load your class here...
require_once('../api_class_template.php');
// the name of the api class is 'yourApi'
class TestOfApiConnect extends UnitTestCase {
   public $api;
    function testApiConstructs(){
    	$this->api = new yourApi();
    	// obviously will return false because these are private parameters
    	$this->check_class_params('_http _root',false);
    	$this->check_class_params('url',true);
    }
    
    function check_class_params($params=NULL,$mode=TRUE){
    	// look up parameters inside of class and see if they are set/ true
    	// also allow to only check for certain parameters by passing in an array with the names of those variables or a space seperated string
    	// parameters to look for in the object
    	$api_class_vars =  get_class_vars(get_class($this->api));
    	if($params != null && is_string($params)){    		
			$params = explode(' ',$params);
			foreach($params as $key_name)
				$api_vars [$key_name] = "$key_name";
			$api_vars = array_intersect_key($api_class_vars,$api_vars);
    	}
    	else
    		$api_vars = $api_class_vars;
    	foreach($api_vars as $key=>$value){
    		if($mode == TRUE)
    			$this->assertTrue($this->api->$key);
    		elseif($mode == FALSE)
    			$this->assertFalse($this->api->$key);
    		}
    }
}
?>

<?php
require_once('simpletest/autorun.php');
// load baseclass 
require_once('../APIBaseClass.php');
// load your class here...
require_once('../api_class_template.php');
// the name of the api class is 'yourApi'
class TestOfApiClass extends UnitTestCase {
   public $api;
    function testApiConstructs(){
    	$this->api = new yourApi();
    	// obviously will return false because these are private parameters
    	$this->check_class_params('_http _root',false);
    	$this->check_class_params('url',true);
    }
    // public function do_query($query_path,$params,$return_param)
	
    function testApi_do_query($mode=TRUE){
    // load a file that can do the tests automagically so we don't have to write them in each time
    // inlcude('do_query_conf.php') use a static associtiave array
    	$query_path = $this->api->url;
    	$params = array('param1'=>'value1');
    	$return_param = 'param1';
    	// check for do query config file
    	if(is_file('do_query_conf.php') && !class_exists('do_query_conf')){
    		require('do_query_conf.php');
    	}
    	// check for configuration class to do automated testing
    	if(class_exists('do_query_conf')){
    		foreach(do_query_conf::$_ as $item)
        		$query = explode (' ', $item);
        	if(count($query) == 3){
        		if($mode == false)
        			$this->assertFalse($query[0],$query[1],$query[2]);
        		else
        			$this->assertTrue($query[0],$query[1],$query[2]);
        	}
        	else{
        	// cause a fail test if your conf file isn't written properly
        		if($mode == false)
        			$this->assertFalse(true);
        		else
        			$this->assertTrue(false);
        	}
        }else
        	if($mode== false)
    			$this->assertFalse($this->api->do_query($query_path,$params,$return_param));
    		else 
    			$this->assertTrue($this->api->do_query($query_path,$params,$return_param));
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

<?php
// FYI .. as is api_class_template passes, even if the curl can't connect to the provided address.
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
		// not sure if these test are useful for the base class.. but they check to see
		// that they are private, and the api_url is available from the called class
    	$this->check_class_params('_http _root',false);
    	$this->check_class_params('api_url',true);
    }

    function testApiDoQueryObjectType(){
    	$method_name = 'do_query';
    	/* tests do query against invalid function syntax calls with arrays, numbers and strings
    	 do query cannot take anything other than three passed strings should return false
    	 playing around with different invalid DoQuery requests. This is hard to abstract
    	 until I figure out how to dynamically add arguments to the method call syntax
    	*/
    	
    	$this->assertFalse($this->api->$method_name(1,'  ',array()));
    	// pass three blank arrays
    	$this->assertFalse($this->api->$method_name(array(),array(),array()));
    	// pass three numbers
    	$this->assertFalse($this->api->$method_name(0,1,0));
    	$this->assertFalse($this->api->$method_name(0,1,array('value')));
    	// pass one number
    	$this->assertFalse($this->api->$method_name('  ','  ','  '));
    }
	
    function testApiDoQuery($query_path=NULL,$params=NULL,$return_param=NULL,$mode=FALSE){
    /* this is like above but we test valid method parameters, or invalid method parameters if mode is FALSE
    	$query_path is the api URL
    	$params is a coded string written as such 'param<=>value param2<=>value2' and so on. Take care to not use spaces except between
    	parameter/value pairs
    	$return_param is the name of a parameter to return (as per the original do_query function call), this parameter must be in the $params variable
    	
    	or
    	
    	leave the method call blank and let a file called 'do_query_conf.php' be included. This file contains a class with a static variable
    	that can be accessed inside and outside of objects without any inheritance, object creation or global definitions.
    	
    	$mode is an optional value that will allow a developer to toggle between 'assertFalse' and 'assertTrue', take care to define all variables
    	before $mode with their default 'nulls'
    	
	    check for configuration class file to do automated testing perhaps make this a static public var that dev can set at top of class
	   	
	   	that class will look like class do_query_conf{ static $_ = array( 'do query method call1','do query method call2') and so on. 
	   	Basically $params in an array
	   	
    */
    
		if(!class_exists('do_query_conf') && pathinfo('do_query_conf.php')) include('do_query_conf.php');
    	if(class_exists('do_query_conf')){
    		foreach(do_query_conf::$_ as $item)
        		$query = explode (' ', $item);
        	if(count($query) == 3){
        		if($mode == false)
        			$this->assertFalse($this->api->do_query($query[0],$query[1],$query[2]));
        		else
        			$this->assertTrue($this->api->do_query($query[0],$query[1],$query[2]));
        	}
        	else{
        	// cause a fail test if your conf file isn't written properly
        		if($mode == false)
        			$this->assertFalse(true);
        		elseif($mode == true)
        			$this->assertTrue(false);
        	}
        // if no config file present
        }elseif(is_string($query_path)&&is_string($params)&&is_bool($mode)){
        	if($mode == false)
        	// may need to use something other than assertFalse/assertTrue to be more precise
    			$this->assertFalse($this->api->do_query($query_path,$params,$return_param));
    		elseif($mode == true) 
    			$this->assertTrue($this->api->do_query($query_path,$params,$return_param));
    	}else{
    	// conf file not found, and testDoQuery was not passed valid syntax
    		return false;
    	}
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
    	// anything that isnt intersected should return false
   
    	foreach($api_vars as $key=>$value){
    		if($mode == TRUE)
    			$this->assertTrue(array_key_exists($key,$api_class_vars));
    		elseif($mode == FALSE)
    			$this->assertFalse(array_key_exists($key,$api_class_vars));
    		}
    }
}
?>

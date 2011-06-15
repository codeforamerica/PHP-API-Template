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
        // in most cases this will be as simple as seeing if an API return is valid, seeing if
        // test queries work (return the expected data.) Stuff like that.
        // maybe try to figure out the name of the api better automatically ?
        $api = new yourApi();
        // look for a url
        $this->assertTrue($api->url);
    	// if not found then the url was not entered properly in the class file
    }
    function testApiConstructsWithPassedUrl($url){
    	$api = new yourApi($url);
    	$this->assertTrue($api->url);
    
    }
}
?>

<?php
    require_once(dirname(__FILE__) . '/simpletest/autorun.php');
    require_once('../APIBaseClass.php');

    class TestAPIBaseClass extends UnitTestCase {
        
        function __construct() {
            parent::__construct('Connection test');
        }
            
        function testSimpleGet() {
            $x = new APIBaseClass();
            $x->new_request('x.iriscouch.com');
            
            // I'd like to assert the member variables here...but they are private
            
            // This get has no data
            $resp = $x->get('/murals/02958ab3d23123d92f6553c75e00fffe','');
            
            // Decode the response
            $resp_json = json_decode($resp);
            
            // See if the ID returned is the ID I asked for
            $this->assertEqual($resp_json->_id, '02958ab3d23123d92f6553c75e00fffe');
        }
        
        function testSimplePost() {
            
        }
        
    }
?>
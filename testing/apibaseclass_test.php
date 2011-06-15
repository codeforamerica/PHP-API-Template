<?php
    require_once(dirname(__FILE__) . '/simpletest/autorun.php');
    require_once('../APIBaseClass.php');

    class TestAPIBaseClass extends UnitTestCase {
        
        function __construct() {
            parent::__construct('Connection test');
        }
            
        function testGetFunction() {
            $x = new APIBaseClass();
            // TO DO, use test endpoint
            $x->new_request('x.iriscouch.com');
            
            $input = array(
              '/murals/02958ab3d23123d92f6553c75e00fffe',
              '',
              0,
              999,
              array()
            );
            
            foreach ($input as $i) {
                $resp = $x->get($i, '');
                // This fails as it makes calls to URL with integers in it
                $this->assertIsA($resp, 'string');
                // TO DO, check the format of this string
            }
        }
        
        function testSimplePost() {
            
        }
        
    }
?>
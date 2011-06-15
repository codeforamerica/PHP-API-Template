<?php
/**
 * @file
 * Unit testing for base class
 *
 * Use $this->dump($var); for debugging
 */

require_once dirname(__FILE__) . '/simpletest/autorun.php';
require_once '../APIBaseClass.php';

/**
 * Unit test class for Base API class
 */
class UnitTestAPIBaseClass extends UnitTestCase {
    
    function __construct() {
        parent::__construct('Connection test');
    }
    
    function testConstructor() {
        $x = new APIBaseClass();
        // What should $x look like?
    }
        
    function testNewRequest() {
        $x = new APIBaseClass();
        $x->new_request($_SERVER['SERVER_NAME']);
        // What should this look like?
    }
        
    function testGet() {
        $x = new APIBaseClass();
        $x->new_request($_SERVER['SERVER_NAME']);
        
        $input = array(
            $_SERVER['REQUEST_URI'] . 'test_endpoint.php?endpoint=testing',
            $_SERVER['REQUEST_URI'] . 'test_endpoint.php',
            'test_endpoint.p=testing',
            '',
            0,
            999,
            array(),
        );
        
        foreach ($input as $i) {
            $resp = $x->get($i, '');
            // This fails as it makes calls to URL with integers in it
            $this->assertIsA($resp, 'string', 'get should return string.');
            // TO DO, check the format of this string
        }
    }
    
    // Test all methods!!
}
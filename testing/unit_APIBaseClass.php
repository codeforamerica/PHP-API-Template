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
        
        // Valid response
        $resp = $x->get($_SERVER['REQUEST_URI'] . 'test_endpoint.php?endpoint=testing', '');
        $this->assertIsA($resp, 'string', 'get should return string.');
        
        // Valid endpoint, but no response
        $resp = $x->get($_SERVER['REQUEST_URI'] . 'test_endpoint.php', '');
        $this->assertIsA($resp, 'string', 'get should return string.');
        
        // Not valid
        // This raises a CURL error, and it just return s a blank string.  Fix!!
        $resp = $x->get('test_endpoint.p=testing', '');
        
        // Not valid
        // This raises a CURL error, and it just return s a blank string.  Fix!!
        $resp = $x->get(0, '');
        
        // Not valid
        // This raises a CURL error, and it just return s a blank string.  Fix!!
        $resp = $x->get(999, '');
        
        // Not valid
        // This raises a CURL error, and it just return s a blank string.  Fix!!
        $resp = $x->get(array(), '');
        
    }
    
    // Test all methods!!
}
<?php
/**
 * @file
 * Creates a single place to run all tests
 *
 * This testing utilizes SimpleTest.  This should be included in this
 * library.
 *
 * See the following page for API documentation on SimpleTest:
 * http://www.simpletest.org/api/
 */
require_once dirname(__FILE__) . '/simpletest/autorun.php';

$group = new TestSuite('PHP API Testing');
$group->addFile('./unit_APIBaseClass.php');
//$group->addFile('./TestOfApiClass.php');
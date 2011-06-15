<?php

/* For loading suites of test with the do_query method in the APIBaseClass.php


 Usage
 
 Do query passes three parameters, use a simple string to define each set for each test
 first value should be the query URL, second would be a collection of the desired parameters,
 and the final value is the name of the paremeter to return in accordance with proper do_query syntax

* All values required.

*/

class do_query_conf{
	static $_= array(
		'http://testurl.com parameter<=>value,parameter2<=>value parameter2',
		'http://testurl2.com parameter2<=>value,parameter3<=>value parameter3'
	);

}
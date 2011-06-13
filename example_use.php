<?php
// simple wrapper for api classes. dies with object information (object values,methods and variables)

// Base API Class
require 'APIBaseClass.php';
// Custom API Class
require 'example_api.php';

$new = new FCCApi();
// Debug information
die(print_r($new).print_r(get_object_vars($new)).print_r(get_class_methods(get_class($new))));

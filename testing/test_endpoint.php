<?php
/**
 * @file
 * Test endpoint for testing purposes
 *
 * Let's utilize GET parameters as REST endpoints.
 */

$output = '';
switch ($_GET['endpoint']) {
    case 'testing':
        $output = '
{
    "response": {
        "code": 200
    },
    "data": {
        "thing": "This is a test thing."
    }
}
        ';
        break;
        
    default:
        break;
}

print $output;
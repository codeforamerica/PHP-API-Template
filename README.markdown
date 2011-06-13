Why
===
 This library was created to help assist developers in writing api libraries that
 interact with open government api keys.

Usage
=====

	include('APIBaseClass.php');
	include('my_API_lib.php');
 
	new my_API_lib('http://myurl.com');
        // or
        new my_API_lib();
 
How to Write your API Classes
=============================

- Your class must be the same name as your php file
- Your class must extend APIBaseClass

	class my_API_lib extends APIBaseClass{...
	
- Your class must have a construct method that looks something like this:

	public function __construct($url)
	{
		self::new_request('http://myurl.com');
	}
	
- Methods are 

 *get
 *post
 *put
 *delete
 
  Use them in your api library class where needed
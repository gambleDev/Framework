<?php
	/*
	*
	*$route['default_route'] = 'default_controller_path'
	*Route called when non is define
	*
	*Use:
	*http://domain.com/index.php/$route['default_controller']
	*
	*Notes:
	*Make sure this value matched the route variable index of the controller youre trying to reach
	*
	*/
	$route['default_controller'] = 'home';
	$route['default_function'] = 'index';
	/*
	*
	*$route['controller'] = array('path/to/file', array('controller function name' => array('parameterName', 'parameterName2')));
	*Controls which controller is called when url is visited
	*
	*Use:
	*http://domain.com/index.php/controller/controller_function_name/parameterName/parameterName2
	*
	*Notes:
	*Make sure the name of you class is the same as the file name minus the php
	*AFTER THE LAST "/" IS CONSIDERED THE CLASS NAME IN THE PATH TO FILE
	*
	*/
	
	//NOTE: $route index is to make it pretty, make sure your functions names do to! 
	
	$route['home'] = array("Home/main");
	$route['login'] = array("Login/main", array("check" => array("username", "password"),//calls check function in the main class
																			"deleted" => array("userid")));
?>

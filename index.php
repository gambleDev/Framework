<?php
	require_once("src/core/autoload.php");
	require_once("src/core/config/routes.php");
	require_once('src/core/controller.php');
	require_once('src/core/model.php');
	
	class application extends autoload{
		var $routes = array();
		//current page
		var $route;
		var $routeName;
		var $functionName;
		var $parameters;
		var $className;//sets in loadRoutedPage
		
		private function loadRoutedPage($path){
			require_once("src/application/controllers/".$path.".php");
			//if there is slashes it split at the slashes to find the class name at the end
			if(strpos($path,'/') !== false){
				$pathSections = explode("/", $path);
				$totalSections = count($pathSections);
				$className = $pathSections[$totalSections-1];
			}else{
				$className = $path;
			}
			//load the class
			$class = new $className();
			//determines whether or not the function exists
			if(method_exists($class, $this->functionName)){
				//makes sure the parameters match up
				if(isset($this->route[1])){
					if(count($this->route[1][$this->functionName]) !== count($this->parameters)){
						echo "<h1>Error</h1>";
						echo "Too many or not enough parameters were passed to the class function.";
						exit();
					}else{
						$function = $this->functionName;
					
						$currentParameter = 0;
						foreach($this->route[1][$this->functionName] as $name){
							$finalParameters[$name] = $this->parameters[$currentParameter];
							$currentParameter++;
						}
						$class->$function($finalParameters);
					}
				}else{
					$function = $this->functionName;
					$class->$function();
				}
			}else{
				echo "<h1>404 Not Found</h1>";
				echo "The page that you have requested could not be found.";
				exit();
			}
		}
		
		private function getCurrentRoute(){
			$entirePath = "$_SERVER[REQUEST_URI]";
			$route = explode("index.php/", $entirePath);
			//split URL
			if(isset($route[1])){
				$sections = explode("/", $route[1]);
				//delete empty sections of the url for example the ending "/"
				foreach($sections as $key=>$value){
					if(is_null($value) || $value == ''){
						unset($sections[$key]);
					}
				}
				//give the sections logical names
				if(isset($sections[0])){
					$this->routeName = $sections[0];
				}
				
				if(isset($sections[1])){
					$this->functionName = $sections[1];
				}else{
					$this->functionName = $this->routes['default_function'];
				}
				//unset the function name and the route name for easier parsing
				unset($sections[0]);
				if(isset($sections[1])){
					unset($sections[1]);
				}
				//check and sort parameters
				if(isset($sections)){
					foreach($sections as $key=>$value){
						$this->parameters[] = $value;
					}
				}
			}else{
				$routeName = "";
			}
			//gets the correct route
			if(empty($this->routeName)){
				$routePath = $this->routes['default_controller'];//should output the path to php file
			}else{
				$routePath = $this->routeName;//should output the path to php file
			}
			//makes sure the route is there if not 404 it
			if(empty($this->routes[$routePath]) && empty($this->routes[substr($routePath, 0, -1)])){
				echo "<h1>404 Not Found</h1>";
				echo "The page that you have requested could not be found.";
				exit();
			}else{
				if(empty($this->routes[$routePath])){
					$routePath = substr($routePath, 0, -1);
				}
				//this load the controller itself
				$this->route = $this->routes[$routePath];
				$this->loadRoutedPage($this->route[0]);
			}
		}
		
		function __construct($routes=array()){
			$this->routes = $routes;
			echo $this->getCurrentRoute();
		}
	}
	
	$application = new application($route);
	
?>

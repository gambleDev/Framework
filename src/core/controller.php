<?php
	class controller{
		
		public function loadModel($path, $modifiedName = null){
			require_once("src/application/models/".$path.".php");
			//gets the actual class name
			if(strpos($path,'/') !== false){
				$pathSections = explode("/", $path);
				$totalSections = count($pathSections);
				$className = $pathSections[$totalSections-1];
			}else{
				$className = $path;
			}
			//assign it to a usable var
			if($modifiedName == null){
				$this->{$className} = new $className();
			}else{
				$this->{$modifiedName} = new $className();
			}
		}
		
		public function loadView($path){
			require_once("src/application/views/".$path.".php");
		}	
	
	}
?>

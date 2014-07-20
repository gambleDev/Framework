<?php

	class main extends controller{
		public function check($parameters){
			echo"You are logging in as ".$parameters['username']." with password ".$parameters['password'];
		}
	}
?>

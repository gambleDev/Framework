<?php

	class main extends controller{
		public function check($parameters){
			$this->tryThis('helloBaby');
			echo"You are logging in as ".$parameters['username']." with password ".$parameters['password'].$this->helloBaby;
		}
	}
?>

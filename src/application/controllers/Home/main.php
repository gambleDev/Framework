<?php

	class main extends controller{
		public function index(){
			$this->loadModel('Home/mainHome', 'main');//instead of calling $this->mainHome->function() we can call $this->main->function()
			$this->loadView('Home/main');
		}
	}
?>

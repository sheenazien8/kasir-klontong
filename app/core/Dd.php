<?php 
	class Dd {
		public function print_r($name)
		{
			echo '<pre>';
			print_r($name);
			echo '</pre>';
			die();
		}
	}

 ?>
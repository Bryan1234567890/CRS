<?php


class Controller {
	public function libs($lib) 
	{
		$path =  "app/library/". $lib .".php";

		if(file_exists($path))
		{
			require_once($path);
			$path = str_replace('-', '_', $lib);
			return new $path();
		}
	}

	function model($model){
		require_once 'app/models/'.$model.'.php';
		return new $model();
	}

	function view($view , $data = [], $HeadFoot = false){
		//   exit(print_r($HeadFoot , true));

		$output = isset($data['output']) ? $data['output'] : '';
		unset($data['output']);
		if ($output=='object') {
			// $data=(isset($data['data']) ? $data['data']:$data);
			ob_start();
		}

		if($HeadFoot){
			// require_once 'app/src/components/shared/header.php';
			// require_once 'app/src/pages/'.$view.'.php';
			
		} else {
			require_once 'app/src/components/shared/Header.php';
			require_once 'app/src/components/shared/Navbar.php';
			require_once 'app/src/pages/'.$view.'.php';
			require_once 'app/src/components/shared/Footer.php';
	
		}

		if ($output=='object') {
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		}
	}
}
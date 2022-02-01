<?php

	namespace App\Controllers\Error;

	use App\Controllers\BaseController;

	class ErrorController extends BaseController
	{
		public function error403()
		{
			$session = session();

			return view('error/error403', ['session' => $session]);
		}
		
		public function error404()
		{
			$session = session();
			
			return view('error/error404', ['session' => $session]);
		}
	}

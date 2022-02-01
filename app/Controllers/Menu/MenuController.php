<?php

	namespace App\Controllers\Menu;

	use App\Controllers\BaseController;

	class MenuController extends BaseController
	{
		public function index()
		{
			$session = session();

			return view('menu/index', ['session' => $session]);
		}
	}

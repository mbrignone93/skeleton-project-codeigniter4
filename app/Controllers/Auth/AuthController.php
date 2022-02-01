<?php

	namespace App\Controllers\Auth;
	
	use App\Controllers\BaseController;
	use App\Models\Usuario\UsuarioModel;

	class AuthController extends BaseController
	{
		private UsuarioModel $usuarioModel;

		public function __construct(){ $this->usuarioModel = new UsuarioModel(); }

		public function index(){ return view('login/index'); }

		public function login()
		{
			sleep(3);

			$row = $this->usuarioModel->auth($this->request->getPost('user'));

			if ($row != null)
			{
				if ($row->Habilitado == 1)
				{
					if (password_verify($this->request->getPost('pass'), $row->Password))
					{
						if ($row->Password_Temp == 1)

							return $this->response->setHeader('Content-Type', 'application/json')
									  			  ->setJSON(
								[
									"Message" => "Change Password", 
									"Token" => csrf_hash()
								]
							);
							
						else
						{
							$session = session();

							$dataSession = [
								'apellido'  => $row->Apellido,
								'nombre'    => $row->Nombre,
								'sexo'		=> $row->Sexo,
								'usuario'   => $row->Usuario,
								'pass_temp' => $row->Password_Temp,
								'id'	    => $row->Id,
								'id_rol'	=> $row->Id_Rol,
								'skin'	    => $row->Skin
							];
								
							$session->set($dataSession);

							return $this->response->setHeader('Content-Type', 'application/json')
								                  ->setJSON(
								 	[
										"Message" => "Authentication Success"
									]
							);
						}	
					}
					else
						return $this->response->setHeader('Content-Type', 'application/json')
											  ->setJSON(
								[
									"Message" => "Authentication Failed",
									"Token" => csrf_hash()
								]
						);
				}
				else
				
					return $this->response->setHeader('Content-Type', 'application/json')
										  ->setJSON(
							[
								"Message" => "User Disabled",
								"Token" => csrf_hash()
							]
					);
			}
			else
				return $this->response->setHeader('Content-Type', 'application/json')
									  ->setJSON(
						[
							"Message" => "Authentication Failed",
							"Token" => csrf_hash()
						]
				);
		}

		public function logout()
		{
			$session = session();

			$session->destroy();

			return redirect()->to(base_url('/'));
		}

		public function changePassword()
		{
			if ($this->usuarioModel->isCurrentPassword($this->request->getPost('user'), $this->request->getPost('currentPass')))
			{
				$this->usuarioModel->changePassword($this->request->getPost('user'), $this->request->getPost('newPass'), boolval(0));

				return $this->response->setHeader('Content-Type', 'application/json')
									  ->setJSON(
						[
							"Message" => "Password Changed", 
							"Token" => csrf_hash()
						]
					);
			}
			else
				return $this->response->setHeader('Content-Type', 'application/json')
									  ->setJSON(
						[
							"Message" => "Invalid Current Password",
							"Token" => csrf_hash()
						]
					);
		}

		public function resetPassword()
		{
			$this->usuarioModel->changePassword($this->request->getPost('user'), '12345678', boolval(1));

			return $this->response->setHeader('Content-Type', 'application/json')
								  ->setJSON(
					[
						"Message" => "Password Changed", 
						"Token" => csrf_hash()
					]
			);
		}
	}

<?php

	namespace App\Models\Usuario;

	use App\Models\BaseModel;

	class UsuarioModel extends BaseModel
	{
		public function __construct(){ parent::__construct('default', 'Usuarios'); }

		public function auth(string $user)
		{
			$this->builder->select('
			   Apellido, Nombre, Sexo, Usuario, Password, Password_Temp, Habilitado, Id, Id_Rol, Skin
			');
			
			$this->builder->where('Usuario = ', $user);
			
			$query = $this->builder->get();

			return $query->getRow();
		}

		public function isCurrentPassword(string $user, string $currentPass)
		{
			$builder = $this->db->table($this->table);

			$builder->select('Password');
			$builder->where('Usuario = ', $user);
			
			$query = $builder->get();

			$row = $query->getRow();

			if(password_verify($currentPass, $row->Password))
				return true;
			else
				return false;
		}

		public function changePassword(string $user, string $newPass, bool $password_temp)
		{
			$builder = $this->db->table($this->table);

			$array = [
				'Password_Temp' => boolval($password_temp),
				'Password'     => password_hash($newPass, PASSWORD_DEFAULT)
			];

			$builder->set($array, false);
			$builder->where('Usuario', $user);

			$builder->update();
		}

		public function getAll()
		{
			$builder = $this->db->table('Usuarios u');

			$builder->select('
				u.Id,
				u.Legajo,
				u.Nombre,
				u.Apellido,
				u.Usuario,
				ur.Descripcion AS Rol,
				CASE u.Habilitado WHEN 1 THEN \'SI\' WHEN 0 THEN \'NO\' END AS Habilitado
			');

			$builder->join('Usuarios_Roles ur', 'ur.Id = u.Id_Rol');

			$builder->orderBy('u.Legajo', 'DESC');
			
			$query = $builder->get();

			return $query->getResultArray();
		}
	}

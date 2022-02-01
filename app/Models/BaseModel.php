<?php

	/*
		using QueryBuilder Class
		https://codeigniter.com/user_guide/database/query_builder.html
	*/

	namespace App\Models;

	abstract class BaseModel
	{
		protected $db;
		protected $table;
		protected $builder;

		public function __construct(string $dbConnectionName, string $table)
		{ 
			$this->db = \Config\Database::connect($dbConnectionName);
			$this->table = $table;
			$this->builder = $this->db->table($this->table); 
		}

		public function findAll()
		{
			$this->builder->select('*');
			
			$query = $this->builder->get();

			return $query->getResultArray();
		}

		public function find(string $columns)
		{
			$this->builder->select($columns);
			
			$query = $this->builder->get();

			return $query->getResultArray();
		}

		public function findById($columns, $id)
		{
			$this->builder->select($columns);

			$this->builder->where('Id', intval($id));
			
			$query = $this->builder->get();

			return $query->getResultArray();
		}

		public function findAllById($id)
		{
			$this->builder->select('*');

			$this->builder->where('Id', intval($id));
			
			$query = $this->builder->get();

			return $query->getResultArray();
		}

		public function dataExist($columns, $arrayFilterData)
		{
			$this->builder->select($columns);
			$this->builder->where($arrayFilterData);
			
			$query = $this->builder->get();

			$row = $query->getRow();

			if($row != null)
				return true;
			else
				return false;
		}

		public function isBusinessAV($id)
		{
			$this->builder->select('Sucursal');

			$this->builder->where('Id', intval($id));
			$this->builder->like('Sucursal', 'AV');

			$query = $this->builder->get();

			$row = $query->getRow();

			if($row != null)
				return true;
			else
				return false;
		}
		
		public function save($arraySetData)
		{
			$this->builder->set($arraySetData);

			$this->builder->insert();
		}

		public function update($arraySetData, $arrayFilterData)
		{
			$this->builder->set($arraySetData, false);
			$this->builder->where($arrayFilterData);

			$this->builder->update();
		}

		public function delete($arrayFilterData)
		{ 
			$this->builder->delete($arrayFilterData);
		}
	}

<?php

namespace App\Models;
use CodeIgniter\Model;

class M_login extends Model
{		
	public function getLogin($table, $where)
	{
		return $this->db->table($table)->getWhere($where)->getRowArray();
	}

	public function getLoginWithPassword($table, $username, $password)
	{
		$query = $this->db->table($table)
		->where('Username', $username)
		->where('Password', md5($password))
		->get();
		return $query->getRowArray();
	}

	public function joinlogin($table1, $table2, $on, $where)
	{
		return $this->db->table($table1)->join($table2, $on, 'left')->getWhere($where)->getRow();
	}
}
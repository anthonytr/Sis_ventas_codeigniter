<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	public function login($username, $password)
	{
		//Hago las consultas
		$this->db->where("username", $username);
		$this->db->where("password", "$password");

		//Capturo los valores
		$resultados = $this->db->get("usuarios");

		//Condición
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		} else {
			return false;
		}
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_model extends CI_Model {

	public function getCategorias()
	{
		//Retornamos todas las categorias de la tabla categorias
		$this->db->where("estado", "1");
		$resultados = $this->db->get("categorias");
		return $resultados->result();
	}
}

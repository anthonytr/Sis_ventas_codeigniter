<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Usuarios_model");
	}

	public function index()
	{
		//Llamo a la variable de sesión login
		if ($this->session->userdata("login")) {
			redirect(base_url()."dashboard");
		} else {
			$this->load->view("admin/login");
		}
	}

	public function login()
	{
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$res = $this->Usuarios_model->login($username, sha1($password));

		//Si el valor es false
		if (!$res) {
			$this->session->set_flashdata("error", "El y/o la contraseña son incorrectos");
			//Lo redirigimos a la vista de login
			redirect(base_url());
		} else {
			//Variables de sesión
			$data = array(
				'id'     => $res->id,
				'nombre' => $res->nombres,
				'rol'    => $res->rol_id,
				'login'  => TRUE
			);
			//Le pasamos el método set_userdata para establecer la variable de sesión
			$this->session->set_userdata($data);
			redirect(base_url()."dashboard");
		}
	}

	public function logout()
	{
		//Eliminamos todas las variables de sessiones
		$this->session->sess_destroy();
		//Redirigimos a la vista login
		redirect(base_url());
	}
}

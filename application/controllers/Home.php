<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends AUTH_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_campana');
	}

	public function index()
	{
		$data['userdata'] 		= $this->userdata;
		$data['datacampana'] = $this->M_campana->select_all_campana_cinco_dias();


		$data['page'] 			= "home";
		$data['cabTitulo'] = "de Inicio";

		$data['judul'] 			= "Inicio";
		$data['deskripsi'] 		= "Bienvenido/a";
		$this->template->views('home', $data);
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
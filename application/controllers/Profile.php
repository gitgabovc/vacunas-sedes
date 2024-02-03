<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_admin');
	}

	public function index() {
		$data['userdata'] 		= $this->userdata;
		
		$data['page'] 			= "profile";
		$data['cabTitulo'] 		= "Perfil";
		$data['cabDescri'] 		= "Información del usuario";
		$this->template->views('profile', $data);
	}

	public function update() {
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[15]');
		$this->form_validation->set_rules('nama', 'Nombre', 'trim|required');

		$id = $this->userdata->id;
		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/img/';
			$config['allowed_types'] = 'jpg|png';
			
			$this->load->library('upload', $config);
			
			if (!$this->upload->do_upload('foto')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$data_foto = $this->upload->data();
				$data['foto'] = $data_foto['file_name'];
			}

			$result = $this->M_admin->update($data, $id);
			if ($result > 0) {
				$this->updateProfil();
				$this->session->set_flashdata('msg', show_succ_msg('Datos actualizados con éxito'));
				redirect('Profile');
			} else {
				$this->session->set_flashdata('msg', show_err_msg('No se pudo actualizar los datos.'));
				redirect('Profile');
			}
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('Profile');
		}
	}

	public function up_password() {
		$this->form_validation->set_rules('passAct', 'Password Actual', 'trim|required');
		$this->form_validation->set_rules('passNue', 'Password Nuevo', 'trim|required');
		$this->form_validation->set_rules('passRep', 'Password Confirmar', 'trim|required');

		$id = $this->userdata->id;
		if ($this->form_validation->run() == TRUE) {
			if (md5($this->input->post('passAct')) == $this->userdata->password) {
				if ($this->input->post('passNue') != $this->input->post('passRep')) {
					$this->session->set_flashdata('msg', show_err_msg('Las contraseña no son iguales'));
					redirect('Profile');
				} else {
					$data = [
						'password' => md5($this->input->post('passNue'))
					];
					$result = $this->M_admin->update($data, $id);
					if ($result > 0) {
						$this->updateProfil();
						$this->session->set_flashdata('msg', show_succ_msg('Contraseña cambiada con éxito.'));
						redirect('Profile');
					} else {
						$this->session->set_flashdata('msg', show_err_msg('No se pudo cambiar la contraseña.'));
						redirect('Profile');
					}
				}
			} else {
				$this->session->set_flashdata('msg', show_err_msg('Contraseña actual incorrecta.'));
				redirect('Profile');
			}
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('Profile');
		}
	}

}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends AUTH_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('M_admin');
	}

	public function index() {
		$data['userdata'] = $this->userdata;
		$data['datausuario'] = $this->M_admin->select_all();

		$data['page'] = "admin";
		$data['cabTitulo'] = "Administradores";
		$data['cabDescri'] = "Usuarios Administradores";

		$data['modal_admin'] = show_my_modal('admin/modal', 'modal-admin', $data);

		$this->template->views('admin/home', $data);
	}

	public function listado() {
		$data['datausuario'] = $this->M_admin->select_all();
		$this->load->view('admin/list_data', $data);
	}

	public function procesaInsert() {
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
		$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|unique');
		$this->form_validation->set_rules('password', 'Contraseña', 'trim|required');
		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {


            $fileName = $fff.$ddd.$ext;
            $config['upload_path']          = '../assets/img';
            $config['overwrite'] = TRUE;
            $config['allowed_types']        = 'JPG|jpg|JPEG|jpeg';
            // $config['allowed_types']        = 'PDF|DOC|JPG|JPEG|PNG|pdf|png|doc';
            $config['max_size']             = 10000;
            $config['max_width']            = 3000;
            $config['max_height']           = 3000;
            $config['file_name']            = $fileName;
            //
            $this->load->library('upload', $config);
            //
            if ( ! $this->upload->do_upload('file'))
            {
                $error = $this->upload->display_errors();			
            }		
            if($error == 'ok'){
                //
                $data['foto']  = $fileName;
                //$error = $this->FormularioRepository->guardardocs($data);
            }
            echo $error;

			$result = $this->M_admin->insert($data);
			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Usuario creado con éxito.', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('No se pudo crear el usuario.', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}
		echo json_encode($out);
	}

	public function update() {
		$id = trim($_POST['id']);

		$data['datausuario'] = $this->M_admin->select_by_id($id);
		$data['dataPosisi'] = $this->M_posisi->select_all();
		$data['dataKota'] = $this->M_kota->select_all();
		$data['userdata'] = $this->userdata;
		//esto es respuesta ajax
		echo show_my_modal('modals/modal_update_usuario', 'update-usuario', $data);
	}

	public function procesaUpdate() {
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('kota', 'Kota', 'trim|required');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('posisi', 'Posisi', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_admin->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data usuario Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data usuario Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_uM_adminsuario->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Se ha eliminado con éxito.', '20px');
		} else {
			echo show_err_msg('!Error al eliminar!', '20px');
		}
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
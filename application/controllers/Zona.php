<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zona extends AUTH_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('M_zona');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['dataZona'] = $this->M_zona->select_all();

		$data['page'] 		= "zona";
		$data['cabTitulo'] 	= "Zonas";
		$data['cabDescri'] 	= "Administrar Zonas";

		$data['modal_template_zona'] = show_my_modal('modals/modal_zona', 'modal-zona', $data);

		$this->template->views('zona/home', $data);
	}

	public function listado() {
		$data['dataZona'] = $this->M_zona->select_all();
		$this->load->view('zona/list_data', $data);
	}

	public function procesarZona() {
		$this->form_validation->set_rules('descripcion', 'Zona', 'trim|required');
		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_zona->insert($data);
			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Se ha guardado con éxito.', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Error al guardar.', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['dataZona'] 	= $this->M_zona->select_by_id($id);

		echo show_my_modal('modals/modal_update_zona', 'update-zona', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('zona', 'Zona', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_zona->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Se ha modificado con éxito', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Error al modificar', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_zona->delete($id);
		
		if ($result > 0) {
			echo show_succ_msg('Se ha eliminado con éxito', '20px');
		} else {
			echo show_err_msg('Error al eliminar', '20px');
		}
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_zona->select_all();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', "ID"); 
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', "Zona");

		$rowCount = 2;
		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->id); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->descripcion); 
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data Zona.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data Zona.xlsx', NULL);
	}

	public function import() {
		$this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] == '') {
			$this->session->set_flashdata('msg', 'Se requiere archivo');
		} else {
			$config['upload_path'] = './assets/excel/';
			$config['allowed_types'] = 'xls|xlsx';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('excel')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$data = $this->upload->data();
				
				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Jakarta');

				include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';

				$inputFileName = './assets/excel/' .$data['file_name'];
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

				$index = 0;
				foreach ($sheetData as $key => $value) {
					if ($key != 1) {
						$check = $this->M_zona->check_nama($value['B']);

						if ($check != 1) {
							$resultData[$index]['descripcion'] = ucwords($value['B']);
						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_zona->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Datos cargados correctamente'));
						redirect('Ciudad');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Los datos no se pudieron importar', 'warning', 'fa-warning'));
					redirect('Zona');
				}

			}
		}
	}
}

/* End of file Zona.php */
/* Location: ./application/controllers/Zona.php */
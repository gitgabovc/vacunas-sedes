<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operacion extends AUTH_Controller { //Pegawai
	public function __construct() {
		parent::__construct();

	}

	public function index() {
		$data['userdata'] = $this->userdata;
		$data['dataoperacion'] = $this->M_operacion->select_all();
		$data['datainmuebles'] = $this->M_inmueble->select_estado('D');

		$data['page'] = "operacion";
		$data['cabTitulo'] = "Operaciones";
		$data['cabDescri'] = "Administrar operacion";

		$data['modal_operacion'] = show_my_modal('operacion/modal', 'modal-operacion', $data);

		$this->template->views('operacion/home', $data);
	}

	public function listado() {
		$data['dataoperacion'] = $this->M_operacion->select_all();
		$this->load->view('operacion/list_data', $data);
	}

	public function procesaInsert() {
		$this->form_validation->set_rules('codigo', 'Código', 'trim|required');
		$this->form_validation->set_rules('importe', 'Importe', 'trim|required');
		$this->form_validation->set_rules('fecha', 'Fecha', 'trim|required');
		$this->form_validation->set_rules('comisionTotal', 'Comisión Total', 'trim|required');
		$this->form_validation->set_rules('comisionAge', 'Comisión Agente', 'trim|required');
		$this->form_validation->set_rules('comisionRem', 'Comisión Remax', 'trim|required');
		$this->form_validation->set_rules('retension', 'Retención', 'trim|required');
		//$this->form_validation->set_rules('rango', 'Rango', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_operacion->insert($data);

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
		$id = trim($_POST['id']);

		$data['dataoperacion'] = $this->M_operacion->select_by_id($id);
		$data['userdata'] = $this->userdata;
		//esto es respuesta ajax
		echo show_my_modal('operacion/modal_update', 'update-operacion', $data);
	}

	public function procesaUpdate() {
		$this->form_validation->set_rules('codigo', 'Codigo', 'trim|required');
		$this->form_validation->set_rules('ci', 'C.I.', 'trim|required');
		$this->form_validation->set_rules('nombres', 'Nombre', 'trim|required');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required');
		$this->form_validation->set_rules('telefono', 'Teléfono', 'trim|required');
		$this->form_validation->set_rules('direccion', 'Dirección', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_operacion->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Datos actualizados', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('No se pudo actualizar datos', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_operacion->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Se ha eliminado con éxito', '20px');
		} else {
			echo show_err_msg('!Error al eliminar!', '20px');
		}
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_operacion->select_all_operacion();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "ID");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "Nama");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "Nomor Telepon");
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "ID Kota");
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, "ID Kelamin");
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, "ID Posisi");
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, "Status");
		$rowCount++;

		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->id); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->nama); 
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('C'.$rowCount, $value->telp, PHPExcel_Cell_DataType::TYPE_STRING);
		    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $value->id_kota); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $value->id_kelamin); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $value->id_posisi); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $value->status); 
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data operacion.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data operacion.xlsx', NULL);
	}

	public function import() {
		$this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] == '') {
			$this->session->set_flashdata('msg', 'File harus diisi');
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
						$id = md5(DATE('ymdhms').rand());
						$check = $this->M_operacion->check_nama($value['B']);

						if ($check != 1) {
							$resultData[$index]['id'] = $id;
							$resultData[$index]['nama'] = ucwords($value['B']);
							$resultData[$index]['telp'] = $value['C'];
							$resultData[$index]['id_kota'] = $value['D'];
							$resultData[$index]['id_kelamin'] = $value['E'];
							$resultData[$index]['id_posisi'] = $value['F'];
							$resultData[$index]['status'] = $value['G'];
						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_operacion->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data operacion Berhasil diimport ke database'));
						redirect('operacion');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data operacion Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('operacion');
				}

			}
		}
	}
}

/* End of file operacion.php */
/* Location: ./application/controllers/operacion.php */
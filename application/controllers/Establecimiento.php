<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Establecimiento extends AUTH_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_establecimiento');
		$this->load->model('M_ciudad');
	}

	public function index()
	{
		$data['userdata'] 	= $this->userdata;
		$data['dataEstablecimiento'] = $this->M_establecimiento->select_all();
		$data['dataMunicipio'] = $this->M_ciudad->select_all();
		$data['dataResponsable'] = $this->M_establecimiento->select_all_responsables();

		$data['page'] 		= "establecimiento";
		$data['cabTitulo'] 	= "Establecimientos";
		$data['cabDescri'] 	= "Administrar Establecimiento";
		
		$data['modal_template_establecimiento'] = show_my_modal('establecimiento/modal', 'modal-establecimiento', $data);
		
		$this->template->views('establecimiento/home', $data);
	}

	public function listado()
	{

		$data['dataEstablecimiento'] = $this->M_establecimiento->select_all();
		$this->load->view('establecimiento/list_data', $data);

		// print_r($data);
	}

	public function procesarEstablecimiento()
	{
		$this->form_validation->set_rules('nombre', 'Establecimiento', 'trim|required');
		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_establecimiento->insert($data);
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

	public function update()
	{
		$data['userdata'] = $this->userdata;
		$id = trim($_POST['id']);
		$data['dataEstablecimiento'] = $this->M_establecimiento->select_by_id($id);
		$data['dataMunicipioupdate'] = $this->M_ciudad->select_all();
		$data['dataResponsableUpdate'] = $this->M_establecimiento->select_all_responsables();

		echo show_my_modal('establecimiento/update', 'update-establecimiento', $data);
	}

	public function prosesUpdate()
	{
		$this->form_validation->set_rules('nombre', 'Establecimiento', 'trim|required');
		$this->form_validation->set_rules('codigo', 'Establecimiento', 'trim|required');
		$this->form_validation->set_rules('municipio', 'Establecimiento', 'trim|required');
		$this->form_validation->set_rules('responsable', 'Establecimiento', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_establecimiento->update($data);

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

	public function delete()
	{
		$id = $_POST['id'];
		$result = $this->M_establecimiento->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Se ha eliminado con éxito', '20px');
		} else {
			echo show_err_msg('Error al eliminar', '20px');
		}
	}

	public function export()
	{
		error_reporting(E_ALL);

		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_establecimiento->select_all();

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', "ID");
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', "Nombre establecimiento");

		$rowCount = 2;
		foreach ($data as $value) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $value->id);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $value->descripcion);
			$rowCount++;
		}

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save('./assets/excel/Data establecimiento.xlsx');

		$this->load->helper('download');
		force_download('./assets/excel/Data establecimiento.xlsx', NULL);
	}

	public function import()
	{
		$this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] == '') {
			$this->session->set_flashdata('msg', 'Se requiere archivo');
		} else {
			$config['upload_path'] = './assets/excel/';
			$config['allowed_types'] = 'xls|xlsx';

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('excel')) {
				$error = array('error' => $this->upload->display_errors());
			} else {
				$data = $this->upload->data();

				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Jakarta');

				include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';

				$inputFileName = './assets/excel/' . $data['file_name'];
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

				$index = 0;
				foreach ($sheetData as $key => $value) {
					if ($key != 1) {
						$check = $this->M_establecimiento->check_nama($value['B']);

						if ($check != 1) {
							$resultData[$index]['descripcion'] = ucwords($value['B']);
						}
					}
					$index++;
				}

				unlink('./assets/excel/' . $data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_establecimiento->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Datos cargados correctamente'));
						redirect('Establecimiento');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Los datos no se pudieron importar', 'warning', 'fa-warning'));
					redirect('Establecimiento');
				}
			}
		}
	}
}

/* End of file Tipoinmueble.php */
/* Location: ./application/controllers/Tipoinmueble.php */
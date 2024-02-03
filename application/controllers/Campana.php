<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Campana extends AUTH_Controller
{ //Pegawai
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_campana');
		$this->load->model('M_tipocampana');
		$this->load->model('M_establecimiento');
	}

	public function index()
	{
		$data['userdata'] = $this->userdata;
		$data['datacampana'] = $this->M_campana->select_all();
		$data['tipocampana'] = $this->M_tipocampana->select_all();
		for ($i = 2019; $i <= date("Y"); $i++)
			$gestiones[] = array('id' => $i);
		$data['gestiones'] = $gestiones;
		$data['page'] = "campana";
		$data['cabTitulo'] = "Campañas";
		$data['cabDescri'] = "Administrar campañas";

		$data['modal_campana'] = show_my_modal('campana/modal', 'modal-campana', $data);

		$this->template->views('campana/home', $data);
	}

	public function listado()
	{
		$data['datacampana'] = $this->M_campana->select_all_campana();
		$this->load->view('campana/list_data', $data);
	}

	public function procesaInsert()
	{
		// $this->form_validation->set_rules('tipo_campana_id', 'Tipo de Campaña', 'trim|required');
		$this->form_validation->set_rules('descripcion', 'Descripción', 'trim|required');
		// $this->form_validation->set_rules('gestion', 'Gestión', 'trim|required');
		$this->form_validation->set_rules('fechaini', 'Fecha Inicio', 'trim|required');
		$this->form_validation->set_rules('fechafin', 'Fecha Final', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_campana->insert($data);

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
		$id = trim($_POST['id']);
		$data['datacampana'] = $this->M_campana->select_by_id($id);
		$data['tipocampana'] = $this->M_tipocampana->select_all();
		for ($i = 2019; $i <= date("Y"); $i++)
			$gestiones[] = array('id' => $i);
		$data['gestiones'] = $gestiones;
		$data['userdata'] = $this->userdata;
		//esto es respuesta ajax
		echo show_my_modal('campana/modal_update', 'update-campana', $data);
	}

	public function procesaUpdate()
	{
		//$this->form_validation->set_rules('tipo_campana_id', 'Tipo de Campaña', 'trim|required');
		$this->form_validation->set_rules('descripcion', 'Descripción', 'trim|required');
		//$this->form_validation->set_rules('gestion', 'Gestión', 'trim|required');
		$this->form_validation->set_rules('fechaini', 'Fecha Inicio', 'trim|required');
		$this->form_validation->set_rules('fechafin', 'Fecha Final', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_campana->update($data);

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

	public function delete()
	{
		$id = $_POST['id'];
		$result = $this->M_campana->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Se ha eliminado con éxito', '20px');
		} else {
			echo show_err_msg('!Error al eliminar!', '20px');
		}
	}


	public function export()
	{
		error_reporting(E_ALL);

		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_campana->select_all_campana();

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$rowCount = 1;

		$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, "ID");
		$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, "Nama");
		$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, "Nomor Telepon");
		$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, "ID Kota");
		$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, "ID Kelamin");
		$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, "ID Posisi");
		$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, "Status");
		$rowCount++;

		foreach ($data as $value) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $value->id);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $value->nama);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit('C' . $rowCount, $value->telp, PHPExcel_Cell_DataType::TYPE_STRING);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $value->id_kota);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $value->id_kelamin);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $value->id_posisi);
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $value->status);
			$rowCount++;
		}

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save('./assets/excel/Data campana.xlsx');

		$this->load->helper('download');
		force_download('./assets/excel/Data campana.xlsx', NULL);
	}

	public function import()
	{
		$this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] == '') {
			$this->session->set_flashdata('msg', 'File harus diisi');
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
						$id = md5(DATE('ymdhms') . rand());
						$check = $this->M_campana->check_nama($value['B']);

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

				unlink('./assets/excel/' . $data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_campana->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data campana Berhasil diimport ke database'));
						redirect('campana');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data campana Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('campana');
				}
			}
		}
	}
	public function establecimiento($id)
	{
		$data['userdata'] = $this->userdata;
		$data['dataestablec'] = $this->M_campana->select_all_establecimientos_de_campana($id);
		$data['dataestablecnombre'] = $this->M_campana->select_all_est();
		// print_r($data['dataestablec']);
		$data['id'] = $id;
		$data['page'] = "campana_est";
		$data['cabTitulo'] = "Adición de establecimientos";
		$data['cabDescri'] = "Administrar establecimientos";
		$data['modal_campanaest'] = show_my_modal('campana/modal_est', 'modal-campana-est', $data);
		$this->template->views('campana/home_est', $data);
	}

	public function listadoEst($id)
	{
		$data['dataestablec'] = $this->M_campana->select_all_establecimientos_de_campana($id);
		$this->load->view('campana/list_data_est', $data);
	}

	public function procesaInsertEst()
	{
		// $this->form_validation->set_rules('tipo_campana_id', 'Tipo de Campaña', 'trim|required');
		$this->form_validation->set_rules('tipo_campana_id_est', 'Establecimiento', 'trim|required');
		// $this->form_validation->set_rules('gestion', 'Gestión', 'trim|required');
		// $this->form_validation->set_rules('fechaini', 'Fecha Inicio', 'trim|required');
		// $this->form_validation->set_rules('fechafin', 'Fecha Final', 'trim|required');

		$data = $this->input->post();
		// echo $data;
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_campana->insertEst($data);
			// echo $result;
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

	public function delete_establecimineto_de_campana()
	{
		$id = $_POST['id'];
		$result = $this->M_campana->delete_establecimineto_de_campana($id);

		if ($result > 0) {
			echo show_succ_msg('Se ha eliminado con éxito', '20px');
		} else {
			echo show_err_msg('!Error al eliminar!', '20px');
		}
	}

	public function update_establecimiento_de_campana()
	{
		$id = $_POST['id'];
		$data['datacampanaest'] = $this->M_campana->select_by_id_est_de_campana($id);
		$data['tipocampanaest'] = $this->M_campana->select_all_est();
		$data['userdata'] = $this->userdata;
		//esto es respuesta ajax
		echo show_my_modal('campana/modal_update_est', 'update-campana-est', $data);
	}


	public function procesaUpdate_est()
	{

		$this->form_validation->set_rules('tipo_campana_id_estab', 'Tipo de Establecimientos', 'trim|required');
		// $this->form_validation->set_rules('descripcion', 'Descripción', 'trim|required');
		//$this->form_validation->set_rules('gestion', 'Gestión', 'trim|required');
		// $this->form_validation->set_rules('fechaini', 'Fecha Inicio', 'trim|required');
		// $this->form_validation->set_rules('fechafin', 'Fecha Final', 'trim|required');


		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_campana->update_establecimiento_de_campana($data);

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
}

/* End of file campana.php */
/* Location: ./application/controllers/campana.php */
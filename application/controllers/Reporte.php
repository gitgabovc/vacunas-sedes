<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reporte extends AUTH_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_campana');
		$this->load->model('M_reporte');
		$this->load->model('M_establecimiento');
	}

	public function index($id = 0, $idCampana = 0)
	{
		$data['userdata'] 	= $this->userdata;
		if ($id != 0) {

			$data['listacampana'] = $this->M_campana->select_campana_con_determinada_gestion($id);
			$data['listaestablecimientos'] = $this->M_campana->select_all_establecimientos_de_campana_a($idCampana);
		} else {
			$data['listacampana'] = $this->M_campana->select_all_campana();
			$data['listaestablecimientos'] = $this->M_establecimiento->select_all();
		}
		$data['idCampana'] = $idCampana;
		for ($i = 2019; $i <= date("Y"); $i++)
			$gestiones[] = array('id' => $i);
		$data['gestiones'] = $gestiones;

		$data['page'] 		= "reporte";
		$data['id'] 		= $id;
		$data['cabTitulo'] 	= "Reportes";
		// $data['cabDescri'] 	= "Administrar Reporte";


		$this->template->views('reporte/home', $data);
	}
	public function reporte_campana($id = 0)
	{
		$data = $this->input->post();
		$data['userdata'] 	= $this->userdata;
		$data['listareportecampana'] = $this->M_campana->select_all_campana();

		$data['page'] 		= "reporte";
		$data['id'] 		= $id;
		$data['cabTitulo'] 	= "Reportes";
		// $data['cabDescri'] 	= "Administrar Reporte";


		$this->template->views('reporte/home', $data);
	}


	public function getsubuni()
	{
		$subunis  = array();
		$idu = $this->input->post("idu");
		$subunis  =  $this->M_reporte->get_subunidades_lst($idu);
		// $subunis  =  $this->unidadesRepository->get_subunidades_lst( $idu );
		echo json_encode($subunis);
	}

	public function getcateprog()
	{
		$cates  = array();
		$ids = $this->input->post("ids");
		$cates  =  $this->M_reporte->get_catesub_lst($ids);
		echo json_encode($cates);
	}

	public function export()
	{
		error_reporting(E_ALL);

		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_caja->select_all();

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$rowCount = 1;

		$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, "ID");
		$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, "Nama Caja");
		$rowCount++;

		foreach ($data as $value) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $value->id);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $value->nama);
			$rowCount++;
		}

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save('./assets/excel/Data Caja.xlsx');

		$this->load->helper('download');
		force_download('./assets/excel/Data Caja.xlsx', NULL);
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
						$check = $this->M_caja->check_nama($value['B']);

						if ($check != 1) {
							$resultData[$index]['nama'] = ucwords($value['B']);
						}
					}
					$index++;
				}

				unlink('./assets/excel/' . $data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_kota->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data Caja Berhasil diimport ke database'));
						redirect('Caja');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data Caja Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('Caja');
				}
			}
		}
	}
	public function generarReporte()
	{
		$tipoReporte = $_POST['tipoReporte'];
		$gestion = $_POST['gestion'];
		$data['gestion'] = $gestion;
		$idCampana = $_POST['campana'];
		$idEstablecimiento = $_POST['establecimiento'];
		if ($tipoReporte == 'detalleCampana') {

			$data['lista']  =  $this->M_reporte->select_hoja_vacunacion($idCampana, $idEstablecimiento, $gestion);
			if ($idCampana == 0 && $idEstablecimiento==0) {
				$data['campana']  =  'Todos';
				$data['establecimiento']  =  'Todos';
			} elseif($idCampana==0) {
				// $data['campana']  =  $idCampana;
				$data['campana']  =  'Todos';


				

				$data['establecimiento']  =  $this->M_establecimiento->select_by_id($idEstablecimiento)->nombre;
			}elseif($idEstablecimiento==0) {
				// $data['campana']  =  $idCampana;
				$data['campana']  =  $this->M_campana->select_by_id_campana($idCampana)->descripcion;
				$data['establecimiento']  =  'Todos';
			} else{
				$data['campana']  =  $this->M_campana->select_by_id_campana($idCampana)->descripcion;
				$data['establecimiento']  =  $this->M_establecimiento->select_by_id($idEstablecimiento)->nombre;
			}
			if (isset($_POST['print'])) {

				$this->load->view('reporte/reportedet', $data);
			} else {

				$this->generarExcel($tipoReporte, $data);
			}
		}
		if ($tipoReporte == 'resumenCampana') {
			$data['lista']  =  $this->M_reporte->select_resumen($gestion, $idCampana, $idEstablecimiento);
			if ($idCampana == 0 && $idEstablecimiento==0) {
				$data['campana']  =  'Todos';
				$data['establecimiento']  =  'Todos';
			} elseif($idCampana==0) {
				// $data['campana']  =  $idCampana;
				$data['campana']  =  'Todos';
				$data['establecimiento']  =  $this->M_establecimiento->select_by_id($idEstablecimiento)->nombre;
			}elseif($idEstablecimiento==0) {
				// $data['campana']  =  $idCampana;
				$data['campana']  =  $this->M_campana->select_by_id_campana($idCampana)->descripcion;
				$data['establecimiento']  =  'Todos';
			} else{
				$data['campana']  =  $this->M_campana->select_by_id_campana($idCampana)->descripcion;
				$data['establecimiento']  =  $this->M_establecimiento->select_by_id($idEstablecimiento)->nombre;
			}
			if (isset($_POST['print'])) {

				$this->load->view('reporte/reporteresumen', $data);
			} else {

				$this->generarExcel($tipoReporte, $data);
			}
		}
		if ($tipoReporte == 'resumenEdades') {
			$data['listaPerros']  =  $this->M_reporte->select_resumen_edades_perros($gestion, $idCampana, $idEstablecimiento);
			$data['listaGatos']  =  $this->M_reporte->select_resumen_edades_gatos($gestion, $idCampana, $idEstablecimiento);
			if ($idCampana == 0 && $idEstablecimiento==0) {
				$data['campana']  =  'Todos';
				$data['establecimiento']  =  'Todos';
			} elseif($idCampana==0) {
				// $data['campana']  =  $idCampana;
				$data['campana']  =  'Todos';
				$data['establecimiento']  =  $this->M_establecimiento->select_by_id($idEstablecimiento)->nombre;
			}elseif($idEstablecimiento==0) {
				// $data['campana']  =  $idCampana;
				$data['campana']  =  $this->M_campana->select_by_id_campana($idCampana)->descripcion;
				$data['establecimiento']  =  'Todos';
			} else{
				$data['campana']  =  $this->M_campana->select_by_id_campana($idCampana)->descripcion;
				$data['establecimiento']  =  $this->M_establecimiento->select_by_id($idEstablecimiento)->nombre;
			}
			if (isset($_POST['print'])) {

				$this->load->view('reporte/reporteresumen_edades', $data);
			} else {

				$this->generarExcel($tipoReporte, $data);
			}
		}
	}

	function generarExcel($tipo, $data)
	{
		error_reporting(E_ALL);

		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$rowCount = 8;
		if ($tipo == 'detalleCampana') {
			$objPHPExcel->getActiveSheet()->SetCellValue('D1', "HOJA RESUMEN DE VACUNACIÓN");
			$objPHPExcel->getActiveSheet()->SetCellValue('A3', "Gestion: " . $data['gestion']);
			$objPHPExcel->getActiveSheet()->SetCellValue('A4', "Campaña: " . $data['campana']);
			$objPHPExcel->getActiveSheet()->SetCellValue('A5', "Establecimiento: " . $data['establecimiento']);

			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, "Nro Brigada");
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, "Fecha");
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, "Nombre Mascota");
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, "Edad Meses");
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, "Edad Años");
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, "Tipo");
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, "Sexo");
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, "Color");
			$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, "Nombre Propietario");
			$rowCount++;

			foreach ($data['lista'] as $value) {
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $value->nrobrigada);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('B' . $rowCount, $value->fecha, PHPExcel_Cell_DataType::TYPE_STRING);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $value->nombreMascota);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $value->edad_meses);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $value->edad_anios);
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $value->tipo);
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $value->sexo);
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $value->color);
				$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $value->nombrePropietario);
				$rowCount++;
			}
		}
		if ($tipo == 'resumenCampana') {
			$objPHPExcel->getActiveSheet()->SetCellValue('D1', "HOJA DE VACUNACIÓN RESUMEN");
			$objPHPExcel->getActiveSheet()->SetCellValue('A3', "Gestion: " . $data['gestion']);
			$objPHPExcel->getActiveSheet()->SetCellValue('A4', "Campaña: " . $data['campana']);
			$objPHPExcel->getActiveSheet()->SetCellValue('A5', "Establecimiento: " . $data['establecimiento']);

			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, "Establecimiento");
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, "Responsable");
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, "Lugar");
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, "# Brigada");
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, "Dosis");
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, "Perros");
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, "Gatos");
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, "Total");
			$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, "%");
			$rowCount++;

			foreach ($data['lista'] as $value) {
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $value->establecimiento);
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, $value->responsable);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $value->lugar);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $value->nrobrigada);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $value->dosis);
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $value->perros);
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $value->gatos);
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $value->vacunas);
				$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, 100 * ($value->vacunas) / ($value->dosis));
				$rowCount++;
			}
		}
		if ($tipo == 'resumenEdades') {
			$objPHPExcel->getActiveSheet()->SetCellValue('D1', "HOJA DE VACUNACIÓN RESUMEN POR EDADES");
			$objPHPExcel->getActiveSheet()->SetCellValue('A3', "Gestion: " . $data['gestion']);
			$objPHPExcel->getActiveSheet()->SetCellValue('A4', "Campaña: " . $data['campana']);
			$objPHPExcel->getActiveSheet()->SetCellValue('A5', "Establecimiento: " . $data['establecimiento']);
			$objPHPExcel->getActiveSheet()->SetCellValue('A7', "Perros");

			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, "Nro Brigada");
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, "Menores a 3 Meses");
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, "Mayor o Igual a 3 Meses y Menores a 1 Año ");
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, "Mayor o Igual a 1 Año");
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, "Total");

			$rowCount++;


			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, "H");
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, "M");
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, "Total");
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, "H");
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, "M");
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, "Total");
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, "H");
			$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, "M");
			$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, "Total");
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, "H");
			$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, "M");
			$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, "Total");
			$rowCount++;

			foreach ($data['listaPerros'] as $value) {
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $value->nrobrigada);
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, $value->menortresmesesH);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $value->menortresmesesM);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, ($value->menortresmesesM) + ($value->menortresmesesH));
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $value->mayorigualtresmesesymenorunanioH);
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $value->mayorigualtresmesesymenorunanioM);
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, ($value->mayorigualtresmesesymenorunanioM) + ($value->mayorigualtresmesesymenorunanioH));
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $value->mayorigualunanioH);
				$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $value->mayorigualunanioM);
				$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, ($value->mayorigualunanioM) + ($value->mayorigualunanioH));
				$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, ($value->menortresmesesH) + ($value->mayorigualunanioH) + ($value->mayorigualtresmesesymenorunanioH));
				$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, ($value->menortresmesesM) + ($value->mayorigualunanioM) + ($value->mayorigualtresmesesymenorunanioM));
				$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, ($value->menortresmesesH) + ($value->mayorigualunanioH) + ($value->mayorigualtresmesesymenorunanioH) + ($value->menortresmesesM) + ($value->mayorigualunanioM) + ($value->mayorigualtresmesesymenorunanioM));
				$rowCount++;
			}

			$rowCount += 3;

			$objPHPExcel->getActiveSheet()->SetCellValue('A' . ($rowCount - 1), "Gatos");

			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, "Nro Brigada");
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, "Menores a 3 Meses");
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, "Mayor o Igual a 3 Meses y Menores a 1 Año ");
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, "Mayor o Igual a 1 Año");
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, "Total");

			$rowCount++;


			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, "H");
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, "M");
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, "Total");
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, "H");
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, "M");
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, "Total");
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, "H");
			$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, "M");
			$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, "Total");
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, "H");
			$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, "M");
			$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, "Total");
			$rowCount++;

			foreach ($data['listaGatos'] as $value) {
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $value->nrobrigada);
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, $value->menortresmesesH);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $value->menortresmesesM);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, ($value->menortresmesesM) + ($value->menortresmesesH));
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $value->mayorigualtresmesesymenorunanioH);
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $value->mayorigualtresmesesymenorunanioM);
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, ($value->mayorigualtresmesesymenorunanioM) + ($value->mayorigualtresmesesymenorunanioH));
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $value->mayorigualunanioH);
				$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $value->mayorigualunanioM);
				$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, ($value->mayorigualunanioM) + ($value->mayorigualunanioH));
				$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, ($value->menortresmesesH) + ($value->mayorigualunanioH) + ($value->mayorigualtresmesesymenorunanioH));
				$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, ($value->menortresmesesM) + ($value->mayorigualunanioM) + ($value->mayorigualtresmesesymenorunanioM));
				$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, ($value->menortresmesesH) + ($value->mayorigualunanioH) + ($value->mayorigualtresmesesymenorunanioH) + ($value->menortresmesesM) + ($value->mayorigualunanioM) + ($value->mayorigualtresmesesymenorunanioM));
				$rowCount++;
			}
		}

		// $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		// $objWriter->save('./assets/excel/Data campana.xlsx');
		// $this->load->helper('download');
		// force_download('./assets/excel/Data campana.xlsx', NULL);

		$filename = $tipo." ". date('Ymd_Hm') . '.xlsx';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Content-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		ob_end_clean();
		$objWriter->save('php://output');
	}
}

/* End of file Caja.php */

/* Location: ./application/controllers/Caja.php */


// echo 'hola';
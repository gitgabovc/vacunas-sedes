<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_campana extends CI_Model
{

	public function select_all_campana()
	{
		$this->db->select('*');
		$this->db->from('campana');
		$this->db->where('del_at IS NULL');
		$data = $this->db->get();
		return $data->result();
	}
	public function select_campana_con_id($idCampana)
	{
		$this->db->select('*');
		$this->db->from('campana');
		$this->db->where('del_at IS NULL');
		$this->db->where('id', $idCampana);
		$data = $this->db->get();
		return $data->result();
	}
	public function select_campana_con_determinada_gestion($id)
	{
		$this->db->select('*');
		$this->db->from('campana');
		$this->db->where('del_at IS NULL');
		$this->db->where('gestion', $id);
		$data = $this->db->get();
		return $data->result();
	}
	public function select_all_campana_cinco_dias()
	{
		$fechaActual = date("Y-m-d");
		$fechaMin = date("Y-m-d", strtotime($fechaActual . "- 5 days"));
		$fechaMax = date("Y-m-d", strtotime($fechaActual . "+ 5 days"));


		$sql = "SELECT * FROM campana 
		WHERE  del_at IS NULL AND fechaini BETWEEN '{$fechaMin}' AND '{$fechaMax}'";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function select_all()
	{
		$sql = " SELECT * FROM campana ORDER BY fechaini DESC";
		$data = $this->db->query($sql);
		return $data->result();
	}
	public function select_estado($est)
	{
		$sql = "SELECT * FROM campana WHERE estado = '$est'";
		$data = $this->db->query($sql);
		return $data->result();
	}
	// $this->db->select('*');
	// $this->db->from('campana');
	// $this->db->where('del_at IS NULL');
	// $this->db->where("fechaini BETWEEN $fechaMin AND `$fechaMax`");
	// $data = $this->db->get();
	// return $data->result();


	// $sql = "SELECT * FROM fechas 
	// WHERE  fechas.id = '{$id}'";
	// $data = $this->db->query($sql);
	// return $data->row();

	public function select_tipos()
	{
		$sql = "SELECT * FROM tipocampana";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function select_by_id($id)
	{
		$sql = "SELECT * FROM campana 
		WHERE  campana.id = '{$id}'";
		$data = $this->db->query($sql);
		return $data->row();
	}
	public function select_by_id_campana($id)
	{
		$sql = "SELECT * FROM campana 
		WHERE  campana.id = '{$id}'";
		$data = $this->db->query($sql);
		return $data->row();
	}

	public function update($data)
	{
		$fecha = date("Y-m-d h:m:s");
		$sql = "UPDATE campana SET tipo_campana_id='" . $data['tipo_campana_id']
			. "', descripcion='" . $data['descripcion']
			. "', gestion='" . $data['gestion']
			. "', fechaini='" . $data['fechaini']
			. "', fechafin='" . $data['fechafin']
			. "', mod_at = '$fecha'  WHERE id='" . $data['id'] . "'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function delete($id)
	{
		$fecha = date("Y-m-d h:m:s");
		//$sql = "DELETE FROM campana WHERE id='" .$id ."'";
		$sql = "UPDATE campana SET del_at = '$fecha' WHERE id='" . $id . "'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	public function l($id)
	{
		$fecha = date("Y-m-d h:m:s");
		//$sql = "DELETE FROM establecimiento WHERE id='" .$id ."'";
		$sql = "UPDATE establecimiento SET del_at = '$fecha' WHERE id='" . $id . "'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function insert($data)
	{
		$fecha = date("Y-m-d h:m:s");
		$sql = "INSERT INTO campana (tipo_campana_id, descripcion, gestion, fechaini, fechafin, add_at)
		VALUES('" . $data['tipo_campana_id'] . "','" . $data['descripcion'] . "','" . $data['gestion'] . "','" .
			$data['fechaini'] . "','" . $data['fechafin'] . "','$fecha')";
		//estado = D disponible
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function insert_batch($data)
	{
		$this->db->insert_batch('campana', $data);
		return $this->db->affected_rows();
	}

	public function total_rows()
	{
		$data = $this->db->get('campana');
		return $data->num_rows();
	}

	public function select_all_establecimientos_de_campana($id)
	{

		$this->db->select('fechas.*,nombre,codigo'); // select *
		$this->db->from('fechas'); // tabla
		$this->db->join('establecimiento', 'fechas.establecimiento_id=establecimiento.id'); // tabla
		// validado
		$this->db->where('fechas.del_at IS NULL');
		$this->db->where('campana_id', $id);
		// $this->db->order_by('id');
		return $this->db->get()->result();
	}
	public function select_all_establecimientos_de_campana_a($id)
	{

		$this->db->select('nombre,codigo,establecimiento.id'); // select *
		$this->db->from('fechas'); // tabla
		$this->db->join('establecimiento', 'fechas.establecimiento_id=establecimiento.id'); // tabla
		// validado
		$this->db->where('fechas.del_at IS NULL');
		$this->db->where('establecimiento.del_at IS NULL');
		$this->db->where('campana_id', $id);
		// $this->db->order_by('id');
		return $this->db->get()->result();
	}

	public function insert_establecimineto_a_campana($data)
	{
		$fecha = date("Y-m-d h:m:s");
		$sql = "INSERT INTO campana (tipo_campana_id, descripcion, gestion, fechaini, fechafin, add_at)
		VALUES('" . $data['tipo_campana_id'] . "','" . $data['descripcion'] . "','" . $data['gestion'] . "','" .
			$data['fechaini'] . "','" . $data['fechafin'] . "','$fecha')";
		//estado = D disponible
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function select_all_est()
	{

		$this->db->select('*'); // select *
		$this->db->from('establecimiento'); // tabla
		return $this->db->get()->result();
	}

	public function insertEst($data)
	{
		$fecha = date("Y-m-d h:m:s");
		$sql = "INSERT INTO fechas (establecimiento_id, campana_id,add_at)
		VALUES('" . $data['tipo_campana_id_est'] . "','" . $data['id-camp-est']  .  "','$fecha')";
		//estado = D disponible
		$this->db->query($sql);
		return $this->db->affected_rows();
	}


	public function delete_establecimineto_de_campana($id)
	{
		$fecha = date("Y-m-d h:m:s");
		//$sql = "DELETE FROM campana WHERE id='" .$id ."'";
		$sql = "UPDATE fechas SET del_at = '$fecha' WHERE id='" . $id . "'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}


	public function select_by_id_est_de_campana($id)
	{
		$sql = "SELECT * FROM fechas 
		WHERE  fechas.id = '{$id}'";
		$data = $this->db->query($sql);
		return $data->row();
	}

	public function update_establecimiento_de_campana($data)
	{
		$fecha = date("Y-m-d h:m:s");
		$sql = "UPDATE fechas SET establecimiento_id='" . $data['tipo_campana_id_estab']
			. "', mod_at = '$fecha'  WHERE id='" . $data['id'] . "'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
}

/* End of file M_campana.php */
/* Location: ./application/models/M_campana.php */
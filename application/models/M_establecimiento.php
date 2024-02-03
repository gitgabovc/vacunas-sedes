<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_establecimiento extends CI_Model
{

	public function select_all()
	{

		$this->db->select('establecimiento.*,municipio.nombre as nombreMunicipio,r.nombre as nombreResponsable '); // select *
		$this->db->from('establecimiento'); // tabla
		$this->db->join('municipio', 'municipio.id=establecimiento.municipio_id'); // tabla
		$this->db->join('responsable r', 'r.id=establecimiento.responsable_id'); // tabla
		$this->db->where('establecimiento.del_at IS NULL');
		return $this->db->get()->result();
	}
	public function select_all_responsables()
	{

		$this->db->select('r.id,r.nombre'); // select *
		$this->db->from('responsable r'); // tabla
		$this->db->where('r.del_at IS NULL');
		return $this->db->get()->result();
	}

	public function select_by_id($id)
	{
		$sql = "SELECT * FROM establecimiento WHERE id = '{$id}'";
		$data = $this->db->query($sql);
		return $data->row();
	}

	public function insert($data)
	{
		$fecha = date("Y-m-d h:m:s");
		$sql = "INSERT INTO establecimiento (nombre, add_at,codigo,responsable_id,municipio_id)
		VALUES('" . $data['nombre'] . "','$fecha','" . $data['codigo'] . "','" . $data['responsable_id'] . "','" . $data['municipio'] . "')";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function insert_batch($data)
	{
		$this->db->insert_batch('establecimiento', $data);
		return $this->db->affected_rows();
	}

	public function update($data)
	{
		$fecha = date("Y-m-d h:m:s");
		$sql = "UPDATE establecimiento SET nombre='" . $data['nombre'] . "', mod_at = '$fecha',codigo='" . $data['codigo'] . "',responsable_id='" . $data['responsable']  . "',municipio_id = '" . $data['municipio']  . "' WHERE id='" . $data['id'] . "'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function delete($id)
	{
		$fecha = date("Y-m-d h:m:s");
		//$sql = "DELETE FROM establecimiento WHERE id='" .$id ."'";
		$sql = "UPDATE establecimiento SET del_at = '$fecha' WHERE id='" . $id . "'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function check_desc($desc)
	{
		$this->db->where('nombre', $desc);
		$data = $this->db->get('establecimiento');
		return $data->num_rows();
	}

	public function total_rows()
	{
		$data = $this->db->get('establecimiento');
		return $data->num_rows();
	}
}

/* End of file M_ciudad.php */
/* Location: ./application/models/M_ciudad.php */
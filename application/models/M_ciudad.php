<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_ciudad extends CI_Model
{

	public function select_all()
	{
		$this->db->select('*');
		$this->db->from('municipio');
		//selecciona cuando es nulo
		$this->db->where('del_at IS NULL');
		$data = $this->db->get();
		return $data->result();
	}

	public function select_by_id($id)
	{
		$sql = "SELECT * FROM municipio WHERE id = '{$id}'";
		$data = $this->db->query($sql);
		return $data->row();
	}

	public function insert($data)
	{
		$fecha = date("Y-m-d h:m:s");
		$sql = "INSERT INTO municipio (nombre, add_at) VALUES('" . $data['nombre'] . "','$fecha')";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function insert_batch($data)
	{
		$this->db->insert_batch('municipio', $data);
		return $this->db->affected_rows();
	}

	public function update($data)
	{
		$fecha = date("Y-m-d h:m:s");
		$sql = "UPDATE municipio SET nombre='" . $data['nombre'] . "', mod_at = '$fecha' WHERE id='" . $data['id'] . "'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function delete($id)
	{
		$fecha = date("Y-m-d h:m:s");
		//$sql = "DELETE FROM municipio WHERE id='" .$id ."'";
		$sql = "UPDATE municipio SET del_at = '$fecha' WHERE id='" . $id . "'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function check_desc($desc)
	{
		$this->db->where('nombre', $desc);
		$data = $this->db->get('municipio');
		return $data->num_rows();
	}

	public function total_rows()
	{
		$data = $this->db->get('municipio');
		return $data->num_rows();
	}
}

/* End of file M_ciudad.php */
/* Location: ./application/models/M_ciudad.php */
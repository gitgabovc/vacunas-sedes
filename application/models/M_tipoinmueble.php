<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tipoinmueble extends CI_Model {
	
	public function select_all() {
		$this->db->select('*');
		$this->db->from('tipoinmueble');
		$data = $this->db->get();
		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM tipoinmueble WHERE id = '{$id}'";
		$data = $this->db->query($sql);
		return $data->row();
	}

	public function insert($data) {
		$sql = "INSERT INTO tipoinmueble VALUES('','" .$data['descripcion'] ."')";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('tipoinmueble', $data);		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE tipoinmueble SET descripcion='" .$data['tipoinmueble'] ."' WHERE id='" .$data['id'] ."'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM tipoinmueble WHERE id='" .$id ."'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function check_desc($desc) {
		$this->db->where('descripcion', $desc);
		$data = $this->db->get('tipoinmueble');
		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('tipoinmueble');
		return $data->num_rows();
	}
}

/* End of file M_tipoinmueble.php */
/* Location: ./application/models/M_tipoinmueble.php */
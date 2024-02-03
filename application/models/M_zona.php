<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_zona extends CI_Model {
	
	public function select_all() {
		$this->db->select('*');
		$this->db->from('zona');
		$data = $this->db->get();
		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM zona WHERE id = '{$id}'";
		$data = $this->db->query($sql);
		return $data->row();
	}

	public function insert($data) {
		$sql = "INSERT INTO zona VALUES('','" .$data['descripcion'] ."')";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('zona', $data);		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE zona SET descripcion='" .$data['zona'] ."' WHERE id='" .$data['id'] ."'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM zona WHERE id='" .$id ."'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function check_desc($desc) {
		$this->db->where('descripcion', $desc);
		$data = $this->db->get('zona');
		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('zona');
		return $data->num_rows();
	}
}

/* End of file M_zona.php */
/* Location: ./application/models/M_zona.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

	public function select($id = '') {
		if ($id != '') {
			$this->db->where('id', $id);
		}
		$data = $this->db->get('admin');
		return $data->row();
	}

	public function select_all() {
		$sql = " SELECT * FROM admin WHERE password is not null";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function update($data, $id) {
		$this->db->where("id", $id);
		$this->db->update("admin", $data);
		return $this->db->affected_rows();
	}

	public function insert($data) {
		$fechadd = date("Y-m-d h:m:s");
		$password = md5($data['password']);
		$sql = "INSERT INTO admin (username, password, nama, foto) VALUES('" .
		$data['usuario']."','" . $password ."','" .$data['nombre'] ."'," .$data['foto'] .")";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "UPDATE admin SET password = NULL WHERE id='" .$id ."'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */
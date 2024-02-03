<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_usuario extends CI_Model {
	public function select_all_usuario() {
		$sql = "SELECT * FROM usuario";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function select_all() {
		$sql = " SELECT uu.id, uu.nombre, uu.usuario, ee.nombre as establecimiento
		FROM usuario uu
		INNER JOIN establecimiento ee ON ee.id = uu.establecimiento_id";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "uu.id, uu.nombre, uu.usuario, ee.nombre as establecimiento
		FROM usuario uu
		INNER JOIN establecimiento ee on ee.id = uu.establecimiento_id
		WHERE uu.id = '{$id}'";
		$data = $this->db->query($sql);
		return $data->row();
	}

	public function select_by_posisi($id) {
		$sql = "SELECT COUNT(*) AS jml FROM usuario WHERE id_posisi = {$id}";
		$data = $this->db->query($sql);
		return $data->row();
	}

	public function select_by_kota($id) {
		$sql = "SELECT COUNT(*) AS jml FROM usuario WHERE id_kota = {$id}";
		$data = $this->db->query($sql);
		return $data->row();
	}

	public function update($data) {
		$sql = "UPDATE usuario SET nama='" .$data['nama'] 
		."', telp='" .$data['telp'] ."', id_kota=" .$data['kota'] .", id_kelamin=" 
		.$data['jk'] .", id_posisi=" .$data['posisi'] 
		." WHERE id='" .$data['id'] ."'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM usuario WHERE id='" .$id ."'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function insert($data) {
		$fechadd = date("Y-m-d h:m:s");
		$password = md5($data['password']);
		$sql = "INSERT INTO usuario (usuario, password, nombre, establecimiento_id, estado, add_at) VALUES('" .
		$data['usuario']."','" . $password ."','" .$data['nombre'] ."'," .$data['idestablecimiento'] .",'A','$fechadd')";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('usuario', $data);		
		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('usuario');
		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('usuario');
		return $data->num_rows();
	}
}

/* End of file M_usuario.php */
/* Location: ./application/models/M_usuario.php */
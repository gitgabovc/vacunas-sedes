<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tipocampana extends CI_Model {
	
	public function select_all() {
		$this->db->select('*');
		$this->db->from('tipo_campana');
		$this->db->where('del_at IS NULL');
		$data = $this->db->get();
		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM tipo_campana WHERE id = '{$id}'";
		$data = $this->db->query($sql);
		return $data->row();
	}

	public function insert($data) {
		$fecha = date("Y-m-d h:m:s");
		$sql = "INSERT INTO tipo_campana (descripcion, add_at) VALUES('" .$data['descripcion'] ."','$fecha')";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('tipo_campana', $data);		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$fecha = date("Y-m-d h:m:s");
		$sql = "UPDATE tipo_campana SET descripcion='" .$data['descripcion'] ."', mod_at = '$fecha' WHERE id='" .$data['id'] ."'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function delete($id) {
		$fecha = date("Y-m-d h:m:s");
		//$sql = "DELETE FROM municipio WHERE id='" .$id ."'";
		$sql = "UPDATE tipo_campana SET del_at = '$fecha' WHERE id='" .$id ."'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function check_desc($desc) {
		$this->db->where('descripcion', $desc);
		$data = $this->db->get('tipo_campana');
		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('tipo_campana');
		return $data->num_rows();
	}
	public function referenciado($idTipoCampana) {
		$this->db->where('tipo_campana_id', $idTipoCampana);
		$data = $this->db->get('campana');
		return $data->num_rows();
	}
}

/* End of file M_ciudad.php */
/* Location: ./application/models/M_ciudad.php */
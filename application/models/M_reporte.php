<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_reporte extends CI_Model
{

	public function select_hoja_vacunacion($idCampana, $idEstablecimiento, $gestion)
	{

		$this->db->select('c.gestion,f.establecimiento_id,c.id,b.nrobrigada,v.fecha_vacuna as fecha, m.nombre as nombreMascota, m.edad_meses as edad_meses, m.edad_anios as edad_anios, m.tipo as tipo, m.sexo as sexo, m.color as color, p.nombre as nombrePropietario');
		$this->db->from('campana c');
		$this->db->join('fechas f', 'c.id=f.campana_id');
		$this->db->join('brigadas b', 'b.fechas_id=f.id');
		$this->db->join('vacunas v', 'b.id=v.brigadas_id');
		$this->db->join('mascota m', 'v.mascota_id = m.id');
		$this->db->join('propietario p', 'm.propietario_id = p.id');
		if ($gestion != 0) {
		$this->db->where('c.gestion', $gestion);
		}
		$this->db->where('v.vacunado','S');
		if ($idCampana != 0) {
			$this->db->where('c.id', $idCampana);
		}
		if ($idEstablecimiento != 0) {
			$this->db->where('f.establecimiento_id', $idEstablecimiento);
		}
		$this->db->where('c.del_at IS NULL');
		return $this->db->get()->result();

		// SELECT c.gestion,c.id,f.fecha, m.nombre as nombreMascota, m.edad_meses, m.tipo, m.sexo, m.color, p.nombre as nombrePropietario
		// FROM campana c
		// JOIN fechas f ON c.id=f.campana_id
		// JOIN vacunas v on f.id=v.fechas_id
		// JOIN mascota m ON v.mascota_id = m.id
		// JOIN propietario p ON m.propietario_id = p.id
	}

	public function select_resumen($gestion, $idCampana, $idEstablecimiento)
	{

		$this->db->select("c.id as idCampana, f.establecimiento_id as IdEstablecimiento,e.nombre as establecimiento, r.nombre as responsable, b.lugar, b.nrobrigada,b.dosis, COUNT(v.id) as vacunas, SUM(IF(m.tipo='p',1,0)) as perros,SUM(IF(m.tipo='g',1,0)) as gatos");
		$this->db->from('campana c');
		$this->db->join('fechas f', 'c.id=f.campana_id');
		$this->db->join('establecimiento e', 'e.id=f.establecimiento_id');
		$this->db->join('brigadas b', 'f.id=b.fechas_id');
		$this->db->join('responsable r', 'r.id =b.responsable_id');
		$this->db->join('vacunas v', 'v.brigadas_id = b.id', 'left');
		$this->db->join('mascota m', 'm.id = v.mascota_id', 'left');
		if ($gestion != 0) {
		$this->db->where('c.gestion', $gestion);
		}
		$this->db->where('c.del_at IS NULL');
		$this->db->where('v.vacunado', 'S');
		if ($idCampana != 0) {
			$this->db->where('c.id', $idCampana);
		}
		if ($idEstablecimiento != 0) {
			$this->db->where('f.establecimiento_id', $idEstablecimiento);
		}
		$this->db->group_by('b.id');
		return $this->db->get()->result();

		// SELECT c.descripcion as campana, e.nombre as establecimiento, r.nombre as responsable, b.lugar, b.nrobrigada,b.dosis, COUNT(v.id) as vacunas, SUM(IF(m.tipo='p',1,0)) as perros,SUM(IF(m.tipo='g',1,0)) as gatos
		// FROM campana c
		// JOIN fechas f ON f.campana_id=c.id
		// JOIN establecimiento e ON e.id=f.establecimiento_id
		// JOIN brigadas b ON b.fechas_id=f.id
		// JOIN responsable r ON r.id = b.responsable_id
		// LEFT JOIN vacunas v ON v.brigadas_id = b.id
		// LEFT JOIN mascota m ON m.id = v.mascota_id
		// GROUP BY b.id
		// ORDER BY 1


	}
	public function select_resumen_edades_perros($gestion, $idCampana, $idEstablecimiento)
	{

		$this->db->select("c.descripcion as campana, b.nrobrigada as nrobrigada, e.id,
			SUM(IF(m.edad_meses<3 AND m.edad_anios=0,IF(m.sexo='H',1,0),0)) as menortresmesesH,
			SUM(IF(m.edad_meses<3 AND m.edad_anios=0,IF(m.sexo='m',1,0),0)) as menortresmesesM,
			SUM(IF(m.edad_meses>=3 AND m.edad_anios<1,IF(m.sexo='H',1,0),0)) as mayorigualtresmesesymenorunanioH,
			SUM(IF(m.edad_meses>=3 AND m.edad_anios<1,IF(m.sexo='m',1,0),0)) as mayorigualtresmesesymenorunanioM,
			SUM(IF( m.edad_anios>=1,IF(m.sexo='H',1,0),0)) as mayorigualunanioH,
			SUM(IF( m.edad_anios>=1,IF(m.sexo='m',1,0),0)) as mayorigualunanioM,
			SUM(IF( m.sexo='H',1,0)) as TotalH,
			SUM(IF( m.sexo='m',1,0)) as TotalM
		");
		$this->db->from('campana c');
		$this->db->join('fechas f', 'c.id=f.campana_id');
		$this->db->join('establecimiento e', 'e.id=f.establecimiento_id');
		$this->db->join('brigadas b', 'f.id=b.fechas_id');
		$this->db->join('vacunas v', 'v.brigadas_id = b.id', 'left');
		$this->db->join('mascota m', 'm.id = v.mascota_id', 'left');
		if ($gestion != 0) {
		$this->db->where('c.gestion', $gestion);
		}
		$this->db->where('c.del_at IS NULL');
		$this->db->where("m.tipo", "p");
		$this->db->where('v.vacunado', 'S');
		if ($idCampana != 0) {
			$this->db->where('c.id', $idCampana);
		}
		if ($idEstablecimiento != 0) {
			$this->db->where('f.establecimiento_id', $idEstablecimiento);
		}
		$this->db->group_by('b.id');
		return $this->db->get()->result();

		// SELECT c.descripcion as campana, b.nrobrigada, e.id
		// SUM(IF(m.edad_meses<3 AND m.edad_anios=0,IF(m.sexo='H',1,0),0)) as '<3meses H',
		// SUM(IF(m.edad_meses<3 AND m.edad_anios=0,IF(m.sexo='m',1,0),0)) as '<3meses M',
		// SUM(IF(m.edad_meses>=3 AND m.edad_anios<1,IF(m.sexo='H',1,0),0)) as '>=3meses y <1anio H',
		// SUM(IF(m.edad_meses>=3 AND m.edad_anios<1,IF(m.sexo='m',1,0),0)) as '>=3meses y <1anio M',
		// SUM(IF( m.edad_anios>=1,IF(m.sexo='H',1,0),0)) as '>=1anio H',
		// SUM(IF( m.edad_anios>=1,IF(m.sexo='m',1,0),0)) as '>=1anio M',
		// SUM(IF( m.sexo='H',1,0)) as 'Total H',
		// SUM(IF( m.sexo='m',1,0)) as 'Total M'
		// FROM campana c
		// JOIN fechas f ON f.campana_id=c.id
		//JOIN establecimiento e ON e.id=f.establecimiento_id
		// JOIN brigadas b ON b.fechas_id=f.id
		// LEFT JOIN vacunas v ON v.brigadas_id = b.id
		// LEFT JOIN mascota m ON m.id = v.mascota_id
		// WHERE m.tipo = 'p'
		// GROUP BY b.id


	}

	public function select_resumen_edades_gatos($gestion, $idCampana, $idEstablecimiento)
	{

		$this->db->select("c.descripcion as campana, b.nrobrigada as nrobrigada, e.id,
			SUM(IF(m.edad_meses<3 AND m.edad_anios=0,IF(m.sexo='H',1,0),0)) as menortresmesesH,
			SUM(IF(m.edad_meses<3 AND m.edad_anios=0,IF(m.sexo='m',1,0),0)) as menortresmesesM,
			SUM(IF(m.edad_meses>=3 AND m.edad_anios<1,IF(m.sexo='H',1,0),0)) as mayorigualtresmesesymenorunanioH,
			SUM(IF(m.edad_meses>=3 AND m.edad_anios<1,IF(m.sexo='m',1,0),0)) as mayorigualtresmesesymenorunanioM,
			SUM(IF( m.edad_anios>=1,IF(m.sexo='H',1,0),0)) as mayorigualunanioH,
			SUM(IF( m.edad_anios>=1,IF(m.sexo='m',1,0),0)) as mayorigualunanioM,
			SUM(IF( m.sexo='H',1,0)) as TotalH,
			SUM(IF( m.sexo='m',1,0)) as TotalM
		");
		$this->db->from('campana c');
		$this->db->join('fechas f', 'c.id=f.campana_id');
		$this->db->join('establecimiento e', 'e.id=f.establecimiento_id');
		$this->db->join('brigadas b', 'f.id=b.fechas_id');
		$this->db->join('vacunas v', 'v.brigadas_id = b.id', 'left');
		$this->db->join('mascota m', 'm.id = v.mascota_id', 'left');
		if ($gestion != 0) {
		$this->db->where('c.gestion', $gestion);
		}
		$this->db->where('c.del_at IS NULL');
		$this->db->where("m.tipo", "g");
		$this->db->where('v.vacunado', 'S');
		if ($idCampana != 0) {
			$this->db->where('c.id', $idCampana);
		}
		if ($idEstablecimiento != 0) {
			$this->db->where('f.establecimiento_id', $idEstablecimiento);
		}
		$this->db->group_by('b.id');
		return $this->db->get()->result();

		// SELECT c.descripcion as campana, b.nrobrigada, e.id
		// SUM(IF(m.edad_meses<3 AND m.edad_anios=0,IF(m.sexo='H',1,0),0)) as '<3meses H',
		// SUM(IF(m.edad_meses<3 AND m.edad_anios=0,IF(m.sexo='m',1,0),0)) as '<3meses M',
		// SUM(IF(m.edad_meses>=3 AND m.edad_anios<1,IF(m.sexo='H',1,0),0)) as '>=3meses y <1anio H',
		// SUM(IF(m.edad_meses>=3 AND m.edad_anios<1,IF(m.sexo='m',1,0),0)) as '>=3meses y <1anio M',
		// SUM(IF( m.edad_anios>=1,IF(m.sexo='H',1,0),0)) as '>=1anio H',
		// SUM(IF( m.edad_anios>=1,IF(m.sexo='m',1,0),0)) as '>=1anio M',
		// SUM(IF( m.sexo='H',1,0)) as 'Total H',
		// SUM(IF( m.sexo='m',1,0)) as 'Total M'
		// FROM campana c
		// JOIN fechas f ON f.campana_id=c.id
		//JOIN establecimiento e ON e.id=f.establecimiento_id
		// JOIN brigadas b ON b.fechas_id=f.id
		// LEFT JOIN vacunas v ON v.brigadas_id = b.id
		// LEFT JOIN mascota m ON m.id = v.mascota_id
		// WHERE m.tipo = 'g'
		// GROUP BY b.id


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

	public function get_subunidades_lst($idu)
	{
		//devuelve las subunidades como matriz
		if ($idu > 0)  // de una subunidad
			$sql = "SELECT id, descripcion, fechaini
			   FROM campana
			   WHERE del_at IS NULL AND gestion = $idu";
		else // de todas las subunidades
			$sql = "SELECT su.*, un.codigo as ucod
				 FROM subunidad su
				 INNER JOIN unidad un ON un.id = su.unidad_id
				 ORDER BY un.codigo, su.codigo";
		$query = $this->db->query($sql);
		// si hay resultados 
		if ($query->num_rows() > 0) {
			// almacenamos en una matriz bidimensional
			foreach ($query->result_array() as $row) {
				$data[$row['id']] = $row['descripcion'] . ' ( ' . $row['fechaini'] . ' )';
			}
		} else {
			$data = array();
		}
		return $data;
	}

	public function get_catesub_lst($ids)
	{
		//devuelve las cate progs de una usbuni dada, como array 
		if ($ids > 0) {

			$sql = " SELECT nombre, establecimiento.id as id
			FROM  fechas
			INNER JOIN establecimiento ON fechas.establecimiento_id=establecimiento.id
			WHERE fechas.del_at IS NULL AND establecimiento.del_at IS NULL AND campana_id = $ids" ;
		} else {

			$sql = " SELECT fechas.* ,nombre
			FROM  fechas
			INNER JOIN establecimiento ON fechas.establecimiento_id=establecimiento.id
			WHERE fechas.del_at IS NULL AND establecimiento.del_at IS NULL";
		}

		$query = $this->db->query($sql);
		$data = array();
		// si hay resultados 
		if ($query->num_rows() > 0) {
			// almacenamos en una matriz bidimensional 
			foreach ($query->result_array() as $row) {
				$data[$row['id']] = $row['nombre'];
			}
		}
		return $data;
	}
}

/* End of file M_campana.php */
/* Location: ./application/models/M_campana.php */
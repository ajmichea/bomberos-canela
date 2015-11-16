<?php
class MPanel extends CI_Model{

	public function insertar($data){
		$this -> db -> insert('usuarios',$data);
	}

	public function consultarUsuario($data){
		$this -> db -> select('*');
		$this -> db -> from('usuarios');
		$this -> db -> where('username',$data['username']);
		$this -> db -> where('password',$data['password']);
		$consulta = $this -> db -> get();
		$resultado = $consulta -> row();
		return $resultado;
	}

	public function creargaleria($galeria,$imagen){
		if ($imagen == '') {
			$this-> db -> insert('galeria',$galeria);
			$id = $this-> db ->insert_id();
			return $id;
		}else{
			$this-> db -> insert('galeria',$galeria);
			$id = $this-> db ->insert_id();
			/*$id=mysql_insert_id();*/
			$this -> cargarimagen($id,$imagen);
		}
	}

	public function recuperarultimo(){
		return $this-> db ->insert_id();
	}

	public function consultargalerias($nomgaleria){
		if ($nomgaleria != '') {
			$this-> db -> select('nombre_galeria');
			$this-> db -> from('galeria');
			$this-> db -> where('nombre_galeria',$nomgaleria);
			$consulta = $this-> db ->get();
			$resultado = $consulta ->row();
			return $resultado;
		}else{
			$this-> db -> select('*');
			$this-> db -> from('galeria');
			$this-> db ->order_by('nombre_galeria','asc');
			$consulta = $this-> db -> get();
			if ($consulta->num_rows() > 0) {
				return $consulta->result();
			}
		}			
	}

	public function insertaregistro($dato, $datos){
		$this -> db -> insert($dato['tabla'], $datos['valores']);
		$respuesta = $this->db->affected_rows();
		return $respuesta;
	}

	public function listar($data){
		$this-> db -> select($data['campos']);
		$this-> db -> from($data['tabla']);
		if ($data['donde'] != '') {
			$this-> db -> where($data['donde'],$data['igual']);
		}		
		$consulta = $this-> db ->get();
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}else{
			return array('resultado'=>'0');
		}
	}

	public function eliminar($datos){
		$this -> db -> where($datos['donde'],$datos['igual']);
		$this -> db -> delete($datos['tabla']);
		return $this-> db ->affected_rows();
	}

	public function eliminarArchivo($datos){
		define('PUBPATH',str_replace(SELF,'',FCPATH)); 
		$archivo = PUBPATH.$datos['ubicacion'];
		unlink($archivo);
	}

	public function modificar($datos,$mod){
		$this -> db -> where($datos['donde'],$datos['igual']);
		$this -> db -> update($datos['tabla'],$mod);
		return $this-> db ->affected_rows();
	}

	public function modificarmultiples_pk($datos,$mod){
		$this -> db -> where($datos['donde'],$datos['igual']);
		$this -> db -> where($datos['donde2'],$datos['igual2']);
		$this -> db -> update($datos['tabla'],$mod);
		return $this-> db ->affected_rows();
	}

	public function cargarimagen($galeria,$imagen){
		date_default_timezone_set('America/Santiago');
		$fecha=date("Y/m/d");

		$fotogaleria = array('id_galeria' => $galeria,
							'nom_foto' => $imagen,
							'ubicacion_foto' => base_url().'Imagenes/Galeria/'.$imagen,
							'fech_ing_foto' => $fecha,
							'estado_foto' => '1');
		$this-> db -> insert('fotos',$fotogaleria);
	}	

	public function crearconsejo($datos){
		$this-> db -> insert('consejo',$datos);
		$id = $this-> db ->insert_id();
		return $id;
	}
	 
	public function consultarconsejos($nomconsejo){
	 	if ($nomconsejo != '') {
			$this-> db -> select('*');
			$this-> db -> from('consejo c');
			$this-> db -> join('parrafo p','c.id_consejo = p.id_consejo');
			$this-> db -> join('imagen_parrafo ip','c.id_consejo = ip.id_consejo');
			$this-> db -> where('c.id_consejo',$nomconsejo);
			$this-> db -> order_by('fech_consejo','asc');
			$consulta = $this-> db ->get();
			$resultado = $consulta ->result();
			return $resultado;
		}else{
			$this-> db -> select('*');
			$this-> db -> from('consejo');
			$this-> db -> order_by('fech_consejo','asc');
			$consulta = $this-> db -> get();
			if ($consulta->num_rows() > 0) {
				return $consulta->result();
			}
		}

	}

	/*
	===========================================================================
	===========================================================================
	*/

	public function crearpublicacion($datos){
		$this-> db -> insert('publicacion_inicial',$datos);
		$id = $this-> db ->insert_id();
		return $id;
	}

	public function consultarpublicacion($nompublicacion){
	 	if ($nompublicacion != '') {
			$this-> db -> select('*');
			$this-> db -> from('publicacion_inicial p');
			$this-> db -> join('contenido_publicacion cp','p.id_publicacion = cp.id_publicacion');
			$this-> db -> where('p.id_publicacion',$nompublicacion);
			$this-> db -> order_by('fech_publicacion','asc');
			$consulta = $this-> db ->get();
			$resultado = $consulta ->result();
			return $resultado;
		}else{
			$this-> db -> select('*');
			$this-> db -> from('publicacion_inicial');
			$this-> db -> order_by('fech_publicacion','des');
			$consulta = $this-> db -> get();
			if ($consulta->num_rows() > 0) {
				return $consulta->result();
			}
		}

	}

	/*
	===========================================================================
	===========================================================================
	*/

	public function consultarefemeride($nomefemeride){
	 	if ($nomefemeride != '') {
			$this-> db -> select('*');
			$this-> db -> from('efemeride');
			$this-> db -> where('id_efemeride',$nomefemeride);
			$this-> db -> order_by('nombre_efemeride','asc');
			$consulta = $this-> db ->get();
			$resultado = $consulta ->result();
			return $resultado;
		}else{
			$this-> db -> select('*');
			$this-> db -> from('efemeride');
			$this-> db -> order_by('nombre_efemeride','asc');
			$consulta = $this-> db -> get();
			if ($consulta->num_rows() > 0) {
				return $consulta->result();
			}
		}

	}
}
?>
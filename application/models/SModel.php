<?php
/**
* 
*/
class SModel extends CI_Model{
	
	public function cargarnoticias(){
		$this-> db -> select('*');
		$this-> db -> from('publicacion_inicial');
		$this-> db -> where('estado_publicacion','1');
		$this-> db -> order_by('fech_publicacion desc');
		$consulta = $this->db->get();
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}

	public function cargarnoticiascontenido($id){
		$this-> db -> select('*');
		$this-> db -> from('publicacion_inicial p');
		$this-> db -> join('contenido_publicacion c','p.id_publicacion = c.id_publicacion');
		$this-> db -> where('p.id_publicacion',$id);
		$this-> db -> where('estado_publicacion','1');
		$consulta = $this->db->get();
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}

	public function cargarnoticiasfull(){
		$this-> db -> select('*');
		$this-> db -> from('publicacion_inicial p');
		$this-> db -> join('contenido_publicacion c','p.id_publicacion = c.id_publicacion');
		$this-> db -> where('estado_publicacion','1');
		$this-> db -> order_by('fech_publicacion desc');
		$consulta = $this->db->get();
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}

	public function cargargalerias(){
		$this-> db -> select('*');
		$this-> db -> from('galeria g');
		$this-> db -> join('fotos f', 'g.id_galeria=f.id_galeria');
		$this-> db -> where('estado_galeria','1');
		$this-> db -> where('estado_foto','1');
		$consulta = $this->db->get();
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}

	public function lista($data){
		$this-> db -> select($data['campos']);
		$this-> db -> from($data['tabla']);
		$this-> db -> where($data['donde'],$data['igual']);
		$this-> db -> order_by($data['orden'],'desc');
		$consulta = $this-> db ->get();
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}

	

	public function listar($data){
		$this-> db -> select($data['campos']);
		$this-> db -> from($data['tabla']);
		$this-> db -> join($data['inner'],$data['union']);
		if (isset($data['union2'])) {
			$this-> db -> join($data['inner2'],$data['union2']);
		}
		$this-> db -> where($data['donde'],$data['igual']);
		$this-> db -> where($data['donde2'],$data['igual2']);
		$this-> db -> order_by($data['orden'],'desc');
				
		$consulta = $this-> db ->get();
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}

	public function listarefemeride($data){
		$this-> db -> select($data['campos']);
		$this-> db -> from($data['tabla']);
		$this-> db -> where($data['donde'],$data['igual']);
		$this-> db -> order_by($data['orden'],'asc');
		$this-> db -> order_by($data['orden2'],'asc');
				
		$consulta = $this-> db ->get();
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}
}
?>
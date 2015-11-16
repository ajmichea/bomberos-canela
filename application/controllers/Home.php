<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this -> load -> model('SModel');
	}

	public function Index(){
		$data["titulo"] = "Home";

		$data['noticias'] = $this->SModel->cargarnoticias();
		$hogar=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'1','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$trabajo=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'2','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$comunidad=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'3','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');

		$con1 = array('tabla'=>'banner','campos'=>'*','donde'=>'estado_banner','igual'=>'1','orden'=>'id_banner');
		$data['banners'] = $this->SModel->lista($con1);
		$con2 = array('tabla'=>'contenido_publicacion','campos'=>'id_publicacion, id_banner','donde'=>'id_banner !=','igual'=>'NULL','orden'=>'id_banner');
		$data['bannerspublicaciones'] = $this->SModel->lista($con2);

		$data['conhogar'] = $this->SModel->listar($hogar);
		$data['contrabajo'] = $this->SModel->listar($trabajo);
		$data['concomunidad'] = $this->SModel->listar($comunidad);

		$this -> load -> view("Header/header", $data);
		$this -> load -> view("bomberos/home");
		$this -> load -> view("Footer/footer");
	}

	public function Noticias($id){
		$data["titulo"] = "Noticias";

		$hogar=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'1','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$trabajo=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'2','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$comunidad=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'3','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$data['conhogar'] = $this->SModel->listar($hogar);
		$data['contrabajo'] = $this->SModel->listar($trabajo);
		$data['concomunidad'] = $this->SModel->listar($comunidad);

		$data['noticias'] = $this->SModel->cargarnoticias();
		if ($id != 'Destacadas') {
			$data['noticia'] = $this->SModel->cargarnoticiascontenido($id);	
		}
		$data['noticiasFull'] = $this->SModel->cargarnoticiasfull();

		$this -> load -> view("Header/header", $data);
		$this -> load -> view("bomberos/noticias");
		$this -> load -> view("Footer/footer");

	}

	public function Prevencion($id){
		$data["titulo"] = "Prevención y Seguridad";

		if ($id != 'Destacadas') {
			$seguir = true;
			$tipo = '';
			$iden = '';
			$total_caracteres = strlen($id);
			for ($i=0; $i < $total_caracteres ; $i++) { 
				if ($id[$i] != '_' && $seguir) {
					$tipo = $tipo.$id[$i];
				}else{
					$seguir = false;
					$iden = $iden.$id[$i];
				}
			}
			$iden = str_replace('_', '', $iden);
			$data['peticion'] = array('tipo'=>$tipo,'identificador'=>$iden);	
		}

		$hogar=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'1','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$trabajo=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'2','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$comunidad=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'3','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$data['conhogar'] = $this->SModel->listar($hogar);
		$data['contrabajo'] = $this->SModel->listar($trabajo);
		$data['concomunidad'] = $this->SModel->listar($comunidad);

		$hogar=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'1','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','inner2'=>'parrafo p','union2'=>'c.id_consejo=p.id_consejo','orden'=>'fech_consejo');
		$trabajo=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'2','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','inner2'=>'parrafo p','union2'=>'c.id_consejo=p.id_consejo','orden'=>'fech_consejo');
		$comunidad=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'3','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','inner2'=>'parrafo p','union2'=>'c.id_consejo=p.id_consejo','orden'=>'fech_consejo');
		$data['conhogarfull'] = $this->SModel->listar($hogar);
		$data['contrabajofull'] = $this->SModel->listar($trabajo);
		$data['concomunidadfull'] = $this->SModel->listar($comunidad);

		$this -> load -> view("Header/header", $data);
		$this -> load -> view("bomberos/prevencion");
		$this -> load -> view("Footer/footer");
	}

	
	public function Efemerides(){
		$data["titulo"] = "Efemerides";

		$hogar=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'1','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$trabajo=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'2','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$comunidad=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'3','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$data['conhogar'] = $this->SModel->listar($hogar);
		$data['contrabajo'] = $this->SModel->listar($trabajo);
		$data['concomunidad'] = $this->SModel->listar($comunidad);

		for ($i=1; $i <=12 ; $i++) {
			if ($i < 10) {
			 	$mes = '0'.$i;	
			}else{
				$mes = $i;
			} 
			$efe = array('tabla'=>'efemeride','campos'=>'*','orden'=>'Month(efemeride.FECHA_EFEMERIDE)','orden2'=>'Day(efemeride.FECHA_EFEMERIDE)','donde'=>'Month(efemeride.FECHA_EFEMERIDE)','igual'=>$mes);
			$data['efemeride'.$i] = $this->SModel->listarefemeride($efe);
		}

		$this -> load -> view("Header/header",$data);
		$this -> load -> view("bomberos/efemerides");
		$this -> load -> view("Footer/footer");

	}

	public function Historia(){
		$data["titulo"] = "Historia";

		$hogar=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'1','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$trabajo=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'2','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$comunidad=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'3','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$data['conhogar'] = $this->SModel->listar($hogar);
		$data['contrabajo'] = $this->SModel->listar($trabajo);
		$data['concomunidad'] = $this->SModel->listar($comunidad);

		$this -> load -> view("Header/header",$data);
		$this -> load -> view("bomberos/historia");
		$this -> load -> view("Footer/footer");

	}

	public function Himno(){
		$data["titulo"] = "Himno";

		$hogar=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'1','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$trabajo=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'2','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$comunidad=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'3','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$data['conhogar'] = $this->SModel->listar($hogar);
		$data['contrabajo'] = $this->SModel->listar($trabajo);
		$data['concomunidad'] = $this->SModel->listar($comunidad);

		$this -> load -> view("Header/header",$data);
		$this -> load -> view("bomberos/himno");
		$this -> load -> view("Footer/footer");

	}

	public function Galeria(){
		$data["titulo"] = "Galerias";
		$data['galeria'] = $this->SModel->cargargalerias();

		$hogar=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'1','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$trabajo=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'2','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$comunidad=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'3','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$data['conhogar'] = $this->SModel->listar($hogar);
		$data['contrabajo'] = $this->SModel->listar($trabajo);
		$data['concomunidad'] = $this->SModel->listar($comunidad);

		$this -> load -> view("Header/header",$data);
		$this -> load -> view("bomberos/galeria");
		$this -> load -> view("Footer/footer");

	}

	public function Contacto(){
		$data["titulo"] = "Contacto";

		$hogar=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'1','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$trabajo=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'2','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$comunidad=array('tabla'=>'consejo c','campos'=>'*','donde'=>'c.id_tipoconsejo','igual'=>'3','donde2'=>'c.estado_consejo','igual2'=>'1','inner'=>'imagen_parrafo i','union'=>'c.id_consejo=i.id_consejo','orden'=>'fech_consejo');
		$data['conhogar'] = $this->SModel->listar($hogar);
		$data['contrabajo'] = $this->SModel->listar($trabajo);
		$data['concomunidad'] = $this->SModel->listar($comunidad);

		$this -> load -> view("Header/header",$data);
		$this -> load -> view("bomberos/contacto");
		$this -> load -> view("Footer/footer");

	}
}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this -> load -> library('session');
		$this -> load -> model('MPanel');
	}

	public function index(){

		if (!$this-> session->userdata('usuario')) {
			$this -> load -> view('Panel/login');
		}else{
			redirect('Panel/Administrador');
		}		
	}

	public function Ingreso(){

		if ($this-> session->userdata('usuario')) {
			redirect('Panel/Administrador');			
		}else{
			$this-> form_validation->set_rules('username','Username','required|xss_clean');
			$this-> form_validation->set_rules('password','Password','required|md5|xss_clean');
			$this-> form_validation->set_message('required','Debe completar el campo %s');

			if ($this-> form_validation->run() == FALSE) {
				$this-> index();
			}else{
				$datos = array('username' => $this->input->post('username'), 'password' => $this->input->post('password') );
				$usuario = $this-> MPanel-> consultarUsuario($datos);
				if ($usuario) {
					if ($usuario->estado_usuario == 0) {
						$data["datoError"] = "Usuario deshabilitado del sistema. Contáctese con el administrador.";
					$this -> load -> view('Panel/login', $data);
					}else{
						$dato_usuario = array('usuario' => $usuario->nombre_usuario,'permisos'=>$usuario->privilegio_usuario,'username'=>$usuario->username);
						$this->session->set_userdata($dato_usuario); /*puede ('nombre variable','valor variable')*/
						redirect('Panel/Administrador');
					}						
				}else{
					$data["datoError"] = "Usuario no registrado";
					$this -> load -> view('Panel/login', $data);
				}
			}
		}
	}

	public function administrador(){
		if ($this-> session->userdata('usuario')) {
			$this->session->unset_userdata('error');
			$this->session->unset_userdata('aviso');
			$this->session->unset_userdata('con_id_user');
			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/contenido');
			$this -> load -> view('Panel/Administracion/footer');
		}else{
			redirect('Panel');
		}
	}

	public function logout(){
		$this-> session-> sess_destroy();
		redirect('Panel');
	}

	/*
	====================================================================================
	====================================================================================
	*/

	public function usuarios(){
		if ($this->session->userdata('usuario')) {
			$this -> load -> view('Panel/Administracion/header');
			if ($this->session->userdata('aviso')) {
				$data['aviso'] = $this->session->userdata('aviso');
				$this -> load -> view('Panel/Administracion/Usuarios/usuario',$data);
			}else{
				if ($this->session->userdata('error')) {
					$data['error'] = $this->session->userdata('error');
					$this -> load -> view('Panel/Administracion/Usuarios/usuario', $data);
				}else{
					$this -> load -> view('Panel/Administracion/Usuarios/usuario');
				}
			}
			
			$this -> load -> view('Panel/Administracion/footer');

			$this->session->unset_userdata('error');
			$this->session->unset_userdata('aviso');
		}else{
			redirect('Panel');
		}
	}

	public function agregarusuario(){
		if ($this->session->userdata('usuario')) {
			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Usuarios/usuario');
			if ($this->session->userdata('error')) {
				$data['error'] = $this->session->userdata('error');
				$this -> load -> view('Panel/Administracion/Usuarios/nuevousuario',$data);
			}else{
				$this -> load -> view('Panel/Administracion/Usuarios/nuevousuario');
			}
			$this -> load -> view('Panel/Administracion/footer');
			$this->session->unset_userdata('error');
			$this->session->unset_userdata('aviso');
			$this->session->unset_userdata('con_id_user');
		}else{
			redirect('Panel');
		}
	}

	public function guardarusuario(){
		if ($this->session->userdata('usuario')) {
			$this->form_validation->set_rules('username','Username','required|trim|max_length[50]|xss_clean');
			$this->form_validation->set_rules('nom','Nombre','required|trim|max_length[50]|xss_clean');
			$this->form_validation->set_rules('ape','Apellido','required|trim|max_length[50]|xss_clean');
			$this->form_validation->set_rules('rut','Cedula de Identidad','required|trim|min_length[11]|max_length[12]|xss_clean');
			$this->form_validation->set_rules('mail','e-mail','required|trim|max_length[50]|valid_email|xss_clean');
			$this->form_validation->set_rules('password1','Password','required|trim|xss_clean|md5');
			$this->form_validation->set_rules('password2','Comfirmación de Password','required|trim|xss_clean|md5');
			$this->form_validation->set_rules('privilegios','Nivel de Privilegios','required|trim|xss_clean');

			$this->form_validation->set_message('required','Debe ingresar %s');
			$this->form_validation->set_message('max_length','No debe sobrepasar los 50 caracteres en el campo %s');
			$this->form_validation->set_message('valid_email','Dirección e-mail no valida');
			if ($this->form_validation->run() == false) {
				$this->agregarusuario();
			}else{
				if ($this->input->post('password1') == $this->input->post('password2')) {
					if ($this->validarrut($this->input->post('rut'))) {
						$ubicacion = array('tabla'=>'usuarios');
						$datos['valores'] = array('username'=>$this->input->post('username'),'password'=>$this->input->post('password1'),
												  'nombre_usuario'=>$this->input->post('nom'),'apellido_usuario'=>$this->input->post('ape'),
												  'cedula_usuario'=>$this->input->post('rut'),'mail_usuario'=>$this->input->post('mail'),
												  'privilegio_usuario'=>$this->input->post('privilegios'),'estado_usuario'=>'1');
						$resp = $this->MPanel->insertaregistro($ubicacion,$datos);
						if ($resp > 0) {
							$nota = array('aviso'=>'Acción realizada con exito');
							$this->session->set_userdata($nota);
							$this->usuarios();
						}else{
							$nota = array('error'=>'Acción NO completada');
							$this->session->set_userdata($nota);
							$this->usuarios();
						}
					}else{
						$nota = array('error'=>'El rut ingresado no es valido');
						$this->session->set_userdata($nota);
						$this->agregarusuario();
					}					
				}else{
					$nota = array('error'=>'Las contraseñas deben ser identicas');
					$this->session->set_userdata($nota);
					$this->agregarusuario();
				}
			}
		}else{
			redirect('Panel');
		}
	}

	public function modificarusuario(){
		if ($this->session->userdata('usuario')) {
			if ($this->session->userdata('con_id_user')) {
				$query = array('tabla'=>'usuarios','campos'=>'*','donde'=>'id_usuario','igual'=>$this->session->userdata('con_id_user'));
			}else{
				$query = array('tabla'=>'usuarios','campos'=>'*','donde'=>'id_usuario','igual'=>$this->input->post('idusuario'));
			}
			
			$data['usuarios'] = $this->MPanel->listar($query);
			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Usuarios/usuario');
			if ($this->session->userdata('error')) {
				$data['error'] = $this->session->userdata('error');
				$this -> load -> view('Panel/Administracion/Usuarios/modificarusuario',$data);
			}else{
				$this -> load -> view('Panel/Administracion/Usuarios/modificarusuario',$data);
			}
			$this -> load -> view('Panel/Administracion/footer');
			$this->session->unset_userdata('error');
			$this->session->unset_userdata('aviso');
			$this->session->unset_userdata('con_id_user');
		}else{
			redirect('Panel');
		}
	}

	public function seleccionarusuario(){
		if ($this->session->userdata('usuario')) {
			$query = array('tabla'=>'usuarios','campos'=>'*','donde'=>'');
			$data['usuarios'] = $this->MPanel->listar($query);
			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Usuarios/usuario');
			if ($this->session->userdata('error')) {
				$data['error'] = $this->session->userdata('error');
				$this -> load -> view('Panel/Administracion/Usuarios/seleccionarusuario',$data);
			}else{
				$this -> load -> view('Panel/Administracion/Usuarios/seleccionarusuario',$data);
			}
			$this -> load -> view('Panel/Administracion/footer');
			$this->session->unset_userdata('error');
			$this->session->unset_userdata('aviso');
			$this->session->unset_userdata('con_id_user');
		}else{
			redirect('Panel');
		}
	}

	public function actualizarusuario(){
		if ($this->session->userdata('usuario')) {
			$this->form_validation->set_rules('username','Username','required|trim|max_length[50]|xss_clean');
			$this->form_validation->set_rules('nom','Nombre','required|trim|max_length[50]|xss_clean');
			$this->form_validation->set_rules('ape','Apellido','required|trim|max_length[50]|xss_clean');
			$this->form_validation->set_rules('rut','Cedula de Identidad','required|trim|min_length[11]|max_length[12]|xss_clean');
			$this->form_validation->set_rules('mail','e-mail','required|trim|max_length[50]|valid_email|xss_clean');
			$this->form_validation->set_rules('password1','Password','required|trim|max_length[50]|xss_clean|md5');
			$this->form_validation->set_rules('password2','Comfirmación de Password','required|trim|max_length[50]|xss_clean|md5');
			$this->form_validation->set_rules('privilegios','Nivel de Privilegios','required|trim|xss_clean');

			$this->form_validation->set_message('required','Debe ingresar %s');
			$this->form_validation->set_message('max_length','No debe sobrepasar los 50 caracteres en el campo %s');
			$this->form_validation->set_message('valid_email','Dirección e-mail no valida');
			if ($this->form_validation->run() == false) {
				$this->modificarusuario();
			}else{
				if ($this->input->post('password1') == $this->input->post('password2')) {
					if ($this->validarrut($this->input->post('rut'))) {
						$ubicacion = array('tabla'=>'usuarios','donde'=>'id_usuario','igual'=>$this->input->post('idusuario'));
						$datos = array('username'=>$this->input->post('username'),'password'=>$this->input->post('password1'),
												  'nombre_usuario'=>$this->input->post('nom'),'apellido_usuario'=>$this->input->post('ape'),
												  'cedula_usuario'=>$this->input->post('rut'),'mail_usuario'=>$this->input->post('mail'),
												  'privilegio_usuario'=>$this->input->post('privilegios'),'estado_usuario'=>'1');
						$resp = $this->MPanel->modificar($ubicacion,$datos);
						if ($resp > 0) {
							$nota = array('aviso'=>'Acción realizada con exito');
							$this->session->set_userdata($nota);
							$this->usuarios();
						}else{
							$nota = array('error'=>'Acción NO completada');
							$this->session->set_userdata($nota);
							$this->usuarios();
						}
					}else{
						$nota = array('error'=>'El rut ingresado no es valido');
						$this->session->set_userdata($nota);
						$this->modificarusuario();
					}					
				}else{
					$nota = array('error'=>'Las contraseñas deben ser identicas');
					$this->session->set_userdata($nota);
					$this->modificarusuario();
				}
			}
		}else{
			redirect('Panel');
		}
	}

	public function deshabilitarusuario(){
		if ($this->session->userdata('usuario')) {
			$datostabla = array('tabla'=>'usuarios','donde'=>'id_usuario','igual'=>$this->input->post('idusuario'));
			$datosmodificar = array('estado_usuario'=>'0');
			$this->MPanel->modificar($datostabla,$datosmodificar);
			$aviso = array('aviso'=>'Acción realizada');
			$this->session->set_userdata($aviso);
			$this->usuarios();
		}else{
			redirect('Panel');
		}
	}

	public function habilitarusuario(){
		if ($this->session->userdata('usuario')) {
			$datostabla = array('tabla'=>'usuarios','donde'=>'id_usuario','igual'=>$this->input->post('idusuario'));
			$datosmodificar = array('estado_usuario'=>'1');
			$this->MPanel->modificar($datostabla,$datosmodificar);
			$aviso = array('aviso'=>'Acción realizada');
			$this->session->set_userdata($aviso);
			$this->usuarios();
		}else{
			redirect('Panel');
		}
	}

	public function eliminarusuario(){
		if ($this->session->userdata('usuario')) {
			$datos = array('tabla'=>'usuarios','donde'=>'id_usuario','igual'=>$this->input->post('idusuario'));
			$borrado = $this->MPanel->eliminar($datos);	
			if ($borrado > 0) {
				$aviso = array('aviso'=>'Acción realizada');			
			}else{
				$aviso = array('aviso'=>'Acción NO realizada');
			}
			$this->session->set_userdata($aviso);
			$this->usuarios();
		}else{
			redirect('Panel');
		}
	}

	public function validarrut($rut){
		$rut=str_replace('.', '', $rut);
	    if (preg_match('/^(\d{1,9})-((\d|k|K){1})$/',$rut,$d)) {
	        $s=1;$r=$d[1];for($m=0;$r!=0;$r/=10)$s=($s+$r%10*(9-$m++%6))%11;
	        return chr($s?$s+47:75)==strtoupper($d[2]);
	    }
	}

	/*
	====================================================================================
	====================================================================================
	*/

	public function galeria(){
		if ($this-> session->userdata('usuario')) {
			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Galeria/galeria');
			$this -> load -> view('Panel/Administracion/footer');
		}else{
			redirect('Panel');
		}
	}

	public function notificaciongaleria($notificacion){
		if ($this-> session->userdata('usuario')) {
			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Galeria/galeria',$notificacion);
			$this -> load -> view('Panel/Administracion/footer');
		}else{
			redirect('Panel');
		}
	}

	public function nuevagaleria(){
		if ($this-> session->userdata('usuario')) {
			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Galeria/galeria');
			$this -> load -> view('Panel/Administracion/Galeria/nuevagaleria');
			$this -> load -> view('Panel/Administracion/footer');
		}else{
			redirect('Panel');
		}
	}

	public function cargargaleria(){
		if ($this->session->userdata('usuario')) {
			$this-> form_validation->set_rules('galeria','Galeria','required');
			$this-> form_validation->set_message('required','Debe ingresar una %s');
			$contador = $this->input->post('cont');

			if ($this->form_validation->run() == FALSE) {
				$this->nuevagaleria();
			
			}else{

				date_default_timezone_set('America/Santiago');
				$fecha=date("Y/m/d");
				 
				$galeria = array('nombre_galeria' => $this->input->post('galeria'),
							'id_cliente' => '1',
							'fech_galeria' => $fecha,
							'estado_galeria' => '1');
				$existe = $this-> MPanel ->consultargalerias($this->input->post('galeria'));
				if ($existe) {
					$data['aviso'] = 'Ya se encuentra registrada una galería con el nombre seleccionado';
					$this -> notificaciongaleria($data);
				}else{
					if ($contador > 0) {/* Terminado*/
						$fotos = 0;
						$ini = 0;
						$comprobar = 0;
						
						$reg_ngaleria = FALSE;
						while ($comprobar <= $contador) {
							if ($comprobar == 0) {
								$c = '';
							}else{
								$c = $comprobar;
							}
							if ($_FILES['userfile'.$c]['name'] != '') {
								$reg_ngaleria = TRUE;
							}
							$comprobar++;
						}

						if ($reg_ngaleria) {
							$imagen = '';
							$id_galeria = $this-> MPanel->creargaleria($galeria,$imagen);
							
							while ($ini <= $contador) {
								if ($ini == 0) {
									$ini2='';
								}else{
									$ini2 = $ini;
								}
								if ($_FILES['userfile'.$ini2]['name'] != '') {
									$_FILES['userfile']['name'] = $_FILES['userfile'.$ini2]['name'];
									$_FILES['userfile']['tmp_name'] = $_FILES['userfile'.$ini2]['tmp_name'];
									$_FILES['userfile']['size'] = $_FILES['userfile'.$ini2]['size'];
									$_FILES['userfile']['type'] = $_FILES['userfile'.$ini2]['type'];
									$ub = 'Imagenes/Galeria/';
									$up_imagen = $this->subir_imagen($ub);

									if(!is_array($up_imagen)){
										$fotos++;
										$this-> MPanel->cargarimagen($id_galeria,$up_imagen);
										$data = array('aviso' => 'Acción realizada con exito. Se han cargado '.$fotos.' imagenes a su galería.');
									}else{
										if ($fotos == 0) {
											$data = array('aviso' => $up_imagen['error']);
										}										
									}
								}
								$ini++;
							}
							$this -> notificaciongaleria($data);
						}else{
							$data['error'] = 'Debe al menos ingresar una imagen al crear una nueva Galería.';
							$data['input_usuario'] = $this->input->post('galeria');
							$this -> load -> view('Panel/Administracion/header');
							$this -> load -> view('Panel/Administracion/Galeria/galeria');
							$this -> load -> view('Panel/Administracion/Galeria/nuevagaleria',$data);
							$this -> load -> view('Panel/Administracion/footer');
						}

					}else{ 
						if ($_FILES['userfile']['name'] != '') {
							$ub = 'Imagenes/Galeria/';
							$up_imagen = $this->subir_imagen($ub);

							if(!is_array($up_imagen)){
								$this-> MPanel->creargaleria($galeria,$up_imagen);
								$data = array('aviso' => 'Acción realizada con exito');
								$this -> notificaciongaleria($data);
							}else{
								$data = array('aviso' => $up_imagen['error']);
								$this -> notificaciongaleria($data);
							}
						}else{
							$data['error'] = "Debe ingresar una Imagen";
							$data['input_usuario'] = $this->input->post('galeria');
							$this -> load -> view('Panel/Administracion/header');
							$this -> load -> view('Panel/Administracion/Galeria/galeria');
							$this -> load -> view('Panel/Administracion/Galeria/nuevagaleria',$data);
							$this -> load -> view('Panel/Administracion/footer');
						}
					}
				}
			}
		}else{
			redirect('Panel');
		}
	}

	public function subir_imagen($ubicacion_img){

		$config['upload_path'] = $ubicacion_img;
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] = 50*1024;
		/*$config['max_width'] = '1024';
		$config['max_heigth'] = '1024';*/
		$config['remove_spaces'] = TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload()) {
			$error = array('error' => $this->upload->display_errors());
			return $error;
		}else{
			$datos = $this->upload->data();
			return $datos['file_name'];
		}
	}

	public function modificargaleria(){
		if ($this-> session->userdata('usuario')) {
			$data['combo'] = $this -> MPanel->consultargalerias('');
			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Galeria/galeria');
			$this -> load -> view('Panel/Administracion/Galeria/modificargaleria',$data);
			$this -> load -> view('Panel/Administracion/footer');
		}else{
			redirect('Panel');
		}
	}

	public function cargardivImg(){
		if ($this-> session->userdata('usuario')) {
			$data['combo'] = $this -> MPanel->consultargalerias('');
			if ($this->input->post('galerias') != '') {
				if ($this->input->post('radiobtns') != '') {
					$opc = $this->input->post('radiobtns');
					$id_galeria = $this->input->post('idgaleria');
					$est_galeria = $this->input->post('estgaleria');
					$cant_foto = $this->input->post('totalfoto');
					switch ($opc) {
						case 'rdoAG':
							$dato = array('tabla'=>'galeria','donde'=>'id_galeria','igual'=>$id_galeria);
							$dato2 = array('estado_galeria'=>'1');
							$this -> MPanel -> modificar($dato,$dato2);
							$data['exito'] = 'Acción realizada con éxito';
							break;

						case 'rdoDG':
							$dato = array('tabla'=>'galeria','donde'=>'id_galeria','igual'=>$id_galeria);
							$dato2 = array('estado_galeria'=>'0');
							$this -> MPanel -> modificar($dato,$dato2);
							$data['exito'] = 'Acción realizada con éxito';
							break;
						
						case 'rdoBG':
							$totalbox = $this->input->post('totalbox');
							if ($totalbox < $this->input->post('totalboxDs')) {
								$totalbox = $this->input->post('totalboxDs');
							}
							$contador = 1;
							$base = base_url();
							while ($contador < $totalbox) {
								$ubicacion = str_replace($base, '', $this->input->post('fotobox'.$contador));
								$dato = array('ubicacion' => $ubicacion);
								$this -> MPanel -> eliminarArchivo($dato);

								$ubicacion = str_replace($base, '', $this->input->post('fotoboxDs'.$contador));
								$dato = array('ubicacion' => $ubicacion);
								$this -> MPanel -> eliminarArchivo($dato);
								
								$contador++;
							}
							$dato = array('tabla'=>'fotos','donde'=>'id_galeria','igual'=>$id_galeria);
							$this -> MPanel ->eliminar($dato);
							$dato = array('tabla'=>'galeria','donde'=>'id_galeria','igual'=>$id_galeria);
							$this -> MPanel ->eliminar($dato);
							$data['exito'] = 'Acción realizada con éxito';
							break;

						case 'rdoNI':
							$contador = $this->input->post('cont');
							$ini = 0;
							$fotos = 0;
							if ($contador > 0) {
								while ($ini <= $contador) {
									if ($ini == 0) {
										$ini2='';
									}else{
										$ini2 = $ini;
									}
									if ($_FILES['userfile'.$ini2]['name'] != '') {
										$_FILES['userfile']['name'] = $_FILES['userfile'.$ini2]['name'];
										$_FILES['userfile']['tmp_name'] = $_FILES['userfile'.$ini2]['tmp_name'];
										$_FILES['userfile']['size'] = $_FILES['userfile'.$ini2]['size'];
										$_FILES['userfile']['type'] = $_FILES['userfile'.$ini2]['type'];
										$ub = 'Imagenes/Galeria/';
										$up_imagen = $this->subir_imagen($ub);

										if(!is_array($up_imagen)){
											$fotos++;
											$this-> MPanel->cargarimagen($id_galeria,$up_imagen);
											$data['exito'] = 'Acción realizada con éxito. Se han cargado '.$fotos.' imagenes a su galería.';
										}else{
											if ($fotos == 0) {
												$data['error'] = 'Acción no realizada';
											}										
										}
									}
									$ini++;
								}
							}else{
								if ($_FILES['userfile']['name'] != '') {
									$ub = 'Imagenes/Galeria/';
									$up_imagen = $this->subir_imagen($ub);

									if(!is_array($up_imagen)){
										$this->MPanel->cargarimagen($id_galeria,$up_imagen);
										$data['exito'] = 'Acción realizada con éxito';
										$this -> notificaciongaleria($data);
									}else{
										$data['error'] = 'Acción no realizada';
										$this -> notificaciongaleria($data);
									}
								}else{
									$data['error'] = "Debe ingresar una Imagen";
								}
							}
								
							break;

						case 'rdoDI':
							$totalbox = $this->input->post('totalbox');
							$contador = 1;
							while ($contador < $totalbox) {
								if ($this->input->post('box'.$contador)) {
									$dato = array('tabla'=>'fotos','donde'=>'id_foto','igual'=>$this->input->post('box'.$contador));
									$dato2 = array('estado_foto'=>'0');
									$this -> MPanel -> modificar($dato,$dato2);
								}
								$contador++;
							}
							if ($contador > 1) {
								$data['exito'] = 'Acción realizada con éxito';
							}else{
								$data['error'] = 'No ha seleccionado imagen para deshabilitar';
							}
							break;

						case 'rdoAI':
							$totalbox = $this->input->post('totalboxDs');
							$contador = 1;
							while ($contador < $totalbox) {
								if ($this->input->post('boxDs'.$contador)) {
									$dato = array('tabla'=>'fotos','donde'=>'id_foto','igual'=>$this->input->post('boxDs'.$contador));
									$dato2 = array('estado_foto'=>'1');
									$this -> MPanel -> modificar($dato,$dato2);
								}
								$contador++;
							}
							if ($contador > 1) {
								$data['exito'] = 'Acción realizada con éxito';
							}else{
								$data['error'] = 'No ha seleccionado imagen para habilitar';
							}
							break;

						case 'rdoBI':
							$totalbox = $this->input->post('totalbox');
							if ($totalbox < $this->input->post('totalboxDs')) {
								$totalbox = $this->input->post('totalboxDs');
							}
							$contador = 1;
							$base = base_url();
							while ($contador < $totalbox) {
								if ($this->input->post('box'.$contador)) {
									$ubicacion = str_replace($base, '', $this->input->post('fotobox'.$contador));
									$dato = array('tabla'=>'fotos','donde'=>'id_foto','igual'=>$this->input->post('box'.$contador),'ubicacion' => $ubicacion);
									$this -> MPanel -> eliminarArchivo($dato);
									$this -> MPanel -> eliminar($dato);
								}
								if ($this->input->post('boxDs'.$contador)) {
									$ubicacion = str_replace($base, '', $this->input->post('fotoboxDs'.$contador));
									$dato = array('tabla'=>'fotos','donde'=>'id_foto','igual'=>$this->input->post('box'.$contador),'ubicacion' => $ubicacion);
									$this -> MPanel -> eliminarArchivo($dato);
									$this -> MPanel -> eliminar($dato);
								}
								$contador++;
							}
							$data['exito'] = 'Acción realizada con éxito';
							break;
					}
					$this->mantenedorgaleria($data);
				}else{
					$id_galeria = $this->input->post('galerias');
					$est_galeria = $this->input->post('estgaleria');
					$data['id_galeria'] = $id_galeria;
					$data['est_galeria'] = $est_galeria;
					$datos = array('tabla'=>'fotos', 'campos'=>'*', 'donde'=>'id_galeria', 'igual'=>$id_galeria);
					$data['imagenes'] = $this-> MPanel->listar($datos);
					$this->mantenedorgaleria($data);
				}
			}else{
				$this->mantenedorgaleria($data);
			}
		}else{
			redirect('Panel');
		}
	}

	public function mantenedorgaleria($data){
		$this -> load -> view('Panel/Administracion/header');
		$this -> load -> view('Panel/Administracion/Galeria/galeria');
		$this -> load -> view('Panel/Administracion/Galeria/modificargaleria',$data);
		$this -> load -> view('Panel/Administracion/footer');
	}

	/*
	====================================================================================
	====================================================================================
	*/

	public function contacto(){
		if ($this-> session->userdata('usuario')) {
			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Contacto/contacto');
			$this -> load -> view('Panel/Administracion/footer');
		}else{
			redirect('Panel');
		}
	}

	public function nuevocontacto(){
		if ($this-> session->userdata('usuario')) {

			$lista_direc = array('tabla'=>'cliente','campos'=>'','donde'=>'id_cliente','igual'=>'1');
			$lista_fono = array('tabla'=>'telefono','campos'=>'*','donde'=>'id_cliente','igual'=>'1');
			$lista_mail = array('tabla'=>'mail','campos'=>'*','donde'=>'id_cliente','igual'=>'1');

			$conteo_direc = 0;
			$conteo_fono = 0;
			$conteo_mail = 0;

			$conteo = $this->MPanel->listar($lista_direc);			
			foreach ($conteo as $cd) {
				$conteo_direc++;
			}
			$conteo = $this->MPanel->listar($lista_fono);
			foreach ($conteo as $cf) {
				$conteo_fono++;
			}
			$conteo = $this->MPanel->listar($lista_mail);
			foreach ($conteo as $cf) {
				$conteo_mail++;
			}

			if ($conteo_direc >= 1) {
				$data['aviso_direccion'] = 'Ha alcanzado el maximo de direcciones permitidas';
			}
			if ($conteo_fono >= 3) {
				$data['aviso_fono'] = 'Ha alcanzado el máximo de números permitidos';
			}
			if ($conteo_mail >= 3) {
				$data['aviso_mail']  = 'Ha alcanzado el máximo de e-mails permitidos';
			}

			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Contacto/contacto');
			$this -> load -> view('Panel/Administracion/Contacto/nuevocontacto',$data);
			$this -> load -> view('Panel/Administracion/footer');
		}else{
			redirect('Panel');
		}
	}

	public function cargarcontacto(){
		if ($this-> session->userdata('usuario')) {
			date_default_timezone_set('America/Santiago');
			$fecha=date("Y/m/d");

			$this->session->unset_userdata('avisod');
			$this->session->unset_userdata('avisoF');
			$this->session->unset_userdata('avisoM');
			$this-> form_validation->set_rules('fono','numero de teléfono','trim|numeric|max_length[15]|xss_clean');
			$this-> form_validation->set_rules('mail','dirección de correo','trim|valid_email|max_length[100]|xss_clean');

			if ($this-> form_validation->run() == false) {
				$this->nuevocontacto();
			}else{
				if ($this->input->post('direccion')) {
					$dato['tabla'] = 'cliente';
					$datos['valores'] = array('id_cliente'=>'1','direccion'=>$this->input->post('direccion'));
					$resp_direccion = $this->MPanel->insertaregistro($dato,$datos);
					if ($resp_direccion > 0) {
						$dato['avisod'] = 'Se ha ingresado la dirección con exito';
					}else{
						$dato['error'] = 'No se ha ingresado el registro';
					}
				}
				if ($this->input->post('fono')) {
					$dato['tabla'] = 'telefono';
					$datos['valores'] = array('id_cliente'=>'1','estado_telefono'=>'1','fech_ing_telefono'=>$fecha,'numero_telefono'=>$this->input->post('fono'));
					$resp_fono = $this->MPanel->insertaregistro($dato,$datos);
					if ($resp_fono > 0) {
						$dato['avisoF'] = 'Se ha ingresado el número telefónico con exito';
					}else{
						$dato['error'] = 'No se ha ingresado el registro';
					}
				}
				if ($this->input->post('mail')) {
					$dato['tabla'] = 'mail';
					$datos['valores'] = array('id_cliente'=>'1','estado_mail'=>'1','fech_ing_mail'=>$fecha,'e_mail'=>$this->input->post('mail'));
					$resp_mail = $this->MPanel->insertaregistro($dato,$datos);
					if ($resp_mail > 0) {
						$dato['avisoM'] = 'Se ha ingresado el e-mail con exito';
					}else{
						$dato['error'] = 'No se ha ingresado el registro';
					}
				}
				$this->session->set_userdata($dato);
				redirect('Panel/confirmacioncontacto');
			}				
		}else{
			redirect('Panel');
		}
	}

	public function modificarcontacto(){
		if ($this-> session->userdata('usuario')) {

			$lista_direc = array('tabla'=>'cliente','campos'=>'','donde'=>'id_cliente','igual'=>'1');
			$lista_fono = array('tabla'=>'telefono','campos'=>'*','donde'=>'id_cliente','igual'=>'1');
			$lista_mail = array('tabla'=>'mail','campos'=>'*','donde'=>'id_cliente','igual'=>'1');

			$data['datos_direccion'] = $this->MPanel->listar($lista_direc);			
			
			$fono = $this->MPanel->listar($lista_fono);
			if (!array_key_exists('resultado', $fono)) {
				$data['datos_fono'] = $fono;
			}
			
			$mail = $this->MPanel->listar($lista_mail);
			if (!array_key_exists('resultado',$mail)) {
				$data['datos_mail'] = $mail;	
			}
			
			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Contacto/contacto');
			$this -> load -> view('Panel/Administracion/Contacto/modificarcontacto',$data);
			$this -> load -> view('Panel/Administracion/footer');
		}else{
			redirect('Panel');
		}
	}

	public function guardarmodificarcontacto(){
		if ($this-> session->userdata('usuario')) {
			date_default_timezone_set('America/Santiago');
			$fecha=date("Y/m/d");

			$this->session->unset_userdata('avisod');
			$this->session->unset_userdata('avisoF');
			$this->session->unset_userdata('avisoM');

			$i = 0;
			while ( $i < 3) {
				$this-> form_validation->set_rules('fono'.$i,'numero de teléfono','trim|numeric|max_length[15]|xss_clean');
				$this-> form_validation->set_rules('n_mail'.$i,'dirección de correo','trim|valid_email|max_length[100]|xss_clean');	
				$i++;
			}

			if ($this-> form_validation->run() == false) {
				$this->modificarcontacto();
			}else{
				$i = 0;
				while ($i < 3) {
					if ($this->input->post('direccion')) {
						$dato = array('tabla'=>'cliente','donde'=>'id_cliente','igual'=>'1');
						$datos = array('direccion'=>$this->input->post('direccion'));
						$resp_direccion = $this->MPanel->modificar($dato,$datos);
					}

					if ($this->input->post('fono'.$i)) {
						if ($this->input->post('fono'.$i) != '') {
							$idfono = $this->input->post('id_fono'.$i);
							$dat = array('tabla'=>'telefono','donde'=>'id_telefono','igual'=>$idfono);
							$mod = array('numero_telefono'=>$this->input->post('fono'.$i));
							$this->MPanel->modificar($dat,$mod);					
						}					
					}else{
						$idfono = $this->input->post('id_fono'.$i);
						$dat = array('tabla'=>'telefono','donde'=>'id_telefono','igual'=>$idfono);
						$this->MPanel->eliminar($dat);
					}	

					if ($this->input->post('n_mail'.$i)) {
						if ($this->input->post('n_mail'.$i) != '') {
							$idmail = $this->input->post('id_mail'.$i);
							$dat = array('tabla'=>'mail','donde'=>'id_mail','igual'=>$idmail);
							$mod = array('e_mail'=>$this->input->post('n_mail'.$i));
							$this->MPanel->modificar($dat,$mod);					
						}						
					}else{
						$idmail = $this->input->post('id_mail'.$i);
						$dat = array('tabla'=>'mail','donde'=>'id_mail','igual'=>$idmail);
						$this->MPanel->eliminar($dat);
					}

					$i++;
				}
				$dato['avisod'] = 'La actualización se ha guardado correctamente';
				$this->session->set_userdata($dato);
				redirect('Panel/confirmacioncontacto');
			}				
		}else{
			redirect('Panel');
		}
	}


	public function confirmacioncontacto(){
		if ($this-> session->userdata('usuario')) {
			$data['avisoD'] = $this->session->userdata('avisod');
			$data['avisoF'] = $this->session->userdata('avisoF');
			$data['avisoM'] = $this->session->userdata('avisoM');
			$data['error'] = $this->session->userdata('error');
			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Contacto/contacto',$data);
			$this -> load -> view('Panel/Administracion/footer');
		}else{
			redirect('Panel');
		}
	}

	/*
	=====================================================================================
	=====================================================================================
	*/

	public function consejos(){
		if ($this->session->userdata('usuario')) {
			$this -> load -> view('Panel/Administracion/header');
			if ($this->session->userdata('aviso')) {
				$data['aviso'] = $this->session->userdata('aviso');
				$this -> load -> view('Panel/Administracion/Consejos/consejos',$data);
			}else{
				if ($this->session->userdata('error')) {
					$data['error'] = $this->session->userdata('error');
					$this -> load -> view('Panel/Administracion/Consejos/consejos', $data);
				}else{
					$this -> load -> view('Panel/Administracion/Consejos/consejos');
				}
			}
			
			$this -> load -> view('Panel/Administracion/footer');

			$this->session->unset_userdata('error');
			$this->session->unset_userdata('aviso');
		}else{
			redirect('Panel');
		}
	}

	public function nuevoconsejo(){
		if ($this->session->userdata('usuario')) {
			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Consejos/consejos');
			if ($this->session->userdata('error')) {
				$data['error'] = $this->session->userdata('error');
				$this -> load -> view('Panel/Administracion/Consejos/nuevoconsejo',$data);
			}else{
				$this -> load -> view('Panel/Administracion/Consejos/nuevoconsejo');
			}
			$this -> load -> view('Panel/Administracion/footer');
		}else{
			redirect('Panel');
		}
	}

	public function cargarconsejo(){
		if ($this->session->userdata('usuario')) {
			$this->session->unset_userdata('error');
			$this->session->unset_userdata('aviso');

			$this->form_validation->set_rules('titulo','titulo','required');
			$this->form_validation->set_rules('parrafo_introduccion','parrafo introductorio','required|max_length[100]');
			$this->form_validation->set_rules('parrafo','primer parrafo','required');
			$this->form_validation->set_rules('tp_consejo','Tipo de consejo','required');
			$this->form_validation->set_message('required','Debe completar el %s');
			$this->form_validation->set_message('max_length','Ha sobrepasado el máximo de carácteres en el %s');

			if ($this->form_validation->run()==false) {
				$this->nuevoconsejo();
			}else{
				if ($_FILES['userfile']['name'] != '') {
					$ubicacion_img_cons = 'Imagenes/Consejo/';
					$up_imagen = $this->subir_imagen($ubicacion_img_cons);

					if (!is_array($up_imagen)) {
						date_default_timezone_set('America/Santiago');
						$fecha=date("Y/m/d");

						if ($this->input->post('tp_consejo') == 'Hogar') {
							$idtipo = 1;
						}
						if ($this->input->post('tp_consejo') == 'Trabajo') {
							$idtipo = 2;
						}
						if ($this->input->post('tp_consejo') == 'Comunidad') {
							$idtipo = 3;
						}

						$consejo = array('id_cliente'=>'1',
										  'id_tipoconsejo'=>$idtipo,
										  'nombre_consejo'=>$this->input->post('titulo'),
										  'fech_consejo'=>$fecha,
										  'desc_consejo'=>$this->input->post('parrafo_introduccion'),
										  'estado_consejo'=>'1');

						$id_consejo = $this->MPanel->crearconsejo($consejo);

						$tb['tabla'] = 'parrafo';
						$cont_parrafo['valores'] = array('id_consejo'=>$id_consejo,
															'contenido_parrafo'=>$this->input->post('parrafo'));
						$cant_parrafo = $this->MPanel->insertaregistro($tb,$cont_parrafo);
						$i=1;
						while ($i<=5) {
							if ($this->input->post('parrafo'.$i)) {
								$cont_parrafo['valores'] = array('id_consejo'=>$id_consejo,
															'contenido_parrafo'=>$this->input->post('parrafo'.$i));
								$cant_parrafo = $cant_parrafo + $this->MPanel->insertaregistro($tb,$cont_parrafo);	
							}
							$i++;	
						}

						if ($cant_parrafo > 0) {
							$tb['tabla'] = 'imagen_parrafo';
							$cont_imagen['valores'] = array('id_consejo'=>$id_consejo,
															  'imagen_ubicacion'=>base_url().'Imagenes/Consejo/'.$up_imagen,
															  'nombre_imagenparrafo'=>$up_imagen);
							$total_proceso = $this->MPanel->insertaregistro($tb,$cont_imagen);
						}

						if ($total_proceso > 0) {
							$a = 'Acción realizada con exito';
						}
						$aviso = array('aviso'=>$a);
						$this->session->set_userdata($aviso);
						$this->consejos();

					}else{
						$this->session->set_userdata($up_imagen);
						$this->consejos();
					}

				}else{
					$error = array('error'=>'Debe ingresar una imagen');
					$this->session->set_userdata($error);
					$this->nuevoconsejo();
				}
			}
		}else{
			redirect('Panel');
		}
	}

	public function modificarconsejo(){
		if ($this->session->userdata('usuario')) {

			$data['consejos'] = $this-> MPanel -> consultarconsejos('');

			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Consejos/consejos');
			$this -> load -> view('Panel/Administracion/Consejos/modificarconsejo',$data);
			$this -> load -> view('Panel/Administracion/footer');
		}else{
			redirect('Panel');
		}
	}

	public function consejoselecionado(){
		if ($this->session->userdata('usuario')) {

			$idconsejo = $this->input->post('consejos');
			$data['consejos'] = $this-> MPanel -> consultarconsejos('');
			$data['datos_parrafo'] = $this-> MPanel -> consultarconsejos($idconsejo);
			$data['idconsejo'] = $idconsejo;

			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Consejos/consejos');
			if ($this->session->userdata('error')) {
				$data['error'] = $this->session->userdata('error');
				$this -> load -> view('Panel/Administracion/Consejos/modificarconsejo',$data);
			}else{
				$this -> load -> view('Panel/Administracion/Consejos/modificarconsejo',$data);
			}
			$this -> load -> view('Panel/Administracion/footer');
		}else{
			redirect('Panel');
		}
		$this->session->unset_userdata('error');
		$this->session->unset_userdata('aviso');
	}

	public function actualizarconsejo(){
		if ($this->session->userdata('usuario')) {
			$this->session->unset_userdata('error');
			$this->session->unset_userdata('aviso');

			$this->form_validation->set_rules('titulo','titulo','required');
			$this->form_validation->set_rules('parrafo','primer parrafo','required');
			$this->form_validation->set_rules('parrafo_introduccion','parrafo introductorio','required|max_length[100]');
			$this->form_validation->set_rules('tp_consejo','Tipo de consejo','required');
			$this->form_validation->set_rules('imagen','tipo de imagen','required');
			$this->form_validation->set_message('required','Debe completar el %s');
			$this->form_validation->set_message('max_length','Ha sobrepasado el máximo de carácteres en el %s');

			if ($this->form_validation->run()==false) {
				$this->consejoselecionado();
			}else{
				if ($this->input->post('imagen') == 'nueva') {
					if ($_FILES['userfile']['name'] != '') {
						$ubicacion_img_cons = 'Imagenes/Consejo/';
						$up_imagen = $this->subir_imagen($ubicacion_img_cons);

						if (!is_array($up_imagen)) {

							if ($this->input->post('tp_consejo') == 'Hogar') {
								$idtipo = 1;
							}
							if ($this->input->post('tp_consejo') == 'Trabajo') {
								$idtipo = 2;
							}
							if ($this->input->post('tp_consejo') == 'Comunidad') {
								$idtipo = 3;
							}

							$datostabla = array('tabla'=>'consejo','donde'=>'id_consejo','igual'=>$this->input->post('consejos'));
							$datosmodificar = array('nombre_consejo'=>$this->input->post('titulo'),'id_tipoconsejo'=>$idtipo,'desc_consejo'=>$this->input->post('parrafo_introduccion'));
							$this->MPanel->modificar($datostabla,$datosmodificar);

							$datostabla = array('tabla'=>'imagen_parrafo','donde'=>'id_consejo','igual'=>$this->input->post('consejos'));
							$datosmodificar = array('nombre_imagenparrafo'=>$up_imagen,'imagen_ubicacion'=>base_url().'Imagenes/Consejo/'.$up_imagen);
							$afectadas = $this->MPanel->modificar($datostabla,$datosmodificar);

							if ($afectadas > 0) {
								$base = base_url();
								$ubicacion = str_replace($base, '', $this->input->post('img_crg'));
								$dato = array('ubicacion' => $ubicacion);
								$this -> MPanel -> eliminarArchivo($dato);	
							}

							$datostabla = array('tabla'=>'parrafo','donde'=>'id_consejo','igual'=>$this->input->post('consejos'),'donde2'=>'id_parrafo','igual2'=>$this->input->post('idparrafo'));
							$datosmodificar = array('contenido_parrafo'=>$this->input->post('parrafo'));
							$this->MPanel->modificarmultiples_pk($datostabla,$datosmodificar);

							$i=1;
							while ($i<=5) {
								if ($this->input->post('idparrafo'.$i)) {
									if ($this->input->post('parrafo'.$i)) {
										$datostabla = array('tabla'=>'parrafo','donde'=>'id_consejo','igual'=>$this->input->post('consejos'),'donde2'=>'id_parrafo','igual2'=>$this->input->post('idparrafo'.$i));
										$datosmodificar = array('contenido_parrafo'=>$this->input->post('parrafo'.$i));
										$this->MPanel->modificarmultiples_pk($datostabla,$datosmodificar);	
									}else{
										$dat = array('tabla'=>'parrafo','donde'=>'id_parrafo','igual'=>$this->input->post('idparrafo'.$i));
										$this->MPanel->eliminar($dat);
									}
								}
								$i++;
							}
						
							$aviso = array('aviso'=>'Acción realizada');
							$this->session->set_userdata($aviso);
							$this->consejos();

						}else{
							$this->session->set_userdata($up_imagen);
							$this->modificarconsejo();
						}

					}else{
						$error = array('error'=>'Debe ingresar una imagen');
						$this->session->set_userdata($error);
						$this->modificarconsejo();
					}	
				}else{
					if ($this->input->post('tp_consejo') == 'Hogar') {
						$idtipo = 1;
					}
					if ($this->input->post('tp_consejo') == 'Trabajo') {
						$idtipo = 2;
					}
					if ($this->input->post('tp_consejo') == 'Comunidad') {
						$idtipo = 3;
					}

					$datostabla = array('tabla'=>'consejo','donde'=>'id_consejo','igual'=>$this->input->post('consejos'));
					$datosmodificar = array('nombre_consejo'=>$this->input->post('titulo'),'id_tipoconsejo'=>$idtipo,'desc_consejo'=>$this->input->post('parrafo_introduccion'));
					$this->MPanel->modificar($datostabla,$datosmodificar);

					$datostabla = array('tabla'=>'parrafo','donde'=>'id_consejo','igual'=>$this->input->post('consejos'),'donde2'=>'id_parrafo','igual2'=>$this->input->post('idparrafo'));
					$datosmodificar = array('contenido_parrafo'=>$this->input->post('parrafo'));
					$this->MPanel->modificarmultiples_pk($datostabla,$datosmodificar);

					$i=1;
					while ($i<=5) {
						if ($this->input->post('idparrafo'.$i)) {
							if ($this->input->post('parrafo'.$i)) {
								$datostabla = array('tabla'=>'parrafo','donde'=>'id_consejo','igual'=>$this->input->post('consejos'),'donde2'=>'id_parrafo','igual2'=>$this->input->post('idparrafo'.$i));
								$datosmodificar = array('contenido_parrafo'=>$this->input->post('parrafo'.$i));
								$this->MPanel->modificarmultiples_pk($datostabla,$datosmodificar);	
							}else{
								$dat = array('tabla'=>'parrafo','donde'=>'id_parrafo','igual'=>$this->input->post('idparrafo'.$i));
								$this->MPanel->eliminar($dat);
							}
						}
						$i++;	
					}
				
					$aviso = array('aviso'=>'Acción realizada');
					$this->session->set_userdata($aviso);
					$this->consejos();
				}
			}
		}else{
			redirect('Panel');
		}
	}

	public function deshabilitarconsejo(){
		if ($this->session->userdata('usuario')) {
			$datostabla = array('tabla'=>'consejo','donde'=>'id_consejo','igual'=>$this->input->post('consejos'));
			$datosmodificar = array('estado_consejo'=>'0');
			$this->MPanel->modificar($datostabla,$datosmodificar);
			$aviso = array('aviso'=>'Acción realizada');
			$this->session->set_userdata($aviso);
			$this->consejos();
		}else{
			redirect('Panel');
		}
	}

	public function habilitarconsejo(){
		if ($this->session->userdata('usuario')) {
			$datostabla = array('tabla'=>'consejo','donde'=>'id_consejo','igual'=>$this->input->post('consejos'));
			$datosmodificar = array('estado_consejo'=>'1');
			$this->MPanel->modificar($datostabla,$datosmodificar);
			$aviso = array('aviso'=>'Acción realizada');
			$this->session->set_userdata($aviso);
			$this->consejos();
		}else{
			redirect('Panel');
		}
	}

	public function eliminarconsejo(){
		if ($this->session->userdata('usuario')) {
			$datos = array('tabla'=>'parrafo','donde'=>'id_consejo','igual'=>$this->input->post('consejos'));
			$this->MPanel->eliminar($datos);
			$datos = array('tabla'=>'imagen_parrafo','donde'=>'id_consejo','igual'=>$this->input->post('consejos'));
			$this->MPanel->eliminar($datos);
			$datos = array('tabla'=>'consejo','donde'=>'id_consejo','igual'=>$this->input->post('consejos'));
			$borrado = $this->MPanel->eliminar($datos);	
			if ($borrado > 0) {
				$base = base_url();
				$ubicacion = str_replace($base, '', $this->input->post('img_crg'));
				$dato = array('ubicacion' => $ubicacion);
				$this -> MPanel -> eliminarArchivo($dato);
				$aviso = array('aviso'=>'Acción realizada');			
			}else{
				$aviso = array('aviso'=>'Acción NO realizada');
			}			
			$aviso = array('aviso'=>'Acción realizada');
			$this->session->set_userdata($aviso);
			$this->consejos();
		}else{
			redirect('Panel');
		}
	}

	/*
	=====================================================================================
	=====================================================================================
	*/

	public function publicacion(){
		if ($this->session->userdata('usuario')) {
			$this -> load -> view('Panel/Administracion/header');
			if ($this->session->userdata('aviso')) {
				$data['aviso'] = $this->session->userdata('aviso');
				$this -> load -> view('Panel/Administracion/Publicacion/publicacion',$data);
			}else{
				if ($this->session->userdata('error')) {
					$data['error'] = $this->session->userdata('error');
					$this -> load -> view('Panel/Administracion/Publicacion/publicacion', $data);
				}else{
					$this -> load -> view('Panel/Administracion/Publicacion/publicacion');
				}
			}
			
			$this -> load -> view('Panel/Administracion/footer');

			$this->session->unset_userdata('error');
			$this->session->unset_userdata('aviso');
		}else{
			redirect('Panel');
		}
	}

	public function nuevapublicacion(){
		if ($this->session->userdata('usuario')) {
			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Publicacion/publicacion');
			if ($this->session->userdata('error')) {
				$data['error'] = $this->session->userdata('error');
				$this -> load -> view('Panel/Administracion/Publicacion/nuevapublicacion',$data);
			}else{
				$this -> load -> view('Panel/Administracion/Publicacion/nuevapublicacion');
			}
			$this -> load -> view('Panel/Administracion/footer');
		}else{
			redirect('Panel');
		}
	}

	public function cargarpublicacion(){
		if ($this->session->userdata('usuario')) {
			$this->session->unset_userdata('error');
			$this->session->unset_userdata('aviso');

			$this->form_validation->set_rules('titulo','titulo','required');
			$this->form_validation->set_rules('parrafo','primer parrafo','required');
			$this->form_validation->set_rules('parrafo_introduccion','parrafo introductorio','required');
			$this->form_validation->set_message('required','Debe completar el %s');

			if ($this->form_validation->run()==false) {
				$this->nuevapublicacion();
			}else{
				if ($_FILES['userfile']['name'] != '') {
					$ubicacion_img_cons = 'Imagenes/Publicacion/';
					$up_imagen = $this->subir_imagen($ubicacion_img_cons);

					if (!is_array($up_imagen)) {
						date_default_timezone_set('America/Santiago');
						$fecha=date("Y/m/d");

						$publicacion = array('id_cliente'=>'1',
										  'nombre_publicacion'=>$this->input->post('titulo'),
										  'descripcion_publicacion'=>$this->input->post('parrafo_introduccion'),
										  'foto_publicacioninicial'=>base_url().'Imagenes/Publicacion/'.$up_imagen,
										  'fech_publicacion'=>$fecha,
										  'estado_publicacion'=>'1');

						$id_publicacion = $this->MPanel->crearpublicacion($publicacion);

						$tb['tabla'] = 'contenido_publicacion';
						$cont_parrafo['valores'] = array('id_publicacion'=>$id_publicacion,
															'contenido'=>$this->input->post('parrafo'));
						$cant_parrafo = $this->MPanel->insertaregistro($tb,$cont_parrafo);
						$i=1;
						while ($i<=5) {
							if ($this->input->post('parrafo'.$i)) {
								$cont_parrafo['valores'] = array('id_publicacion'=>$id_publicacion,
															'contenido'=>$this->input->post('parrafo'.$i));
								$cant_parrafo = $cant_parrafo + $this->MPanel->insertaregistro($tb,$cont_parrafo);	
							}
							$i++;	
						}

						$aviso = array('aviso'=>'Acción realizada con exito');
						$this->session->set_userdata($aviso);
						$this->publicacion();

					}else{
						$this->session->set_userdata($up_imagen);
						$this->publicacion();
					}

				}else{
					$error = array('error'=>'Debe ingresar una imagen');
					$this->session->set_userdata($error);
					$this->nuevapublicacion();
				}
			}
		}else{
			redirect('Panel');
		}
	}

	public function modificarpublicacion(){
		if ($this->session->userdata('usuario')) {

			$data['publicacion'] = $this-> MPanel -> consultarpublicacion('');

			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Publicacion/publicacion');
			$this -> load -> view('Panel/Administracion/Publicacion/modificarpublicacion',$data);
			$this -> load -> view('Panel/Administracion/footer');
		}else{
			redirect('Panel');
		}
	}

	public function publicacionselecionada(){
		if ($this->session->userdata('usuario')) {

			$idpublicacion = $this->input->post('consejos');
			$data['publicacion'] = $this-> MPanel -> consultarpublicacion('');
			$data['datos_parrafo'] = $this-> MPanel -> consultarpublicacion($idpublicacion);
			$data['idpublicacion'] = $idpublicacion;

			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Publicacion/publicacion');
			if ($this->session->userdata('error')) {
				$data['error'] = $this->session->userdata('error');
				$this -> load -> view('Panel/Administracion/Publicacion/modificarpublicacion',$data);
			}else{
				$this -> load -> view('Panel/Administracion/Publicacion/modificarpublicacion',$data);
			}
			$this -> load -> view('Panel/Administracion/footer');
		}else{
			redirect('Panel');
		}
		$this->session->unset_userdata('error');
		$this->session->unset_userdata('aviso');
	}

	public function actualizarpublicacion(){
		if ($this->session->userdata('usuario')) {
			$this->session->unset_userdata('error');
			$this->session->unset_userdata('aviso');

			$this->form_validation->set_rules('titulo','titulo','required');
			$this->form_validation->set_rules('parrafo','primer parrafo','required');
			$this->form_validation->set_rules('imagen','tipo de imagen','required');
			$this->form_validation->set_rules('parrafo_introduccion','parrafo introductorio','required');
			$this->form_validation->set_message('required','Debe completar el %s');

			if ($this->form_validation->run()==false) {
				$this->publicacionselecionada();
			}else{
				if ($this->input->post('imagen') == 'nueva') {
					if ($_FILES['userfile']['name'] != '') {
						$ubicacion_img_cons = 'Imagenes/Publicacion/';
						$up_imagen = $this->subir_imagen($ubicacion_img_cons);

						if (!is_array($up_imagen)) {

							$datostabla = array('tabla'=>'publicacion_inicial','donde'=>'id_publicacion','igual'=>$this->input->post('consejos'));
							$datosmodificar = array('nombre_publicacion'=>$this->input->post('titulo'),'descripcion_publicacion'=>$this->input->post('parrafo_introduccion'),
													'foto_publicacioninicial'=>base_url().'Imagenes/Publicacion/'.$up_imagen);
							$afectadas = $this->MPanel->modificar($datostabla,$datosmodificar);

							if ($afectadas > 0) {
								$base = base_url();
								$ubicacion = str_replace($base, '', $this->input->post('img_crg'));
								$dato = array('ubicacion' => $ubicacion);
								$this -> MPanel -> eliminarArchivo($dato);	
							}

							$datostabla = array('tabla'=>'contenido_publicacion','donde'=>'id_publicacion','igual'=>$this->input->post('consejos'),'donde2'=>'id_contenido','igual2'=>$this->input->post('idparrafo'));
							$datosmodificar = array('contenido_parrafo'=>$this->input->post('parrafo'));
							$this->MPanel->modificarmultiples_pk($datostabla,$datosmodificar);

							$i=1;
							while ($i<=5) {
								if ($this->input->post('idparrafo'.$i)) {
									if ($this->input->post('parrafo'.$i)) {
										$datostabla = array('tabla'=>'contenido_publicacion','donde'=>'id_publicacion','igual'=>$this->input->post('consejos'),'donde2'=>'id_contenido','igual2'=>$this->input->post('idparrafo'.$i));
										$datosmodificar = array('contenido'=>$this->input->post('parrafo'.$i));
										$this->MPanel->modificarmultiples_pk($datostabla,$datosmodificar);	
									}else{
										$dat = array('tabla'=>'contenido_publicacion','donde'=>'id_contenido','igual'=>$this->input->post('idparrafo'.$i));
										$this->MPanel->eliminar($dat);
									}
								}
								$i++;
							}
						
							$aviso = array('aviso'=>'Acción realizada');
							$this->session->set_userdata($aviso);
							$this->publicacion();

						}else{
							$this->session->set_userdata($up_imagen);
							$this->modificarpublicacion();
						}

					}else{
						$error = array('error'=>'Debe ingresar una imagen');
						$this->session->set_userdata($error);
						$this->modificarpublicacion();
					}	
				}else{
					
					$datostabla = array('tabla'=>'publicacion_inicial','donde'=>'id_publicacion','igual'=>$this->input->post('consejos'));
					$datosmodificar = array('nombre_publicacion'=>$this->input->post('titulo'),'descripcion_publicacion'=>$this->input->post('parrafo_introduccion'));
					$this->MPanel->modificar($datostabla,$datosmodificar);

					$datostabla = array('tabla'=>'contenido_publicacion','donde'=>'id_publicacion','igual'=>$this->input->post('consejos'),'donde2'=>'id_contenido','igual2'=>$this->input->post('idparrafo'));
					$datosmodificar = array('contenido'=>$this->input->post('parrafo'));
					$this->MPanel->modificarmultiples_pk($datostabla,$datosmodificar);

					$i=1;
					while ($i<=5) {
						if ($this->input->post('idparrafo'.$i)) {
							if ($this->input->post('parrafo'.$i)) {
								$datostabla = array('tabla'=>'contenido_publicacion','donde'=>'id_publicacion','igual'=>$this->input->post('consejos'),'donde2'=>'id_contenido','igual2'=>$this->input->post('idparrafo'.$i));
								$datosmodificar = array('contenido'=>$this->input->post('parrafo'.$i));
								$this->MPanel->modificarmultiples_pk($datostabla,$datosmodificar);	
							}else{
								$dat = array('tabla'=>'contenido_publicacion','donde'=>'id_contenido','igual'=>$this->input->post('idparrafo'.$i));
								$this->MPanel->eliminar($dat);
							}
						}
						$i++;	
					}
				
					$aviso = array('aviso'=>'Acción realizada');
					$this->session->set_userdata($aviso);
					$this->publicacion();
				}
			}
		}else{
			redirect('Panel');
		}
	}

	public function deshabilitarpublicacion(){
		if ($this->session->userdata('usuario')) {
			$datostabla = array('tabla'=>'publicacion_inicial','donde'=>'id_publicacion','igual'=>$this->input->post('consejos'));
			$datosmodificar = array('estado_publicacion'=>'0');
			$this->MPanel->modificar($datostabla,$datosmodificar);
			$aviso = array('aviso'=>'Acción realizada');
			$this->session->set_userdata($aviso);
			$this->publicacion();
		}else{
			redirect('Panel');
		}
	}

	public function habilitarpublicacion(){
		if ($this->session->userdata('usuario')) {
			$datostabla = array('tabla'=>'publicacion_inicial','donde'=>'id_publicacion','igual'=>$this->input->post('consejos'));
			$datosmodificar = array('estado_publicacion'=>'1');
			$this->MPanel->modificar($datostabla,$datosmodificar);
			$aviso = array('aviso'=>'Acción realizada');
			$this->session->set_userdata($aviso);
			$this->publicacion();
		}else{
			redirect('Panel');
		}
	}

	public function eliminarpublicacion(){
		if ($this->session->userdata('usuario')) {
			$datos = array('tabla'=>'contenido_publicacion','donde'=>'id_publicacion','igual'=>$this->input->post('consejos'));
			$this->MPanel->eliminar($datos);
			$datos = array('tabla'=>'publicacion_inicial','donde'=>'id_publicacion','igual'=>$this->input->post('consejos'));
			$borrado = $this->MPanel->eliminar($datos);	
			if ($borrado > 0) {
				$base = base_url();
				$ubicacion = str_replace($base, '', $this->input->post('img_crg'));
				$dato = array('ubicacion' => $ubicacion);
				$this -> MPanel -> eliminarArchivo($dato);
				$aviso = array('aviso'=>'Acción realizada');			
			}else{
				$aviso = array('aviso'=>'Acción NO realizada');
			}
			$this->session->set_userdata($aviso);
			$this->publicacion();
		}else{
			redirect('Panel');
		}
	}

	/*
	=====================================================================================
	=====================================================================================
	*/

	public function efemerides(){
		if ($this->session->userdata('usuario')) {
			$this -> load -> view('Panel/Administracion/header');
			if ($this->session->userdata('aviso')) {
				$data['aviso'] = $this->session->userdata('aviso');
				$this -> load -> view('Panel/Administracion/Efemeride/efemeride',$data);
			}else{
				if ($this->session->userdata('error')) {
					$data['error'] = $this->session->userdata('error');
					$this -> load -> view('Panel/Administracion/Efemeride/efemeride', $data);
				}else{
					$this -> load -> view('Panel/Administracion/Efemeride/efemeride');
				}
			}
			
			$this -> load -> view('Panel/Administracion/footer');

			$this->session->unset_userdata('error');
			$this->session->unset_userdata('aviso');
		}else{
			redirect('Panel');
		}
	}

	public function nuevaefemeride(){
		if ($this->session->userdata('usuario')) {
			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Efemeride/efemeride');
			if ($this->session->userdata('error')) {
				$data['error'] = $this->session->userdata('error');
				$this -> load -> view('Panel/Administracion/Efemeride/nuevaefemeride',$data);
			}else{
				$this -> load -> view('Panel/Administracion/Efemeride/nuevaefemeride');
			}
			$this -> load -> view('Panel/Administracion/footer');
		}else{
			redirect('Panel');
		}
	}

	public function cargarefemeride(){
		if ($this->session->userdata('usuario')) {
			$this->session->unset_userdata('error');
			$this->session->unset_userdata('aviso');

			$this->form_validation->set_rules('nom_efemeride','titulo de la efeméride','required|max_length[45]');
			$this->form_validation->set_rules('dia','Día','required|is_natural|max_length[2]');
			$this->form_validation->set_rules('mes','Mes','required|is_natural|max_length[2]');
			$this->form_validation->set_rules('ano','Año','required|is_natural|max_length[4]');
			$this->form_validation->set_rules('desc_efemeride','descripción de la efeméride','required|max_length[255]');
			$this->form_validation->set_message('required','Debe ingresar %s');
			$this->form_validation->set_message('max_length','Ha sobrepasado el límite de caracteres en %s');
			$this->form_validation->set_message('is_natural','Solo debe ingresar números en %s');

			if ($this->form_validation->run() == false) {
				$this->nuevaefemeride();
			}else{
				$consulta = array('tabla'=>'efemeride','campos'=>'*','donde'=>'','igual'=>'');
				$lista_efemeride = $this->MPanel->listar($consulta);

				if (!isset($lista_efemeride['resultado'])) {
					$encontrado = false;
					foreach ($lista_efemeride as $k) {
						if ($k->NOMBRE_EFEMERIDE == $this->input->post('nom_efemeride')) {
							$encontrado = True;
						}
					}

					if (!$encontrado) {
						date_default_timezone_set('America/Santiago');
						$fecha=date("Y/m/d");

						$fecha_efemeride = $this->input->post('ano')."/".$this->input->post('mes')."/".$this->input->post('dia');

						$ing_efemeride['valores'] = array('id_cliente'=>'1',
											              'nombre_efemeride'=>$this->input->post('nom_efemeride'),
											    		  'fecha_efemeride'=>$fecha_efemeride,
											   			  'fech_ing_efemeride'=>$fecha,
											   			  'descripcion_efemeride'=>$this->input->post('desc_efemeride'),
											   			  'estado_efemeride'=>'1');
						$dato['tabla'] = 'efemeride';

						$resultado = $this->MPanel->insertaregistro($dato,$ing_efemeride);

						if ($resultado > 0) {
							$aviso = array('aviso'=>'Acción realizada con exito');
							$this->session->set_userdata($aviso);
							$this->efemerides();
						}else{
							$error = array('error'=>'Acción no completada');
							$this->session->set_userdata($error);
							$this->efemerides();
						
						}
					}else{
						$error = array('error'=>'Ya existe una efeméride con el nombre seleccionado');
						$this->session->set_userdata($error);
						$this->efemerides();
					}

				}else{
					date_default_timezone_set('America/Santiago');
					$fecha=date("Y/m/d");

					$fecha_efemeride = $this->input->post('ano')."/".$this->input->post('mes')."/".$this->input->post('dia');

					$ing_efemeride['valores'] = array('id_cliente'=>'1',
										              'nombre_efemeride'=>$this->input->post('nom_efemeride'),
										    		  'fecha_efemeride'=>$fecha_efemeride,
										   			  'fech_ing_efemeride'=>$fecha,
										   			  'descripcion_efemeride'=>$this->input->post('desc_efemeride'),
										   			  'estado_efemeride'=>'1');
					$dato['tabla'] = 'efemeride';

					$resultado = $this->MPanel->insertaregistro($dato,$ing_efemeride);

					if ($resultado > 0) {
						$aviso = array('aviso'=>'Acción realizada con exito');
						$this->session->set_userdata($aviso);
						$this->efemerides();
					}else{
						$error = array('error'=>'Acción no completada');
						$this->session->set_userdata($error);
						$this->efemerides();
					
					}
				}
			}
		}else{
			redirect('Panel');
		}
	}

	public function modificarefemeride(){
		if ($this->session->userdata('usuario')) {

			$data['efemerides'] = $this-> MPanel -> consultarefemeride('');

			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Efemeride/efemeride');
			$this -> load -> view('Panel/Administracion/Efemeride/modificarefemeride',$data);
			$this -> load -> view('Panel/Administracion/footer');
		}else{
			redirect('Panel');
		}
	}

	public function efemerideselecionada(){
		if ($this->session->userdata('usuario')) {

			$idefemeride = $this->input->post('efemerides');
			$data['efemerides'] = $this-> MPanel -> consultarefemeride('');
			$data['datos_efemeride'] = $this-> MPanel -> consultarefemeride($idefemeride);
			$data['idefemeride'] = $idefemeride;

			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Efemeride/efemeride');
			if ($this->session->userdata('error')) {
				$data['error'] = $this->session->userdata('error');
				$this -> load -> view('Panel/Administracion/Efemeride/modificarefemeride',$data);
			}else{
				$this -> load -> view('Panel/Administracion/Efemeride/modificarefemeride',$data);
			}
			$this -> load -> view('Panel/Administracion/footer');
		}else{
			redirect('Panel');
		}
		$this->session->unset_userdata('error');
		$this->session->unset_userdata('aviso');
	}

	public function actualizarefemeride(){
		if ($this->session->userdata('usuario')) {
			$this->session->unset_userdata('error');
			$this->session->unset_userdata('aviso');

			$this->form_validation->set_rules('efemerides','efeméride');
			$this->form_validation->set_rules('nom_efemeride','titulo de la efeméride','required|max_length[45]');
			$this->form_validation->set_rules('dia','Día','required|is_natural|max_length[2]');
			$this->form_validation->set_rules('mes','Mes','required|is_natural|max_length[2]');
			$this->form_validation->set_rules('ano','Año','required|is_natural|max_length[4]');
			$this->form_validation->set_rules('desc_efemeride','descripción de la efeméride','required|max_length[255]');
			$this->form_validation->set_message('required','Debe ingresar %s');
			$this->form_validation->set_message('max_length','Ha sobrepasado el límite de caracteres en %s');
			$this->form_validation->set_message('is_natural','Solo debe ingresar números en %s');

			if ($this->form_validation->run()==false) {
				$this->efemerideselecionada();
			}else{
				$consulta = array('tabla'=>'efemeride','campos'=>'*','donde'=>'','igual'=>'');
				$lista_efemeride = $this->MPanel->listar($consulta);

				if (!isset($lista_efemeride['resultado'])) {
					$encontrado = 0;
					foreach ($lista_efemeride as $k) {
						if ($k->NOMBRE_EFEMERIDE == $this->input->post('nom_efemeride')) {
							$encontrado++;
						}
					}

					if ($encontrado <= 1) {

						$fecha_efemeride = $this->input->post('ano')."/".$this->input->post('mes')."/".$this->input->post('dia');

						$act_efemeride = array('nombre_efemeride'=>$this->input->post('nom_efemeride'),
										       'fecha_efemeride'=>$fecha_efemeride,
											   'descripcion_efemeride'=>$this->input->post('desc_efemeride'));
						$dato = array('tabla'=>'efemeride','donde'=>'id_efemeride','igual'=>$this->input->post('efemerides'));

						$resultado = $this->MPanel->modificar($dato,$act_efemeride);

						if ($resultado > 0) {
							$aviso = array('aviso'=>'Acción realizada con exito');
							$this->session->set_userdata($aviso);
							$this->efemerides();
						}else{
							$error = array('error'=>'Acción no completada');
							$this->session->set_userdata($error);
							$this->efemerides();
						
						}
					}else{
						$error = array('error'=>'Ya existe una efeméride con el nombre seleccionado');
						$this->session->set_userdata($error);
						$this->modificarefemeride();
					}

				}else{

					$fecha_efemeride = $this->input->post('ano')."/".$this->input->post('mes')."/".$this->input->post('dia');

					$act_efemeride = array('nombre_efemeride'=>$this->input->post('nom_efemeride'),
									       'fecha_efemeride'=>$fecha_efemeride,
										   'descripcion_efemeride'=>$this->input->post('desc_efemeride'));
					$dato = array('tabla'=>'efemeride','donde'=>'id_efemeride','igual'=>$this->input->post('efemerides'));

					$resultado = $this->MPanel->modificar($dato,$act_efemeride);

					if ($resultado > 0) {
						$aviso = array('aviso'=>'Acción realizada con exito');
						$this->session->set_userdata($aviso);
						$this->efemerides();
					}else{
						$error = array('error'=>'Acción no completada');
						$this->session->set_userdata($error);
						$this->efemerides();
					
					}
				}
			}
		}else{
			redirect('Panel');
		}
	}

	public function deshabilitarefemeride(){
		if ($this->session->userdata('usuario')) {
			$datostabla = array('tabla'=>'efemeride','donde'=>'id_efemeride','igual'=>$this->input->post('efemerides'));
			$datosmodificar = array('estado_efemeride'=>'0');
			$this->MPanel->modificar($datostabla,$datosmodificar);
			$aviso = array('aviso'=>'Acción realizada');
			$this->session->set_userdata($aviso);
			$this->efemerides();
		}else{
			redirect('Panel');
		}
	}

	public function habilitarefemeride(){
		if ($this->session->userdata('usuario')) {
			$datostabla = array('tabla'=>'efemeride','donde'=>'id_efemeride','igual'=>$this->input->post('efemerides'));
			$datosmodificar = array('estado_efemeride'=>'1');
			$this->MPanel->modificar($datostabla,$datosmodificar);
			$aviso = array('aviso'=>'Acción realizada');
			$this->session->set_userdata($aviso);
			$this->efemerides();
		}else{
			redirect('Panel');
		}
	}

	public function eliminarefemeride(){
		if ($this->session->userdata('usuario')) {
			$datos = array('tabla'=>'efemeride','donde'=>'id_efemeride','igual'=>$this->input->post('efemerides'));
			$borrado = $this->MPanel->eliminar($datos);	
			if ($borrado > 0) {
				$aviso = array('aviso'=>'Acción realizada');			
			}else{
				$aviso = array('aviso'=>'Acción NO realizada');
			}
			$this->session->set_userdata($aviso);
			$this->efemerides();
		}else{
			redirect('Panel');
		}
	}

	/*
	=====================================================================================
	=====================================================================================
	*/

	public function banner(){
		if ($this->session->userdata('usuario')) {
			$this -> load -> view('Panel/Administracion/header');
			if ($this->session->userdata('aviso')) {
				$data['aviso'] = $this->session->userdata('aviso');
				$this -> load -> view('Panel/Administracion/Banner/banner',$data);
			}else{
				if ($this->session->userdata('error')) {
					$data['error'] = $this->session->userdata('error');
					$this -> load -> view('Panel/Administracion/Banner/banner', $data);
				}else{
					$this -> load -> view('Panel/Administracion/Banner/banner');
				}
			}
			
			$this -> load -> view('Panel/Administracion/footer');

			$this->session->unset_userdata('error');
			$this->session->unset_userdata('aviso');
		}else{
			redirect('Panel');
		}
	}

	public function nuevobanner(){
		if ($this->session->userdata('usuario')) {
			$data['publicacion'] = $this-> MPanel -> consultarpublicacion('');

			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Banner/banner',$data);
			if ($this->session->userdata('error')) {
				$data['error'] = $this->session->userdata('error');
				$this -> load -> view('Panel/Administracion/Banner/nuevobanner');
			}else{
				$this -> load -> view('Panel/Administracion/Banner/nuevobanner');
			}
			$this -> load -> view('Panel/Administracion/footer');
			$this->session->unset_userdata('error');
			$this->session->unset_userdata('aviso');
		}else{
			redirect('Panel');
		}
	}

	public function cargarbanner(){
		if ($this->session->userdata('usuario')) {
			$this->session->unset_userdata('error');
			$this->session->unset_userdata('aviso');

			$this->form_validation->set_rules('titulobanner','titulo del banner','xss_clean|max_length[45]|required');
			if ($this->input->post('checkbox')) { 
				$this->form_validation->set_rules('noticias','seleccionador de noticia','required');
			} 
			$this->form_validation->set_message('required','Debe completar el %s');
			$this->form_validation->set_message('max_length','Ha sobrepasado el maximo de letras en %s');

			if ($this->form_validation->run()==false) {
				$this->nuevobanner();
			}else{
				if ($_FILES['userfile']['name'] != '') {
					$ubicacion_img_cons = 'Imagenes/Banner/';
					$up_imagen = $this->subir_imagen($ubicacion_img_cons);

					if (!is_array($up_imagen)) {

						$tabla = array('tabla'=>'banner');
						$banner['valores'] = array('id_cliente'=>'1',
										'nombre_banner'=>$this->input->post('titulobanner'),
										'nombreimagenbanner'=>$this->input->post('descbanner'),
										'imagen_banner'=>base_url().'Imagenes/Banner/'.$up_imagen,
										'estado_banner'=>'1');

						$this->MPanel->insertaregistro($tabla,$banner);

						$idbanner = $this->MPanel->recuperarultimo();

						if ($this->input->post('checkbox')) { 
							$datos = array('tabla'=>'contenido_publicacion','donde'=>'id_publicacion','igual'=>$this->input->post('noticias'));
							$modificar = array('id_banner'=>$idbanner);
							$this->MPanel->modificar($datos,$modificar);
						} 

						$aviso = array('aviso'=>'Acción realizada con exito');
						$this->session->set_userdata($aviso);
						$this->banner();

					}else{
						$this->session->set_userdata($up_imagen);
						$this->banner();
					}

				}else{
					$error = array('error'=>'Debe ingresar una imagen');
					$this->session->set_userdata($error);
					$this->nuevobanner();
				}
			}
		}else{
			redirect('Panel');
		}
	}

	public function modificarbanner(){
		if ($this->session->userdata('usuario')) {
			$data['publicacion'] = $this-> MPanel -> consultarpublicacion('');
			$lista=array('tabla'=>'banner','campos'=>'*','donde'=>'');
			$data['banners'] = $this-> MPanel -> listar($lista);

			if ($this->input->post('idbanner')) {
				$data['idbanner'] = $this->input->post('idbanner');
				$lista=array('tabla'=>'banner','campos'=>'*','donde'=>'id_banner','igual'=>$this->input->post('idbanner'));
				$data['bannerseleccionado'] = $this-> MPanel -> listar($lista);
			}

			$this -> load -> view('Panel/Administracion/header');
			$this -> load -> view('Panel/Administracion/Banner/banner');
			if ($this->session->userdata('error')) {
				$data['error'] = $this->session->userdata('error');
				$this -> load -> view('Panel/Administracion/Banner/modificarbanner',$data);
			}else{
				$this -> load -> view('Panel/Administracion/Banner/modificarbanner',$data);
			}
			$this -> load -> view('Panel/Administracion/footer');
		}else{
			redirect('Panel');
		}
		$this->session->unset_userdata('error');
		$this->session->unset_userdata('aviso');
	}

	public function actualizarbanner(){
		if ($this->session->userdata('usuario')) {
			$this->session->unset_userdata('error');
			$this->session->unset_userdata('aviso');

			$this->form_validation->set_rules('titulobanner','titulo del banner','xss_clean|max_length[45]|required');
			if ($this->input->post('checkbox')) { 
				$this->form_validation->set_rules('noticias','seleccionador de noticia','required');
			} 
			$this->form_validation->set_message('required','Debe completar el %s');
			$this->form_validation->set_message('max_length','Ha sobrepasado el maximo de letras en %s');

			if ($this->form_validation->run()==false) {
				$this->nuevobanner();
			}else{
				if ($this->input->post('imagen') == 'nueva') {
					if ($_FILES['userfile']['name'] != '') {
						$ubicacion_img_cons = 'Imagenes/Banner/';
						$up_imagen = $this->subir_imagen($ubicacion_img_cons);

						if (!is_array($up_imagen)) {

							$tabla = array('tabla'=>'banner','donde'=>'id_banner','igual'=>$this->input->post('idbanner'));
							$banner = array('nombre_banner'=>$this->input->post('titulobanner'),
											'nombreimagenbanner'=>$this->input->post('descbanner'),
											'imagen_banner'=>base_url().'Imagenes/Banner/'.$up_imagen,
											'estado_banner'=>'1');

							$this->MPanel->modificar($tabla,$banner);

							if ($this->input->post('checkbox')) { 
								$datos = array('tabla'=>'contenido_publicacion','donde'=>'id_publicacion','igual'=>$this->input->post('noticias'));
								$modificar = array('id_banner'=>$this->input->post('idbanner'));
								$this->MPanel->modificar($datos,$modificar);
							} 

							$aviso = array('aviso'=>'Acción realizada con exito');
							$this->session->set_userdata($aviso);
							$this->banner();

						}else{
							$this->session->set_userdata($up_imagen);
							$this->banner();
						}

					}else{
						$error = array('error'=>'Debe ingresar una imagen');
						$this->session->set_userdata($error);
						$this->nuevobanner();
					}
				}else{
					$tabla = array('tabla'=>'banner','donde'=>'id_banner','igual'=>$this->input->post('idbanner'));
					$banner = array('nombre_banner'=>$this->input->post('titulobanner'),
									'nombreimagenbanner'=>$this->input->post('descbanner'),
									'estado_banner'=>'1');

					$this->MPanel->modificar($tabla,$banner);

					if ($this->input->post('checkbox')) { 
						$datos = array('tabla'=>'contenido_publicacion','donde'=>'id_publicacion','igual'=>$this->input->post('noticias'));
						$modificar = array('id_banner'=>$this->input->post('idbanner'));
						$this->MPanel->modificar($datos,$modificar);
					} 

					$aviso = array('aviso'=>'Acción realizada con exito');
					$this->session->set_userdata($aviso);
					$this->banner();
				}
			}
		}else{
			redirect('Panel');
		}
	}

	public function deshabilitarbanner(){
		if ($this->session->userdata('usuario')) {
			$datostabla = array('tabla'=>'banner','donde'=>'id_banner','igual'=>$this->input->post('idbanner'));
			$datosmodificar = array('estado_banner'=>'0');
			$this->MPanel->modificar($datostabla,$datosmodificar);
			$aviso = array('aviso'=>'Acción realizada');
			$this->session->set_userdata($aviso);
			$this->banner();
		}else{
			redirect('Panel');
		}
	}

	public function habilitarbanner(){
		if ($this->session->userdata('usuario')) {
			$datostabla = array('tabla'=>'banner','donde'=>'id_banner','igual'=>$this->input->post('idbanner'));
			$datosmodificar = array('estado_banner'=>'1');
			$this->MPanel->modificar($datostabla,$datosmodificar);
			$aviso = array('aviso'=>'Acción realizada');
			$this->session->set_userdata($aviso);
			$this->banner();
		}else{
			redirect('Panel');
		}
	}

	public function eliminarbanner(){
		if ($this->session->userdata('usuario')) {
			$datos = array('tabla'=>'contenido_publicacion','donde'=>'id_banner','igual'=>$this->input->post('idbanner'));
							$modificar = array('id_banner'=>'0');
							$this->MPanel->modificar($datos,$modificar);
			$datos = array('tabla'=>'banner','donde'=>'id_banner','igual'=>$this->input->post('idbanner'));
			$borrado = $this->MPanel->eliminar($datos);	
			if ($borrado > 0) {
				$aviso = array('aviso'=>'Acción realizada');			
			}else{
				$aviso = array('aviso'=>'Acción NO realizada');
			}
			$this->session->set_userdata($aviso);
			$this->banner();
		}else{
			redirect('Panel');
		}
	}
}
?>
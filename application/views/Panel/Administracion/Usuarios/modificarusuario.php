<script type="text/javascript">
  <?php
  if($this->session->userdata('permisos') == 'admin' ){ ?>
        jQuery(function ($) {
            $("#rut").shieldMaskedTextBox({
                enabled: true,
                mask: "00.000.000-A"
            });
        });
    <?php } ?>
</script>
<div class="container">
    <?php
    if (isset($usuarios)) {
        foreach ($usuarios as $u) {
            $id_user = $u->id_usuario;
            $nom_user = $u->nombre_usuario;
            $ape_user = $u->apellido_usuario;
            $rut_user = $u->cedula_usuario;
            $username_user = $u->username;
            $mail_user = $u->mail_usuario;
            $est_user = $u->estado_usuario;
            $priv_user = $u->privilegio_usuario;
        }
    }
    ?>
    <div class="row">
        <div class="span12">
            <div class="widget">
                <div class="widget-header"><i class="icon-user"></i>
                    <h3>Usuario Seleccionado: <?php echo $username_user;?></h3>
                </div>
                <div class="widget-content">
                  <?php
                  if($this->session->userdata('permisos') != 'admin' ){ 
                    $username = array('type'=>'text','name'=>'username','class'=>'span6','placeholder'=>'Username','maxlength'=>'50','value'=>$username_user,'disabled'=>'');
                    $rut = array('type'=>'text','name'=>'rut','id'=>'rut','class'=>'span4','placeholder'=>'12.345.678-K','maxlength'=>'13','value'=>$rut_user,'disabled'=>'');
                  }else{
                    $username = array('type'=>'text','name'=>'username','class'=>'span6','placeholder'=>'Username','maxlength'=>'50','value'=>$username_user);
                    $rut = array('type'=>'text','name'=>'rut','id'=>'rut','class'=>'span4','placeholder'=>'12.345.678-K','maxlength'=>'13','value'=>$rut_user);
                  } 
                  
                  $nombre = array('type'=>'text','name'=>'nom','class'=>'span6','placeholder'=>'Nombres','maxlength'=>'50','value'=>$nom_user);
                  $apellido = array('type'=>'text','name'=>'ape','class'=>'span6','placeholder'=>'Apellidos','maxlength'=>'50','value'=>$ape_user);
                  $mail = array('type'=>'text','name'=>'mail','class'=>'span4','placeholder'=>'Dirección e-mail','maxlength'=>'50','value'=>$mail_user);
                  $pass1 = array('type'=>'password','name'=>'password1','class'=>'span4','placeholder'=>'Password','maxlength'=>'50');
                  $pass2 = array('type'=>'password','name'=>'password2','class'=>'span4','placeholder'=>'Confirme Password','maxlength'=>'50');
                  if(isset($error)){ ?>
                      <div class="alert alert-danger"><strong><?php echo $error;?></strong></div>
                  <?php }
                  echo validation_errors('<div class="alert alert-danger"><strong>','</strong></div>');
                  $atributos_form = array('class'=>'form-horizontal', 'name'=>'formulario_nuevo', 'id'=>'formulario_nuevo');
                  echo form_open('Panel/Actualizarusuario',$atributos_form);
                  ?>
                        <div class="control-group">                     
                            <label class="control-label">Username</label>
                            <div class="controls">
                                <?php echo form_input($username);?>
                            </div>      
                        </div>
                        <div class="control-group">                     
                            <label class="control-label">Nombre</label>
                            <div class="controls">
                                <?php echo form_input($nombre);?>
                            </div>      
                        </div> 
                        <div class="control-group">                     
                            <label class="control-label">Apellido</label>
                            <div class="controls">
                                <?php echo form_input($apellido);?>
                            </div>      
                        </div>
                        <div class="control-group">                     
                            <label class="control-label">Cedula Identidad</label>
                            <div class="controls">
                                <?php echo form_input($rut);?>
                            </div>      
                        </div> 
                        <div class="control-group">                     
                            <label class="control-label">Email</label>
                            <div class="controls">
                                <?php echo form_input($mail);?>
                            </div>      
                        </div>
                        <div class="control-group">                     
                            <label class="control-label">Password</label>
                            <div class="controls">
                                <?php echo form_input($pass1);?>
                            </div>      
                        </div>                         
                        
                        <div class="control-group">                     
                            <label class="control-label">Confirme Password</label>
                            <div class="controls">
                                <?php echo form_input($pass2);?>
                            </div>      
                        </div>
                        <div class="control-group">                     
                            <label class="control-label">Privilegios</label>
                            <div class="controls">
                                <label class="radio inline" disabled>
                                    <input type="radio" name="privilegios" value="admin"<?php if($priv_user == "admin"){ echo "checked"; } if($this->session->userdata('permisos') != 'admin' ){ ?> disabled <?php } ?> > Administrador
                                </label>
                                <label class="radio inline">
                                    <input type="radio" name="privilegios" value="Medio"<?php if($priv_user == "Medio"){ echo "checked"; } if($this->session->userdata('permisos') != 'admin' ){ ?> disabled <?php } ?>> Nivel Medio
                                </label>
                                <label class="radio inline">
                                    <input type="radio" name="privilegios" value="Bajo"<?php if($priv_user == "Bajo"){ echo "checked";} if($this->session->userdata('permisos') != 'admin' ){ ?> disabled <?php } ?>> Nivel Básico
                                </label>
                            </div>      
                        </div>
                        <?php
                        if($this->session->userdata('permisos') != 'admin' ){ ?>
                            <input type="hidden" name="username" value="<?php echo $username_user; ?>">
                            <input type="hidden" name="rut" value="<?php echo $rut_user; ?>">
                            <input type="hidden" name="privilegios" value="<?php echo $priv_user; ?>">
                        <?php  } ?>
                        <input type="hidden" name="idusuario" value="<?php echo $id_user; ?>">
                        <center>
                          <button type="submit" class="btn btn-primary">Guardar</button> 
                          <button type="button" class="btn" onClick="location.href='<?php echo base_url(); ?>Panel'">Cancelar</button>
                        </center>    
                    <?php
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

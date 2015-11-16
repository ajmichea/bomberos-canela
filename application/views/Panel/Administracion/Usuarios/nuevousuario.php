<script type="text/javascript">
  jQuery(function ($) {
        $("#rut").shieldMaskedTextBox({
            enabled: true,
            mask: "00.000.000-A"
        });
      });
</script>
<div class="container">
    <div class="row">
        <div class="span12">
            <div class="widget">
                <div class="widget-header"><i class="icon-user"></i>
                    <h3>Nuevo Usuario</h3>
                </div>
                <?php 
                if ($this-> session->userdata('permisos') == 'Bajo') {  ?>
                    <div class="widget-content">
                        <div class="alert alert-danger">
                            <center><strong>Usted no cuenta con los permisos para realizar esta acción.</strong></center>
                        </div>
                    </div>
                    <?php
                }else{ ?>
                    <div class="widget-content">
                      <?php
                      $username = array('type'=>'text','name'=>'username','class'=>'span6','placeholder'=>'Username','maxlength'=>'50');
                      $nombre = array('type'=>'text','name'=>'nom','class'=>'span6','placeholder'=>'Nombres','maxlength'=>'50');
                      $apellido = array('type'=>'text','name'=>'ape','class'=>'span6','placeholder'=>'Apellidos','maxlength'=>'50');
                      $rut = array('type'=>'text','name'=>'rut','id'=>'rut','class'=>'span4','placeholder'=>'12.345.678-K','maxlength'=>'50');
                      $mail = array('type'=>'text','name'=>'mail','class'=>'span4','placeholder'=>'Dirección e-mail','maxlength'=>'50');
                      $pass1 = array('type'=>'password','name'=>'password1','class'=>'span4','placeholder'=>'Password','maxlength'=>'50');
                      $pass2 = array('type'=>'password','name'=>'password2','class'=>'span4','placeholder'=>'Confirme Password','maxlength'=>'50');
                      if(isset($error)){ ?>
                          <div class="alert alert-danger"><strong><?php echo $error;?></strong></div>
                      <?php }
                      echo validation_errors('<div class="alert alert-danger"><strong>','</strong></div>');
                      $atributos_form = array('class'=>'form-horizontal', 'name'=>'formulario_nuevo', 'id'=>'formulario_nuevo');
                      echo form_open('Panel/GuardarUsuario',$atributos_form);
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
                                    <label class="radio inline">
                                        <input type="radio" name="privilegios" value="admin"> Administrador
                                    </label>
                                    <label class="radio inline">
                                        <input type="radio" name="privilegios" value="Medio"> Nivel Medio
                                    </label>
                                    <label class="radio inline">
                                        <input type="radio" name="privilegios" value="Bajo"> Nivel Básico
                                    </label>
                                </div>      
                            </div>
                            <center>
                              <button type="submit" class="btn btn-primary">Guardar</button> 
                              <button type="button" class="btn" onClick="location.href='<?php echo base_url(); ?>Panel'">Cancelar</button>
                            </center>    
                        <?php
                        echo form_close();
                        ?>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>




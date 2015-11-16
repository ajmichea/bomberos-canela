<script type="text/javascript">

    function preguntarAntesDeSalir(y)
    {
        if (confirm("La acción "+y+" al usuario."))
            return true;        
    }
    <?php 
    if ($this->session->userdata('permisos') != 'Bajo') { ?>

    function accion(a,d){
        var location;
        switch(a){
            case 'a':
                location = 'modificarusuario';
                document.getElementById('idusuario').value = d;
                document.getElementById('formulario_nuevo').action = location;
                document.getElementById('formulario_nuevo').submit();
            break;

            case 'b':
                location = 'deshabilitarusuario';
                y="deshabilitara";
                respuesta = preguntarAntesDeSalir(y);
                if (respuesta) {
                    document.getElementById('idusuario').value = d;
                    document.getElementById('formulario_nuevo').action = location;
                    document.getElementById('formulario_nuevo').submit();
                };
            break;

            case 'c':
                location = 'habilitarusuario';
                y="habilitara";
                respuesta = preguntarAntesDeSalir(y);
                if (respuesta) {
                    document.getElementById('idusuario').value = d;
                    document.getElementById('formulario_nuevo').action = location;
                    document.getElementById('formulario_nuevo').submit();
                };
            break;

            case 'd':
                location = 'eliminararusuario';
                y="eliminara";
                respuesta = preguntarAntesDeSalir(y);
                if (respuesta) {
                    document.getElementById('idusuario').value = d;
                    document.getElementById('formulario_nuevo').action = location;
                    document.getElementById('formulario_nuevo').submit();
                };
            break;            
        }
    }
    <?php }; ?>

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
            <div class="widget widget-table action-table">
                <div class="widget-header"><i class="icon-user"></i>
                    <h3>Modificar Usuario</h3>
                </div>
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
                  echo form_open('',$atributos_form);

                  if (isset($usuarios)) { ?>
                    <input type="hidden" name="idusuario" id="idusuario">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th> Cedula de Identidad </th>
                                <th> Username </th>
                                <th> Nombre </th>
                                <th> Apellido </th>
                                <th> E-mail </th>
                                <th> Acción </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($usuarios as $u) {     ?>
                                <tr>
                                    <td><center><?php echo $u->cedula_usuario; ?></center></td>
                                    <td><center><?php echo $u->username; ?></center></td>
                                    <td><center><?php echo $u->nombre_usuario; ?></center></td>
                                    <td><center><?php echo $u->apellido_usuario; ?></center></td>
                                    <td><center><?php echo $u->mail_usuario; ?></center></td>
                                    <td><center>
                                        <?php
                                        if ($this->session->userdata('permisos') == 'admin') {  ?>
                                            <a onclick="accion('a',<?php echo $u->id_usuario; ?>);" class="btn btn-small btn-success"><i class="btn-icon-only icon-pencil"> </i></a>&nbsp
                                            <a onclick="accion(<?php if ($u->estado_usuario == 1) { ?> 'b' <?php }else{ ?> 'c' <?php } ?>,<?php echo $u->id_usuario; ?>);" class="btn btn-small btn-warning"><i class="btn-icon-only <?php if ($u->estado_usuario == 1) { ?> icon-warning-sign <?php }else{ ?>icon-ok<?php } ?>"></i></a>&nbsp
                                            <a onclick="accion('d',<?php echo $u->id_usuario; ?>);" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"></i></a></center></td>
                                        <?php    
                                        }else{
                                            if ($this->session->userdata('permisos') == 'Medio'){ ?>
                                                <a onclick="accion('a',<?php echo $u->id_usuario; ?>);" class="btn btn-small btn-success"><i class="btn-icon-only icon-pencil"> </i></a>&nbsp
                                                <a onclick="accion(<?php if ($u->estado_usuario == 1) { ?> 'b' <?php }else{ ?> 'c' <?php } ?>,<?php echo $u->id_usuario; ?>);" class="btn btn-small btn-warning"><i class="btn-icon-only <?php if ($u->estado_usuario == 1) { ?> icon-warning-sign <?php }else{ ?>icon-ok<?php } ?>"></i></a>&nbsp
                                                <a class="btn btn-danger btn-small" disabled><i class="btn-icon-only icon-remove"></i></a></center></td>
                                            <?php     
                                            }else{ ?>
                                                <a class="btn btn-small btn-success" disabled><i class="btn-icon-only icon-pencil"> </i></a>&nbsp
                                                <a class="btn btn-small btn-warning" disabled><i class="btn-icon-only <?php if ($u->estado_usuario == 1) { ?> icon-warning-sign <?php }else{ ?>icon-ok<?php } ?>"></i></a>&nbsp
                                                <a class="btn btn-danger btn-small" disabled><i class="btn-icon-only icon-remove"></i></a></center></td>
                                            <?php
                                            }
                                        }
                                        ?>
                                                
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                      <?php
                  }else{    ?>
                    <div class="alert">
                        <strong>No existen Usuarios.</strong>
                    </div>
                <?php   

                  }
                  echo form_close();
                  ?>
                </div>
            </div>
        </div>
    </div>
</div>




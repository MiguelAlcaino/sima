<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/jquery-ui-1.11.2.custom/jquery-ui.css')?>"/>
<script type="text/javascript" src="<?php echo base_url('public/admin/jquery-ui-1.11.2.custom/jquery-ui.js')?>"></script>
<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        
        <h2> Clientes</h2>
        
        <ul id="tabs" class="tabs">
            <li <?php if($tab == '') echo 'class="active"'?>><?php echo anchor("clientes/index","Listar")?></li>
            <li <?php if($tab == 'nuevo') echo 'class="active"'?>><?php echo anchor("clientes/nuevo","Nuevo cliente")?></li>
        </ul>
    </div>    
    

    <div class="block_content tab_content  <?php if($tab != 'nuevo') echo 'hide'?>" id="new">
        
    <?php if (validation_errors()){ ?>
            <div class="message error">
            <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
      <form method="post" action="<?php echo site_url('clientes/agregar')?>" enctype="multipart/form-data" id="form_">
              <div style="float:left; width:450px">
                    <p><label>Nombre Comercial</label><br /> <input type="text" name="nombre"  size="55" class="text"  value="<?php echo set_value('nombre') ?>"></p>
                    <p><label>Razón Social</label><br /> <input type="text" name="razon" size="55" class="text"  value="<?php echo set_value('razon') ?>"></p>
                    
                    <p><label>RUT</label><br /> <input type="text" name="nif_cif" size="55" class="text"  value="<?php echo set_value('nif_cif') ?>"></p>
                    
                    <p><label>Persona de Contacto</label><br /> <input type="text" name="contacto" size="55" class="text" value="<?php echo set_value('contacto') ?>"></p>
                    
                    <p><label>Página web </label><br /> <input type="text" name="pagina_web" size="55" class="text" value="<?php echo set_value('pagina_web') ?>"></p>
                    
                    <p><label>Email</label><br /> <input type="text" name="email" size="55" class="text" value="<?php echo set_value('email') ?>"></p>
                    
                    <p><label>Teléfono </label><br /> <input type="text" name="telefono" size="55" class="text" value="<?php echo set_value('telefono') ?>"></p>
                    
                    <p><label>Móvil </label><br /> <input type="text" name="movil" size="55" class="text" value="<?php echo set_value('movil') ?>"></p>
                    
                    <p><label>Fax</label><br /> <input type="text" name="fax" size="55" class="text" value="<?php echo set_value('fax') ?>"></p>
                      
                </div> 
                <div style="float:left; width:450px; margin-left:50px">
                  <p><label>Provincia</label><br /> <select class="styled" name="provincia"><option value=" ">- Seleccionar</option><?php       foreach($provincias as $key){
                ?><option value="<?php echo $key['id_provincia'] ?>"><?php echo $key['nombre_provincia'] ?></option><?php
            }
             ?></select></p>
             
             <p><label>Comuna</label><br /> <select class="styled" name="comuna_id"><option value=" ">- Seleccionar</option><?php      foreach($comunas as $key){
                ?><option value="<?php echo $key['comuna_id'] ?>" ><?php echo $key['comuna_nombre'] ?></option><?php
            }
             ?></select></p>
                    
                    <p><label>Dirección</label><br /> <input type="text" name="direccion" size="55" class="text" value="<?php echo set_value('direccion') ?>"></p>
                    
                    <p><label>Código postal </label><br /> <input type="text" name="cp" size="55" class="text" value="<?php echo set_value('cp') ?>"></p>
                    
                    <p><label>Giro</label><br /> <input type="text" name="tipo" size="55" class="text" value="<?php echo set_value('tipo') ?>"></p>
                    
                    <p><label>Entidad Bancaria</label><br /> <input type="text" name="entidad" size="55" class="text" value="<?php echo set_value('entidad') ?>"></p>
                    
                    <p><label>N° Cuenta</label><br /> <input type="text" name="numero_cuenta" size="55" class="text" value="<?php echo set_value('numero_cuenta') ?>"></p>
                    
                    <p><label>Observaciones </label><br /> <textarea class="text m" name="observaciones"><?php echo set_value('observaciones') ?></textarea></p>
                </div>
                
                <br clear="all" />
                <hr>
                <p>
                  <input type="submit" class="submit mid" value="Guardar" />
                </p>
               
             </form>
          
                                
    </div>
    
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>
<script>
    
</script>
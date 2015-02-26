<link rel="stylesheet" type="text/css" href="public/admin/jquery-ui-1.11.2.custom/jquery-ui.css"/>
<link rel="stylesheet" type="text/css" href="public/admin/datetimepicker/jquery.datetimepicker.css"/ >
<script type="text/javascript" src="public/admin/jquery-ui-1.11.2.custom/jquery-ui.js"></script>
<script src="public/admin/datetimepicker/jquery.datetimepicker.js"></script>

<style>

</style>
<script>
  var contador_filas = <?php echo count($conductores)?>;
</script>

<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        
        <h2>Nuevo Proveedor de viajes a terceros</h2>
        
        <ul>
            <li><?php echo anchor("proveedores_viajes_terceros", "Lista de Proveedores terceros")?></li>
            <li class="active"><?php echo anchor("proveedores_viajes_terceros/nuevo", "Nuevo proveedor tercero")?></li>
        </ul>
    </div>    

    <div class="block_content">
        
    <?php if (validation_errors()){ ?>
            <div class="message error">
            <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
      <form method="post" action="proveedores_viajes_terceros/add" enctype="multipart/form-data">
        
                 
                <div style="float:left; width:900px">
                    
                      
                  <div class="ui-widget">
                    <input type="hidden" id="contador_filas" name="contador_filas" />

                    <p><label>Nombre del proveedor</label><br /> <input value="<?php echo $data[0]['nombre_proveedor']?>" type="text" name="nombre_proveedor" size="55" class="text" ></p>

                      <p><label>RUT</label><br /> <input value="<?php echo $data[0]['rut']?>"maxlength="10" type="text" name="rut" size="55" class="text" ></p>

                    <p><label>Razón social</label><br /> <input value="<?php echo $data[0]['razon_social_proveedor']?>" type="text" name="razon_social_proveedor" size="55" class="text" ></p>
                    
                    <p><label>Dirección de contacto</label><br /> <input value="<?php echo $data[0]['direccion_contacto']?>" type="text" name="direccion_contacto" size="55" class="text" ></p>
                    
                    <p><label>Persona de contacto</label><br /> <input value="<?php echo $data[0]['persona_de_contacto']?>" type="text" name="persona_de_contacto" size="55" class="text" ></p>
                    
                    <p><label>Teléfono</label><br /> <input value="<?php echo $data[0]['telefono']?>" type="text" name="telefono" size="55" class="text" ></p>
                    
                    <div><h3>Conductores</h3>
                      <table id="conductores_table" width="100%">
                        <thead>
                          <tr>
                            <th>Identificador</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>RUT</th>
                            <th>Patente camión asociada</th>
                            <th>Patente rampla asociada</th>
                            <th>Opciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($conductores as $conductor):?>
                            <tr>
                              <td><?php echo $conductor['identificador']?></td>
                              <td><?php echo $conductor['nombre']?></td>
                              <td><?php echo $conductor['apellidos']?></td>
                              <td><?php echo $conductor['rut']?></td>
                              <td><?php echo $conductor['patente_camion_asociada']?></td>
                              <td><?php echo $conductor['patente_rampla_asociada']?></td>
                              <td><img src='public/admin/images/bdelete.png' style='cursor: pointer;' onclick='eliminar_fila(this)'></td>
                            </tr>
                          <?php endforeach;?>
                        </tbody>
                      </table>
                    </div>
                    
                    <input type="button" style="visibility: visible;" class="submit extra_long" id="anadir_conductor" value="Añadir conductor">
                      
                </div> 
                <br clear="all" />
                <hr>
                <p>
                  <input type="submit" class="submit mid" value="Actualizar" />
                </p>
               
             </form>
          
    </div>
    
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>
<script>
  $('#contador_filas').val(contador_filas);

  function eliminar_fila(elemento){
    $(elemento).parent().parent().remove();
    contador_filas--;
    $("#contador_filas").val(contador_filas);
  }
  
  $("#anadir_conductor").click(function() {
          $('<a href="ajax/anadir_conductor"></a>').facebox({
            overlayShow: true
          }).click();

        });
</script>
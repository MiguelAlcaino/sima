<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/jquery-ui-1.11.2.custom/jquery-ui.css')?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/datetimepicker/jquery.datetimepicker.css')?>"/ >
<script type="text/javascript" src="<?php echo base_url('public/admin/jquery-ui-1.11.2.custom/jquery-ui.js')?>"></script>
<script src="<?php echo base_url('public/admin/datetimepicker/jquery.datetimepicker.js')?>"></script>

<style>

</style>

<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        
        <h2>Nuevo Viaje</h2>
        
        <ul>
            <li><?php echo anchor("conductores", "Lista de Conductores")?></li>
            <li class="active"><?php echo anchor("conductores/nuevo", "Nuevo conductor")?></li>
        </ul>
    </div>    

    <div class="block_content">
        
    <?php if (validation_errors()){ ?>
            <div class="message error">
            <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
      <form method="post" action="<?php echo site_url('conductores/add')?>" enctype="multipart/form-data">
        
                 
                <div style="float:left; width:450px">
                    
                      
                  <div class="ui-widget">
                    
                    <p><label>Identificador del conductor</label><br /> <input type="text" name="identificador" size="55" class="text" ></p>
                    
                    <p><label>Nombre</label><br /> <input type="text" name="nombre" size="55" class="text" ></p>
                    
                    <p><label>Apellido</label><br /> <input type="text" name="apellido" size="55" class="text" ></p>
                    
                    <p><label>Patente asociada</label><br /> <input type="text" name="patente_asociada" size="55" class="text" ></p>
                    
                    <p><label>RUT</label><br /> <input type="text" name="rut" size="55" class="text" ></p>
                    
                    <p><label>Fecha de nacimiento</label><br /> <input id="fecha_nacimiento" type="text" name="fecha_nacimiento" size="55" class="text" ></p>
                    
                    
                      
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

<script type="text/javascript">        
        $('#fecha_nacimiento').datetimepicker({
          format:'Y-m-d',
          timepicker:false,
        });
        </script>
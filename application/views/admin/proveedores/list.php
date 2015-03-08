<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        
        <h2> Proveedores</h2>
        
        <ul class="tabs">
            <li <?php if($tab == '') echo 'class="active"'?>><a href="#list">Listar</a></li>
            <li <?php if($tab == 'nuevo') echo 'class="active"'?>><a href="#new">Nuevo Proveedor</a></li>
        </ul>
        <ul>
            <li>Buscar: <input type="text" id="filtro"/></li>
        </ul>
    </div>		
    
    <div class="block_content tab_content <?php if($tab != '') echo 'hide'?>" id="list">
    	<?php 
				if($this->session->flashdata('message'))
				{ ?>
					<?php echo $this->session->flashdata('message'); ?>
				<?php 
				} ?>
        <form action="" method="post">
        
            <table cellpadding="0" cellspacing="0" width="100%" class="sortable_list">
            
                <thead>
                    <tr>
                    	<th width="10"></th>
                        <th>Nombre Comercial</th>
                        <th>Razón Social</th>
                        <th>RUT</th>
                        <th>Contacto</th>
                        <th>Email</th>
                        <th>Provincia</th>
                        <th class="option">Opcion</th>
                    </tr>
                </thead>

                
                <tbody>
                   <?php
					if(is_array($data))
					{
					foreach($data as $key){
					 ?>
                        <tr class="rows">
                        	<td></td>
                            <td><?php echo $key['nombre_comercial'] ?></td>
                            <td><?php echo $key['razon_social']  ?></td>
                            <td><?php echo $key['nif_cif']  ?></td>
                            <td><?php echo $key['contacto']  ?></td>
                            <td><?php echo $key['email']  ?></td>
                            <td><?php echo $key['nombre_provincia']  ?></td>
                            <td class="options">
                                <a href="<?php echo site_url('proveedores/editar/'.$key['id_proveedor']) ?>" class="tip" title="Editar"><img src="<?php echo base_url('public/admin/images/bedit.png')?>" /></a>
                                <a href="<?php echo site_url('proveedores/eliminar/'.$key['id_proveedor'] ?>" class="tip"  title="Eliminar" onclick="return delete_row()"><img src="<?php echo base_url('public/admin/images/bdelete.png')?>" /></a>
                                
                            </td>
                        </tr>
                   <?php 
					}
				   } ?>
                    
                </tbody>
                
            </table>
            
        </form>
        
        <?php 
		if(count($data) > 0){
		?>
        
		<div class="pagination right" id="pager">
            <a href="#" class="prev">«</a> <span id="pnumbers"></span> <a href="#" class="next">»</a>
            <select class="pagesize">
                    <option selected="selected"  value="10">10</option>
        
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option  value="40">40</option>
                </select>
        </div>
		<script type="text/javascript">
        	$(function () {
				$("table.sortable_list").tablesorter({
					headers: { 0: { sorter: false}, 7: {sorter: false} },		// Disabled on the 1st and 6th columns
					widgets: ['zebra']
				}).tablesorterFilter({ filterContainer: $("#filtro"),
                    filterClearContainer: $("#filterClearTwo"),
                    filterCaseSensitive: false
                }).tablesorterPager({container: $("#pager"),positionFixed: false}
				);
				
			});
        </script>
        <?php 
		}
		?>
        
    </div>
    <div class="block_content tab_content  <?php if($tab != 'nuevo') echo 'hide'?>" id="new">
				
		<?php if (validation_errors()){ ?>
            <div class="message error">
            <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
			<form method="post" action="<?php echo site_url('proveedores/agregar')?>" enctype="multipart/form-data" id="form_">
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
                 	<p><label>Provincia</label><br /> <select class="styled" name="provincia"><option value=" ">- Seleccionar</option><?php 			foreach($provincias as $key){
								?><option value="<?php echo $key['id_provincia'] ?>"><?php echo $key['nombre_provincia'] ?></option><?php
						}
						 ?></select></p>
                    <p><label>Población</label><br /> <input type="text" name="poblacion" size="55" class="text" value="<?php echo set_value('poblacion') ?>"></p>
                    
                    <p><label>Dirección</label><br /> <input type="text" name="direccion" size="55" class="text" value="<?php echo set_value('direccion') ?>"></p>
                    
                    <p><label>Código postal </label><br /> <input type="text" name="cp" size="55" class="text" value="<?php echo set_value('cp') ?>"></p>
                    
                    <p><label>Tipo Empresa</label><br /> <input type="text" name="tipo" size="55" class="text" value="<?php echo set_value('tipo') ?>"></p>
                    
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
    $('.sortable_list').tablesorter();
</script>
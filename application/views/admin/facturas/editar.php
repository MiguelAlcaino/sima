<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        
        <h2>Facturas</h2>
        
        <ul>
            
            <li><a href="<?php echo site_url('facturas')?>">Pendientes</a></li>
            <li><a href="<?php echo site_url('facturas/pagadas')?>">Pagadas</a></li>
            <li><a href="<?php echo site_url('facturas/nueva')?>">Crear Factura</a></li>
            <li><a href="<?php echo site_url('facturas/imprimir/'.$data[0]['id_factura']) ?>">Imprimir</a></li>
        </ul>
    </div>		

    <div class="block_content">
				
		<?php if (validation_errors()){ ?>
            <div class="message error">
            <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
			<form method="post" action="<?php echo site_url('facturas/actualizar')?>" enctype="multipart/form-data">
            	<input type="hidden" id="id_factura" name="id_factura" value="<?php echo $data[0]['id_factura'] ?>" />
            	<div style="width:50%; float:left">
                	<p><label>Número Factura</label><br /> <input type="text" name="numero" class="text required"  value="<?php echo $data[0]['numero'] ?>"></p>
                	<p><label>Fecha</label><br /> <input type="text" name="fecha" class="text required"  value="<?php echo date("d/m/Y",strtotime($data[0]['fecha'])) ?>"></p>
                	<p><label>Condiciones de venta</label><br /> <input type="text" name="condiciones_venta" style="width:380px" class="text required" value="<?php echo $data[0]['condiciones_venta']?>"></p>
                </div>
                <div style="width:50%; float:left">
                	<div class="ui-widget">
                		<p><label> Cliente</label><br /> <input type="text" name="cliente" id="clientes" disabled="disabled" class="text required"  value="<?php echo $data[0]['nombre_comercial'] ?>"></p>				</div>
                    <textarea class="text" name="des" id="des" style="height:40px" disabled="disabled"><?php echo $data[0]['nombre_comercial']." (".$data[0]['razon_social'].") \n".$data[0]['nif_cif'].", ".$data[0]['direccion'].", ".$data[0]['poblacion'].", ".$data[0]['nombre_provincia'].", ".$data[0]['cp'] ?></textarea>
                </div>
                <br clear="all" />
				<table cellpadding="0" cellspacing="0" width="100%">
            
                    <thead>
                        <tr>
                            <th width="10"></th>
                            <th>Cantidad</th>
                            <th width="30%">Descripción</th>
                            <th style="text-align:right" width="10%">Precio</th>
                            <th style="text-align:right" width="10%">Precio Total</th>
                        </tr>
                    </thead>
                    <tbody id="detalle">
                    	<?php
                        $total = 0;
						foreach($detail as $k)
						{
							$precio_t = ($k['precio'] * $k['cantidad']);
							$total    = $total + $precio_t;
							$iva      = ($total * 0.18);
					 	?>
                    		<tr>
                            	<td></td>
                            	<td><?php echo $k['cantidad'] ?></td>
                                <td><?php echo $k['descripcion'] ?></td>
                                <td style="text-align:right"><?php echo number_format($k['precio'],2) ?></td>
                                <td style="text-align:right"><?php echo $precio_t ?></td>
                            </tr>
                        <?php 
						
						}
						?>
                    </tbody>
                    <tfoot>
                    	<tr>
                        	<th colspan="3"></th>
                            <th style="text-align:right"><b>Total sin IVA</b></th>
                            <th style="text-align:right"><b class="total_siva"><?php echo number_format($total,2) ?></b></th>
                        </tr>
                        <tr>
                            <th colspan="3"></th>
                            <th style="text-align:right"><b> IVA</b></th>
                            <th style="text-align:right"><b class="iva"><?php echo number_format($iva,2) ?></b></th>
                        </tr>
                        <tr>
                            <th colspan="3"></th>
                            <th style="text-align:right"><b>Total con IVA</b></th>
                            <th style="text-align:right"><b class="total_civa"><?php echo number_format(($total+$iva),2) ?></b></th>
                        </tr>
                     <tfoot>
                </table>	
                <br clear="all" />
                <p>
                	<label>Estado</label>  <select class="styled" name="estado"><option value="0"  <?php echo ($data[0]['estado'] == 0) ? "selected='selected'":"" ?>>Pendiente</option><option value="1"  <?php echo ($data[0]['estado'] == 1) ? "selected='selected'":"" ?>>Pagada</option></select>
                	<input type="hidden" name="estado_anterior" value="<?php echo $data[0]['estado']?>"/>
                </p>
                <hr>
               <p>
                	<input type="submit" class="submit mid" value="Actualizar" />
                </p>
             </form>
					
		</div>
    
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>
<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        
        <h2>Facturas</h2>
        
        <ul>
        	<li><a href="<?php echo site_url('facturas')?>">Pendientes</a></li>
            <li><a href="<?php echo site_url('facturas/pagadas')?>">Pagadas</a></li>
            <li class="active"><a href="<?php echo site_url('facturas/nueva')?>">Crear Factura</a></li>
        </ul>
    </div>		
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/jquery-ui-1.11.2.custom/jquery-ui.css')?>"/>
	  <script type="text/javascript" src="<?php echo base_url('public/admin/jquery-ui-1.11.2.custom/jquery-ui.js')?>"></script>

    <div class="block_content" id="new">
				
		
		<?php if (validation_errors()){ ?>
            <div class="message error">
            <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
			<form method="post" action="<?php echo site_url('facturas/agregar')?>" enctype="multipart/form-data" id="form_new_p" name="form_new_p">
            	<input type="hidden" id="id_cliente" name="id_cliente" />
            	<div style="width:50%; float:left">
                	<p><label>Número Factura</label><br /> <input type="text" name="numero" class="text required" ></p>
                	<p><label>Fecha</label><br /> <input type="text" name="fecha" style="width:380px"  class="text date_picker"   value="<?php echo date("Y/m/d") ?>"></p>
                	<p><label>Condiciones de venta</label><br /> <input type="text" name="condiciones_venta" style="width:380px" class="text required"></p>
                </div>
                <div style="width:50%; float:left">
                	<div class="ui-widget">
                		<p><label>Buscar Cliente</label><br /> <input type="text" name="cliente" id="clientes" class="text required"  value=""></p>				</div>
                    <textarea class="text" name="des" id="des" style="height:40px" disabled="disabled"></textarea>
                </div>
                <p align="right"><input type="button" style="visibility: hidden;" class="submit extra_long" id="buscar_prod_serv" value="Ingresar por código" /></p>
                <p>
                  <table id="todos_los_viajes">
                    <thead>
                      <tr>
                        <th>Selección</th>
                        <th>Fecha</th>
                        <th>Nave</th>
                        <th>Conductor</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Descripción Carga</th>
                        <th>Propio o Tercero</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                      <tr>
                        <td colspan="8" align="right"> <input type="button"  class="submit extra_long" id="agregar_viajes" value="Agregar viajes" /></td>
                      </tr>
                    </tfoot>
                  </table>
                </p>
                <br clear="all" />
				<table cellpadding="0" cellspacing="0" width="100%">
            
                    <thead>
                        <tr>
                            <th width="10"></th>
                            <th>Cantidad</th>
                            <th width="30%">Descripción</th>
                            <th style="text-align:right" width="10%">Precio</th>
                            <th style="text-align:right" width="10%">Precio Total</th>
                            <th class="option" style="text-align:center">Opcion</th>
                        </tr>
                    </thead>
                    <tbody id="detalle">
                    	<tr class="nothing">
                        	<td style="text-align:center" colspan="6">Sin detalle</td>
                        </tr>
                    </tbody>
                    <tfoot>
                    	<tr>
                        	<th colspan="3"></th>
                            <th style="text-align:right"><b>Total sin IVA</b></th>
                            <th style="text-align:right"><b class="total_siva">0.00</b></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th colspan="3"></th>
                            <th style="text-align:right"><b> IVA</b></th>
                            <th style="text-align:right"><b class="iva">0.00</b></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th colspan="3"></th>
                            <th style="text-align:right"><b>Total con IVA</b></th>
                            <th style="text-align:right"><b class="total_civa">0.00</b></th>
                            <th></th>
                        </tr>
                     <tfoot>
                </table>	
				<input type="hidden" name="input_total_civa" id="input_total_civa" />
                <p>
                	<input type="submit" class="submit mid" value="Guardar" />
                </p>
               
             </form>
					
                    						
		</div>
    
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>
<script type="text/javascript">
    
        $('#agregar_viajes').hide();
    
        $( "#clientes" ).autocomplete({
          source: function( request, response ) {
            $.ajax({
              url: "<?php echo site_url('ajax/clientes')?>",
              type:"POST",
              dataType: "json",
              data: {
                maxRows: 12,
                q: request.term,
              },
              success: function(data) {
                
                response( $.map( data, function( item ) {
                  return {
                    label: item.nombre_comercial +" ("+ item.razon_social +")",
                    value: item.nombre_comercial,
                    id: item.id_cliente,
                    nif_cif: item.nif_cif,
                    direccion: item.direccion,
                    ciudad: item.poblacion,
                    provincia: item.nombre_provincia,
                    cp: item.cp
                  }
                }));
              }
            });
          },
          minLength: 2,
          select: function( event, ui ) {
            $("#id_cliente").val(ui.item.id);
            $("#buscar_prod_serv").css("visibility", "visible");
            traerViajes(ui.item.id);
            $("#des").val(ui.item.label+"\n"+ui.item.nif_cif+", "+ui.item.direccion+", "+ui.item.ciudad+", "+ui.item.provincia+", "+ui.item.cp);
          },
          open: function() {
            $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
          },
          close: function() {
            $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
          }
        });
        
        $("#buscar_prod_serv").click(function() {
          $('<a href="<?php echo site_url('ajax/search_prod_serv')?>"></a>').facebox({
            overlayShow: true
          }).click();

        });
        
        $(".psi, .quantity").on("keyup",(function(){
          calculate();
        }));
        
        $(".delete").on("click",(function(){
          $(this).parent().parent().remove();
          if($("#detalle tr").length == 0){
            $("#detalle").html('<tr class="nothing"><td style="text-align:center" colspan="6">Sin detalle</td></tr>');
          }
          calculate();
        }));
        
        function calculate()
        {
          var suma=0, iva = 0;
          $(".psi").each(function(x){
            suma += parseInt($(".psi").eq(x).val() * $(".quantity").eq(x).val());
            $(".ptotal").eq(x).text((parseInt($(".psi").eq(x).val() * $(".quantity").eq(x).val())).toFixed(0));
          });
          iva = (suma) * 0.19;
          $(".total_siva").html((suma).toFixed(0));
          $(".iva").html((iva).toFixed(0));
          $(".total_civa").html((suma + iva).toFixed(0));
          $("#input_total_civa").val((suma + iva).toFixed(0));
        }
        
        $("#form_new_p").validate({
          errorClass : 'error',
          errorElement : 'span',
          submitHandler: function(form) {
            if($("#detalle tr").eq(0).hasClass("nothing")){
              alert("Usted debe ingresar un detalle para la factura");
              return false;
            }
            
            document.form_new_p.submit()
          }
        });
        
        function traerViajes(cliente_id){
          $.ajax({
            type: "POST",
            dataType: "json",
            data: {
              cliente_id: cliente_id
            },
            url: "<?php echo site_url("ajax/viajesPropiosYTercerosFacturadosPorCliente")?>",
            success: function(data){
              $('#todos_los_viajes tbody').empty();
              if(data.length == 0){
                
              }else{
                $('#agregar_viajes').show();
              }
              
              $.each(data, function(index, value){
                //console.log(value);
                descripcion = "Traslado "+((value.numero_contenedor == "") ? "" : "cont: "+value.numero_contenedor)+" "+( (value.nave == "") ? "" : "nave: "+value.nave )+" "+value.origen+" a "+value.destino+" "+ ( (value.numero_guia == "") ? "" : value.numero_guia )+" ("+value.codigo_viaje+")";
                html ="<tr>";
                html +="<td><input valor_viaje=\'"+value.valor_viaje+"\' descripcion=\'"+descripcion+"\' cantidad=\'1\' tipo_viaje=\'"+value.tipo_viaje+"\' class=\'viajes_no_facturados\' type=\'checkbox\' name=\'viajes_no_facturados[]\' value=\'"+value.id+"\' /></td>";
                html +="<td>"+value.fecha_origen+"</td>";
                html +="<td>"+value.nave+"</td>";
                html +="<td>"+value.conductor_identificador+" - "+value.conductor_nombre+" "+value.conductor_apellido+"</td>";
                html +="<td>"+value.origen+"</td>";
                html +="<td>"+value.destino+"</td>";
                html +="<td>"+value.descripcion_carga+"</td>";
                html +="<td>"+((value.tipo_viaje == 3) ? "Propio" : "Tercero")+"</td>";
                html +="</tr>"
                $('#todos_los_viajes tbody').append(html);
                
              });
            $('.viajes_no_facturados').click(function(){
                  cantidad_viajes_seleccionados = $('.viajes_no_facturados:checked').length;
                  console.log(cantidad_viajes_seleccionados);
                  if(cantidad_viajes_seleccionados > 15){
                    $(this).attr('checked','');
                    alert("No puede seleccionar más de 15 elementos para una factura");
                  }
                });
              
            
            
            }
          });
        }
        
        function eliminar_fila_detalle(elemento){
          $(elemento).parent().parent().remove();
          if($("#detalle tr").length == 0){
            $("#detalle").html('<tr class="nothing"><td style="text-align:center" colspan="6">Sin detalle</td></tr>');
          }
          calculate();
        }
        
        $('#agregar_viajes').click(function(){
          $('.viajes_no_facturados:checked').each(function(){
            //console.log($(this).attr('descripcion'));
            var html = "<tr><td></td><td><input type=\'hidden\' name=\'origen_detalle_id_form[]\' value="+$(this).val()+" /> <input type=\'hidden\' name=\'tipo_detalle_form[]\' value="+$(this).attr('tipo_viaje')+" /> <input style=\'text-align:center\' value="+$(this).attr('cantidad')+"  name=\'quantity[]\' class=\'quantity\' type=\'text\'><input type=\'hidden\' name=\'descripcion[]\' value=\'"+$(this).attr('descripcion')+"\' ></td><td>"+$(this).attr('descripcion')+"</td><td><input style=\'text-align:right\' value="+$(this).attr('valor_viaje')+" type=\'text\' class=\'psi\' name=\'psi[]\'></td><td style=\'text-align:right\' class=ptotal>"+($(this).attr('valor_viaje') * $(this).attr('cantidad')).toFixed(0)+"</td><td  style=\'text-align:center\'><a  class=\'delete\'  title=\'Eliminar\' onclick=\'eliminar_fila_detalle(this);\'  href=javascript:;><img src=\'public/admin/images/bdelete.png\' /></td></tr>";
            
            if($("#detalle tr").eq(0).hasClass("nothing")){
              $("#detalle").html(html);
            }else{
              $("#detalle").append(html);
            }
            
            var suma=0, iva = 0;
            $(".psi").each(function(x){
              suma += parseInt($(".psi").eq(x).val() * $(".quantity").eq(x).val());
            });
            iva = (suma) * 0.19;
            $(".total_siva").html((suma).toFixed(0));
            $(".iva").html((iva).toFixed(0));
            $(".total_civa").html((suma + iva).toFixed(0));
            $("#input_total_civa").val((suma + iva).toFixed(0));
            
          });
        });
        
        </script>
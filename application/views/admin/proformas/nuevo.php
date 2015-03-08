<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        
        <h2> Proformas</h2>
        
        <ul>
            <li><a href="proformas">Pendientes</a></li>
            <li><a href="proformas/pagadas">Pagadas</a></li>
            <li class="active"><a href="proformas/nuevo">Crear Proforma</a></li>
        </ul>
        
    </div>		
    
    
    
    <link rel="stylesheet" type="text/css" href="public/admin/jqueryui/css/smoothness/jquery-ui-1.8.16.custom.css"/>
	<script type="text/javascript" src="public/admin/jqueryui/js/jquery-ui-1.8.16.custom.min.js"></script>

    <div class="block_content" id="new">
		<script type="text/javascript">
        	$(function() {
		
				$( "#clientes" ).autocomplete({
					source: function( request, response ) {
						$.ajax({
							url: "ajax/clientes",
							type:"POST",
							dataType: "json",
							data: {
								maxRows: 12,
								q: request.term
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
					$('<a href="ajax/search_prod_serv_to_proforma"></a>').facebox({
						overlayShow: true
					}).click();

				});
				
				$(".psi, .quantity").live("keyup",(function(){
					calculate();
				}));
				
				$(".delete").live("click",(function(){
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
						$(".ptotal").eq(x).text((parseInt($(".psi").eq(x).val() * $(".quantity").eq(x).val())).toFixed(2));
					});
					$(".total_siva").html((suma).toFixed(2));
					$("#input_total_civa").val(suma);
				}
				
				$("#form_new_p").validate({
					errorClass : 'error',
					errorElement : 'span',
					submitHandler: function(form) {
						if($("#detalle tr").eq(0).hasClass("nothing")){
							alert("Ustede debe ingresar un detalle para la proforma");
							return false;
						}
						
						document.form_new_p.submit()
					}
				});

			});
        </script>		
		
		<?php if (validation_errors()){ ?>
            <div class="message error">
            <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
			<form method="post" action="proformas/agregar/" enctype="multipart/form-data" id="form_new_p" name="form_new_p"> 
            	<input type="hidden" id="id_cliente" name="id_cliente" />
                
            	<div style="width:50%; float:left">
                	<p><label>Número</label><br /> <input type="text" name="numero" class="text required"  value="<?php echo $cod ?>"></p>
                	<p><label>Fecha</label><br /> <input type="text" name="fecha" style="width:380px"  class="text date_picker"  value="<?php echo date("Y/m/d") ?>"></p>
                </div>
                <div style="width:50%; float:left">
                	<div class="ui-widget">
                		<p><label>Buscar Cliente</label><br /> <input type="text" name="cliente" id="clientes" class="text required"  value=""></p>				</div>
                    <textarea class="text" name="des" id="des" style="height:40px" disabled="disabled"></textarea>
                </div>
                <p align="right"><input type="button" class="submit extra_long" id="buscar_prod_serv" value="Añadir Producto o Servicio" /></p>
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
                            <th style="text-align:right"><b>Total</b></th>
                            <th style="text-align:right"><b class="total_siva">0.00</b></th>
                            <th></th>
                        </tr>
                     <tfoot>
                </table>	
                <br clear="all" />
                <hr>
				<input type="hidden" name="input_total_civa" id="input_total_civa" />
                <p>
                	<input type="submit" class="submit mid" value="Guardar" />
                </p>
               
             </form>
					
                    						
		</div>
    
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>
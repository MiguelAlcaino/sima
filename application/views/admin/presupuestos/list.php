<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        
        <h2> Presupuestos</h2>
        
        <ul class="tabs">
            <li <?php if($tab == '') echo 'class="active"'?>><a href="#list">Listar</a></li>
            <li <?php if($tab == 'nuevo') echo 'class="active"'?>><a href="#new">Crear Presupuesto</a></li>
        </ul>
         <ul>
        	<li>Del: <input type="text" id="fechai"  class="date" value="<?php echo date("Y-m-d",strtotime('-1 month',time()))?>"/></li>
            <li>Hasta: <input type="text" id="fechaf" class="date"  value="<?php echo date("Y-m-d"); ?>"  /></li>
            <li>Empresa: <select id="empresa" style="width:150px">
            		<option value="">Todas</option>
                    <?php
					foreach($clientes as $kc){
						?><option value="<?php echo $kc['id_cliente'] ?>"><?php echo $kc['nombre_comercial'] ?></option><?php
					}
					 ?>
            </select>&nbsp; <input type="button" value="Buscar" class="" id="btn_search" /></li>
        </ul>
    </div>		
    <script type="text/javascript">
    	$(document).ready(function(){
			
			function search_factura(q, fi, ff){
				$.ajax({
					data: "q="+q+"&fi="+fi+"&ff="+ff,
					type: "POST",
					dataType: "json",
					url: "ajax/presupuestos_ajax/",
						success: function(data){ 
							if(data.length > 0){
								var html ='', sum=0;
								$.each(data, function(i,item){
									html += '<tr class="rows"><td></td><td>'+item.numero+'</td><td>'+item.nombre_comercial+'</td><td style="text-align:right">'+item.monto+'</td><td style="text-align:center">'+item.fecha+'</td><td><a href="presupuestos/editar/'+item.id+'" class="tip" title="Editar"><img src="public/admin/images/bedit.png" /></a>&nbsp; <a href="presupuestos/eliminar/'+item.id+'" class="tip"  title="Eliminar" onclick="return delete_row()"><img src="public/admin/images/bdelete.png" /></a>&nbsp; <a href="presupuestos/imprimir/'+item.id+'" class="tip"  title="Imprimir"><img src="public/admin/images/pdf.png" /></a></td></tr>';
									sum = sum + parseFloat(item.monto);
								});
								
								$(".total_pe").html("<b>"+sum.toFixed(2)+"</b>");
								$(".sortable_list tbody").html(html);
								$(".sortable_list").trigger("update");
								var sorting = [[1,0]]; 
								$("#pager").show();
								$(".sortable_list").trigger("sorton",[sorting]).tablesorterPager({container: $("#pager"),positionFixed: false}
				); 
							}else{
								$(".total_pe").html("<b>0.00</b>");
								$(".sortable_list tbody").html("");
								$("#pager").hide();
							}
						}
				  });	
			 }
	 		
			search_factura($("#empresa").find("option:selected").val(),$("#fechai").val(),$("#fechaf").val());
			
			$("#btn_search").click(function(){
				search_factura($("#empresa").find("option:selected").val(),$("#fechai").val(),$("#fechaf").val());
			});
			
			
			var dates = $('#fechai, #fechaf').datepicker({
			showOn: "button",
			buttonImage: "public/admin/images/calendar.png",
			buttonImageOnly: true,
			maxDate: '+3M',
			dateFormat: 'yy-mm-dd',
			onSelect: function(selectedDate) {
				var option = this.id == "fechai" ? "minDate" : "maxDate";
				var instance = $(this).data("datepicker");
				var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				dates.not(this).datepicker("option", option, date);
			}
		});
			
		});
    </script>
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
                    	<th width="5%"></th>
                        <th width="20%">Número</th>
                        <th width="20%">Cliente</th>
                        <th width="10%"><div style="position:relative; left:28px">Precio Total</div></th>
                        <th width="30%" style="text-align:center">Fecha</th>
                        <th class="option" width="150">Opcion</th>
                    </tr>
                </thead>

                <tbody>
                   
                </tbody>
                <tfoot>
                	<tr>
                	<tr><td colspan="2"></td><td><b>Total</b></td><td class="total_pe" style="text-align:right; font-size:13px"><b>0.00</b></td><td colspan="2"></td></tr>
                </tr>
                </tfoot>
            </table>
            
        </form>
        
        
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
					headers: { 0: { sorter: false}, 5: {sorter: false} },		// Disabled on the 1st and 6th columns
					widgets: ['zebra']
				})
				/*.tablesorterPager({container: $("#pager"),positionFixed: false}
				)*/
			});
        </script>
        
    </div>
    
    <link rel="stylesheet" type="text/css" href="public/admin/jqueryui/css/smoothness/jquery-ui-1.8.16.custom.css"/>
	<script type="text/javascript" src="public/admin/jqueryui/js/jquery-ui-1.8.16.custom.min.js"></script>

    <div class="block_content tab_content  <?php if($tab != 'nuevo') echo 'hide'?>" id="new">
		<script type="text/javascript">
        	$(function() {
		
				$( "#clientes" ).autocomplete({
					source: function( request, response ) {
						$.ajax({
							url: "<?php echo site_url('ajax/clientes')?>",
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
					$('<a href="<?php echo site_url('ajax/search_prod_serv')?>"></a>').facebox({
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
					iva = (suma) * 0.18;
					$(".total_siva").html((suma).toFixed(2));
					$(".iva").html((iva).toFixed(2));
					$(".total_civa").html((suma + iva).toFixed(2));
					$("#input_total_civa").val((suma + iva).toFixed(2));
				}
				
				$("#form_new_p").validate({
					errorClass : 'error',
					errorElement : 'span',
					submitHandler: function(form) {
						if($("#detalle tr").eq(0).hasClass("nothing")){
							alert("Ustede debe ingresar un detalle para el presupuesto");
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
			<form method="post" action="<?php echo site_url('presupuestos/agregar')?>" enctype="multipart/form-data" id="form_new_p" name="form_new_p">
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
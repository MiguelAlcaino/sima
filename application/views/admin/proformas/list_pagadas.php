<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        
        <h2> Proformas</h2>
        
        <ul>
        	<li>Del: <input type="text" id="fechai"  class="date" value="<?php echo date("Y-m-d",strtotime('-1 month',time()))?>"/></li>
            <li>Hasta: <input type="text" id="fechaf" class="date"  value="<?php echo date("Y-m-d"); ?>"  /></li>
            <li>Empresa: <select id="empresa" style="width:110px">
            		<option value="">Todas</option>
                    <?php
					foreach($clientes as $kc){
						?><option value="<?php echo $kc['id_cliente'] ?>"><?php echo $kc['nombre_comercial'] ?></option><?php
					}
					 ?>
            </select>&nbsp; <input type="button" value="Buscar" class="" id="btn_search" /></li>
            
            <li><a href="proformas">Pendientes</a></li>
            <li class="active"><a href="proformas/pagadas">Pagadas</a></li>
            <li><a href="proformas/nuevo">Crear Proforma</a></li>
        </ul>
    </div>		
    <script type="text/javascript">
    	$(document).ready(function(){
			
			function search_factura(q, fi, ff){
				$.ajax({
					data: "q="+q+"&fi="+fi+"&ff="+ff+"&t=1",
					type: "POST",
					dataType: "json",
					url: "ajax/proformas_ajax/",
						success: function(data){ 
							if(data.length > 0){
								var html ='', sum=0;
								$.each(data, function(i,item){
									html += '<tr class="rows"><td></td><td>'+item.numero+'</td><td>'+item.nombre_comercial+'</td><td style="text-align:right">'+item.monto+'</td><td style="text-align:center">'+item.fecha+'</td><td><a href="proformas/editar/'+item.id+'" class="tip" title="Editar"><img src="public/admin/images/bedit.png" /></a>&nbsp; <a href="proformas/eliminar/'+item.id+'" class="tip"  title="Eliminar" onclick="return delete_row()"><img src="public/admin/images/bdelete.png" /></a>&nbsp; <a href="proformas/imprimir/'+item.id+'" class="tip"  title="Imprimir"><img src="public/admin/images/pdf.png" /></a></td></tr>';
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
    <div class="block_content" id="list">
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
				
/*				
*/			});
        </script>
        
    </div>
    
    <link rel="stylesheet" type="text/css" href="public/admin/jqueryui/css/smoothness/jquery-ui-1.8.16.custom.css"/>
	<script type="text/javascript" src="public/admin/jqueryui/js/jquery-ui-1.8.16.custom.min.js"></script>

    
    
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>
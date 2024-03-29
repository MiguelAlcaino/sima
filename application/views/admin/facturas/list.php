    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/jquery-ui-1.11.2.custom/jquery-ui.css')?>"/>
    <script type="text/javascript" src="<?php echo base_url('public/admin/jquery-ui-1.11.2.custom/jquery-ui.js')?>"></script>

<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        
        <h2>Facturas</h2>
        
        <ul>
        	<li class="active"><a href="<?php echo site_url('facturas')?>">Pendientes</a></li>
            <li><a href="<?php echo site_url('facturas/pagadas')?>">Pagadas</a></li>
            <li><a href="<?php echo site_url('facturas/nueva')?>">Crear Factura</a></li>
        </ul>
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
            </select>
            &nbsp; <input type="button" value="Buscar" class="" id="btn_search" />
            </li>
        </ul>
    </div>
    
    <div class="block_content">
    	<?php 
		
				if($this->session->flashdata('message'))
				{ ?>
					<?php echo $this->session->flashdata('message'); ?>
				<?php 
				} ?>
        <form action="" method="post">
        
            <table cellpadding="0" cellspacing="0" width="100%" class="sortable_list_pen">
            
                <thead>
                    <tr>
                    	<th width="5%"></th>
                        <th width="20%">Número</th>
                        <th width="20%">Cliente</th>
                        <th width="8%"><div style="position:relative; left:28px">Precio Total</div></th>
                        <th width="30%" style="text-align:center">Fecha</th>
                        <th class="option" width="10%">Opcion</th>
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
        
        
		
		<script type="text/javascript">
        	$(function () {
						
				$("table.sortable_list_pen").tablesorter({
					headers: { 0: { sorter: false}, 5: {sorter: false} },		// Disabled on the 1st and 6th columns
					widgets: ['zebra']
				});
				
			});
        </script>
        
    </div>
    
    


<script type="text/javascript">
      
      
      function search_factura(q, fi, ff, t){
        $.ajax({
          data: "q="+q+"&fi="+fi+"&ff="+ff+"&t="+t,
          type: "POST",
          dataType: "json",
          url: "<?php echo site_url('ajax/facturas_ajax')?>",
            success: function(data){ 
              if(data.length > 0){
                var html ='', sum=0;
                $.each(data, function(i,item){
                  html += '<tr class="rows"><td></td><td>'+item.numero+'</td><td>'+item.nombre_comercial+'</td><td style="text-align:right">$'+new Intl.NumberFormat().format(item.monto)+'</td><td style="text-align:center">'+item.fecha+'</td><td><a href="<?php echo site_url('facturas/editar')?>/'+item.id+'" class="tip" title="Editar"><img src="<?php echo base_url('public/admin/images/bedit.png')?>" /></a>&nbsp; <a href="<?php echo site_url('facturas/eliminar')?>/'+item.id+'" class="tip"  title="Eliminar" onclick="return delete_row()"><img src="<?php echo base_url('public/admin/images/bdelete.png')?>" /></a>&nbsp; <a href="<?php echo site_url('facturas/imprimir_factura')?>/'+item.id+'" class="tip"  title="Imprimir"><img src="<?php echo base_url('public/admin/images/pdf.png')?>" /></a></td></tr>';
                  
                  sum = sum + parseFloat(item.monto);
                  
                });
                
                $(".total_pe").html("<b>$"+new Intl.NumberFormat().format(sum.toFixed(0))+"</b>");
                $(".sortable_list_pen tbody").html(html);
                $(".sortable_list_pen").trigger("update");
                var sorting = [[1,0]]; 
                $(".sortable_list_pen").trigger("sorton",[sorting]); 
              }else{
                $(".total_pe").html("<b>0.00</b>");
                $(".sortable_list_pen tbody").html("");
              }
            }
          }); 
       }
      
      search_factura($("#empresa").find("option:selected").val(),$("#fechai").val(),$("#fechaf").val(),0);
      
      $("#btn_search").click(function(){
        search_factura($("#empresa").find("option:selected").val(),$("#fechai").val(),$("#fechaf").val(),0);
      });
      
      
      var dates = $('#fechai, #fechaf').datepicker({
      showOn: "button",
      buttonImage: "<?php echo base_url('public/admin/images/calendar.png')?>",
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
      $('.sortable_list_pen').tablesorter();
    
    </script>    
    
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>
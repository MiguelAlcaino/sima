    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/jquery-ui-1.11.2.custom/jquery-ui.css')?>"/>
    <script type="text/javascript" src="<?php echo base_url('public/admin/jquery-ui-1.11.2.custom/jquery-ui.js')?>"></script>
<style>

</style>

<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        
        <h2>Viajes temporales</h2>
        
        <ul>
          <li class="active"><?php echo anchor("viajes_temporales", "Lista de Viajes temporales")?></li>
            <li><?php echo anchor("viajes_temporales/nuevo", "Nuevo viaje temporal")?></li>            
            
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
                        <th style="text-align:left">Nave</th>
                        <th style="text-align:left">N° contenedor</th>
                        <th style="text-align:left">Cliente</th>
                        <th style="text-align:left">Fecha de origen</th>
                        <th style="text-align:left">Origen</th>
                        <th style="text-align:left">Destino</th>
                        <th style="text-align:left">Valor viaje</th>
                        <th class="option" width="10%">Opción</th>
                    </tr>
                </thead>

                
                <tbody>
                   
                </tbody>
                <tfoot>
                  <tr>
                  <tr><td colspan="2"></td><td><b>Total</b></td><td colspan="3"></td><td class="total_pe" style="text-align:right; font-size:13px"><b>0.00</b></td><td colspan="1"></td></tr>
                </tr>
                </tfoot>
            </table>
            
        </form>
        
        
    
    <script type="text/javascript">
          $(function () {
            
        $("table.sortable_list_pen").tablesorter({
          headers: { 0: { sorter: false}, 5: {sorter: false} },   // Disabled on the 1st and 6th columns
          widgets: ['zebra']
        });
        
      });
      
      function search_factura(q, fi, ff, t){
        $.ajax({
          data: "q="+q+"&fi="+fi+"&ff="+ff+"&t="+t,
          type: "POST",
          dataType: "json",
          url: "<?php echo site_url('ajax/list_viajes_temporales_ajax')?>",
            success: function(data){ 
              if(data.length > 0){
                var html ='', sum=0;
                $.each(data, function(i,item){
                  html += '<tr class="rows"><td>'+item.nave+'</td>';
                  html += '<td>'+item.numero_contenedor+'</td>';
                  html += '<td>'+item.nombre_comercial+'</td>';
                  html += '<td>'+item.fecha_origen+'</td>';
                  html += '<td style="text-align:left">'+item.origen+'</td>';
                  html += '<td style="text-align:left">'+item.destino+'</td>';
                  html += '<td>$'+new Intl.NumberFormat().format(item.valor_viaje)+'</td>';
                  html += '<td>';
                  html += '<a href="<?php echo site_url('viajes_temporales/editar')?>/'+item.id+'" class="tip" title="Editar"><img src="<?php echo base_url('public/admin/images/bedit.png')?>" /></a>&nbsp;';
                  html += '<a href="<?php echo site_url('viajes_temporales/eliminar')?>/'+item.id+'" class="tip"  title="Eliminar" onclick="return delete_row()"><img src="<?php echo base_url('public/admin/images/bdelete.png')?>" /></a>&nbsp; </td>';
                  
                  html += '</tr>';
                  
                  sum = sum + parseInt(item.valor_viaje);
                  
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
        
    </div>    
    
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>
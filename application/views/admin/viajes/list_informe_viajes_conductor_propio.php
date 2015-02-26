    <link rel="stylesheet" type="text/css" href="public/admin/jquery-ui-1.11.2.custom/jquery-ui.css"/>
    <script type="text/javascript" src="public/admin/jquery-ui-1.11.2.custom/jquery-ui.js"></script>

<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        
        <h2>Viajes por cliente</h2>
        
        <ul>
          <li class="active"><?php echo anchor("viajes", "Lista de Viajes")?></li>
            <li><?php echo anchor("viajes/nuevo", "Nuevo viaje")?></li>            
            
        </ul>
        <ul>
          
            <li>Conductor Propio: <select id="conductor_id" style="width:110px">
                <option value="">Seleccione</option>
                    <?php
          foreach($conductores as $conductor){
            ?><option value="<?php echo $conductor['id'] ?>"><?php echo $conductor['identificador']." - ".$conductor['nombre']." ".$conductor['apellido'] ?></option><?php
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
        
            <table id="todos_los_viajes" cellpadding="0" cellspacing="0" width="100%" class="sortable_list_pen">
            
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Nave</th>
                        <th>Conductor</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Descripción Carga</th>
                        <th>Propio o Tercero</th>
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
      
      $('#conductor_id').change(function(){
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {
              conductor_id: $(this).val()
            },
            url: "<?php echo site_url("ajax/viajesPropiosPorConductor")?>",
            success: function(data){
              $('#todos_los_viajes tbody').empty();
              
              
              $.each(data, function(index, value){
                //console.log(value);
                descripcion = "Traslado "+((value.numero_contenedor == "") ? "" : "cont: "+value.numero_contenedor)+" "+( (value.nave == "") ? "" : "nave: "+value.nave )+" "+value.origen+" a "+value.destino+" "+ ( (value.numero_guia == "") ? "" : value.numero_guia )+" ("+value.codigo_viaje+")";
                html ="<tr>";
                //html +="<td><input valor_viaje=\'"+value.valor_viaje+"\' descripcion=\'"+descripcion+"\' cantidad=\'1\' tipo_viaje=\'"+value.tipo_viaje+"\' class=\'viajes_no_facturados\' type=\'checkbox\' name=\'viajes_no_facturados[]\' value=\'"+value.id+"\' /></td>";
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
            }
          });
      });
      
      function search_factura(q, fi, ff, t){
        $.ajax({
          data: "q="+q+"&fi="+fi+"&ff="+ff+"&t="+t,
          type: "POST",
          dataType: "json",
          url: "<?php echo site_url('ajax/list_viajes_ajax')?>",
            success: function(data){ 
              if(data.length > 0){
                var html ='', sum=0;
                $.each(data, function(i,item){
                  html += '<tr class="rows"><td>'+item.codigo_viaje+'</td>';
                  html += '<td>'+item.nombre_comercial+'</td>';
                  html += '<td>'+item.conductor_identificador+' - '+item.conductor_nombre+' '+item.conductor_apellido+'</td>';
                  html += '<td>'+item.fecha_origen+'</td>';
                  html += '<td style="text-align:left">'+item.origen+'</td>';
                  html += '<td style="text-align:left">'+item.destino+'</td>';
                  html += '<td>'+item.valor_viaje+'</td>';
                  html += '<td>';
                  html += '<a href="viajes/editar/'+item.id+'" class="tip" title="Editar"><img src="public/admin/images/bedit.png" /></a>&nbsp;';
                  html += '<a href="viajes/eliminar/'+item.id+'" class="tip"  title="Eliminar" onclick="return delete_row()"><img src="public/admin/images/bdelete.png" /></a>&nbsp; </td>';
                  
                  html += '</tr>';
                  
                  sum = sum + parseInt(item.valor_viaje);
                  
                });
                
                $(".total_pe").html("<b>$"+sum.toFixed(0)+"</b>");
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
      
      //search_factura($("#empresa").find("option:selected").val(),$("#fechai").val(),$("#fechaf").val(),0);
      
      $("#btn_search").click(function(){
        search_factura($("#empresa").find("option:selected").val(),$("#fechai").val(),$("#fechaf").val(),0);
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
      
        </script>
        
    </div>    
    
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>
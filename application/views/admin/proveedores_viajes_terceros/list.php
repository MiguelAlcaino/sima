    <link rel="stylesheet" type="text/css" href="public/admin/jquery-ui-1.11.2.custom/jquery-ui.css"/>
    <script type="text/javascript" src="public/admin/jquery-ui-1.11.2.custom/jquery-ui.js"></script>

<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        
        <h2>Proveedores</h2>
        
        <ul>
          <li class="active"><?php echo anchor("proveedores_viajes_terceros", "Lista de Proveedores terceros")?></li>
            <li><?php echo anchor("proveedores_viajes_terceros/nuevo", "Nuevo proveedor tercero")?></li>            
            
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
                        
                        <th style="text-align:left">Nombre del proveedor</th>
                        <th style="text-align:left">Razón social</th>
                        <th style="text-align:left">Persona de contacto</th>
                        <th style="text-align:left">Teléfono</th>
                        <th class="option" width="10%">Opción</th>
                    </tr>
                </thead>

                
                <tbody>
                   
                </tbody>
                
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
          url: '<?php echo site_url("ajax/list_proveedores_viajes_terceros_ajax")?>',
            success: function(data){ 
              if(data.length > 0){
                var html ='', sum=0;
                $.each(data, function(i,item){
                  html += '<tr class="rows"><td>'+item.nombre_proveedor+'</td>';
                  html += '<td>'+item.razon_social_proveedor+'</td>';
                  html += '<td>'+item.persona_de_contacto+'</td>';
                  html += '<td>'+item.telefono+'</td>';
                  html += '<td>';
                  html += '<a href="<?php echo site_url('proveedores_viajes_terceros/editar')?>/'+item.id+'" class="tip" title="Editar"><img src="public/admin/images/bedit.png" /></a>&nbsp;';
                  html += '<a href="<?php echo site_url('proveedores_viajes_terceros/eliminar')?>/'+item.id+'" class="tip"  title="Eliminar" onclick="return delete_row()"><img src="public/admin/images/bdelete.png" /></a>&nbsp; </td>';
                  
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
      
      search_factura($("#empresa").find("option:selected").val(),$("#fechai").val(),$("#fechaf").val(),0);
      
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
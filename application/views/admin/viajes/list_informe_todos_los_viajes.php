<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        
        <h2>Lista de todos los viajes</h2>
        
        <ul>
            <li><?php echo anchor("viajes_temporales/nuevo", "Nuevo viaje")?></li>
            <li><?php echo anchor("viajes/informeViajesTodos","Lista de viajes")?></li>
        </ul>
       
    </div>

    <div class="block_content">
        <div class="message" style="display: none">
        <?php if($this->session->flashdata('message')): ?>
            <?php echo $this->session->flashdata('message'); ?>
        <?php endif ?>
        </div>
        <form action="" method="post">
            <table id="todos_los_viajes" cellpadding="0" cellspacing="0" width="100%" class="sortable_list_pen">
            
                <thead>
                    <tr>
                        
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Nave</th>
                        <th>Conductor</th>
                        <th>N° Contenedor</th>
                        <th>N° guía</th>
                        <th>Tipo</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Interchange?</th>
                        <th>Guía?</th>
                        <th class="no-sort">Opciones</th>
                    </tr>
                </thead>

                
                <tbody>
                   
                </tbody>
                <tfoot>
                  <tr>
                  <tr><td colspan="10"></td></tr>
                </tr>
                </tfoot>
            </table>
            
        </form>
    </div>    
    
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>
<script type="text/javascript">

    getTodosLosViajes();
    $(function () {

        $("table.sortable_list_pen").tablesorter({
            headers: { 0: { sorter: false}, 5: {sorter: false} },   // Disabled on the 1st and 6th columns
            widgets: ['zebra']
        });

    });

    function getTodosLosViajes(){
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {

            },
            url: "<?php echo site_url("ajax/viajesPropiosYTerceros")?>",
            success: function(data){
                $('#todos_los_viajes tbody').empty();

                var html = "";
                $.each(data, function(index, value){
                    //console.log(value);
                    descripcion = "Traslado "+((value.numero_contenedor == "") ? "" : "cont: "+value.numero_contenedor)+" "+( (value.nave == "") ? "" : "nave: "+value.nave )+" "+value.origen+" a "+value.destino+" "+ ( (value.numero_guia == "") ? "" : value.numero_guia )+" ("+value.codigo_viaje+")";
                    html ="<tr tipo_viaje='"+value.tipo_viaje+"' viaje_id='"+value.id+"'>";
                    //html +="<td><input valor_viaje=\'"+value.valor_viaje+"\' descripcion=\'"+descripcion+"\' cantidad=\'1\' tipo_viaje=\'"+value.tipo_viaje+"\' class=\'viajes_no_facturados\' type=\'checkbox\' name=\'viajes_no_facturados[]\' value=\'"+value.id+"\' /></td>";
                    html +="<td>"+value.fecha_origen+"</td>";
                    html +="<td>"+value.clientes_nombre_comercial+"</td>";
                    html +="<td>"+value.nave+"</td>";
                    if(value.conductor_id != null && value.conductor_nombre != null){
                        if(value.tipo_viaje == 3){
                            html +="<td>"+value.conductor_identificador+" - "+value.conductor_nombre+" "+value.conductor_apellido+" <i title='Pagar anticipo' id_conductor=\""+value.conductor_id+"\" id_viaje=\""+value.id+"\" class=\"fa fa-usd pago_conductor\"></i></td>";
                        }else{
                            html +="<td>"+value.conductor_identificador+" - "+value.conductor_nombre+" "+value.conductor_apellido+"</td>";
                        }

                    }else{
                        html +="<td style='color:red; font-weight:bold;'>Sin conductor asociado</td>";
                    }
                    html +="<td>"+value.numero_contenedor+"</td>";
                    if(value.numero_guia == null || value.numero_guia == ''){
                        html +="<td style='color:red; font-weight:bold;' >Sin n° guía</td>";
                    }else{
                        html +="<td>"+value.numero_guia+"</td>";
                    }
                    if(value.tipo_viaje == 3){
                        html +='<td style="color:green; font-weight:bold;">Propio</td>';
                    }else{
                        html +='<td style="color:blue; font-weight:bold;">Tercero</td>';

                    }
                    html +="<td>"+value.origen+"</td>";
                    html +="<td>"+value.destino+"</td>";
                    if(value.interchange_entregado == 0){
                        html +="<td><center><img tipo_documento='interchange' class='changeImage' esta_entregado='false' style='width: 16px; cursor: pointer;' src='<?php echo base_url('public/admin/images/icondock/Cancel-26.png')?>' /></center></td>";
                    }else{
                        html +="<td><center><img tipo_documento='interchange' class='changeImage' esta_entregado='true' style='width: 16px; cursor: pointer;' src='<?php echo base_url('public/admin/images/icondock/Ok-26.png')?>' /></center></td>";
                    }
                    if(value.guia_entregada == 0){
                        html +="<td><center><img tipo_documento='guia_despacho'class='changeImage' esta_entregado='false' style='width: 16px; cursor: pointer;' src='<?php echo base_url('public/admin/images/icondock/Cancel-26.png')?>' /></center></td>";
                    }else{
                        html +="<td><center><img tipo_documento='guia_despacho'class='changeImage' esta_entregado='true' style='width: 16px; cursor: pointer;' src='<?php echo base_url('public/admin/images/icondock/Ok-26.png')?>' /></center></td>";
                    }


                    if(value.tipo_viaje == 3){
                        html +='<td><a href="<?php echo site_url('viajes/editar')?>/'+value.id+'" class="tip" title="Editar"><img src="<?php echo base_url('public/admin/images/bedit.png')?>" /></a> &nbsp;';
                        html += '<a href="<?php echo site_url('viajes/eliminar')?>/'+value.id+'" class="tip"  title="Eliminar" onclick="return delete_row()"><img src="<?php echo base_url('public/admin/images/bdelete.png')?>" /></a> &nbsp;';
                        html += '<a href="<?php echo site_url("ajax/nuevoPago")?>/propio/'+value.id+'" class="tip pago_viaje" title="Agregar pago"><img class="icon_option" src="<?php echo base_url('public/admin/images/icondock/coins.png')?>" /></a> ';
                        html += '<a href="<?php echo site_url("ajax/loadTrackingLog/")?>/viajes/'+value.id+'" rel="facebox"><img style="width: 20px;" src="<?php echo base_url('public/admin/images/file-extension-log-icon.png')?>" /></a></td>';
                    }else{
                        html +='<td><a href="<?php echo site_url('viajes_proveedores_terceros/editar')?>/'+value.id+'" class="tip" title="Editar"><img src="<?php echo base_url('public/admin/images/bedit.png')?>" /></a> &nbsp;';
                        html += '<a href="<?php echo site_url('viajes_proveedores_terceros/eliminar')?>/'+value.id+'" class="tip"  title="Eliminar" onclick="return delete_row()"><img src="<?php echo base_url('public/admin/images/bdelete.png')?>" /></a> &nbsp;';
                        html += '<a href="<?php echo site_url("ajax/nuevoPago")?>/tercero/'+value.id+'" class="tip pago_viaje" title="Agregar pago"><img class="icon_option" src="<?php echo base_url('public/admin/images/icondock/coins.png')?>" /></a> ';
                        html += '<a href="<?php echo site_url("ajax/loadTrackingLog/")?>/viajes_proveedores_terceros/'+value.id+'" rel="facebox"><img style="width: 20px;" src="<?php echo base_url('public/admin/images/file-extension-log-icon.png')?>" /></a></td>';
                    }
                    html +="</tr>";
                    $('#todos_los_viajes tbody').append(html);
                });
                $('.sortable_list_pen').DataTable({
                    "order" : [[0,"desc"]],
                    "columnDefs": [ {
                        "targets": 'no-sort',
                        "orderable": false}],
                    "paging" : false,
                    "info" : false,
                    "language": {
                        "sSearch" : "Buscar:"
                    }
                });
                $('td').dblclick(function(){
                    var url = $(this).parent().children('td:last').children('a:first').attr('href');
                    window.location = url;
                });
                $('a[rel*=facebox]').facebox();
                initPagoConductor();
                initOpciones();
                initRegistroDocumento();
            }
        });
    }

    $('#cliente_id').change(function(){

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
                        html += '<a href="<?php echo site_url('viajes/editar')?>/'+item.id+'" class="tip" title="Editar"><img src="<?php echo base_url('public/admin/images/bedit.png')?>" /></a>&nbsp;';
                        html += '<a href="<?php echo site_url('viajes/eliminar')?>/'+item.id+'" class="tip"  title="Eliminar" onclick="return delete_row()"><img src="<?php echo base_url('public/admin/images/bdelete.png')?>" /></a>&nbsp; </td>';

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
    function initPagoConductor() {
        $(".pago_conductor").click(function () {
            var id_conductor = $(this).attr("id_conductor");
            var id_viaje = $(this).attr("id_viaje");
            $('<a href="<?php echo site_url('ajax/addPagoAnticipoConductorAjax')?>/' + id_viaje + '/' + id_conductor + '"></a>').facebox({
                overlayShow: true
            }).click();
        });
    }

    function initOpciones(){
        $(".pago_viaje").click(function(e){
            e.preventDefault();
            $('<a href="'+ $(this).attr('href')+'"></a>').facebox({
                overlayShow: true
            }).click();
        });
    }

    function initRegistroDocumento(){
        $('.changeImage').click(function(){
            var img = $(this);
            if($(this).attr('esta_entregado') == 'false'){
                $.ajax({
                    url: '<?php echo site_url("ajax/cambiarEstadoDocumento")?>',
                    type: 'POST',
                    data: {
                        viaje_id : $(this).parent().parent().parent('tr').attr('viaje_id'),
                        tipo_documento : $(this).attr('tipo_documento'),
                        tipo_viaje: $(this).parent().parent().parent('tr').attr('tipo_viaje')
                    },
                    success: function(data){
                        img.attr("src","<?php echo base_url('public/admin/images/icondock/Ok-26.png')?>");
                    }
                });


            }

        });
    }


</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/jquery-ui-1.11.2.custom/jquery-ui.css')?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/datetimepicker/jquery.datetimepicker.css')?>"/ >
<script src="<?php echo base_url('public/admin/jquery-ui-1.11.2.custom/jquery-ui.js')?>"></script>
<script src="<?php echo base_url('public/admin/datetimepicker/jquery.datetimepicker.js')?>"></script>
<script src="<?php echo base_url('public/admin/autoNumeric/autoNumeric.js')?>"></script>
<style>
  #primero_numero_contenedor{
    width: 46px;
    text-transform: uppercase ;
  }
  #segundo_numero_contenedor{
    width: 75px;
  }
  #tercero_numero_contenedor{
    width: 30px;
  }
  .ui-helper-hidden-accessible { display:none; }
  
  #identificador_viaje_span, #saldo_viaje_span, #saldo_resta_tercero_span{
    font-size:large;
  }
  #des_span{
    font-weight: bold;
  }
</style>

<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        
        <h2>Nuevo Viaje</h2>
        
        <ul>
            <li><?php echo anchor("viajes_proveedores_terceros", "Lista de Viajes de proveedores terceros")?></li>
            <li class="active"><?php echo anchor("viajes_proveedores_terceros/nuevo", "Nuevo viaje de proveedor terceros")?></li>
        </ul>
    </div>    

    <div class="block_content">
        
    <?php if (validation_errors()){ ?>
            <div class="message error">
            <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
      <form id="form_viaje" method="post" action="<?php echo site_url('viajes_proveedores_terceros/add')?>" enctype="multipart/form-data">
        
                 
                <div style="float:left; width:600px">
                    
                      
                  <div class="ui-widget">
                    
                    
                    <p><label>Identificador de viaje (Este campo se llenará automaticamente)</label><br /><span id="identificador_viaje_span">XXXXXXX</span>
                      <input id="identificador_viaje" type="hidden" name="identificador_viaje" size="55" >
                    </p>
                    
                    <p><label>Buscar Cliente</label><br /> <input required="required" type="text" name="cliente" id="clientes" class="text required"  value=""></p>       </div>
                    <span id="des_span">-----</span>
                    <input type="hidden" class="text" name="des" id="des" style="height:35px" />
                    <input type="hidden" id="id_cliente" name="id_cliente" />
                    
                    <p><label>Proveedor de viajes terceros</label><br />
                      <select name="proveedor_viajes_tercero_id">
                        <?php foreach($proveedores_viajes_terceros as $proveedor_viaje_tercero):?>
                          <option value="<?php echo $proveedor_viaje_tercero['id']?>"><?php echo $proveedor_viaje_tercero['nombre_proveedor']?></option>
                        <?php endforeach;?>
                      </select>
                    </p>
                  
                    <p><label>Selecccione Conductor</label><br />
                      <select id="conductor_id" name="conductor_id">
                        <option>- Seleccionar</option>
                        <?php foreach($conductores as $conductor):?>
                          <option patente_asociada="<?php echo $conductor['patente_asociada']?>" identificador="<?php echo $conductor['identificador']?>" value="<?php echo $conductor['id']?>"><?php echo $conductor['identificador']?> - <?php echo $conductor['nombre']?> <?php echo $conductor['apellido']?></option>
                        <?php endforeach; ?>
                      </select></p>
                    
                    
                    
                    <p><label>Patente del camión</label><br /> <input required="required" type="text" name="identificador_maquina" size="55" class="text" ></p>
                    
                    <p><label>Patente de la rampla</label><br /> <input required="required" type="text" name="patente_rampla" size="55" class="text" ></p>
                    
                    <p><label>Fecha del viaje</label><br /> <input required="required" id="fecha_origen" type="text" name="fecha_origen" size="55" class="text" ></p>
                    
                    <p><label>Nombre de la nave</label><br /> <input type="text" name="nave" size="55" class="text" ></p>
                    
                    <p><label>Número del contenedor</label><br /> <input onblur="capitalize(this)"  type="text" id="primero_numero_contenedor" name="primero_numero_contenedor" class="text" maxlength="4" />
                      <input type="text" id="segundo_numero_contenedor" name="segundo_numero_contenedor" class="text" min="0" max="999999" maxlength="6" /> - 
                      <input type="text" id="tercero_numero_contenedor" name="tercero_numero_contenedor" min="0" max="9" maxlength="1" class="text" /> 
                      <input type="hidden" id="numero_contenedor" name="numero_contenedor" ></p>
                    
                    <p><label>Número de guía</label><br /> <input type="text" name="numero_guia" size="55" class="text" ></p>
                    
                    <p><label>Número de Interchange</label><br /> <input type="text" name="numero_interchange" size="55" class="text" ></p>
                    
                    
                    
                    <p><label>Origen que aparecerá en la factura</label><br /> <input maxlength="10" type="text" name="origen" size="55" class="text" ></p>
                    
                    <p><label>Destino que aparecerá en la factura</label><br /> <input maxlength="10" type="text" name="destino" size="55" class="text" ></p>
                    
                    <p><label>Tipo de carga</label><br />
                      <select name="tipo_carga" >
                        <option>1x40</option>
                        <option>1x20</option>
                        <option>Granel</option>
                        <option>Cajas</option>
                        <option>Transtainer</option>
                        <option>Maquinaria</option>
                      </select>
                    </p>
                    
                    <p><label>Descripción de la carga</label><br /> <input type="text" name="descripcion_carga" size="55" class="text" ></p>
                    
                    <p><label>Valor del viaje</label><br /> <input id="valor_viaje_num" type="text" name="valor_viaje_num" size="55" class="text" >
                      <input id="valor_viaje" type="hidden" name="valor_viaje">
                    </p>
                    
                    <p><label>Valor a pagar al tercero</label><br /> <input id="valor_a_pagar_a_tercero_num" type="text" name="valor_a_pagar_a_tercero_num" size="55" class="text" >
                      <input id="valor_a_pagar_a_tercero" type="hidden" name="valor_a_pagar_a_tercero">
                    </p>
                    
                    <p><label>Saldo</label><br /><span id="saldo_resta_tercero_span">$ 0</span>
                      <input type="hidden" id="saldo_resta_tercero" name="saldo_resta_tercero" >
                      
                    </p>
                    
                    <p><label>¿Está facturado?</label><br />
                      <input type="radio" name="esta_facturado" value="0" checked="checked">No<br>
                      <input type="radio" name="esta_facturado" value="1">Sí
                    </p>
                    
                    <p><label>¿Está pagado por parte del cliente?</label><br />
                      <input type="radio" name="esta_pagado_por_cliente" value="0" checked="checked">No<br>
                      <input type="radio" name="esta_pagado_por_cliente" value="1">Sí
                    </p>
                    
                    <p><label>¿Se pagó al proveedor tercero?</label><br />
                      <input type="radio" name="esta_pagado_proveedor_tercero" value="0" checked="checked">No<br>
                      <input type="radio" name="esta_pagado_proveedor_tercero" value="1">Sí
                    </p>
                    
                    <p><label>¿Está abonado?</label><br />
                      <input type="radio" name="esta_abonado" value="0" checked="checked">No<br>
                      <input type="radio" name="esta_abonado" value="1">Sí
                    </p>
                    
                    <div id='monto_abono_div'>
                    <p ><label>Cantidad abonada</label><br /> <input type="text" id="monto_abono_num" name="monto_abono_num" size="55" class="text" >
                      <input type="hidden"id="monto_abono" name="monto_abono" />
                    </p>
                    
                    <p><label>Saldo del viaje</label><br /><span id="saldo_viaje_span">$ 0</span>
                      <input type="hidden" id="saldo_viaje" name="saldo_viaje" >
                      
                    </p>
                    </div>
                    
                    <p><label>Cantidad de kilometros del tramo</label><br /> <input type="text" name="kilometros_tramo" size="55" class="text" ></p>
                    
                    
                    <p><label>Notas adicionales </label><br /> <textarea class="text m" name="notas_adicionales"></textarea></p>
                    
                    
                    <p><label>Imagen de la guía </label><br /> <input type="file" name="ruta_imagen_guia" size="55" ></p>
                    
                    <p><label>Imagen de Interchange</label><br /> <input type="file" name="ruta_imagen_interchange" class="text" ></p>
                    
                    
                    
                    <p><label>Dirección de origen</label><br /> <input type="text" name="direccion_origen" size="55" class="text"  /></p>
                    
                    <p><label>Ciudad de origen</label><br /> <select class="styled" name="provincia_origen_id"><option value=" ">- Seleccionar</option><?php      foreach($provincias as $key){
                        ?><option value="<?php echo $key['id_provincia'] ?>" ><?php echo $key['nombre_provincia'] ?></option><?php
                    }
                     ?></select></p>
             
                    <p><label>Comuna de origen</label><br /> <select class="styled" name="comuna_origen_id"><option value=" ">- Seleccionar</option><?php      foreach($comunas as $key){
                        ?><option value="<?php echo $key['comuna_id'] ?>" ><?php echo $key['comuna_nombre'] ?></option><?php
                    }
                     ?></select></p>
                    
                    <p><label>Fecha de destino del viaje</label><br /> <input id="fecha_destino" type="text" name="fecha_destino" size="55" class="text" ></p>
                
                     
                     <p><label>Dirección de destino</label><br /> <input type="text" name="direccion_destino" size="55" class="text" ></p>
                    
                    <p><label>Ciudad de destino</label><br /> <select class="styled" name="provincia_destino_id"><option value=" ">- Seleccionar</option><?php      foreach($provincias as $key){
                        ?><option value="<?php echo $key['id_provincia'] ?>" ><?php echo $key['nombre_provincia'] ?></option><?php
                    }
                     ?></select></p>
             
                    <p><label>Comuna de destino</label><br /> <select class="styled" name="comuna_destino_id"><option value=" ">- Seleccionar</option><?php      foreach($comunas as $key){
                        ?><option value="<?php echo $key['comuna_id'] ?>" ><?php echo $key['comuna_nombre'] ?></option><?php
                    }
                     ?></select></p>
                </div>
                <br clear="all" />
                <hr>
                <p>
                  <div id="box"  style="display:none;">
                    Los datos se han guardado con éxito.
                    <input id="button_form_box" class="submit mid" type="submit" value="Aceptar" />
                    <script>
                      $('#button_form_box').click(function(){
                        $('#form_viaje').submit();
                      });

                    </script>
                  </div>
                  <input type="submit" class="submit mid" value="Actualizar" />
                </p>
               
             </form>
          
    </div>
    
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>

<script type="text/javascript">



        //Esconder input monto abonado
        $('#monto_abono_div').hide();
        
        //Setear conductores del proveedor y patentes preseleccionados
        actualizarOptionsConductores($('select[name=proveedor_viajes_tercero_id]').val());
          
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
          messages: {
              noResults: '',
              results: function() {}
          },
          minLength: 2,
          select: function( event, ui ) {
            $("#id_cliente").val(ui.item.id);
            $("#des").val(ui.item.label+"\n"+ui.item.nif_cif+", "+ui.item.direccion+", "+ui.item.ciudad+", "+ui.item.provincia+", "+ui.item.cp);
            $('#des_span').text(ui.item.label+"\n"+ui.item.nif_cif+", "+ui.item.direccion+", "+ui.item.ciudad+", "+ui.item.provincia+", "+ui.item.cp);
          },
          open: function() {
            $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
          },
          close: function() {
            $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
          }
        });

        $('#fecha_origen, #fecha_destino').datetimepicker({
            format:'Y-m-d',
            timepicker:false
        });
        
        $('#conductor_id').change(function(){
           $('input[type=text][name=identificador_maquina]').val($('#conductor_id').find(":selected").attr("patente_camion"));
          escribirIdentificadorViaje();
        });
        
        $('#fecha_origen').change(function(){
          str = $(this).val();
          date = str.substr(0, 10);
          date = date.split("-");
          escribirIdentificadorViaje();
        });
        
        function escribirIdentificadorViaje(){
          var identificador = $('#conductor_id').find(":selected").attr("identificador");
          if($('#fecha_origen').val() == "" && $('#conductor_id').val() == "- Seleccionar"){
            //$('#identificador_viaje').val(identificador);
          }else{
            if($('#fecha_origen').val() == "" && $('#conductor_id').val() != "- Seleccionar"){
              $('#identificador_viaje').val(identificador);
              $('#identificador_viaje_span').text(identificador);
            }else{
              if($('#fecha_origen').val() != "" && $('#conductor_id').val() == "- Seleccionar"){
                $('#identificador_viaje').val("");
                $('#identificador_viaje_span').text("");
              }else{
                $('#identificador_viaje').val(identificador+date[2]+date[1]);
                $('#identificador_viaje_span').text(identificador+date[2]+date[1]);
              }
            }
          }
          
        }
        
        $('#primero_numero_contenedor, #segundo_numero_contenedor, #tercero_numero_contenedor').change(function(){
          numero_contenedor=$('#primero_numero_contenedor').val()+$('#segundo_numero_contenedor').val()+"-"+$('#tercero_numero_contenedor').val()
          $('#numero_contenedor').val(numero_contenedor.toUpperCase());
        });
        
        function capitalize(element)
        { 
        var x=element;
        x.value= x.value.toUpperCase();
        }
        
        $("input[type=radio][name=esta_abonado]").change(function(){
          if(this.value == 1){
            $('#monto_abono_div').show();
          }else{
            $('#monto_abono_div').hide();
          }
        });
        
        $("#valor_viaje_num, #monto_abono_num, #valor_a_pagar_a_tercero_num").autoNumeric('init', {aDec: ',',aSep: '.', aSign: '$ ', vMin:'0', vMax: '999999999', nBracket: '(,)'});
        $("#valor_viaje_num").change(function(){
          $('#valor_viaje').val($("#valor_viaje_num").autoNumeric('get'));
        });
        
        $("#valor_a_pagar_a_tercero_num").change(function(){
          $("#valor_a_pagar_a_tercero").val($("#valor_a_pagar_a_tercero_num").autoNumeric('get'));
          saldo_resta_tercero = $('#valor_viaje').val() - $('#valor_a_pagar_a_tercero').val();
          $("#saldo_resta_tercero").val(saldo_resta_tercero);
          $("#saldo_resta_tercero_span").text("$ "+new Intl.NumberFormat().format(saldo_resta_tercero));
        });
        
        $("#monto_abono_num").change(function(){
          $('#monto_abono').val($("#monto_abono_num").autoNumeric('get'));
          saldo_viaje = $('#valor_viaje').val() - $('#monto_abono').val();
          $('#saldo_viaje').val(saldo_viaje);
          $('#saldo_viaje_span').text("$ "+ new Intl.NumberFormat().format(saldo_viaje));
        });
        
        //$('#form_viaje').submit(function(event){
        //  $.facebox({ div: '#box' });
        //  return false;
        //});
        //$('#button_form_box').click(function(){
        //  $('#form_viaje').submit();
        //});
        
        $('select[name=proveedor_viajes_tercero_id]').change(function(){
          actualizarOptionsConductores($(this).val());
        });
        
        $('select[name=conductor_id]').change(function(){
          actualizarPatentes();
        });
        
        function actualizarOptionsConductores(valor){
          $.ajax({
            type: "POST",
            dataType: "json",
            data: {
              proveedor_viajes_tercero_id: valor
            },
            url: "<?php echo site_url("ajax/conductoresDeProveedor")?>",
            success: function(data){
              $('#conductor_id').empty();
              $.each(data, function(index, value){
                option = $("<option></option>")
                  .attr("value", value.id)
                  .attr("patente_camion",value.patente_camion_asociada)
                  .attr("patente_rampla",value.patente_rampla_asociada)
                  .attr("identificador",value.identificador)
                  .text(value.identificador+" - "+value.nombre+" "+value.apellidos);
                $('#conductor_id').append(option);
                
                actualizarPatentes();
                escribirIdentificadorViaje();
              });
            }
          });
          
          
        }
        
        function actualizarPatentes(){
          $('input[type=text][name=identificador_maquina]').val($('#conductor_id').find(":selected").attr("patente_camion"));
          $('input[type=text][name=patente_rampla]').val($('#conductor_id').find(":selected").attr("patente_rampla"));
        }

        </script>
        
        
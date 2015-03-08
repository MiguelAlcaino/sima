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
  
  #identificador_viaje_span, #saldo_viaje_span{
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
        
        <h2>Nuevo Viaje Temporal</h2>
        
        <ul>
            <li><?php echo anchor("viajes_temporales", "Lista de viajes temporales")?></li>
            <li class="active"><?php echo anchor("viajes_temporales/nuevo", "Nuevo viaje temporal")?></li>
        </ul>
    </div>    

    <div class="block_content">
        
    <?php if (validation_errors()){ ?>
            <div class="message error">
            <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
      <form id="form_viaje" method="post" action="<?php echo site_url('viajes_temporales/add')?>" enctype="multipart/form-data">
        
                 
                <div style="float:left; width:600px">
                    
                      
                  <div class="ui-widget">
                    
                    
                    <p><label>Buscar Cliente</label><br /> <input required="required" type="text" name="cliente" id="clientes" class="text required"  value=""></p>       </div>
                    <span id="des_span">-----</span>
                    <input type="hidden" class="text" name="des" id="des" style="height:35px" />
                    <input type="hidden" id="id_cliente" name="id_cliente" />
                    
                    <p><label>Fecha del viaje</label><br /> <input required="required" id="fecha_origen" type="text" name="fecha_origen" size="55" class="text" ></p>
                    
                    <p><label>Nombre de la nave</label><br /> <input type="text" name="nave" size="55" class="text" ></p>
                    
                    <p><label>Número del contenedor</label><br /> <input onblur="capitalize(this)"  type="text" id="primero_numero_contenedor" name="primero_numero_contenedor" class="text" maxlength="4" />
                      <input type="text" id="segundo_numero_contenedor" name="segundo_numero_contenedor" class="text" min="0" max="999999" maxlength="6" /> - 
                      <input type="text" id="tercero_numero_contenedor" name="tercero_numero_contenedor" min="0" max="9" maxlength="1" class="text" /> 
                      <input type="hidden" id="numero_contenedor" name="numero_contenedor" ></p>
                    
                    <p><label>Origen que aparecerá en la factura</label><br /> <input maxlength="10" type="text" name="origen" size="55" class="text" ></p>
                    
                    <p><label>Destino que aparecerá en la factura</label><br /> <input maxlength="10" type="text" name="destino" size="55" class="text" ></p>

                    <p><label>Número guía</label><br /> <input maxlength="10" type="text" name="numero_guia" size="55" class="text" ></p>

                    <p><label>Valor del viaje</label><br /> <input id="valor_viaje_num" type="text" name="valor_viaje_num" size="55" class="text" >
                      <input id="valor_viaje" type="hidden" name="valor_viaje">
                    </p>
                    
                   
                    <p><label>Notas adicionales </label><br /> <textarea class="text m" name="notas_adicionales"></textarea></p>
                    
                    
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
                  <input type="submit" class="submit mid" name="agregar" value="Agregar" />
                  
                </p>
               
             </form>
          
    </div>
    
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>

<script type="text/javascript">

        //Esconder input monto abonado
        $('#monto_abono_div').hide();
          
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
           $('input[type=text][name=identificador_maquina]').val($('#conductor_id').find(":selected").attr("patente_asociada"));
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
        
        $("#valor_viaje_num, #monto_abono_num").autoNumeric('init', {aDec: ',',aSep: '.', aSign: '$ ', vMin:'0', vMax: '999999999', nBracket: '(,)'});
        $("#valor_viaje_num").change(function(){
          $('#valor_viaje').val($("#valor_viaje_num").autoNumeric('get'));
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
        </script>
        
        
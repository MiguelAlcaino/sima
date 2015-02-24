<?php
class Ajax extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('ms_model','ms');
	}

	function index()
	{	
	
	}
	
	function add_us()
	{
		$this->ms->add_usuarios_secciones();
	}
		
	function delete_us()
	{
		$this->ms->delete_usuarios_secciones();
	}
  //getViajesPropiosYTercerosByConductorPropioId($conductor_id)
  function viajesPropiosPorConductor(){
    $this->load->model("viajes_model");
    $data['value'] = json_encode($this->viajes_model->getViajesPropiosYTercerosByConductorPropioId($this->input->post("conductor_id")));
    $this->load->view("admin/ajax/responce",$data);
  }
  //getViajesPropiosYTerceros()
  
  function viajesPropiosYTerceros(){
    $this->load->model("viajes_model");
    $data['value'] = json_encode($this->viajes_model->getViajesPropiosYTerceros());
    $this->load->view("admin/ajax/responce",$data);
  }
  
  function viajesPropiosYTercerosPorCliente(){
    $this->load->model("viajes_model");
    $data['value'] = json_encode($this->viajes_model->getViajesPropiosYTercerosByClienteId($this->input->post("cliente_id")));
    $this->load->view("admin/ajax/responce",$data);
  }
  
  function viajesPropiosYTercerosFacturadosPorCliente(){
    $this->load->model("viajes_model");
    $data['value'] = json_encode($this->viajes_model->getViajesPropiosYTercerosFacturadosByClienteId($this->input->post("cliente_id")));
    $this->load->view("admin/ajax/responce",$data);
  }
  
  function conductoresDeProveedor(){
    $this->load->model("conductores_proveedor_terceros_model");
    $data['value'] = json_encode($this->conductores_proveedor_terceros_model->getAllByIdProveedor($this->input->post("proveedor_viajes_tercero_id")));
    $this->load->view("admin/ajax/responce",$data);
  }
	
	function clientes()
	{
		$this->load->model('clientes_model','clientes');
		
		$data['value'] = json_encode($this->clientes->get_term($_POST['q']));
		$this->load->view("admin/ajax/responce",$data);
	}
  
  function anadir_conductor(){
    $html .= "<div id='popup' style='width:470px; height:506px' class='block'><h2>Agregar un conductor</h2>";
    $html .= '<div class="block">
          <div class="block_content">
            <form id="form_add_conductor">
            <p>
              <label>Identificador:</label> <input id="identificador" type="text" name="identificador" id="identificador" class="text required" />
            </p>
            
            <p>
              <label>Nombre:</label><br /> <input id="nombre_conductor" type="text required" name="nombre" class="text" style="width:220px" />
            </p>
            <p>
              <label>Apellido:</label><br /> <input id="apellido_conductor" type="text required" name="apellido" class="text" style="width:220px" />
            </p>
            <p>
              <label>Rut:</label><br /> <input id="rut_conductor" type="text required" name="rut" class="text" style="width:220px" />
            </p>
            <p>
              <label>Patente camión asociada:</label><br /> <input id="patente_camion_asociada" type="text required" name="patente_camion_asociada" class="text" style="width:220px" />
            </p>
            <p>
              <label>Patente rampla asociada:</label><br /> <input id="patente_rampla_asociada" type="text required" name="patente_rampla_asociada" class="text" style="width:220px" />
            </p>
            
            <p align="center"><input type="submit" class="submit mid" id="aceptar" value="Aceptar" /></p>
          ';
    $html .= '</form></div></div>';
    
    $html .= '<script>
        $("#form_add_conductor").validate({
          submitHandler: function(form) {
            
            html = "<tr><td>"+$(\'#identificador\').val()+"</td><td>"+$(\'#nombre_conductor\').val()+"</td><td>"+$(\'#apellido_conductor\').val()+"</td><td>"+$(\'#rut_conductor\').val()+"</td><td>"+$(\'#patente_camion_asociada\').val()+"</td><td>"+$(\'#patente_rampla_asociada\').val()+"</td><td><img src=\'public/admin/images/bdelete.png\' style=\'cursor: pointer;\' onclick=\'eliminar_fila(this)\'></td>";
            html += "<input type=\'hidden\' value=\'"+$(\'#identificador\').val()+"\' name=\'identificador[]\' />";
            html += "<input type=\'hidden\' value=\'"+$(\'#nombre_conductor\').val()+"\' name=\'nombre_conductor[]\' />";
            html += "<input type=\'hidden\' value=\'"+$(\'#apellido_conductor\').val()+"\' name=\'apellido_conductor[]\' />";
            html += "<input type=\'hidden\' value=\'"+$(\'#rut_conductor\').val()+"\' name=\'rut_conductor[]\' />";
            html += "<input type=\'hidden\' value=\'"+$(\'#patente_camion_asociada\').val()+"\' name=\'patente_camion_asociada[]\' />";
            html += "<input type=\'hidden\' value=\'"+$(\'#patente_rampla_asociada\').val()+"\' name=\'patente_rampla_asociada[]\' />";
            html += "</tr>";
            $("#conductores_table tbody").append(html);
            contador_filas++;
            $("#contador_filas").val(contador_filas);
            $.facebox.close();
            return false;
          }
        });
    </script>';
    
    $data['value'] = $html;
    $this->load->view("admin/ajax/responce",$data);
  }
  
  function add_conductor_tercero_a_viaje_temporal($viaje_temporal_id){
    
    $this->load->model('proveedores_viajes_terceros_model');
    $proveedores_viajes_terceros = $this->proveedores_viajes_terceros_model->getAll();
    
    
    $html = "<div id='popup' style='width:470px; height:550px' class='block'><h2>Añadir nuevo conductor</h2>";
    $html .= '<div class="block">
          <div class="block_content">
           <form id="form_anadir_conductor" method="post" action="conductores_proveedor_terceros/add" enctype="multipart/form-data">
        
                 
                <div style="float:left; width:450px">
                    
                      
                  <div class="ui-widget">
                    
                    <p><label>Proveedor de viajes</label><br />
                      <select name="proveedor_viajes_terceros_id">';
                      
                        foreach($proveedores_viajes_terceros as $proveedor_viaje_tercero){
                          $html .= '<option value="'.$proveedor_viaje_tercero["id"].'">'.$proveedor_viaje_tercero["nombre_proveedor"].'</option>';
                        }
                       
     $html .=       '</select>
                    </p>
                    <input type="hidden" name="viaje_temporal_id" value="'.$viaje_temporal_id.'" />
                    <p><label>Identificador del conductor</label><br /> <input type="text" required="required" name="identificador" size="55" class="text" ></p>
                    
                    <p><label>Nombre</label><br /> <input required="required" type="text" name="nombre" size="55" class="text" ></p>
                    
                    <p><label>Apellido</label><br /> <input required="required" type="text" name="apellido" size="55" class="text" ></p>
                    
                    <p><label>RUT</label><br /> <input type="text" name="rut" size="55" class="text" ></p>
                    
                    <p><label>Patente de camión asociada</label><br /> <input type="text" name="patente_camion_asociada" size="55" class="text" ></p>
                    
                    <p><label>Patente de rampla asociada</label><br /> <input type="text" name="patente_rampla_asociada" size="55" class="text" ></p>
                     
                </div> 
                <br clear="all" />
                <hr>
                <p>
                  <input type="submit" id="anadir_conductor_btn" class="submit largo" value="Añadir y continuar" />
                  <input type="button" id="continuar_sin_anadir" class="submit largo" value="Continuar sin añadir" />
                </p>
               
             </form>
          ';
    $html .= '</div></div>';
    $html .= '<script>
      $("#continuar_sin_anadir").click(function(){
        $("#continuar_sin_anadir").attr("disabled",true);
        $("#anadir_conductor_btn").attr("disabled",true);
        $("#form_viaje").append($("<input type=\"hidden\" name=\"convertir_propio\" value=\"convertir_propio\" />"));
        $("#form_viaje").submit();
      });
      
      $("#form_anadir_conductor").submit(function(e){
        $("#continuar_sin_anadir").attr("disabled",true);
        $("#anadir_conductor_btn").attr("disabled",true);
        e.preventDefault();
        var boton_submit = $(this).find("input[type=submit]:focus");
        if(boton_submit.attr("id") == "anadir_conductor_btn"){
          
        var postData = $("#form_anadir_conductor").serializeArray();
        var formURL  = $("#form_anadir_conductor").attr("action");
        var postData_form_viaje = $("#form_viaje").serializeArray();
        var formURL_form_viaje  = $("#form_viaje").attr("action");
        
        $.ajax(
        {
            url : formURL,
            type: "POST",
            data : postData,
            success:function(data, textStatus, jqXHR) 
            {
                console.log(JSON.parse(data).id_conductor);
                var id_conductor = JSON.parse(data).id_conductor;
                $("#form_viaje").append($("<input type=\"hidden\" name=\"conductor_propio_id\" value=\""+id_conductor+"\" />"));
                $("#form_viaje").append($("<input type=\"hidden\" name=\"convertir_propio\" value=\"convertir_propio\" />"));
                $("#form_viaje").submit();
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                //if fails      
            }
        });
          
        }
        
      });
      
    </script>';
    
    $data['value'] = $html;
    $this->load->view("admin/ajax/responce",$data);
  }
  
  function add_conductor_propio_a_viaje_temporal($viaje_temporal_id){
    $html = "<div id='popup' style='width:470px; height:495px' class='block'><h2>Añadir nuevo conductor</h2>";
    $html .= '<div class="block">
          <div class="block_content">
            <form id="form_anadir_conductor" method="post" action="conductores/add" enctype="multipart/form-data">
        
                 
                <div style="float:left; width:450px">
                    
                      
                  <div class="ui-widget">
                    
                    <input type="hidden" name="viaje_temporal_id" value="'.$viaje_temporal_id.'" />
                    <p><label>Identificador del conductor</label><br /> <input required="required" type="text" name="identificador" size="55" class="text" ></p>
                    
                    <p><label>Nombre</label><br /> <input required="required" type="text" name="nombre" size="55" class="text" ></p>
                    
                    <p><label>Apellido</label><br /> <input required="required" type="text" name="apellido" size="55" class="text" ></p>
                    
                    <p><label>Patente asociada</label><br /> <input type="text" name="patente_asociada" size="55" class="text" ></p>
                    
                    <p><label>RUT</label><br /> <input type="text" name="rut" size="55" class="text" ></p>
                    
                    <p><label>Fecha de nacimiento</label><br /> <input id="fecha_nacimiento" type="text" name="fecha_nacimiento" size="55" class="text" ></p>
                    
                    
                      
                </div> 
                <br clear="all" />
                <hr>
                <p>
                  <input type="submit" id="anadir_conductor_btn" class="submit largo" value="Añadir y continuar" />
                  <input type="button" id="continuar_sin_anadir" class="submit largo" value="Continuar sin añadir" />
                </p>
               
             </form>
          ';
    $html .= '</div></div>';
    $html .= '<script>
      $("#continuar_sin_anadir").click(function(){
        $("#continuar_sin_anadir").attr("disabled",true);
        $("#anadir_conductor_btn").attr("disabled",true);
        $("#form_viaje").append($("<input type=\"hidden\" name=\"convertir_propio\" value=\"convertir_propio\" />"));
        $("#form_viaje").submit();
      });
      
      $("#form_anadir_conductor").submit(function(e){
        $("#continuar_sin_anadir").attr("disabled",true);
        $("#anadir_conductor_btn").attr("disabled",true);
        e.preventDefault();
        var boton_submit = $(this).find("input[type=submit]:focus");
        if(boton_submit.attr("id") == "anadir_conductor_btn"){
          
        var postData = $("#form_anadir_conductor").serializeArray();
        var formURL  = $("#form_anadir_conductor").attr("action");
        var postData_form_viaje = $("#form_viaje").serializeArray();
        var formURL_form_viaje  = $("#form_viaje").attr("action");
        
        $.ajax(
        {
            url : formURL,
            type: "POST",
            data : postData,
            success:function(data, textStatus, jqXHR) 
            {
                console.log(JSON.parse(data).id_conductor);
                var id_conductor = JSON.parse(data).id_conductor;
                $("#form_viaje").append($("<input type=\"hidden\" name=\"conductor_propio_id\" value=\""+id_conductor+"\" />"));
                $("#form_viaje").append($("<input type=\"hidden\" name=\"convertir_propio\" value=\"convertir_propio\" />"));
                $("#form_viaje").submit();
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                //if fails      
            }
        });
          
        }
        
      });
      
    </script>';
    
    $data['value'] = $html;
    $this->load->view("admin/ajax/responce",$data);
  }
	
	function search_prod_serv()
	{
		 
		
		$html = "<div id='popup' style='width:470px; height:290px' class='block'><h2>Buscar Producto o Servicio</h2>";
		$html .= '<div class="block">
					<div class="block_content">
						<form id="form_add_ps">
						<p>
							<label>Tipo:</label> <input type="radio" name="tipo" id="tipo" value="1" /> Producto &nbsp;&nbsp; <input type="radio" value="2" name="tipo" id="tipo"/> &nbsp;&nbsp; Servicio &nbsp;&nbsp;<input type="radio" value="3" name="tipo" id="tipo" checked="checked" /> Viajes 
						</p>
						<p>
							<label>Nombre:</label> <input type="text" name="term" id="term" class="text required">
						</p>
						<div id="inputs_precio_cantidad">
						<p>
							<label>Precio:</label><br clear="all"> <input type="text required" name="precio" id="precio_b" class="text" style="width:220px">
						</p>
						<p>
							<label>Cantidad:</label><br clear="all"> <input readonly="readonly" type="text" name="cantidad" id="cantidad" class="text number required"  style="width:220px">
						</p>
						<input type="hidden" id="tipo_detalle" name="tipo_detalle"/>
						<input type="hidden" id="origen_detalle_id" name="origen_detalle_id" />
						</div>
						<p align="center"><input type="submit" class="submit mid" id="aceptar" value="Aceptar" /></p>
					';
		$html .= '</form></div></div>';
    
    $html .= '<script>
    
    tipo = 3;
    $("input[type=radio][name=tipo]").change(function(){
      tipo = this.value;
      if(this.value == 3){
        $("#cantidad").val("");
        $("#cantidad").attr("readonly","readonly");
      }else{
        $("#cantidad").val("");
        $("#cantidad").removeAttr( "readonly" );
      }
    });
    $( "#term" ).autocomplete({
          messages: {
              noResults: "",
              results: function() {}
          },
          source: function( request, response ) {
            tipo = $("#tipo:checked").val();
            $.ajax({
              url: "ajax/filtro_prod_serv",
              type:"POST",
              dataType: "json",
              data: {
                maxRows: 12,
                q: request.term,
                tipo: $("#tipo:checked").val(),
                id_cliente: $("#id_cliente").val() 
              },
              success: function(data) {
                
                response( $.map( data, function( item ) {
                  if(tipo == "3"){
                    return {
                    label: item.identificador_viaje,
                    value: "Traslado "+((item.numero_contenedor == "") ? "" : "cont: "+item.numero_contenedor)+" "+( (item.nave == "") ? "" : "nave: "+item.nave )+" "+item.origen+" a "+item.destino+" "+ ( (item.numero_guia == "") ? "" : item.numero_guia )+" ("+item.codigo_viaje+")",
                    //value: item.tipo_carga+" viaje "+ ((item.nave == "") ? "" : item.nave) +" "+ ( (item.numero_contenedor == "") ? "" : item.numero_contenedor ) +" ("+item.codigo_viaje+")",
                    //value: item.tipo_carga+" viaje "+ ((item.nave == "") ? "" : item.nave) +" "+ ( (item.numero_contenedor == "") ? "" : item.numero_contenedor ) + " "+item.origen+" a "+item.destino+" ("+item.codigo_viaje+")",
                    //value: item.identificador_viaje,
                    id_viaje: item.id,
                    precio: item.valor_viaje,
                    cantidad: 1,
                    viaje: item
                    }
                  }else{
                    return {
                    label: item.nombre,
                    value: item.nombre,
                    id_prod: item.id_producto,
                    id_serv: item.id_servicio,
                    precio: item.precio
                    }
                  }
                  
                }
                
                ));
              }
            });
          },
          minLength: 1,
          select: function( event, ui ) {
            $("#precio_b").val(ui.item.precio);
            if(tipo == 3){
              $("#cantidad").val(ui.item.cantidad);
              $("#origen_detalle_id").val(ui.item.id_viaje);
              tipo = ui.item.viaje.tipo_viaje
            }else{
              if(tipo == 2){
                $("#origen_detalle_id").val(ui.item.id_serv);
              }else{
                if(tipo == 1){
                  $("#origen_detalle_id").val(ui.item.id_prod);
                }else{
                  $("#origen_detalle_id").val(0);
                }
              }
            }
            $("#tipo_detalle").val(tipo);
            
            
          },
          open: function() {
            $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
          },
          close: function() {
            $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
          }
        }).data("ui-autocomplete")._renderItem = function( ul, item ) {
              return $( "<li>" )
                .attr( "data-value", item.value )
                .append( "<strong>"+item.label+"</strong>"+"<div style=\'font-size: x-small;\'>Conductor:<strong>"+item.viaje.nombre+" "+item.viaje.apellido+"</strong><br/>Desde: <strong>"+item.viaje.origen+"</strong> Hasta: <strong>"+item.viaje.destino+"</strong><br/>Fecha: <strong>"+item.viaje.fecha_origen+"</strong></div>" )
                .appendTo( ul );
            };
        
        $("#form_add_ps").validate({
          errorClass : "error",
          errorElement : "span",
          submitHandler: function(form) {
            var html = "<tr><td></td><td><input type=\'hidden\' name=\'origen_detalle_id_form[]\' value="+$("#origen_detalle_id").val()+" /> <input type=\'hidden\' name=\'tipo_detalle_form[]\' value="+$("#tipo_detalle").val()+" /> <input style=\'text-align:center\' value="+$("#cantidad").val()+"  name=\'quantity[]\' class=\'quantity\' type=\'text\'><input type=\'hidden\' name=\'descripcion[]\' value=\'"+$("#term").val()+"\' ></td><td>"+$("#term").val()+"</td><td><input style=\'text-align:right\' value="+$("#precio_b").val()+" type=\'text\' class=\'psi\' name=\'psi[]\'></td><td style=\'text-align:right\' class=ptotal>"+($("#precio_b").val() * $("#cantidad").val()).toFixed(0)+"</td><td  style=\'text-align:center\'><a  class=\'delete\'  title=\'Eliminar\'  href=javascript:;><img src=\'public/admin/images/bdelete.png\' /></td></tr>";
          
            if($("#detalle tr").eq(0).hasClass("nothing")){
              $("#detalle").html(html);
            }else{
              $("#detalle").append(html);
            }
            var suma=0, iva = 0;
            $(".psi").each(function(x){
              suma += parseInt($(".psi").eq(x).val() * $(".quantity").eq(x).val());
            });
            iva = (suma) * 0.19;
            $(".total_siva").html((suma).toFixed(0));
            $(".iva").html((iva).toFixed(0));
            $(".total_civa").html((suma + iva).toFixed(0));
            $("#input_total_civa").val((suma + iva).toFixed(0));
            
            
            $.facebox.close();
            return false;
          }
        });
  </script>';
		
		$data['value'] = $html;
		$this->load->view("admin/ajax/responce",$data);
	}

	function search_prod_serv_to_proforma()
	{
		 
		$html  = '<script>
		$(document).ready(function(){
		$( "#term" ).autocomplete({
					source: function( request, response ) {
						$.ajax({
							url: "ajax/filtro_prod_serv",
							type:"POST",
							dataType: "json",
							data: {
								maxRows: 12,
								q: request.term,
								tipo: $("#tipo:checked").val()
							},
							success: function(data) {
								
								response( $.map( data, function( item ) {
									return {
										label: item.nombre,
										value: item.nombre,
										id_prod: item.id_producto,
										id_serv: item.id_servicio,
										precio: item.precio
									}
								}));
							}
						});
					},
					minLength: 1,
					select: function( event, ui ) {
						$("#precio_b").val(ui.item.precio);
					},
					open: function() {
						$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
					},
					close: function() {
						$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
					}
				});
				
				$("#form_add_ps").validate({
					errorClass : "error",
					errorElement : "span",
					submitHandler: function(form) {
						var html = "<tr><td></td><td><input style=\'text-align:center\' value="+$("#cantidad").val()+"  name=\'quantity[]\' class=\'quantity\' type=\'text\'><input type=\'hidden\' name=\'descripcion[]\' value=\'"+$("#term").val()+"\' ></td><td>"+$("#term").val()+"</td><td><input style=\'text-align:right\' value="+$("#precio_b").val()+" type=\'text\' class=\'psi\' name=\'psi[]\'></td><td style=\'text-align:right\' class=ptotal>"+($("#precio_b").val() * $("#cantidad").val()).toFixed(0)+"</td><td  style=\'text-align:center\'><a  class=\'delete\'  title=\'Eliminar\'  href=javascript:;><img src=\'public/admin/images/bdelete.png\' /></td></tr>";
					
						if($("#detalle tr").eq(0).hasClass("nothing")){
							$("#detalle").html(html);
						}else{
							$("#detalle").append(html);
						}
						var suma=0, iva = 0;
						$(".psi").each(function(x){
							suma += parseInt($(".psi").eq(x).val() * $(".quantity").eq(x).val());
						});
						$(".total_civa").html((suma).toFixed(0));
						$("#input_total_civa").val((suma).toFixed(0));
						
						
						$.facebox.close();
						return false;
					}
				});
		});
	</script>';
		$html .= "<div id='popup' style='width:470px; height:290px' class='block'><h2>Buscar Producto o Servicio</h2>";
		$html .= '<div class="block">
					<div class="block_content">
						<form id="form_add_ps">
						<p>
							<label>Tipo:</label> <input type="radio" name="tipo" id="tipo" value="1" checked="checked"> Producto &nbsp;&nbsp; <input type="radio" value="2" name="tipo" id="tipo"> Servicio 
						</p>
						<p>
							<label>Nombre:</label> <input type="text" name="term" id="term" class="text required">
						</p>
						<p>
							<label>Precio:</label><br clear="all"> <input type="text required" name="precio" id="precio_b" class="text" style="width:220px">
						</p>
						<p>
							<label>Cantidad:</label><br clear="all"> <input type="text" name="cantidad" id="cantidad" class="text number required"  style="width:220px">
						</p>
						<p align="center"><input type="submit" class="submit mid" id="aceptar" value="Aceptar" /></p>
					';
		$html .= '</form></div></div>';
		
		
		
		$data['value'] = $html;
		$this->load->view("admin/ajax/responce",$data);
	}
	
	function filtro_prod_serv()
	{
		$this->load->model('productos_model','productos');
		$this->load->model('servicios_model','servicios');
    $this->load->model('viajes_model');
    $this->load->model('viajes_proveedores_terceros_model');
		if($_POST['tipo'] == 1){
			$data['value'] = json_encode($this->productos->get_term($_POST['q']));
		}else{
		  if($_POST['tipo'] == 2){
		    $data['value'] = json_encode($this->servicios->get_term($_POST['q']));
		  }else{
		    
        // Modificar esto: Se debe adecuar para buscar viajes que aún no estén facturados
        $viajes = $this->viajes_model->get_term($_POST['q'], $_POST['id_cliente']);
        $viajes_terceros = $this->viajes_proveedores_terceros_model->get_term($_POST['q'], $_POST['id_cliente']);
		    $data['value'] = json_encode(array_merge($viajes, $viajes_terceros));
		  }
			
		}
		$this->load->view("admin/ajax/responce",$data);

	}
	
	function facturas_ajax(){
		$this->load->model('facturas_model','facturas');
		$data['value'] = json_encode($this->facturas->get_term());
		$this->load->view("admin/ajax/responce",$data);
	}

  function list_viajes_ajax(){
    $this->load->model('viajes_model');
    $data['value'] = json_encode($this->viajes_model->get_all());
    $this->load->view("admin/ajax/responce",$data);
  }
  
  function list_viajes_temporales_ajax(){
    $this->load->model('viajes_temporales_model');
    $data['value'] = json_encode($this->viajes_temporales_model->get_all());
    $this->load->view("admin/ajax/responce",$data);
  }
  
  function list_viajes_proveedores_terceros_ajax(){
    $this->load->model('viajes_proveedores_terceros_model');
    $data['value'] = json_encode($this->viajes_proveedores_terceros_model->get_all());
    $this->load->view("admin/ajax/responce",$data);
  }
  
  function list_conductores_ajax(){
    $this->load->model('conductores_model');
    $data['value'] = json_encode($this->conductores_model->getAll());
    $this->load->view("admin/ajax/responce",$data);
  }
  
  function list_conductores_proveedor_terceros_ajax(){
    $this->load->model('conductores_proveedor_terceros_model');
    $data['value'] = json_encode($this->conductores_proveedor_terceros_model->getAll());
    $this->load->view("admin/ajax/responce",$data);
  }
  
  function list_proveedores_viajes_terceros_ajax(){
    $this->load->model('proveedores_viajes_terceros_model');
    $data['value'] = json_encode($this->proveedores_viajes_terceros_model->getAll());
    $this->load->view("admin/ajax/responce",$data);
  }
	
	function proformas_ajax(){
		$this->load->model('proformas_model','proformas');
		$data['value'] = json_encode($this->proformas->get_term());
		$this->load->view("admin/ajax/responce",$data);
	}
	
	function presupuestos_ajax(){
		$this->load->model('presupuestos_model','presupuestos');
		$data['value'] = json_encode($this->presupuestos->get_term());
		$this->load->view("admin/ajax/responce",$data);
	}

}
?>
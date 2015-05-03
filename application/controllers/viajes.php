<?php
    class Viajes extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("provincias_model","provincias");
    $this->load->model("viajes_model");
    $this->load->model("conductores_model");
    //$this->load->model("facturas_model",'facturas');
    $this->load->model("clientes_model");
  }  
  
  protected function generateRandomString($length = 10) {
    //$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
  }
  
  function informeViajesConductorPropio(){
    $data['conductores'] = $this->conductores_model->getAll();
    $this->template->display('admin/viajes/list_informe_viajes_conductor_propio',$data);
  }
  
  function informeViajesTodos(){
    $this->template->display('admin/viajes/list_informe_todos_los_viajes');  
  }
  
  function informeViajesPorCliente(){
    $data['clientes']  = $this->clientes_model->get_all();
    $this->template->display('admin/viajes/list_informe_viajes_cliente', $data);
  }
  
  function eliminar($id){
    $this->viajes_model->delete($id);
    $this->session->set_flashdata('message', '<div class="message success">Se ha eliminado correctamente</div>');
    redirect("viajes");
  }
  
  function index()
  {
     
    $this->template->display('admin/viajes/list');
  }
  
  public function nuevo(){
    
    $data['provincias']  = $this->provincias->get_all();
    $data['comunas'] = $this->provincias->getComunas();
    $data['conductores'] = $this->conductores_model->getAll(); 
    
    $this->template->display('admin/viajes/new',$data);
  }
  
  public function add($action,$viaje_tercero_id){
    
    $config_upload['upload_path'] = './public/uploads/';
    $config_upload['allowed_types'] = 'gif|jpg|png';
    $config_upload['max_size'] = '2048';
    $config_upload['encrypt_name'] = TRUE;
    $config_upload['remove_spaces'] = TRUE;
    
    //$config_upload['max_width']  = '1024';
    //$config_upload['max_height']  = '768';
    
    $this->load->library('upload', $config_upload);
    
    $error_array = array();
    $data_files_array = array();
    $bandera_error_file = false;
    
    
    foreach ($_FILES as $key => $file) {
        if(!$this->upload->do_upload($key)){
            $error_array[] = $this->upload->display_errors();
            $bandera_error_file = TRUE;
            $data_files_array[$key] = null;
          }else{
             $data_files_array[$key] = $this->upload->data();
          }
    }
    
    $bandera_codigo = TRUE;
    while ($bandera_codigo != FALSE) {
        $codigo_viaje = $this->generateRandomString(6);
        $bandera_codigo = $this->viajes_model->existeCodigoViaje($codigo_viaje);
    }
    
    
    
    $array_datos = array(
      'cliente_id' =>               $this->input->post("id_cliente"),
      'codigo_viaje'  =>            $codigo_viaje,
      'identificador_viaje' =>      $this->input->post("identificador_viaje"),
      'conductor_id' =>             $this->input->post("conductor_id"),
      'identificador_maquina' =>    $this->input->post("identificador_maquina"),
      'valor_viaje' =>              $this->input->post("valor_viaje"),
      'nave' =>                     $this->input->post("nave"),
      'origen'  =>                  $this->input->post("origen"),
      'fecha_origen' =>             $this->input->post("fecha_origen").":00",
      'direccion_origen' =>         $this->input->post("direccion_origen"),
      'provincia_origen_id' =>      $this->input->post("provincia_origen_id"),
      'comuna_origen_id' =>         $this->input->post("comuna_origen_id"),
      'destino' =>                  $this->input->post("destino"),
      'fecha_destino' =>            $this->input->post("fecha_destino").":00",
      'direccion_destino' =>        $this->input->post("direccion_destino"),
      'provincia_destino_id' =>     $this->input->post("provincia_destino_id"),
      'comuna_destino_id' =>        $this->input->post("comuna_destino_id"),
      'tipo_carga'  =>              $this->input->post("tipo_carga"),
      'descripcion_carga' =>        $this->input->post("descripcion_carga"),
      'numero_guia' =>              $this->input->post("numero_guia"),
      //'ruta_imagen_guia' =>         $data_files_array['ruta_imagen_guia']['file_name'],
      'numero_interchange' =>       $this->input->post("numero_interchange"),
      //'ruta_imagen_interchange' =>  $data_files_array['ruta_imagen_interchange']['file_name'],
      'esta_facturado' =>           $this->input->post("esta_facturado"),
      'esta_pagado' =>              $this->input->post("esta_pagado"),
      'esta_abonado' =>             $this->input->post("esta_abonado"),
      'monto_abono' =>              $this->input->post("monto_abono"),
      'saldo_viaje' =>              $this->input->post("saldo_viaje"),
      'kilometros_tramo' =>         $this->input->post("kilometros_tramo"),
      'petroleo_gastado' =>         $this->input->post("petroleo_gastado"),
      'numero_guia_petroleo' =>     $this->input->post("numero_guia_petroleo"),
      //'ruta_imagen_guia_petroleo' =>$data_files_array['ruta_imagen_guia_petroleo']['file_name'],
      'notas_adicionales' =>        $this->input->post("notas_adicionales"),
      'numero_contenedor' =>        $this->input->post("numero_contenedor")
    );

      foreach($data_files_array as $key => $file_array){
          if(array_key_exists("file_name",$file_array)){
              $array_datos[$key] = $data_files_array[$key]['file_name'];
          }
      }

    $viajes_id = $this->viajes_model->add($array_datos);
    $data['files'] = $data_files_array; 
    //$this->template->display('admin/viajes/new',$data);
      if($action == 'delete'){
          $this->load->model("viajes_proveedores_terceros_model");
          /** @var Viajes_proveedores_terceros_model $viajes_proveedores_terceros_model */
          $viajes_proveedores_terceros_model = $this->viajes_proveedores_terceros_model;
          $viajes_proveedores_terceros_model->delete($viaje_tercero_id);
          $this->load->view("admin/ajax/responce",array(
              'value' => json_encode(array(
                  'viaje_propio_id' => $viajes_id
              ))
          ));
      }else{
          redirect("viajes/editar/".$viajes_id);
      }

  }

  public function editar($id){
    
    $data['data'] = $this->viajes_model->getViajeById($id);
    $data['provincias']  = $this->provincias->get_all();
    $data['comunas'] = $this->provincias->getComunas();
    $data['conductores'] = $this->conductores_model->getAll();
    
    //Sacando segundos de la fecha
    $data['data'][0]['fecha_origen'] = substr($data['data'][0]['fecha_origen'], 0, 16);
    $data['data'][0]['fecha_destino'] = substr($data['data'][0]['fecha_destino'], 0, 16);
    
    $this->template->display('admin/viajes/edit',$data);
  }
  
  public function update($id){
    
    $config_upload['upload_path'] = './public/uploads/';
    $config_upload['allowed_types'] = 'gif|jpg|png';
    $config_upload['max_size'] = '2048';
    $config_upload['encrypt_name'] = TRUE;
    $config_upload['remove_spaces'] = TRUE;
    
    //$config_upload['max_width']  = '1024';
    //$config_upload['max_height']  = '768';
    
    $this->load->library('upload', $config_upload);
    
    $error_array = array();
    $data_files_array = array();
    $bandera_error_file = false;

    
    $array_datos = array(
      'cliente_id' =>               $this->input->post("id_cliente"),
      'identificador_viaje' =>      $this->input->post("identificador_viaje"),
      'conductor_id' =>             $this->input->post("conductor_id"),
      'identificador_maquina' =>    $this->input->post("identificador_maquina"),
      'valor_viaje' =>              $this->input->post("valor_viaje"),
      'nave' =>                     $this->input->post("nave"),
      'origen'  =>                  $this->input->post("origen"),
      'fecha_origen' =>             $this->input->post("fecha_origen").":00",
      'direccion_origen' =>         $this->input->post("direccion_origen"),
      'provincia_origen_id' =>      $this->input->post("provincia_origen_id"),
      'comuna_origen_id' =>         $this->input->post("comuna_origen_id"),
      'destino' =>                  $this->input->post("destino"),
      'fecha_destino' =>            $this->input->post("fecha_destino").":00",
      'direccion_destino' =>        $this->input->post("direccion_destino"),
      'provincia_destino_id' =>     $this->input->post("provincia_destino_id"),
      'comuna_destino_id' =>        $this->input->post("comuna_destino_id"),
      'tipo_carga'  =>              $this->input->post("tipo_carga"),
      'descripcion_carga' =>        $this->input->post("descripcion_carga"),
      'numero_guia' =>              $this->input->post("numero_guia"),
      'ruta_imagen_guia' =>         $data_files_array['ruta_imagen_guia']['file_name'], 
      'numero_interchange' =>       $this->input->post("numero_interchange"),
      'ruta_imagen_interchange' =>  $data_files_array['ruta_imagen_interchange']['file_name'], 
      'esta_facturado' =>           $this->input->post("esta_facturado"),
      'esta_pagado' =>              $this->input->post("esta_pagado"),
      'esta_abonado' =>             $this->input->post("esta_abonado"),
      'monto_abono' =>              $this->input->post("monto_abono"),
      'saldo_viaje' =>              $this->input->post("saldo_viaje"),
      'kilometros_tramo' =>         $this->input->post("kilometros_tramo"),
      'petroleo_gastado' =>         $this->input->post("petroleo_gastado"),
      'numero_guia_petroleo' =>     $this->input->post("numero_guia_petroleo"),
      'ruta_imagen_guia_petroleo' =>$data_files_array['ruta_imagen_guia_petroleo']['file_name'],
      'notas_adicionales' =>        $this->input->post("notas_adicionales"),
      'numero_contenedor' =>        $this->input->post("numero_contenedor")
    );
    
    foreach ($_FILES as $key => $file) {
      if($_FILES[$key]['size'] != 0){
        if(!$this->upload->do_upload($key)){
            $error_array[] = $this->upload->display_errors();
            $bandera_error_file = TRUE;
            
          }else{
             $data_files_array[$key] = $this->upload->data();
             $array_datos[$key] = $data_files_array[$key]['file_name'];
          }
      }
        
    }
    
    $this->viajes_model->update($id, $array_datos);
    redirect("viajes/editar/".$id);
  }
    public function buscarViajesPorContenedor(){
        $this->template->display('admin/viajes/searchViajesPorContenedor');
    }
}
?>
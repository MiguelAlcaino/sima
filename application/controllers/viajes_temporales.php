<?php
    class Viajes_temporales extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("viajes_temporales_model");
    $this->load->model("viajes_model");
    $this->load->model("viajes_proveedores_terceros_model");
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
  
  public function index(){
    $this->template->display('admin/viajes_temporales/list');
  }
  
  public function nuevo(){
    $this->template->display('admin/viajes_temporales/new');
  }
  
  public function add(){
    
    
    
    $array_datos = array(
      'cliente_id' =>               $this->input->post("id_cliente"),
      'valor_viaje' =>              $this->input->post("valor_viaje"),
      'nave' =>                     $this->input->post("nave"),
      'origen'  =>                  $this->input->post("origen"),
      'fecha_origen' =>             $this->input->post("fecha_origen").":00",
      'destino' =>                  $this->input->post("destino"),
      'numero_contenedor' =>        $this->input->post("numero_contenedor"),
      'notas_adicionales' =>        $this->input->post("notas_adicionales")
    );
    $viajes_id = $this->viajes_temporales_model->add($array_datos);
    //redirect("viajes_temporales/editar/".$viajes_id);
    $this->session->set_flashdata('message', '<div class="message success">El registro se ha agregado correctamente.</div>');
    redirect("viajes_temporales"); 
  }
  
  public function editar($id){
    $data['data'] = $this->viajes_temporales_model->getViajeById($id);
    $this->template->display('admin/viajes_temporales/edit', $data);
  }
  
  public function update($id){
    
    $bandera_codigo = TRUE;
    while ($bandera_codigo != FALSE) {
        $codigo_viaje = $this->generateRandomString(6);
        $bandera_codigo = $this->viajes_model->existeCodigoViaje($codigo_viaje);
        $bandera_codigo = $this->viajes_proveedores_terceros_model->existeCodigoViaje($codigo_viaje);
    }
    
    
    $array_datos = array(
        'cliente_id'    =>          $this->input->post("id_cliente"),
        'valor_viaje'   =>          $this->input->post("valor_viaje"),
        'nave'  =>                  $this->input->post("nave"),
        'origen'    =>              $this->input->post("origen"),
        'fecha_origen'  =>          $this->input->post("fecha_origen").":00",
        'destino'   =>              $this->input->post("destino"),
        'numero_contenedor' =>      $this->input->post("numero_contenedor"),
        'notas_adicionales' =>      $this->input->post("notas_adicionales"),
        'numero_guia'   =>          $this->input->post("numero_guia");
    );
    
    
    
    if(isset($_POST['convertir_propio'])){
      if(isset($_POST['conductor_propio_id'])){
        $array_datos['conductor_id'] = $this->input->post("conductor_propio_id");
        $this->load->model("conductores_model");
        $conductor_propio = $this->conductores_model->getConductorById($array_datos['conductor_id']);
        $array_datos['identificador_maquina'] = $conductor_propio[0]['patente_asociada'];
      }
      $array_datos['codigo_viaje'] = $codigo_viaje;
      $id_viaje_propio = $this->viajes_model->add($array_datos);
      $this->viajes_temporales_model->delete($id);
      redirect("viajes/editar/".$id_viaje_propio);
      
    }else if(isset($_POST['convertir_tercero'])){
      
      if(isset($_POST['conductor_propio_id'])){
        $array_datos['conductor_proveedor_tercero_id'] = $this->input->post("conductor_propio_id");
        $this->load->model("conductores_proveedor_terceros_model");
        $conductor_propio = $this->conductores_proveedor_terceros_model->getConductorById($array_datos['conductor_id']);
        $array_datos['identificador_maquina'] = $conductor_propio[0]['patente_camion_asociada'];
      }
      $array_datos['codigo_viaje'] = $codigo_viaje;
      $id_viaje_tercero = $this->viajes_proveedores_terceros_model->add($array_datos);
      $this->viajes_temporales_model->delete($id);
      redirect("viajes_proveedores_terceros/editar/".$id_viaje_tercero);
    }
    $this->viajes_temporales_model->update($id,$array_datos);
    //redirect("viajes_temporales/editar/".$id);
    if($this->input->is_ajax_request()){ 
      
      $data['value'] = json_encode(array("respuesta"=>"OK"));
      $this->load->view("admin/ajax/responce",$data);
    }else{
      $this->session->set_flashdata('message', '<div class="message success">El registro se ha actualizado correctamente.</div>');
      redirect("viajes_temporales");
    }
    
  }

  public function eliminar($id){
    $this->viajes_temporales_model->delete($id);
    $this->session->set_flashdata('message', '<div class="message success">Se ha eliminado correctamente</div>');
    redirect("viajes_temporales");
  }
}
  
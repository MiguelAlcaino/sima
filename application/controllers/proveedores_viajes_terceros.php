<?php
class Proveedores_viajes_terceros extends CI_Controller 
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('proveedores_viajes_terceros_model');
    $this->load->model('conductores_proveedor_terceros_model');
  }
  
  function index(){
    //$data['conductores'] = $this->conductores_model->getAll();
    $this->template->display('admin/proveedores_viajes_terceros/list');
  }
  
  function nuevo(){
    $this->template->display('admin/proveedores_viajes_terceros/new');
  }
  
  function add(){
    $array_datos = array(
      'nombre_proveedor'        => $this->input->post('nombre_proveedor'),
      'razon_social_proveedor'  => $this->input->post('razon_social_proveedor'),
      'direccion_contacto'      => $this->input->post('direccion_contacto'),
      'persona_de_contacto'     => $this->input->post('persona_de_contacto'),
      'telefono'                => $this->input->post('telefono'),
      'rut'                     => $this->input->post('rut')
    );
    
    $id_proveedor=$this->proveedores_viajes_terceros_model->add($array_datos);
    
    $this->load->model('conductores_proveedor_terceros_model');
    
    for($i=0;$i<$this->input->post('contador_filas');$i++){
      $array_datos2 = array(
        'identificador' => $_POST['identificador'][$i],
        'nombre' => $_POST['nombre_conductor'][$i],
        'apellidos' => $_POST['apellido_conductor'][$i],
        'rut' => $_POST['rut_conductor'][$i],
        'proveedor_viajes_terceros_id' => $id_proveedor,
        'patente_camion_asociada' => $_POST['patente_camion_asociada'][$i],
        'patente_rampla_asociada' => $_POST['patente_rampla_asociada'][$i] 
      );
      $this->conductores_proveedor_terceros_model->add($array_datos2);
    }
    
    $this->session->set_flashdata('message', '<div class="message success">Se ha agregado el registro correctamente</div>');
    redirect('proveedores_viajes_terceros');
  }
  
  function editar($id){
    $data['data'] = $this->proveedores_viajes_terceros_model->getProveedorById($id);
    
    $data['conductores'] = $this->conductores_proveedor_terceros_model->getAllByIdProveedor($id);
    
    $this->template->display('admin/proveedores_viajes_terceros/edit',$data);
  }
  
  function update($id){
    $array_datos = array(
      'nombre_proveedor'        => $this->input->post('nombre_proveedor'),
      'razon_social_proveedor'  => $this->input->post('razon_social_proveedor'),
      'direccion_contacto'      => $this->input->post('direccion_contacto'),
      'persona_de_contacto'     => $this->input->post('persona_de_contacto'),
      'telefono'                => $this->input->post('telefono'),
      'rut'                     => $this->input->post('rut')
    );
    
    $this->proveedores_viajes_terceros->update($id, $array_datos);
    
    $this->session->set_flashdata('message', '<div class="message success">Se ha actualizado el registro correctamente</div>');
    redirect('proveedores_viajes_terceros/editar/'.$id);
  }
  
  function eliminar($id){
    $this->proveedores_viajes_terceros_model->delete($id);
    $this->session->set_flashdata('message', '<div class="message success">Se ha eliminado correctamente</div>');
    redirect("proveedores_viajes_terceros");
  }
}
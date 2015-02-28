<?php
class Conductores_proveedor_terceros extends CI_Controller 
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('conductores_proveedor_terceros_model');
  }
  
  function index(){
    //$data['conductores'] = $this->conductores_model->getAll();
    $this->template->display('admin/conductores_proveedor_terceros/list');
  }
  
  function nuevo(){
    $this->load->model('proveedores_viajes_terceros_model');
    $data['proveedores_viajes_terceros'] = $this->proveedores_viajes_terceros_model->getAll();
    $this->template->display('admin/conductores_proveedor_terceros/new',$data);
  }
  
  function add(){
    $array_datos = array(
      'identificador' =>    $this->input->post('identificador'),
      'nombre' =>           $this->input->post('nombre'),
      'apellidos' =>         $this->input->post('apellido'),
      'rut' =>              $this->input->post('rut'),
      'patente_camion_asociada' => $this->input->post('patente_camion_asociada'),
      'patente_rampla_asociada' => $this->input->post('patente_rampla_asociada'),
      'proveedor_viajes_terceros_id' => $this->input->post('proveedor_viajes_terceros_id')
      
      
    );
    
    $id_conductor=$this->conductores_proveedor_terceros_model->add($array_datos);
    
    if($this->input->is_ajax_request()){
      $data['value'] = json_encode(array("id_conductor"=>$id_conductor));
      $this->load->view("admin/ajax/responce",$data);
    }else{
      $this->session->set_flashdata('message', '<div class="message success">Se ha agregado el registro correctamente</div>');
      redirect('conductores_proveedor_terceros');
    }    
  }
  
   function editar($id){
    $this->load->model('proveedores_viajes_terceros_model');
    $data['data'] = $this->conductores_proveedor_terceros_model->getConductorById($id);
    $data['proveedores_viajes_terceros'] = $this->proveedores_viajes_terceros_model->getAll();
    $this->template->display('admin/conductores_proveedor_terceros/edit',$data);
  }
  
  function update($id){
    $array_datos = array(
      'identificador' =>    $this->input->post('identificador'),
      'nombre' =>           $this->input->post('nombre'),
      'apellidos' =>         $this->input->post('apellido'),
      'rut' =>              $this->input->post('rut'),
      'patente_camion_asociada' => $this->input->post('patente_camion_asociada'),
      'patente_rampla_asociada' => $this->input->post('patente_rampla_asociada'),
      'proveedor_viajes_terceros_id' => $this->input->post('proveedor_viajes_terceros_id')
    );
    
    $this->conductores_proveedor_terceros_model->update($id, $array_datos);
    
    $this->session->set_flashdata('message', '<div class="message success">Se ha actualizado el registro correctamente</div>');
    redirect('conductores_proveedor_terceros');
  }
  
  function eliminar($id){
    $this->conductores_proveedor_terceros_model->delete($id);
    $this->session->set_flashdata('message', '<div class="message success">Se ha eliminado correctamente</div>');
    redirect("conductores_proveedor_terceros");
  }
}
?>
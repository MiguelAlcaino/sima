<?php
class Conductores extends CI_Controller 
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('conductores_model');
  }
  
  function index(){
    //$data['conductores'] = $this->conductores_model->getAll();
    $this->template->display('admin/conductores/list');
  }
  
  function nuevo(){
    $this->template->display('admin/conductores/new');
  }
  
  function add(){
    $array_datos = array(
      'identificador' =>    $this->input->post('identificador'),
      'nombre' =>           $this->input->post('nombre'),
      'apellido' =>         $this->input->post('apellido'),
      'patente_asociada' => $this->input->post('patente_asociada'),
      'rut' =>              $this->input->post('rut'),
      'fecha_nacimiento' => $this->input->post('fecha_nacimiento')
    );
    
    $id_conductor=$this->conductores_model->add($array_datos);
    
    if($this->input->is_ajax_request()){
      $data['value'] = json_encode(array("id_conductor"=>$id_conductor));
      $this->load->view("admin/ajax/responce",$data);
    }else{
      $this->session->set_flashdata('message', '<div class="message success">Se ha agregado el registro correctamente</div>');
      redirect('conductores/editar/'.$id_conductor);
    }
    
  }
  
  function editar($id){
    $data['data'] = $this->conductores_model->getConductorById($id);
    $this->template->display('admin/conductores/edit',$data);
  }
  
  function update($id){
    $array_datos = array(
      'identificador' =>    $this->input->post('identificador'),
      'nombre' =>           $this->input->post('nombre'),
      'apellido' =>         $this->input->post('apellido'),
      'patente_asociada' => $this->input->post('patente_asociada'),
      'rut' =>              $this->input->post('rut'),
      'fecha_nacimiento' => $this->input->post('fecha_nacimiento')
    );
    
    $this->conductores_model->update($id, $array_datos);
    
    $this->session->set_flashdata('message', '<div class="message success">Se ha actualizado el registro correctamente</div>');
    redirect('conductores/editar/'.$id);
  }
  
  function eliminar($id){
    $this->conductores_model->delete($id);
    $this->session->set_flashdata('message', '<div class="message success">Se ha eliminado correctamente</div>');
    redirect("conductores");
  }
}
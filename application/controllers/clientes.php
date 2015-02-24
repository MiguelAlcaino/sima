<?php
class Clientes extends CI_Controller 
{
  function __construct()
  {
    parent::__construct();
		
		$this->load->model("clientes_model",'clientes');
		$this->load->model("provincias_model",'provincias');

	}
	
	function index()
	{	
		$data['data']  = $this->clientes->get_all();
		//$data['provincias']  = $this->provincias->get_all();
		$data['q']  = '';
		$data['tab']   = '';
		$this->template->display('admin/clientes/list',$data);
		
	}
	
	function nuevo()
	{	
		$data['tab']   = 'nuevo';
		$data['data']  = $this->clientes->get_all();
		$data['provincias']  = $this->provincias->get_all();
    $data['comunas'] = $this->provincias->getComunas();
		$this->template->display('admin/clientes/new',$data);
	}
	
	function editar($id){
		
		$data['data']  = $this->clientes->get_by_id($id);
		$data['provincias']  = $this->provincias->get_all();
    //$data['comunas'] = array();
    //$data['comunas'] = $this->provincias->getComunas($data['data'][0]['id_provincia']);
    $data['comunas'] = $this->provincias->getComunas();
		$this->template->display('admin/clientes/editar',$data);
		
	}
	
	function agregar()
	{	
		//reglas
		$this->clientes->add();	
		$this->session->set_flashdata('message', '<div class="message success">Se ha guardado correctamente</div>');
		redirect("clientes");
	}
	
	function actualizar()
	{	
			
		$this->clientes->update();	
		$this->session->set_flashdata('message', '<div class="message success">Se ha actualizado correctamente</div>');
		redirect("clientes");
	}
	
	function eliminar($id)
	{	
		$this->clientes->delete($id);
		$this->session->set_flashdata('message', '<div class="message success">Se ha eliminado correctamente</div>');
		redirect("clientes");
	}	
}
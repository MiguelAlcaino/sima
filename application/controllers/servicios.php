<?php
class Servicios extends CI_Controller 
{
  function __construct()
  {
    parent::__construct();
		
		$this->load->model("servicios_model",'servicios');
	}
	
	function index()
	{	
		$data['data']  = $this->servicios->get_all();
		$this->template->display('admin/servicios/list',$data);
		
	}
	
	function nuevo()
	{	
		$data['tab']   = 'nuevo';
		$data['data']  = $this->servicios->get_all();
		$this->template->display('admin/servicios/list',$data);
	}
	
	function editar($id){
		
		$data['data']  = $this->servicios->get_by_id($id);
		$this->template->display('admin/servicios/editar',$data);
		
	}
	
	function agregar()
	{	
			$this->servicios->add();	
			$this->session->set_flashdata('message', '<div class="message success">Se ha guardado correctamente</div>');
			redirect("servicios");
	}
	
	function actualizar()
	{	
			
		$this->servicios->update();	
		$this->session->set_flashdata('message', '<div class="message success">Se ha actualizado correctamente</div>');
		redirect("servicios");
	}
	
	function eliminar($id)
	{	
		$this->servicios->delete($id);
		$this->session->set_flashdata('message', '<div class="message success">Se ha eliminado correctamente</div>');
		redirect("servicios");
	}	
}
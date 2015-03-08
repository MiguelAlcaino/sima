<?php
class Productos extends CI_Controller 
{
  function __construct()
  {
    parent::__construct();
		
		$this->load->model("productos_model",'productos');
	}
	
	function index()
	{	
		$data['data']  = $this->productos->get_all();
    $data['tab'] = '';
		$this->template->display('admin/productos/list',$data);
		
	}
	
	function nuevo()
	{	
		$data['tab']   = 'nuevo';
		$data['data']  = $this->productos->get_all();
		$this->template->display('admin/productos/list',$data);
	}
	
	function editar($id){
		
		$data['data']  = $this->productos->get_by_id($id);
		$this->template->display('admin/productos/editar',$data);
		
	}
	
	function agregar()
	{	
			$this->productos->add();	
			$this->session->set_flashdata('message', '<div class="message success">Se ha guardado correctamente</div>');
			redirect("productos");
	}
	
	function actualizar()
	{	
			
		$this->productos->update();	
		$this->session->set_flashdata('message', '<div class="message success">Se ha actualizado correctamente</div>');
		redirect("productos");
	}
	
	function eliminar($id)
	{	
		$this->productos->delete($id);
		$this->session->set_flashdata('message', '<div class="message success">Se ha eliminado correctamente</div>');
		redirect("productos");
	}	
}
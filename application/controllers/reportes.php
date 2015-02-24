<?php
class Reportes extends CI_Controller 
{
  function __construct()
  {
    parent::__construct();
		
		$this->load->model("dominios_model",'dominios');
		$this->load->model("palabras_model",'palabras');
	}
	
	function index()
	{	
		$data['data']      = $this->palabras->get_all();
		$data['dominios']  = $this->dominios->get_all();
		$this->template->display('admin/reportes/palabras',$data);
	}
	
	function palabras($id = 0, $i='', $f='')
	{	
		$data['data']      = $this->palabras->get_all_by_domain($id, $i, $f);
		$data['dominios']  = $this->dominios->get_all();
		$data['dominio']   = $id;
		$data['fecha_inicio'] = ($i != '') ? date("Y/m/d",strtotime($i)) : '';
		$data['fecha_fin']    = ($f != '') ? date("Y/m/d",strtotime($f)) : '';
 		$this->template->display('admin/reportes/palabras',$data);
	}
	
	function informes($d=0, $p=0)
	{	
		$data['data']      = $this->palabras->get_all_by_domain($id, $i, $f);
		$data['dominios']  = $this->dominios->get_all();
		$data['dominio']   = $d;
		$data['palabra']   = $p;
		
		$data['fecha_inicio'] = ($d != '') ? date("Y/m/d",strtotime('-1 month',time())) : '';
		$data['fecha_fin']    = ($d != '') ? date("Y/m/d",time()) : '';
 		
		$this->template->display('admin/reportes/informes',$data);
	}		
}
?>
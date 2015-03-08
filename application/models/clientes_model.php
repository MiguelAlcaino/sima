<?php
// Proyecto: Sistema Facturacion
// Version: 1.0
// Programador: Jorge Linares
// Framework: Codeigniter
// Clase: Clientes

class Clientes_model extends CI_Model
{
	
	// Constructor
	public function __construct()
	{
		parent::__construct();
			
	}
	
	public function get_total()
	{
		$query = $this->db->query("SELECT * FROM  clientes");
		return $query->num_rows();								
	}
	
	public function get_all()
	{
		
		$query = $this->db->query("SELECT *, ifNull(( SELECT nombre_provincia FROM provincias p 
															WHERE p.id_provincia = c.id_provincia),'') 
															AS nombre_provincia 
											FROM clientes c ORDER BY id_cliente DESC");
		return $query->result_array();
	}
	
	public function get_all_order_name()
	{
		
		$query = $this->db->query("SELECT *, ifNull(( SELECT nombre_provincia FROM provincias p 
															WHERE p.id_provincia = c.id_provincia),'') 
															AS nombre_provincia 
											FROM clientes c ORDER BY nombre_comercial");
		return $query->result_array();
	}
	
	public function get_term($q='')
	{
		
		$query = $this->db->query("SELECT *, ifNull(( SELECT nombre_provincia FROM provincias p 
															WHERE p.id_provincia = c.id_provincia),'') 
															AS nombre_provincia  
											FROM clientes c 
											WHERE CONCAT(nombre_comercial,' ',razon_social,' ',poblacion) LIKE '%$q%'");
		return $query->result_array();
	}
	
	public function get_by_id($id = 0)
	{
		$query = $this->db->query("SELECT * FROM  clientes
										WHERE id_cliente = '".$id."'");
		
		return $query->result_array();								
	}
	
	public function add()
	{	
		
		$array_datos = array(
			"id_cliente" 	        => '',
			"id_provincia" 	        => $this->input->post('provincia'),
			"comuna_id"           => $this->input->post('comuna_id'),
			"nombre_comercial"		=> $this->input->post('nombre'),
			"razon_social"  		=> $this->input->post('razon'),
			"nif_cif"  				=> $this->input->post('nif_cif'),
			"contacto"  			=> $this->input->post('contacto'),
			"pagina_web"  			=> $this->input->post('pagina_web'),
			"email"  				=> $this->input->post('email'),
			"poblacion"  			=> $this->input->post('poblacion'),
			"direccion"  			=> $this->input->post('direccion'),
			"cp"  					=> $this->input->post('cp'),
			"telefono"  			=> $this->input->post('telefono'),
			"movil"  				=> $this->input->post('movil'),
			"fax"  					=> $this->input->post('fax'),
			"tipo_empresa"  		=> $this->input->post('tipo'),
			"entidad_bancaria"  	=> $this->input->post('entidad'),
			"numero_cuenta"  		=> $this->input->post('numero_cuenta'),
			"observaciones"  		=> $this->input->post('observaciones')
		);
		
		$this->db->insert("clientes",$array_datos);
	}
	
	public function update()
	{	
		$array_datos = array(
			"id_provincia" 	        => $this->input->post('provincia'),
			"comuna_id"           => $this->input->post('comuna_id'),
			"nombre_comercial"		=> $this->input->post('nombre'),
			"razon_social"  		=> $this->input->post('razon'),
			"nif_cif"  				=> $this->input->post('nif_cif'),
			"contacto"  			=> $this->input->post('contacto'),
			"pagina_web"  			=> $this->input->post('pagina_web'),
			"email"  				=> $this->input->post('email'),
			"poblacion"  			=> $this->input->post('poblacion'),
			"direccion"  			=> $this->input->post('direccion'),
			"cp"  					=> $this->input->post('cp'),
			"telefono"  			=> $this->input->post('telefono'),
			"movil"  				=> $this->input->post('movil'),
			"fax"  					=> $this->input->post('fax'),
			"tipo_empresa"  		=> $this->input->post('tipo'),
			"entidad_bancaria"  	=> $this->input->post('entidad'),
			"numero_cuenta"  		=> $this->input->post('numero_cuenta'),
			"observaciones"  		=> $this->input->post('observaciones')
		);
		
		$this->db->where('id_cliente', $this->input->post('id'));
		$this->db->update("clientes",$array_datos);
	}
	
	public function delete($id)
	{	
		$this->db->where('id_cliente', $id);
		$this->db->delete("clientes");	
	}
}
?>
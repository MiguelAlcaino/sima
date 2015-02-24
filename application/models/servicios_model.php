<?php
// Proyecto: Sistema Facturacion
// Version: 1.0
// Programador: Jorge Linares
// Framework: Codeigniter
// Clase: Servicios

class Servicios_model extends CI_Model
{
	
	// Constructor
	public function __construct()
	{
		parent::__construct();
			
	}
	
	public function get_total()
	{
		$query = $this->db->query("SELECT * FROM  servicios");
		return $query->num_rows();								
	}
	
	public function get_all()
	{
		
		$query = $this->db->query("SELECT * FROM servicios  ORDER BY id_servicio DESC");
		return $query->result_array();
	}
	
	public function get_term($q='')
	{
		
		$query = $this->db->query("SELECT * FROM servicios WHERE nombre LIKE '%$q%'");
		return $query->result_array();
	}
	
	public function get_by_id($id = 0)
	{
		$query = $this->db->query("SELECT * FROM  servicios WHERE id_servicio = '".$id."'");
		
		return $query->result_array();								
	}
	
	public function add()
	{	
		
		$array_datos = array(
			"id_servicio" 	        => '',
			"nombre"				=> $_POST['nombre'],
			"descripcion"  		    => $_POST['descripcion'],
			"precio"  				=> $_POST['precio']
		);
		
		$this->db->insert("servicios",$array_datos);
	}
	
	public function update()
	{	
		$array_datos = array(
			"nombre"				=> $_POST['nombre'],
			"descripcion"  		    => $_POST['descripcion'],
			"precio"  				=> $_POST['precio']
		);
				
		$this->db->where('id_servicio', $_POST['id']);
		$this->db->update("servicios",$array_datos);
	}
	
	public function delete($id)
	{	
		$this->db->where('id_servicio', $id);
		$this->db->delete("servicios");	
	}
}
?>
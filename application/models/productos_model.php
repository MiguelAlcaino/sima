<?php
// Proyecto: Sistema Facturacion
// Version: 1.0
// Programador: Jorge Linares
// Framework: Codeigniter
// Clase: Productos

class Productos_model extends CI_Model
{
	
	// Constructor
	public function __construct()
	{
		parent::__construct();
			
	}
	
	public function get_total()
	{
		$query = $this->db->query("SELECT * FROM  productos");
		return $query->num_rows();								
	}
	
	public function get_all()
	{
		
		$query = $this->db->query("SELECT * FROM productos  ORDER BY id_producto DESC");
		return $query->result_array();
	}
	
	public function get_term($q='')
	{
		
		$query = $this->db->query("SELECT * FROM productos WHERE nombre LIKE '%$q%'");
		return $query->result_array();
	}
	
	public function get_by_id($id = 0)
	{
		$query = $this->db->query("SELECT * FROM  productos WHERE id_producto = '".$id."'");
		
		return $query->result_array();								
	}
	
	public function add()
	{	
		
		$array_datos = array(
			"id_producto" 	        => '',
			"nombre"				=> $_POST['nombre'],
			"descripcion"  		    => $_POST['descripcion'],
			"precio"  				=> $_POST['precio']
		);
		
		$this->db->insert("productos",$array_datos);
	}
	
	public function update()
	{	
		$array_datos = array(
			"nombre"				=> $_POST['nombre'],
			"descripcion"  		    => $_POST['descripcion'],
			"precio"  				=> $_POST['precio']
		);
				
		$this->db->where('id_producto', $_POST['id']);
		$this->db->update("productos",$array_datos);
	}
	
	public function delete($id)
	{	
		$this->db->where('id_producto', $id);
		$this->db->delete("productos");	
	}
}
?>
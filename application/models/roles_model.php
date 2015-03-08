<?php
// Proyecto: Sistema Facturacion
// Version: 1.0
// Programador: Jorge Linares
// Framework: Codeigniter
// Clase: Roles

class Roles_model extends CI_Model
{
	
	// Constructor
	public function __construct()
	{
		parent::__construct();
			
	}
	
	public function get_all(){
		
		$this->db->select('*');
		$this->db->order_by("id_rol", "asc"); 
		$query = $this->db->get("roles");
		
		return $query->result_array();
	}
}?>
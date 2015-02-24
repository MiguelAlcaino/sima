<?php
// Proyecto: Sistema Facturacion
// Version: 1.0
// Programador: Jorge Linares
// Framework: Codeigniter
// Clase: Provincias

class Provincias_model extends CI_Model
{
	
	// Constructor
	public function __construct()
	{
		parent::__construct();
			
	}
  
  public function getComunas($id_provincia = null){
    if($id_provincia == null){
      $query = $this->db->query("SELECT * FROM comunas ORDER BY comuna_nombre ASC");
    }else{
      $query = $this->db->query("SELECT * FROM comunas c WHERE c.provincia_id = ".$id_provincia);
    }
    
    return $query->result_array();
  }
	
	public function get_total()
	{
		$query = $this->db->query("SELECT * FROM  provincias");
		return $query->num_rows();								
	}
	
	public function get_all()
	{
		
		$query = $this->db->query("SELECT * FROM provincias ORDER BY nombre_provincia ASC");
		return $query->result_array();
	}
}
?>
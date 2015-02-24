<?php
class Conductores_proveedor_terceros_model extends CI_Model
{
  
  // Constructor
  public function __construct()
  {
    parent::__construct();
  }
  
  public function getConductorById($id){
    $query = $this->db->query("SELECT * FROM conductores_proveedor_viajes
              WHERE id = ".$id);
    return $query->result_array();
  }
  
  public function getAll(){
    $query = $this->db->query("SELECT * FROM conductores_proveedor_viajes
              ORDER BY identificador ASC");
    return $query->result_array();
  }
  
  public function getAllByIdProveedor($id){
    $query = $this->db->query("SELECT * FROM conductores_proveedor_viajes
                               WHERE proveedor_viajes_terceros_id = ".$id."
                               ORDER BY identificador ASC");
    return $query->result_array();
  }
  
  public function add($array_datos){   
    $this->db->insert("conductores_proveedor_viajes", $array_datos);
    return $this->db->insert_id();
  }
  
  public function update($id, $array_datos){
    $this->db->where('id', $id);
    $this->db->update('conductores_proveedor_viajes', $array_datos); 
  }
  
  public function delete($id)
  { 
    $this->db->where('id', $id);
    $this->db->delete("conductores_proveedor_viajes");
  }
  
}

?>
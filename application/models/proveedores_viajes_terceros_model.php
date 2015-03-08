<?php
class Proveedores_viajes_terceros_model extends CI_Model
{
  
  // Constructor
  public function __construct()
  {
    parent::__construct();
  }
  
  public function getProveedorById($id){
    $query = $this->db->query("SELECT * FROM proveedores_viajes_terceros
              WHERE id = ".$id);
    return $query->result_array();
  }
  
  public function getAll(){
    $query = $this->db->query("SELECT * FROM proveedores_viajes_terceros
              ORDER BY nombre_proveedor ASC");
    return $query->result_array();
  }
  
  public function add($array_datos){   
    $this->db->insert("proveedores_viajes_terceros", $array_datos);
    return $this->db->insert_id();
  }
  
  public function update($id, $array_datos){
    $this->db->where('id', $id);
    $this->db->update('proveedores_viajes_terceros', $array_datos); 
  }
  
  public function delete($id)
  { 
    $this->db->where('id', $id);
    $this->db->delete("proveedores_viajes_terceros");
  }
  
}
<?php

class Viajes_temporales_model extends CI_Model
{
  
  // Constructor
  function __construct() {
       parent::__construct();
  }
  
  public function add($array_datos){   
    
    $this->db->insert("viajes_temporales", $array_datos);
    return $this->db->insert_id();
  }
  
  public function update($id, $array_datos){
    $this->db->where('id', $id);
    $this->db->update('viajes_temporales', $array_datos); 
  }
  
  public function delete($id)
  { 
    $this->db->where('id', $id);
    $this->db->delete("viajes_temporales");
  }
  
  public function getViajeById($id){
    $query = $this->db->query("SELECT * FROM viajes_temporales v, clientes c
                                WHERE v.cliente_id = c.id_cliente AND
                                      v.id = ".$id);
    return $query->result_array();
  }
  
  public function get_all(){
    $query = $this->db->query("SELECT
                        v.*,
                        c.*
                        FROM viajes_temporales v, clientes c 
                        WHERE v.cliente_id = c.id_cliente
                        ORDER BY v.id DESC
                       ");
    return $query->result_array();
  }
}
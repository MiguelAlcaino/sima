<?php

class Viajes_proveedores_terceros_model extends CI_Model
{
  
  // Constructor
  public function __construct() 
  {
    parent::__construct();
  }
  
  public function get_all(){
    $query = $this->db->query("SELECT
                        v.*,
                        c.*,
                        co.id as id_conductor,
                        co.nombre as conductor_nombre,
                        co.apellidos as conductor_apellido,
                        co.identificador as conductor_identificador,
                        co.rut as conductor_rut
                        
                        FROM viajes_proveedores_terceros v, clientes c , conductores_proveedor_viajes co
                        WHERE v.cliente_id = c.id_cliente
                        AND co.id = v.conductor_proveedor_tercero_id
                        ORDER BY v.id DESC
                       ");
    return $query->result_array();
  }
  
  public function getViajeById($id){
    $query = $this->db->query("SELECT * FROM viajes_proveedores_terceros v, clientes c
                                WHERE v.cliente_id = c.id_cliente AND
                                      v.id = ".$id);
    return $query->result_array();
  }
  
  public function get_term($q='', $id_cliente)
  {
    
    $query = $this->db->query("SELECT *,'4' as 'tipo_viaje' FROM viajes_proveedores_terceros v, conductores_proveedor_viajes c
                               WHERE v.conductor_proveedor_tercero_id = c.id
                               AND identificador_viaje LIKE '%".$q."%'
                               AND cliente_id = ".$id_cliente." 
                               AND esta_facturado = 0");
    return $query->result_array();
  }
  
  public function existeCodigoViaje($codigo_viaje){
    $query = $this->db->query("SELECT * FROM viajes_proveedores_terceros
                               WHERE codigo_viaje = '".$codigo_viaje."'");
    if($query->num_rows() == 0){
      return false;
    }else{
      return true;
    }
  }
  
  public function add($array_datos){   
    
    $this->db->insert("viajes_proveedores_terceros", $array_datos);
    return $this->db->insert_id();
  }
  
  public function update($id, $array_datos){
    $this->db->where('id', $id);
    $this->db->update('viajes_proveedores_terceros', $array_datos); 
  }
  
  public function delete($id)
  { 
    $this->db->where('id', $id);
    $this->db->delete("viajes_proveedores_terceros");
  }
  
  
}

?>
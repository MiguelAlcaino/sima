<?php

class Viajes_model extends CI_Model
{
  
  // Constructor
  public function __construct() 
  {
    parent::__construct();  
  }
  
  public function crearDesdeTemporal($array_datos){
    $this->db->insert("viajes", $array_datos);
    return $this->db->insert_id();
  }

    public function getViajesPropiosYTercerosByNumeroContenedor($numero_contenedor){
        $query = $this->db->query("SELECT * from (
                                  SELECT
                                  v.id as 'id',
                                  v.codigo_viaje as 'codigo_viaje',
                                  v.cliente_id as 'cliente_id',
                                  '3' as 'tipo_viaje',
                                  v.fecha_origen as 'fecha_origen',
                                  v.nave as 'nave',
                                  v.conductor_id as 'conductor_id',
                                  v.origen as 'origen',
                                  v.destino as 'destino',
                                  v.descripcion_carga as 'descripcion_carga',
                                  v.numero_contenedor as 'numero_contenedor',
                                  v.numero_guia as 'numero_guia',
                                  v.valor_viaje as 'valor_viaje',
                                  co.nombre as 'conductor_nombre',
                                  co.apellido as 'conductor_apellido',
                                  co.identificador as 'conductor_identificador'
                              FROM viajes as v, conductores as co
                              WHERE v.numero_contenedor LIKE '".$numero_contenedor."%'
                              AND co.id = v.conductor_id

                              UNION ALL
                              SELECT
                                  vt.id as 'id',
                                  vt.codigo_viaje as 'codigo_viaje',
                                  vt.cliente_id as 'cliente_id',
                                  '4' as 'tipo_viaje',
                                  vt.fecha_origen as 'fecha_origen',
                                  vt.nave as 'nave',
                                  vt.conductor_proveedor_tercero_id as 'conductor_id',
                                  vt.origen as 'origen',
                                  vt.destino as 'destino',
                                  vt.descripcion_carga as 'descripcion_carga',
                                  vt.numero_contenedor as 'numero_contenedor',
                                  vt.numero_guia as 'numero_guia',
                                  vt.valor_viaje as 'valor_viaje',
                                  cpv.nombre as 'conductor_nombre',
                                  cpv.apellidos as 'conductor_apellido',
                                  cpv.identificador as 'conductor_identificador'
                              FROM viajes_proveedores_terceros as vt, conductores_proveedor_viajes cpv
                              WHERE vt.numero_contenedor LIKE '".$numero_contenedor."%'
                              AND vt.conductor_proveedor_tercero_id = cpv.id
                     getTramosByViajeIdAndTipoViaje         )
                              AS temp
                              WHERE temp.numero_contenedor LIKE '".$numero_contenedor."%'
                              ORDER BY temp.nave, temp.fecha_origen ASC");
        return $query->result_array();
    }

  public function getViajesPropiosYTercerosByConductorPropioId($conductor_id){
    $query = $this->db->query("SELECT 
                                  v.id as 'id',
                                  v.codigo_viaje as 'codigo_viaje',
                                  v.cliente_id as 'cliente_id',
                                  '3' as 'tipo_viaje',
                                  v.fecha_origen as 'fecha_origen',
                                  v.nave as 'nave',
                                  v.conductor_id as 'conductor_id',
                                  v.origen as 'origen',
                                  v.destino as 'destino',
                                  v.descripcion_carga as 'descripcion_carga',
                                  v.numero_contenedor as 'numero_contenedor',
                                  v.numero_guia as 'numero_guia',
                                  v.valor_viaje as 'valor_viaje',
                                  co.nombre as 'conductor_nombre',
                                  co.apellido as 'conductor_apellido',
                                  co.identificador as 'conductor_identificador'
                              FROM viajes as v, conductores as co
                              WHERE v.conductor_id = $conductor_id
                              AND co.id = v.conductor_id
                              ");
    return $query->result_array();
  }
  
    public function getViajesPropiosYTerceros(){
    $query = $this->db->query("SELECT temp.*, cl.nombre_comercial as 'clientes_nombre_comercial' from (
                                  SELECT 
                                  v.id as 'id',
                                  v.codigo_viaje as 'codigo_viaje',
                                  v.cliente_id as 'cliente_id',
                                  '3' as 'tipo_viaje',
                                  v.fecha_origen as 'fecha_origen',
                                  v.nave as 'nave',
                                  v.conductor_id as 'conductor_id',
                                  v.origen as 'origen',
                                  v.destino as 'destino',
                                  v.descripcion_carga as 'descripcion_carga',
                                  v.numero_contenedor as 'numero_contenedor',
                                  v.numero_guia as 'numero_guia',
                                  v.valor_viaje as 'valor_viaje',
                                  v.guia_entregada as 'guia_entregada',
                                  v.numero_interchange_entregado as 'interchange_entregado',
                                  co.nombre as 'conductor_nombre',
                                  co.apellido as 'conductor_apellido',
                                  co.identificador as 'conductor_identificador'
                              FROM viajes as v
                              LEFT JOIN conductores AS co ON co.id = v.conductor_id
                              
                              UNION ALL
                              SELECT 
                                  vt.id as 'id',
                                  vt.codigo_viaje as 'codigo_viaje',
                                  vt.cliente_id as 'cliente_id', 
                                  '4' as 'tipo_viaje',
                                  vt.fecha_origen as 'fecha_origen',
                                  vt.nave as 'nave',
                                  vt.conductor_proveedor_tercero_id as 'conductor_id',
                                  vt.origen as 'origen',
                                  vt.destino as 'destino',
                                  vt.descripcion_carga as 'descripcion_carga',
                                  vt.numero_contenedor as 'numero_contenedor',
                                  vt.numero_guia as 'numero_guia',
                                  vt.valor_viaje as 'valor_viaje',
                                  vt.guia_entregada as 'guia_entregada',
                                  vt.numero_interchange_entregado as 'interchange_entregado',
                                  cpv.nombre as 'conductor_nombre',
                                  cpv.apellidos as 'conductor_apellido',
                                  cpv.identificador as 'conductor_identificador'
                                  
                              FROM viajes_proveedores_terceros as vt
                              LEFT JOIN conductores_proveedor_viajes AS cpv ON vt.conductor_proveedor_tercero_id = cpv.id
                              
                              )
                              AS temp
                              LEFT JOIN clientes AS cl ON cl.id_cliente = temp.cliente_id
                              ORDER BY temp.fecha_origen DESC");
    return $query->result_array();
  }
  
    public function getViajesPropiosYTercerosByClienteId($cliente_id){
    $query = $this->db->query("SELECT * from (
                                  SELECT 
                                  v.id as 'id',
                                  v.codigo_viaje as 'codigo_viaje',
                                  v.cliente_id as 'cliente_id',
                                  '3' as 'tipo_viaje',
                                  v.fecha_origen as 'fecha_origen',
                                  v.nave as 'nave',
                                  v.conductor_id as 'conductor_id',
                                  v.origen as 'origen',
                                  v.destino as 'destino',
                                  v.descripcion_carga as 'descripcion_carga',
                                  v.numero_contenedor as 'numero_contenedor',
                                  v.numero_guia as 'numero_guia',
                                  v.valor_viaje as 'valor_viaje',
                                  co.nombre as 'conductor_nombre',
                                  co.apellido as 'conductor_apellido',
                                  co.identificador as 'conductor_identificador'
                              FROM viajes as v, conductores as co
                              WHERE v.cliente_id = $cliente_id
                              AND co.id = v.conductor_id
                              
                              UNION ALL
                              SELECT 
                                  vt.id as 'id',
                                  vt.codigo_viaje as 'codigo_viaje',
                                  vt.cliente_id as 'cliente_id', 
                                  '4' as 'tipo_viaje',
                                  vt.fecha_origen as 'fecha_origen',
                                  vt.nave as 'nave',
                                  vt.conductor_proveedor_tercero_id as 'conductor_id',
                                  vt.origen as 'origen',
                                  vt.destino as 'destino',
                                  vt.descripcion_carga as 'descripcion_carga',
                                  vt.numero_contenedor as 'numero_contenedor',
                                  vt.numero_guia as 'numero_guia',
                                  vt.valor_viaje as 'valor_viaje',
                                  cpv.nombre as 'conductor_nombre',
                                  cpv.apellidos as 'conductor_apellido',
                                  cpv.identificador as 'conductor_identificador'
                              FROM viajes_proveedores_terceros as vt, conductores_proveedor_viajes cpv
                              WHERE vt.cliente_id = $cliente_id
                              AND vt.conductor_proveedor_tercero_id = cpv.id
                              )
                              AS temp
                              WHERE temp.cliente_id = $cliente_id
                              ORDER BY temp.nave, temp.fecha_origen ASC");
    return $query->result_array();
  }
  
  public function getViajesPropiosYTercerosFacturadosByClienteId($cliente_id){
    $query = $this->db->query("SELECT * from (
                                  SELECT 
                                  v.id as 'id',
                                  v.codigo_viaje as 'codigo_viaje',
                                  v.cliente_id as 'cliente_id',
                                  '3' as 'tipo_viaje',
                                  v.fecha_origen as 'fecha_origen',
                                  v.nave as 'nave',
                                  v.conductor_id as 'conductor_id',
                                  v.origen as 'origen',
                                  v.destino as 'destino',
                                  v.descripcion_carga as 'descripcion_carga',
                                  v.numero_contenedor as 'numero_contenedor',
                                  v.numero_guia as 'numero_guia',
                                  v.valor_viaje as 'valor_viaje',
                                  co.nombre as 'conductor_nombre',
                                  co.apellido as 'conductor_apellido',
                                  co.identificador as 'conductor_identificador'
                              FROM viajes as v, conductores as co
                              WHERE v.cliente_id = $cliente_id
                              AND co.id = v.conductor_id
                              AND v.esta_facturado = 0
                              UNION ALL
                              SELECT 
                                  vt.id as 'id',
                                  vt.codigo_viaje as 'codigo_viaje',
                                  vt.cliente_id as 'cliente_id', 
                                  '4' as 'tipo_viaje',
                                  vt.fecha_origen as 'fecha_origen',
                                  vt.nave as 'nave',
                                  vt.conductor_proveedor_tercero_id as 'conductor_id',
                                  vt.origen as 'origen',
                                  vt.destino as 'destino',
                                  vt.descripcion_carga as 'descripcion_carga',
                                  vt.numero_contenedor as 'numero_contenedor',
                                  vt.numero_guia as 'numero_guia',
                                  vt.valor_viaje as 'valor_viaje',
                                  cpv.nombre as 'conductor_nombre',
                                  cpv.apellidos as 'conductor_apellido',
                                  cpv.identificador as 'conductor_identificador'
                              FROM viajes_proveedores_terceros as vt, conductores_proveedor_viajes cpv
                              WHERE vt.cliente_id = $cliente_id
                              AND vt.conductor_proveedor_tercero_id = cpv.id
                              AND vt.esta_facturado = 0)
                              AS temp
                              WHERE temp.cliente_id = $cliente_id
                              ORDER BY temp.nave, temp.fecha_origen ASC");
    return $query->result_array();
  }

    /**
     * @return array
     */
  public function get_all(){
    $query = $this->db->query("SELECT
                        v.*,
                        c.*,
                        co.id as id_conductor,
                        co.nombre as conductor_nombre,
                        co.apellido as conductor_apellido,
                        co.identificador as conductor_identificador,
                        co.rut as conductor_rut,
                        co.fecha_nacimiento as conductor_fecha_nacimiento
                        FROM viajes AS v
                        LEFT JOIN clientes AS c ON v.cliente_id = c.id_cliente
                        LEFT JOIN conductores AS co ON co.id = v.conductor_id
                        GROUP BY v.id
                        ORDER BY v.id DESC
                       ");
    return $query->result_array();
  }
  
  public function getViajeById($id){
    $query = $this->db->query("SELECT * FROM viajes v, clientes c
                                WHERE v.cliente_id = c.id_cliente AND
                                      v.id = ".$id);
    return $query->result_array();
  }
  
  public function get_term($q='', $id_cliente)
  {
    
    $query = $this->db->query("SELECT *, '3' as 'tipo_viaje' FROM viajes v, conductores c
                               WHERE v.conductor_id = c.id
                               AND identificador_viaje LIKE '%".$q."%'
                               AND cliente_id = ".$id_cliente." 
                               AND esta_facturado = 0");
    return $query->result_array();
  }
  
  public function existeCodigoViaje($codigo_viaje){
    $query = $this->db->query("SELECT * FROM viajes
                               WHERE codigo_viaje = '".$codigo_viaje."'");
    if($query->num_rows() == 0){
      return false;
    }else{
      return true;
    }
  }
  
  public function add($array_datos){   
    
    $this->db->insert("viajes", $array_datos);
    return $this->db->insert_id();
  }
  
  public function update($id, $array_datos){
    $this->db->where('id', $id);
    $this->db->update('viajes', $array_datos); 
  }
  
  public function delete($id)
  { 
    $this->db->where('id', $id);
    $this->db->delete("viajes");
  }
  
  
}

?>
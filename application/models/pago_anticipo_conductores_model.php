<?php
/**
 * Created by PhpStorm.
 * User: malcaino
 * Date: 03/05/15
 * Time: 23:54
 */

class Pago_anticipo_conductores_model extends CI_Model{

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $array_datos
     * @return integer
     */
    public function add($array_datos){
        $this->db->insert("pago_anticipo_conductores", $array_datos);
        return $this->db->insert_id();
    }

    /**
     * @return array
     */
    public function getAll(){
        $query = $this->db->query("SELECT * FROM pago_anticipo_conductores
              ORDER BY fecha_anticipo DESC");
        return $query->result_array();
    }

    /**
     * @param null|integer $id_conductor
     * @return array
     */
    public function getAnticiposByConductor($id_conductor = null){
        $query_txt = "
        SELECT
            p.id as pago_anticipo_conductores_id,
            p.monto as pago_anticipo_conductores_monto,
            p.fecha_anticipo as pago_anticipo_conductores_fecha_anticipo,
            p.hora_anticipo as pago_anticipo_conductores_hora_anticipo,
            p.descripcion as pago_anticipo_conductores_descripcion,
            v.id as viaje_id,
            v.codigo_viaje as viaje_codigo_viaje,
            c.identificador as conductor_identificador,
            c.nombre as conductor_nombre,
            c.apellido as conductor_apellido
        FROM pago_anticipo_conductores p
        LEFT JOIN viajes v ON p.viaje_id = v.id
        LEFT JOIN conductores c ON p.conductor_id = c.id";
        if($id_conductor != null){
            $query_txt .= " WHERE p.conductor_id = ".$id_conductor;
        }
        $query_txt .= " ORDER BY p.fecha_anticipo DESC";
        $query = $this->db->query($query_txt);
        return $query->result_array();
    }
}

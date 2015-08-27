<?php

/**
 * Created by PhpStorm.
 * User: malcaino
 * Date: 17/08/15
 * Time: 00:09
 */
class Tramo_Model extends CI_Model
{
    public function add($array_datos){
        $this->db->insert("viaje_tramo", $array_datos);
        return $this->db->insert_id();
    }

    public function getTramosByViajeIdAndTipoViaje($viaje_id, $tipo_viaje){
        $query = $this->db->query("SELECT * FROM viaje_tramo vt
              WHERE vt.viaje_id = ? AND vt.tipo_viaje = ?",
            array($viaje_id,$tipo_viaje)
        );
        return $query->result_array();
    }
}
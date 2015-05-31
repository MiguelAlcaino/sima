<?php
/**
 * Created by PhpStorm.
 * User: malcaino
 * Date: 05/05/15
 * Time: 23:44
 */

class Pago_viajes_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function add($array_datos){
        $this->db->insert("pago_viaje",$array_datos);
        return $this->db->insert_id();
    }

    public function getAll(){
        $query = $this->db->query("SELECT p.* FROM pago_viaje p");
        return $query->result_array();
    }
    public function getPagosViajesByViajeIdAndTipoViaje($viaje_id, $tipo_viaje){
        $query = $this->db->query("SELECT pv.* FROM pago_viaje pv
                                WHERE pv.viaje_id = ? AND pv.tipo_viaje = ?
            ORDER BY pv.fecha_pago DESC, pv.hora_pago DESC", array($viaje_id,$tipo_viaje));
        return $query->result_array();
    }


}
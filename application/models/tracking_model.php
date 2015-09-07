<?php

/**
 * Created by PhpStorm.
 * User: malcaino
 * Date: 06/09/15
 * Time: 20:54
 */
class Tracking_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add($array_datos){
        $this->db->insert("tracking", $array_datos);
        return $this->db->insert_id();
    }

    public function addDetalle($array_datos){
        $this->db->insert("tracking_detalle",$array_datos);
        return $this->db->insert_id();
    }

    /**
     * @param string $tipo_entidad
     * @param string $id_entidad
     */
    public function getTrackingsByTipoEntidadAndIdEntidad($tipo_entidad,$id_entidad){
        $query = $this->db->query("SELECT
                                       t.id as 'tracking_id',
                                       t.tipo_tracking as 'tipo_tracking',
                                       t.tipo_entidad as 'tipo_entidad',
                                       t.id_entidad as 'id_entidad',
                                       t.created as 'created',
                                       t.user_id as 'user_id',
                                       td.id as 'tracking_detalle_id',
                                       td.label as 'label',
                                       td.value as 'value'
                                   FROM tracking t
                                   LEFT JOIN tracking_detalle td ON td.tracking_id = t.id
                                   WHERE t.tipo_entidad = ? AND t.id_entidad = ?
                                   ORDER BY t.created DESC",
            array($tipo_entidad, $id_entidad));

        return $query->result_array();
    }
}
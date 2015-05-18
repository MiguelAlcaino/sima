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
        $this->db->insert($array_datos);
        return $this->db->insert_id();
    }



}
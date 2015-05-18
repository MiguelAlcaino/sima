<?php
/**
 * Created by PhpStorm.
 * User: malcaino
 * Date: 05/05/15
 * Time: 23:21
 */

class Pago_viajes extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model("pago_viajes_model");
    }
    public function index(){

    }

    public function nuevo(){

    }
}
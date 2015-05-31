<?php
/**
 * Created by PhpStorm.
 * User: malcaino
 * Date: 05/05/15
 * Time: 23:21
 */

class Pago_viajes extends CI_Controller{
    /** @var  Pago_viajes_model */
    public $pago_viajes_model;
    public function __construct(){
        parent::__construct();
        $this->load->model("pago_viajes_model");
    }
    public function index(){

    }

    public function nuevo(){

    }

    public function add(){
        $form = $this->input->post(null, true);
        unset($form['monto_num']);
        $id = $this->pago_viajes_model->add($form);
        if($this->input->is_ajax_request()){
            $this->load->view("admin/ajax/responce",array(
                'value' => json_encode(array(
                    'pago_viaje_id' => $id
                ))
            ));
        }else{
            $this->session->set_flashdata('message', 'Pago registrado con éxito');;
            redirect("viajes/informeViajesTodos");
        }
    }
}
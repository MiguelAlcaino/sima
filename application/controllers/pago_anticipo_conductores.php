<?php
/**
 * Created by PhpStorm.
 * User: malcaino
 * Date: 03/05/15
 * Time: 16:47
 */

class Pago_anticipo_conductores extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pago_anticipo_conductores_model');
    }

    /**
     * @param null|integer $id_conductor
     */
    public function index($id_conductor = null){
        /** @var Pago_anticipo_conductores_model $pago_anticipo_conductores_model */
        $pago_anticipo_conductores_model = $this->pago_anticipo_conductores_model;
        $pagos_anticipo = $pago_anticipo_conductores_model->getAnticiposByConductor($id_conductor);

        $this->load->model("conductores_model");
        /** @var Conductores_model $conductores_model */
        $conductores_model = $this->conductores_model;
        $this->template->display("admin/pago_anticipo_conductores/list",array(
            'pago_anticipo_conductores' => $pagos_anticipo,
            'id_conductor' => $id_conductor,
            'conductores_propios' => $conductores_model->getAll()
        ));
    }

    /**
     * @param null|integer $id_viaje
     * @param null|integer $id_conductor
     */
    public function nuevo($id_viaje = null, $id_conductor = null){
        $this->load->model("viajes_model");
        /** @var Viajes_model $viajes_model */
        $viajes_model = $this->viajes_model;
        $this->load->model("conductores_model");
        /** @var Conductores_model $conductores_model */
        $conductores_model = $this->conductores_model;
        /** @var array $viajes */
        $viajes = $viajes_model->get_all();
        /** @var array $conductores */
        $conductores = $conductores_model->getAll();

        $this->template->display("admin/pago_anticipo_conductores/new",array(
            'id_viaje' => $id_viaje,
            'id_conductor' => $id_conductor,
            'viajes' => $viajes,
            'conductores' => $conductores
        ));
    }

    public function add(){
        $datos = $this->input->post();
        /** @var Pago_anticipo_conductores_model $pago_anticipo_conductores_model */
        $pago_anticipo_conductores_model = $this->pago_anticipo_conductores_model;
        unset($datos['monto_num']);
        if($datos['viaje_id'] == "null" || $datos['viaje_id'] == null){
            $datos['viaje_id'] = null;
        }
        $id = $pago_anticipo_conductores_model->add($datos);
        redirect("pago_anticipo_conductores/index/".$datos['conductor_id']);

    }
}
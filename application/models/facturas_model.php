<?php
// Proyecto: Sistema Facturacion
// Version: 1.0
// Programador: Jorge Linares
// Framework: Codeigniter
// Clase: Facturas

class Facturas_model extends CI_Model
{
	
	// Constructor
	public function __construct()
	{
		parent::__construct();
			
	}
	
	public function get_total()
	{
		$query = $this->db->query("SELECT * FROM  facturas");
		return $query->num_rows();								
	}
	
	public function get_max_cod()
	{
		$query = $this->db->query("SELECT MAX(RIGHT(numero,6)) cod FROM  facturas");
		return $query->row(); 								
	}
	
	public function get_all_pagadas()
	{
		
		$query = $this->db->query("SELECT * FROM facturas f, clientes c 
												WHERE f.id_cliente = c.id_cliente AND f.estado = '1'
												ORDER BY f.id_factura DESC");
		return $query->result_array();
	}
	
	public function get_all_pendientes()
	{
		
		$query = $this->db->query("SELECT * FROM facturas f, clientes c 
												WHERE f.id_cliente = c.id_cliente AND f.estado = '0'
												ORDER BY f.id_factura DESC");
		return $query->result_array();
	}
	
	public function get_by_id($id = 0)
	{
		$query = $this->db->query("SELECT *, ifNull(( SELECT nombre_provincia FROM provincias prov 
															WHERE prov.id_provincia = c.id_provincia),'') 
															AS nombre_provincia,
															ifNull(( SELECT comuna_nombre FROM comunas com 
                              WHERE com.comuna_id = c.comuna_id),'') 
                              AS comuna_nombre
												FROM facturas f, clientes c
												WHERE f.id_cliente = c.id_cliente 
													AND f.id_factura = '".$id."' 
														ORDER BY f.id_factura DESC ");
		
		return $query->result_array();								
	}
	
	public function get_detail($id = 0)
	{
		$query = $this->db->query("SELECT * FROM facturas_detalles 
										WHERE  id_factura = '".$id."' ORDER BY id_factura_detalle ASC");
		
		return $query->result_array();								
	}
	
	public function get_term()
	{
		$q  = $this->input->post("q");
		$fi = $this->input->post("fi");
		$ff = $this->input->post("ff");
		$t  = $this->input->post("t");
		
		if($fi != '' && $ff != '') $wfecha = " AND f.fecha BETWEEN '".$fi."' AND '".$ff."'";
		if($q != '') $wcl = " AND c.id_cliente = '".$q."'";
		 
		$query = $this->db->query("SELECT f.id_factura id, f.numero, c.nombre_comercial, f.monto, 
												DATE_FORMAT(f.fecha , '%d/%m/%Y') fecha
												FROM facturas f, clientes c 
												WHERE f.id_cliente = c.id_cliente 
													AND f.estado = '$t'
													".$wfecha."
													".$wcl."
												ORDER BY f.id_factura DESC");												
																								
		return $query->result_array();
	}
	
	public function add()
	{	
		
		$array_datos = array(
			"id_factura" 	    => '',
			"id_cliente" 	   	    => $_POST['id_cliente'],
			"numero"				=> $_POST['numero'],
			"monto"					=> $_POST['input_total_civa'],
			"fecha"  		    	=> $_POST['fecha'],
			"estado"  		    	=> 0,
			"condiciones_venta" => $_POST['condiciones_venta']
		);
		
		$this->db->insert("facturas",$array_datos);
		$id = $this->db->insert_id();
		
		for($i = 0; $i < sizeof($_POST['quantity']);$i++){
			$array_datos = array(
				"id_factura_detalle" 	=> '',
				"id_factura" 	   	    => $id,
				"tipo_detalle"        => $_POST['tipo_detalle_form'][$i],
				"origen_detalle_id"   => $_POST['origen_detalle_id_form'][$i],
				"descripcion"			=> $_POST['descripcion'][$i],
				"precio"				=> $_POST['psi'][$i],
				"cantidad"				=> $_POST['quantity'][$i]
			);
			
			if($array_datos['tipo_detalle'] == 3){
			  $datos_viaje = array('esta_facturado' => 1);
			  $this->db->where('id',$array_datos['origen_detalle_id']);
        $this->db->update('viajes',$datos_viaje);
			}else{
			  if($array_datos['tipo_detalle'] == 4){
			    $datos_viaje = array('esta_facturado' => 1);
          $this->db->where('id',$array_datos['origen_detalle_id']);
          $this->db->update('viajes_proveedores_terceros',$datos_viaje);
			  }
			}
			$this->db->insert("facturas_detalles",$array_datos);
		}
		
	}
	
	public function update()
	{
	  $array_datos = array(
      "estado"    => $_POST['estado'],
      "numero"   =>  $_POST['numero'],
      "condiciones_venta" => $_POST['condiciones_venta']
    );
	    
	  if($_POST['estado_anterior'] == 0 && $_POST['estado'] == 1){
	    $array_datos['fecha_pago'] = date("Y-m-d");
	  }
	    
	  	
		 
				
		$this->db->where('id_factura', $_POST['id_factura']);
		$this->db->update("facturas",$array_datos);
	}
	
	public function delete($id)
	{	
		$this->db->where('id_factura', $id);
		$this->db->delete("facturas");
		
		$this->db->where('id_factura', $id);
		$this->db->delete("facturas_detalles");
	}
}
?>
<?php
// Proyecto: Sistema Facturacion
// Version: 1.0
// Programador: Jorge Linares
// Framework: Codeigniter
// Clase: Proformas

class Proformas_model extends CI_Model
{
	
	// Constructor
	public function __construct()
	{
		parent::__construct();
			
	}
	
	public function get_total()
	{
		$query = $this->db->query("SELECT * FROM  proformas");
		return $query->num_rows();								
	}
	
	public function get_max_cod()
	{
		$query = $this->db->query("SELECT MAX(RIGHT(numero,6)) cod FROM  proformas");
		return $query->row(); 								
	}
	
	public function get_all()
	{
		
		$query = $this->db->query("SELECT * FROM proformas p, clientes c 
												WHERE p.id_cliente = c.id_cliente 
												ORDER BY p.id_proforma DESC");
		return $query->result_array();
	}
	
	
	public function get_by_id($id = 0)
	{
		$query = $this->db->query("SELECT *, ifNull(( SELECT nombre_provincia FROM provincias prov 
															WHERE prov.id_provincia = c.id_provincia),'') 
															AS nombre_provincia 
												FROM proformas p, clientes c
												WHERE p.id_cliente = c.id_cliente 
													AND p.id_proforma = '".$id."' 
														ORDER BY p.id_proforma DESC ");
		
		return $query->result_array();								
	}
	
	public function get_term()
	{
		$q  = $this->input->post("q");
		$fi = $this->input->post("fi");
		$ff = $this->input->post("ff");
		$t  = $this->input->post("t");
		
		if($fi != '' && $ff != '') $wfecha = " AND p.fecha BETWEEN '".$fi."' AND '".$ff."'";
		if($q != '') $wcl = " AND c.id_cliente = '".$q."'";
		 
		$query = $this->db->query("SELECT p.id_proforma id, p.numero, c.nombre_comercial, p.monto, 
												DATE_FORMAT(p.fecha , '%d/%m/%Y') fecha
												FROM proformas p, clientes c 
												WHERE p.id_cliente = c.id_cliente 
													".$wfecha."
													".$wcl."
													AND p.estado = '$t'
												ORDER BY p.id_proforma DESC");	
																								
		return $query->result_array();
	}

	
	public function get_detail($id = 0)
	{
		$query = $this->db->query("SELECT * FROM proformas_detalles 
										WHERE  id_proforma = '".$id."'  ORDER BY id_proforma_detalle ASC");
		
		return $query->result_array();								
	}
	
	public function add()
	{	
		
		$array_datos = array(
			"id_proforma" 	    => '',
			"id_cliente" 	   	    => $_POST['id_cliente'],
			"numero"				=> $_POST['numero'],
			"monto"					=> $_POST['input_total_civa'],
			"fecha"  		    	=> $_POST['fecha'],
			"estado"  		    	=> 0
		);
		
		$this->db->insert("proformas",$array_datos);
		$id = $this->db->insert_id();
		
		for($i = 0; $i < sizeof($_POST['quantity']);$i++){
			$array_datos = array(
				"id_proforma_detalle" 	=> '',
				"id_proforma" 	   	    => $id,
				"descripcion"			=> $_POST['descripcion'][$i],
				"precio"				=> $_POST['psi'][$i],
				"cantidad"				=> $_POST['quantity'][$i]
			);
			$this->db->insert("proformas_detalles",$array_datos);
		}
		
	}
	
	public function update()
	{	
		$array_datos = array(
			"estado"	=> $_POST['estado'],
		);
				
		$this->db->where('id_proforma', $_POST['id']);
		$this->db->update("proformas",$array_datos);
	}
	
	public function delete($id)
	{	
		$this->db->where('id_proforma', $id);
		$this->db->delete("proformas");	
		
		$this->db->where('id_proforma', $id);
		$this->db->delete("proformas_detalles");	
	}
}
?>
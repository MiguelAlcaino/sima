<?php
// Proyecto: Sistema Facturacion
// Version: 1.0
// Programador: Jorge Linares
// Framework: Codeigniter
// Clase: Modulo


class MS_model extends CI_Model
{
	
	// Constructor
	public function __construct()
	{
		parent::__construct();
			
	}
	
	public function get_modulos_secciones()
	{
		$query = $this->db->query("SELECT * FROM  modulos ORDER BY id_modulo ASC");
		
		$datos = array();
		foreach($query->result_array() as $row)
		{
			
			$querys = $this->db->query("SELECT * FROM  secciones s
											WHERE s.id_modulo = '".$row['id_modulo']."' 
												ORDER BY s.id_seccion ASC");
			
			
			$secciones = array();
			
			foreach($querys->result_array() as $rows){
				$secciones[] = array(
					'nombre'	=> $rows['nombre_seccion'],
					'url'		=> $rows['url_seccion']
				);
			}
			$datos[$row['id_modulo']] = array(
				'modulo'	=> $row['nombre_modulo'],
				'secciones'	=> $secciones
			);
		}	
		return $datos;							
	}
	
	public function get_secciones()
	{
		$query = $this->db->query("SELECT * FROM  modulos");
		
		$datos = array();
		foreach($query->result_array() as $row){
			$querys = $this->db->query("SELECT * FROM  secciones 
											WHERE id_modulo = '".$row['id_modulo']."'");
			
			foreach($querys->result_array() as $rows){
				$datos[] = array(
					'modulo'	=> $row['nombre_modulo'],
					'id'		=> $rows['id_seccion'],
					'nombre'	=> $rows['nombre_seccion'],
					'url'		=> $rows['url_seccion']
				);
			}
		}	
		return $datos;							
	}
	
	public function add_usuarios_dominios()
	{
		$array_datos = array(
			"id_usuario" 	   => $_POST['id'],
			"id_dominio"	   => $_POST['do']
		);
		
		$this->db->insert("usuarios_dominios",$array_datos);
	}
	
	public function add_usuarios_secciones()
	{
		$array_datos = array(
			"id_usuario" 	   => $_POST['id'],
			"id_seccion"	   => $_POST['id_seccion']
		);
		
		$this->db->insert("usuarios_secciones",$array_datos);
	}
	
	public function delete_usuarios_secciones()
	{
		$this->db->where("id_usuario",$_POST['id']);
		$this->db->where("id_seccion",$_POST['id_seccion']);
		$this->db->delete("usuarios_secciones",$array_datos);
	}
	
	public function delete_usuarios_dominios()
	{
		$this->db->where("id_usuario",$_POST['id']);
		$this->db->where("id_dominio",$_POST['do']);
		$this->db->delete("usuarios_dominios",$array_datos);
	}
}
?>
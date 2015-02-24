<?php
class Proformas extends CI_Controller 
{
  function __construct()
  {
    parent::__construct();
		
		$this->load->model("proformas_model",'proformas');
		$this->load->model("clientes_model",'clientes');
	}
	
	function index()
	{	
		
		$data['data']  = $this->proformas->get_all();
		$data['clientes']  = $this->clientes->get_all_order_name();
		$this->template->display('admin/proformas/list',$data);
		
	}
	
	function pagadas()
	{	
		
		$data['data']  	   = $this->proformas->get_all();
		$data['clientes']  = $this->clientes->get_all_order_name();
		$this->template->display('admin/proformas/list_pagadas',$data);
		
	}
	
	function nuevo()
	{	
		$codigo        = $this->proformas->get_max_cod();
		
		$data['tab']   = 'nuevo';
		$data['cod']   = $this->codigo($codigo->cod);
		$data['data']  = $this->proformas->get_all();
		$this->template->display('admin/proformas/nuevo',$data);
	}
	
	function editar($id){
		
		$data['data']    = $this->proformas->get_by_id($id);
		$data['detail']  = $this->proformas->get_detail($id);
		
		$this->template->display('admin/proformas/editar',$data);
		
	}
	
	function agregar()
	{	
			$this->proformas->add();	
			$this->session->set_flashdata('message', '<div class="message success">Se ha guardado correctamente</div>');
			redirect("proformas");
	}
	
	function actualizar()
	{	
			
		$this->proformas->update();	
		$this->session->set_flashdata('message', '<div class="message success">Se ha actualizado correctamente</div>');
		redirect("proformas");
	}
	
	function eliminar($id)
	{	
		$this->proformas->delete($id);
		$this->session->set_flashdata('message', '<div class="message success">Se ha eliminado correctamente</div>');
		redirect("proformas");
	}
	
	function imprimir($id=0)
	{
		
		$data    = $this->proformas->get_by_id($id);
		$detail  = $this->proformas->get_detail($id);
		
			$html = '
			<style type="text/css">
				table.content{ border-bottom:1px solid #909090; border-left:1px solid #909090}
				table.content td{ border-top:1px solid #909090; border-right:1px solid #909090; padding:10px}
				.hdetail td{ color:#000000; padding:8px 4px 8px 4px }
				.data{ padding-top:10px;}
				.data td{ font-size:13px; padding:2px 0}
				h1{ font-size:38px; color:#DB9600}
				.foot1 { text-align:center;color:#FFFFFF; background:#22ACC8; font-size:13px; padding:5px;width:840px;left:-19px;bottom:-10px;position:absolute}
				.foot2 { text-align:center;color:#FFFFFF; background:#22ACC8; font-size:13px; padding:5px;width:840px;left:-19px;bottom:-30px;position:absolute}
			</style>
			<table width="900" align="center" cellpadding="0" cellspacing="0">
				<tr>
					
					<th width="200" align="left">
						<img src="public/admin/images/logo_pdf.png">
					</th>
					<th width="160"></th>
					<th width="284" valign="top" class="data">
						<table  cellspacing="1">
							<tr><td width="100">Número :</td>   <td>'.$data[0]['numero'].'</td></tr>
							<tr><td>Fecha :</td>   <td>'.date("d/m/Y",strtotime($data[0]['fecha'])).'</td></tr>
							<tr><td>Cliente :</td>   <td>'.$data[0]['nombre_comercial'].'</td></tr>
							<tr><td>NIF/CIF :</td>   <td>'.$data[0]['nif_cif'].'</td></tr>
							<tr><td>Dirección :</td>   <td>'.$data[0]['direccion'].'</td></tr>
							<tr><td>C.P :</td>   <td>'.$data[0]['cp'].'</td></tr>
							<tr><td>Población :</td>   <td>'.$data[0]['poblacion'].'</td></tr>
							<tr><td>Provincia :</td>   <td>'.$data[0]['nombre_provincia'].'</td></tr>
						</table>
					</th>
				</tr>
			</table>
			<h1 align="center">Proforma</h1>
			';
			$html .='<table align="center" cellspacing="0" class="content" width="700" style="margin-top:40px">
							<tr class="hdetail"> 
								<td width="100">Cantidad</td> 
								<td width="300">Descripción</td>
								<td width="150">Precio</td>
								<td width="100">Precio Total</td>
							</tr>';
            
			foreach($detail as $k){
				$precio_t = ($k['precio'] * $k['cantidad']);
				$total    = $total + $precio_t;
				$iva      = ($total * 0.18);
							
				$html .='<tr>
            	<td>'.$k['cantidad'].'</td> 	<td><div style="width:300px">'.$k['descripcion'].'</div></td> 	<td>'.number_format($k['precio'],2).'</td> 	<td align="right">'.number_format($precio_t,2).'</td>
            </tr>';
			}
			$height = 560 - (count($detail) * 35);
			
			$html .='<tr>
						<td colspan="4" height="'.$height.'"></td>
					</tr>';


			$html .='<tr>
            	<td colspan="2"></td><td><b>Total</b></td><td align="right">'.number_format($total,2).'</td>
            </tr>';
		$html .='
        </table>
		<div class="foot1">
			Sima climatización calefacción S.L. | C.I.F.: B-72171622 | Teniente Miranda 101 A, Algeciras (Cádiz)

		</div>
		<div class="foot2">
			Tel: 697 267 077 | Email: info@simaclimatización.com
		</div>
		';


    require_once('public/admin/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->WriteHTML($html);
    $html2pdf->Output('Proformas '.$data[0]['numero'].'.pdf', 'D');
}
	
	function codigo($cod=''){
		if($cod == '')
		{
			return 'R000001';
		}else
		{
			$dig     = ((int)$cod + 1);
			$ceros   = (6 - strlen($dig));
			$new_cod = str_repeat("0",$ceros).$dig;
			
			return 'R'.$new_cod;
		}
	}	
}
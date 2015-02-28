<?php
class Facturas extends CI_Controller 
{
  function __construct()
  {
    parent::__construct();
		
		$this->load->model("facturas_model",'facturas');
		$this->load->model("clientes_model",'clientes');
	}
	
	function index()
	{	
		
		$codigo            = $this->facturas->get_max_cod();
		$data['data_p']    = $this->facturas->get_all_pendientes();
		$data['clientes']  = $this->clientes->get_all();
		
		$data['cod']     = $this->codigo($codigo->cod);
		$this->template->display('admin/facturas/list',$data);
		
	}
	
	function nueva()
	{	
		$codigo        = $this->facturas->get_max_cod();
		$data['cod']     = $this->codigo($codigo->cod);
		$this->template->display('admin/facturas/nuevo',$data);
	}
	
	function pagadas()
	{	
		$data['data']    = $this->facturas->get_all_pagadas();		
		$data['clientes']  = $this->clientes->get_all();
		
		$this->template->display('admin/facturas/list_pagadas',$data);
	}
	
	function editar($id){
		
		$data['data']    = $this->facturas->get_by_id($id);
		$data['detail']  = $this->facturas->get_detail($id);
		
		$this->template->display('admin/facturas/editar',$data);
		
	}
	
	function agregar()
	{	
			$this->facturas->add();	
			$this->session->set_flashdata('message', '<div class="message success">Se ha guardado correctamente</div>');
			redirect("facturas");
	}
	
	function actualizar()
	{	
			
		$this->facturas->update();	
		$this->session->set_flashdata('message', '<div class="message success">Se ha actualizado correctamente</div>');
		redirect("facturas");
	}
	
	function eliminar($id)
	{	
		$this->facturas->delete($id);
		$this->session->set_flashdata('message', '<div class="message success">Se ha eliminado correctamente</div>');
		redirect("facturas");
	}
  
  private function mesEspanol($numero_mes){
    $meses = array(
    1 => "Enero",
    2 => "Febrero",
    3 => "Marzo",
    4 => "Abril",
    5 => "Mayo",
    6 => "Junio",
    7 => "Julio",
    8 => "Agosto",
    9 => "Septiembre",
    10 => "Octubre",
    11 => "Noviembre",
    12 => "Diciembre"
    );
    
    return $meses[$numero_mes];
  }
  
  function imprimir_factura($id = 0){
    
    $data    = $this->facturas->get_by_id($id);
    $detail  = $this->facturas->get_detail($id);
    $this->load->library('enLetras');
    
    
    $this->load->library('FacturaImagenTCPDF');
    
    $pdf = new FacturaImagenTCPDF("P", "mm", array(216,268), true, 'UTF-8', false);
    
    $pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Contact.cl');
$pdf->SetTitle('TCPDF Example 051');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(0,0,0,0);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

// remove default footer
//$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// set font
$pdf->SetFont('courier', '', 11);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// add a page
$pdf->AddPage();

$color_texto = "black";
$borde = 0;
$x_top_primera_tabla = -15;
$x_top_segunda_tabla = -14;


// Print a text

$dia = date("d",strtotime($data[0]['fecha']));
$html = '<style>
p{
  color: '.$color_texto.';
}
</style>
<p>'.$dia.'</p>';
//$pdf->writeHTMLCell(100,100,25,50,$html);
$pdf->writeHTMLCell(0,5,118,61+$x_top_primera_tabla,$html,$borde);

$mes = date("n",strtotime($data[0]['fecha']));

$html = '<style>
p{
  color: '.$color_texto.';
}
</style>
<p>'.$this->mesEspanol($mes).'</p>';
$pdf->writeHTMLCell(0,5,133,61+$x_top_primera_tabla,$html,$borde);

$anio = date("y",strtotime($data[0]['fecha']));

$html = '<style>
p{
  color: '.$color_texto.';
}
</style>
<p>'.$anio.'</p>';
$pdf->writeHTMLCell(0,5,185,61+$x_top_primera_tabla,$html,$borde);

$html = '<style>
p{
  color: '.$color_texto.';
}
</style>
<p>'.$data[0]['razon_social'].'</p>';
$pdf->writeHTMLCell(0,5,34,69+$x_top_primera_tabla,$html,$borde);

$html = '<style>
p{
  color: '.$color_texto.';
}
</style>
<p>'.$data[0]['direccion'].'</p>';
$pdf->writeHTMLCell(0,5,34,77+$x_top_primera_tabla,$html,$borde);

$html = '<style>
p{
  color: '.$color_texto.';
}
</style>
<p>'.$data[0]['comuna_nombre'].'</p>';
$pdf->writeHTMLCell(0,5,156,77+$x_top_primera_tabla,$html,$borde);

$html = '<style>
p{
  color: '.$color_texto.';
}
</style>
<p>'.$data[0]['nombre_provincia'].'</p>';
$pdf->writeHTMLCell(0,5,31,85+$x_top_primera_tabla,$html,$borde);

$html = '<style>
p{
  color: '.$color_texto.';
}
</style>
<p>'.$data[0]['telefono'].'</p>';
$pdf->writeHTMLCell(0,5,95,85+$x_top_primera_tabla,$html,$borde);

$html = '<style>
p{
  color: '.$color_texto.';
}
</style>
<p>'.$data[0]['nif_cif'].'</p>';
$pdf->writeHTMLCell(0,5,155,85+$x_top_primera_tabla,$html,$borde);

$html = '<style>
p{
  color: '.$color_texto.';
}
</style>
<p>'.$data[0]['tipo_empresa'].'</p>';
$pdf->writeHTMLCell(0,5,29,92+$x_top_primera_tabla,$html,$borde);

$html = '<style>
p{
  color: '.$color_texto.';
}
</style>
<p>'.$data[0]['condiciones_venta'].'</p>';
$pdf->writeHTMLCell(0,5,157,92+$x_top_primera_tabla,$html,$borde);



//Cantidad, detalle, precio unitario
/*
$data= array(
  array("cantidad"=>10,"detalle" => "Chubys", "precio_unitario"=>50),
  array("cantidad"=>23,"detalle" => "Ramitas", "precio_unitario"=>120),
  array("cantidad"=>48,"detalle" => "Bedidas enérgeticas", "precio_unitario"=>1200),
  array("cantidad"=>48,"detalle" => "Bedidas enérgeticas", "precio_unitario"=>1200),
  array("cantidad"=>48,"detalle" => "Bedidas enérgeticas", "precio_unitario"=>1200),
  array("cantidad"=>48,"detalle" => "Bedidas enérgeticas", "precio_unitario"=>1200),
  array("cantidad"=>48,"detalle" => "Bedidas enérgeticas", "precio_unitario"=>1200),
  array("cantidad"=>48,"detalle" => "Bedidas enérgeticas", "precio_unitario"=>1200),
  array("cantidad"=>48,"detalle" => "Bedidas enérgeticas", "precio_unitario"=>1200),
  array("cantidad"=>48,"detalle" => "Bedidas enérgeticas", "precio_unitario"=>1200),
);
*/
$tamano_fuente_detalle = "9px";
$alto_celda_detalle = 7;
$i=0;
$subtotal = 0;

foreach($detail as $key => $value){
  $html = '<style>
  p{
    color: '.$color_texto.';
    
  }
  </style>
  <p>'.$value['cantidad'].'</p>';
  $pdf->writeHTMLCell(0,5,26,113+($alto_celda_detalle*$i)+$x_top_segunda_tabla,$html,$borde);
  
  $html = '<style>
  p{
    color: '.$color_texto.';

  }
  </style>
  <p>'.$value['descripcion'].'</p>';
  $pdf->writeHTMLCell(95,5,43,113+($alto_celda_detalle*$i)+$x_top_segunda_tabla,$html,$borde);
  
  $html = '<style>
  p{
    color: '.$color_texto.';
    
  }
  </style>
  <p>$'.number_format($value['precio'], 0, '', '.').'</p>';
  //number_format($value['precio_unitario'], 0, '', '.');
  $pdf->writeHTMLCell(0,5,140,113+($alto_celda_detalle*$i)+$x_top_segunda_tabla,$html,$borde);
  
  $html = '<style>
  p{
    color: '.$color_texto.';
    
  }
  </style>
  <p>$'.number_format(($value['precio']*$value['cantidad']), 0, '', '.').'</p>';

  $pdf->writeHTMLCell(0,5,170,113+($alto_celda_detalle*$i)+$x_top_segunda_tabla,$html,$borde);
  
  $subtotal = $subtotal + ($value['precio']*$value['cantidad']);
  
  $i++;
}

$iva = $subtotal*0.19;

$html = '<style>
p{
  color: '.$color_texto.';
}
</style>
<p>$'.number_format($subtotal, 0, '', '.').'</p>';
$pdf->writeHTMLCell(0,5,170,203,$html,$borde);

$html = '<style>
p{
  color: '.$color_texto.';
}
</style>
<p>$'.number_format($iva, 0, '', '.').'</p>';
$pdf->writeHTMLCell(0,5,170,213,$html,$borde);

$html = '<style>
p{
  color: '.$color_texto.';
}
</style>
<p>$'.number_format($iva+$subtotal, 0, '', '.').'</p>';
$pdf->writeHTMLCell(0,5,170,223,$html,$borde);

$html = '<style>
p{
  color: '.$color_texto.';
}
</style>
<p>'.$this->enletras->ValorEnLetras(number_format($iva+$subtotal, 0, '', ''),'pesos').'</p>';
$pdf->writeHTMLCell(108,5,28,203,$html,$borde);

if($data[0]['fecha_pago'] != null){

$dia_pago = date("d",strtotime($data[0]['fecha_pago']));

$html = '<style>
p{
  color: '.$color_texto.';
}
</style>
<p>'.$dia_pago.'</p>';
$pdf->writeHTMLCell(0,5,33,211,$html,$borde);

$mes_pago = date("n",strtotime($data[0]['fecha_pago']));

$html = '<style>
p{
  color: '.$color_texto.';
  
}
</style>
<p>'.$this->mesEspanol($mes_pago).'</p>';
$pdf->writeHTMLCell(0,5,52,211,$html,$borde);

$anio_pago = date("y",strtotime($data[0]['fecha_pago']));

$html = '<style>
p{
  color: '.$color_texto.';
}
</style>
<p>'.$anio_pago.'</p>';
$pdf->writeHTMLCell(0,5,113,211,$html,$borde);
}

//$pdf->writeHTMLCell(50,10,0,0,$html,1);
//$pdf->writeHTML($html, true, false, true, false, '');


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output($data[0]['numero'].'.pdf', 'D');

  }
	
	function imprimir($id=0)
	{
		
		$data    = $this->facturas->get_by_id($id);
		$detail  = $this->facturas->get_detail($id);
			/*
			$html = '
			<style type="text/css">
				table.content{ border-bottom:1px solid #909090; border-left:1px solid #909090}
				table.content td{ border-top:1px solid #909090; border-right:1px solid #909090; padding:10px}
				.hdetail td{ color:#000000; padding:8px 4px 8px 4px }
				.data{ padding-top:0px;}
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
						<table  cellspacing="1" align="center">
							<tr><td width="100">Número :</td>   <td>'.$data[0]['numero'].'</td></tr>
							<tr><td>Fecha :</td>   <td>'.date("d/m/Y",strtotime($data[0]['fecha'])).'</td></tr>
							<tr><td>Cliente :</td>   <td>'.$data[0]['nombre_comercial'].'</td></tr>
							<tr><td>RUT :</td>   <td>'.$data[0]['nif_cif'].'</td></tr>
							<tr><td>Dirección :</td>   <td>'.$data[0]['direccion'].'</td></tr>
							<tr><td>C.P :</td>   <td>'.$data[0]['cp'].'</td></tr>
							<tr><td>Provincia :</td>   <td>'.$data[0]['nombre_provincia'].'</td></tr>
						</table>
					</th>
				</tr>
			</table>
			<h1 align="center">Factura</h1>
			';
			
			$html .='<table align="center" cellspacing="0" class="content" width="700" style="margin-top:40px">
						<tr class="hdetail">
							<td width="100">Cantidad</td> 
							<td width="300">Descripción</td>
							<td width="150">Precio</td>
							<td width="100">Precio con IVA</td>
						</tr>';
			foreach($detail as $k){
				$precio_t = ($k['precio'] * $k['cantidad']);
				$total    = $total + $precio_t;
				$iva      = ($total * 0.18);
							
				$html .='<tr>
				<td>'.$k['cantidad'].'</td> 	<td>'.$k['descripcion'].'</td> 	<td>'.number_format($k['precio'],2).'</td> 	<td align="right">'.number_format($precio_t,2).'</td>
			</tr>';
				
			}
			
			$height = 560 - (count($detail) * 35);
			
			$html .='<tr>
						<td colspan="4" height="'.$height.'"></td>
					</tr>';
						
			$html .='<tr>
            	<td colspan="2"></td><td><b>Total</b></td><td align="right">'.number_format($total,2).'</td>
            </tr>';
			$html .='<tr>
            	<td colspan="2"></td><td><b>Total con IVA</b></td><td align="right">'.number_format(($total+$iva),2).'</td>
            </tr>';
		$html .='
        </table>
		<table width="700">
			<tr>
				<td width="20"></td>
				<td style="padding-top:5px">
					Entidad: La Caixa<br>
					N° de Cuenta para abonos: 2100-1993-15-0200133546
				</td>
			</tr>
		</table>
		<div class="foot1">
			Sima climatización calefacción S.L. | C.I.F.: B-72171622 | Teniente Miranda 101 A, Algeciras (Cádiz)

		</div>
		<div class="foot2">
			Tel: 697 267 077 | Email: info@simaclimatización.com
		</div>
		';

    */
    $html = '
    <style>
    #container
    {
        
    }
    
    #image
    {    
        position:absolute;
        left:0;
        top:0;
    }
    #text
    {
        z-index:100;
        position:absolute;    
        color:white;
    }
    </style>
    <div id="container">
    <img id="image" src="http://gps.contact.cl/sima/public/admin/factura.jpg"/>
    <p id="text">
        Hello World!
    </p>
</div>';
    require_once('public/admin/html2pdf/html2pdf.class.php');
    //$html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf = new HTML2PDF('P',array(216,268),'es', true, 'UTF-8', array(0,0,0,0));
    $html2pdf->WriteHTML($html);
    $html2pdf->Output('Facturas '.$data[0]['numero'].'.pdf', 'D');
}
	
	function codigo($cod=''){
		if($cod == '')
		{
			return 'F000001';
		}else
		{
			$dig     = ((int)$cod + 1);
			$ceros   = (6 - strlen($dig));
			$new_cod = str_repeat("0",$ceros).$dig;
			
			return 'F'.$new_cod;
		}
	}	
}
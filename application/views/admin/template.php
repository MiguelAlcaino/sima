<!DOCTYPE html>
<html>
<?php
$centinela = new Centinela();
if(!$centinela->check(0, FALSE)){ redirect(''); }
// send raw HTTP headers to set the content type for MS IE
$this->output->set_header("Content-Type: text/html; charset=UTF-8");
//$this->output->set_title();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<head>
<base href="<?php echo base_url('')?>" />
<title>Administrador : <?php echo NOMBRE_SITIO?></title>
    <link rel="stylesheet" href="<?php echo base_url("public/admin/css/style.css")?>">
    <link rel="stylesheet" href="<?php echo base_url("public/admin/css/jquery.wysiwyg.css")?>">
    <link rel="stylesheet" href="<?php echo base_url("public/admin/css/facebox.css")?>">
    <link rel="stylesheet" href="<?php echo base_url("public/admin/css/visualize.css")?>">
    <link rel="stylesheet" href="<?php echo base_url("public/admin/css/date_input.css")?>">
    <link rel="stylesheet" href="<?php echo base_url('public/admin/jquery-ui-1.11.2.custom/jquery-ui.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('public/bower_components/datatables/media/css/jquery.dataTables.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('public/admin/datetimepicker/jquery.datetimepicker.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('public/admin/font-awesome/css/font-awesome.min.css')?>">
<!--[if lt IE 8]>
    <style type="text/css" media="all">@import url("public/admin/css/ie.css");</style>
<![endif]-->
<!--[if IE]><script type="text/javascript" src="public/admin/js/excanvas.js"></script><![endif]-->
    <script type="text/javascript" src="<?php echo base_url('public/admin/js/jquery-1.11.1.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/admin/jquery-ui-1.11.2.custom/jquery-ui.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/admin/datetimepicker/jquery.datetimepicker.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/admin/autoNumeric/autoNumeric.js')?>"></script>
    <script type="text/javascript" src="public/admin/js/jquery.img.preload.js"></script>
    <script type="text/javascript" src="public/admin/js/jquery.filestyle.mini.js"></script>
    <script type="text/javascript" src="public/admin/js/jquery.wysiwyg.js"></script>
    <script type="text/javascript" src="public/admin/js/jquery.date_input.pack.js"></script>
    <script type="text/javascript" src="public/admin/js/facebox.js"></script>
    <script type="text/javascript" src="public/admin/js/jquery.select_skin.js"></script>
    <script type="text/javascript" src="public/admin/js/ajaxupload.js"></script>
    <script type="text/javascript" src="public/admin/js/jquery.pngfix.js"></script>
    <script type="text/javascript" src="public/admin/js/jquery.tipsy.js"></script>
    <script type="text/javascript" src="public/admin/js/jquery.validate.js"></script>
    <script type="text/javascript" src="public/admin/js/custom.js"></script>
    <script type="text/javascript" src="public/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
</head>
<body>
	<div id="hld">
		<div class="wrapper">
			<div id="header">
				<div class="hdrl"></div>
				<div class="hdrr"></div>
				<h1><a href="#"><?php echo NOMBRE_SITIO ?></a></h1>
				<ul id="nav">
					<?php echo $this->load->view($menu_nav)?>
				</ul>
				<p class="user">Hola, <a href="cuentas"><?php echo $this->session->userdata("nombre");?></a> | <a href="usuarios/logout">Salir</a></p>
			</div>
			<?php $this->load->view($content_template)?>
			<div id="footer">
			</div>
		</div>
	</div>
</body>
</html>
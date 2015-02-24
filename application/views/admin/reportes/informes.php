<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        
        <h2>Informes Graficos</h2>
        
        <ul>
        	<li><a>Dominios</a> <select id="sdominios" style="width:300px"><option value="0">Todos los dominios</option><?php
							foreach($dominios as $key){
								?><option value="<?php echo $key['id_dominio'] ?>" <?php if($dominio == $key['id_dominio']) echo 'selected="selected"' ?>><?php echo $key['nombre_dominio'] ?></option><?php
							}
						 ?></select>
            </li>
            <li><a>Palabra</a> <select id="spalabras" style="width:200px"><option value="0">Seleccionar</option></select></li>
            <li><a href="reportes/informes">Actualizar</a></li>
        </ul>
    </div>		
    
    <div class="block_content" id="list">
    <form action="" method="post">
    	
    	<div  class="filter_fecha"><label>Fecha Inicio</label> <input type="text" class="date_picker text" id="fecha_ini" value="<?php if($fecha_inicio != '') echo $fecha_inicio?>" />&nbsp; <label>Fecha Fin</label> <input type="text" class="date_picker text" value="<?php if($fecha_fin != '') echo $fecha_fin?>" id="fecha_f" />&nbsp; <input type="button" class="submit mid" value="Ver Grafico" id="genera_grafico" />
        </div>
        
            
            
        </form>
        <div id="grafico">
        	
        </div>
        <script type="text/javascript" src="public/admin/highcharts/js/highcharts.js"></script>
		<script type="text/javascript" src="public/admin/highcharts/js/modules/exporting.js"></script>
		<script type="text/javascript">

		var chart;
		$(document).ready(function() {
			
			
			
			$("#sdominios").change(function(){
				$.ajax({
				data: "",
				type: "GET",
				dataType: "json",
				url: "ajax/palabras_combo/"+$(this).val(),
					success: function(data){
						var html = '<option value="0">Seleccionar</option>';
						$.each(data, function(i,item){
							html +='<option value="'+item.id_palabra+'">'+item.palabra+'</option>';
						});	
						$("#spalabras").html(html);
					}
				
				});
			});
			
			$("#genera_grafico").click(function(){
				
				$.ajax({
				data: "fi="+$("#fecha_ini").val()+"&ff="+$("#fecha_f").val(),
				type: "POST",
				dataType: "json",
				url: "ajax/grafico_palabra/"+$("#spalabras").val(),
					success: function(data){ 
						
						pos    = [];
						fechas = [];
						Allpos = [];
						
						
						var w = 0, palabra = '', dominio = '';
						
						$.each(data, function(i,item){
							pos[w]     = item.posicion;
							fechas[w]  = item.fecha;
							w++;
						});
						
						palabra = $("#spalabras").find("option[value="+$("#spalabras").val()+"]").text();
						dominio = $("#sdominios").find("option[value="+$("#sdominios").val()+"]").text();
						
						for(var i=0; i< pos.length; i++){
							
							date = Date.parse(fechas[i] +' UTC');
		
							Allpos.push([
							   date, 
							   parseInt(pos[i])
							]);
						}
						
						var options = {
			
							chart: {
								renderTo: 'container'
							},
							
							title: {
								text: 'Evolución de: '+palabra
							},
							
							subtitle: {
								text: dominio
							},
							
							xAxis: {
								type: 'datetime',
								tickInterval: 7 * 24 * 3600 * 1000, // one week
								tickWidth: 0,
								gridLineWidth: 1,
								labels: {
									align: 'left',
									x: 3,
									y: -3 
								}
							},
							
							yAxis: [{ // left y axis
								title: {
									text: null
								},
								labels: {
									align: 'left',
									x: 3,
									y: 16,
									formatter: function() {
										return Highcharts.numberFormat(this.value, 0);
									}
								},
								labels: {
									align: 'right',
									x: -3,
									y: 16,
									formatter: function() {
									   return Highcharts.numberFormat(this.value, 0);
									}
								 },
								showFirstLabel: false
							}],
							
							legend: {
								align: 'left',
								verticalAlign: 'top',
								y: 20,
								floating: true,
								borderWidth: 0
							},
							
							tooltip: {
								shared: true,
								crosshairs: true
							},
							
							
							series: [{
								name: 'Posicion',
								lineWidth: 4,
								marker: {
									radius: 4
								}
							}]
						};
						
						
						options.series[0].data = Allpos;
						chart = new Highcharts.Chart(options);
					}
				});
			});
			<?php
			if($dominio != ''){
			 ?>
			$.ajax({
				data: "",
				type: "GET",
				dataType: "json",
				url: "ajax/palabras_combo/<?php echo $dominio?>",
					success: function(data){
						var html = '<option value="0">Seleccionar</option>';
						$.each(data, function(i,item){
							html +='<option value="'+item.id_palabra+'">'+item.palabra+'</option>';
						});	
						$("#spalabras").html(html);
						$("#spalabras").find("option[value=<?php echo $palabra?>]").attr("selected","selected");
						$("#genera_grafico").trigger("click");
					}
				
				});
			<?php
			}?>
			
		});
	</script>
        <div id="container" class="highcharts-container" style="margin: 0 2em; clear:both; min-width: 600px; height:400px">
		</div>

    </div>
    
    
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>
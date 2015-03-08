<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        
        <h2>Listado Palabras</h2>
        
        <ul>
        	<li><a>Escribir algo</a> <input type="text" size="20" id="filter" /></li>
        	<li><a>Dominios</a> <select class="styled_domain"><option value="0">Todos los dominios</option><?php
							foreach($dominios as $key){
								?><option value="<?php echo $key['id_dominio'] ?>" <?php if($dominio == $key['id_dominio']) echo 'selected="selected"' ?>><?php echo $key['nombre_dominio'] ?></option><?php
							}
						 ?></select></li>
            <li><a href="reportes/palabras">Sin filtros</a></li>
        </ul>
    </div>		
    
    <div class="block_content" id="list">
    <form action="" method="post">
    	
    	<div  class="filter_fecha"><label>Fecha Alta</label> <input type="text" class="date_picker text" id="fecha_ini" value="<?php if($fecha_inicio != '') echo $fecha_inicio?>" />&nbsp; <label>Fecha Fin</label> <input type="text" class="date_picker text" value="<?php if($fecha_fin != '') echo $fecha_fin?>" id="fecha_f" />&nbsp; <input type="button" onclick="search_by_date()" class="submit mid" value="Filtrar" />
        </div>
		<?php 
				if($this->session->flashdata('message'))
				{ ?>
					<?php echo $this->session->flashdata('message'); ?>
				<?php 
				} ?>
        
        
            <table cellpadding="0" cellspacing="0" width="100%" class="sortable_words">
            
                <thead>
                    <tr>
                    	<th width="10"></th>
                        <th width="15%">Palabra</th>
                        <th width="25%">Dominio</th>
                        <th>Empresa</th>
                        <th>Fecha Alta</th>
                        <th>Fecha Fin</th>
                        <th>Posicion</th>
                        <th class="option">Opcion</th>
                    </tr>
                </thead>

                
                <tbody>
                   <?php
					if(is_array($data))
					{
					foreach($data as $key){
					 ?>
                        <tr class="rows">
                        	<td></td>
                            <td><?php echo $key['palabra'] ?></td>
                            <td><a href="<?php echo $key['nombre_dominio'] ?>" target="_blank"><?php echo $key['nombre_dominio'] ?></a></td>						<td><?php echo $key['empresa_dominio'] ?></td>
                            <td><?php echo date("d/m/Y",$key['fecha_inicio'])  ?></td>
                            <td><?php echo date("d/m/Y",$key['fecha_fin'])  ?></td>
                            <td><?php echo  $key['posicion']?></td>
                            <td class="options">
                                <a href="reportes/informes/<?php echo  $key['id_dominio']?>/<?php echo  $key['id_palabra']?>" class="tip" title="Ver Estadistica"><img src="public/admin/images/chart.png" /></a>
                                
                            </td>
                        </tr>
                   <?php 
					}
				   } ?>
                  
                    
                </tbody>
                
            </table>
            
        </form>
        <?php 
		if(count($data) > 1){
		?>
        
		<div class="pagination right" id="pager">
            <a href="#" class="prev">«</a> <span id="pnumbers"></span> <a href="#" class="next">»</a>
            <select class="pagesize">
                    <option selected="selected"  value="10">10</option>
        
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option  value="40">40</option>
                </select>
        </div>
		<script type="text/javascript">
        	$(function () {
				$("table.sortable_words").tablesorter({
					headers: { 0: { sorter: false}, 7: {sorter: false} },		// Disabled on the 1st and 6th columns
					widgets: ['zebra']
				}).tablesorterPager({container: $("#pager"),positionFixed: false}
				).tablesorterFilter({ filterContainer: $("#filter"),
                    filterClearContainer: $("#filterClearTwo"),
                    filterColumns: [0, 1, 2, 3, 4, 5, 6],
                    filterCaseSensitive: false
                });
				
			});
        </script>
        <?php 
		}
		?>
    </div>
    
    
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>
<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        
        <h2> Clientes</h2>
        
        <ul id="tabs" class="tabs">
            <li <?php if($tab == '') echo 'class="active"'?>><?php echo anchor("clientes/index","Listar")?></li>
            <li <?php if($tab == 'nuevo') echo 'class="active"'?>><?php echo anchor("clientes/nuevo","Nuevo cliente")?></li>
        </ul>
    </div>		
    
    <div class="block_content tab_content <?php if($tab != '') echo 'hide'?>" id="list">
    	<?php 
				if($this->session->flashdata('message'))
				{ ?>
					<?php echo $this->session->flashdata('message'); ?>
				<?php 
				} ?>
        <form action="" method="post">
        
            <table id="lista_clientes" cellpadding="0" cellspacing="0" width="100%" class="sortable_list_pen">
            
                <thead>
                    <tr>
                        <th>Nombre Comercial</th>
                        <th>Razón Social</th>
                        <th>RUT</th>
                        <th>Contacto</th>
                        <th>Email</th>
                        <th>Provincia</th>
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
                            <td><?php echo $key['nombre_comercial'] ?></td>
                            <td><?php echo $key['razon_social']  ?></td>
                            <td><?php echo $key['nif_cif']  ?></td>
                            <td><?php echo $key['contacto']  ?></td>
                            <td><?php echo $key['email']  ?></td>
                            <td><?php echo $key['nombre_provincia']  ?></td>
                            <td class="options">
                                <a href="<?php echo site_url('clientes/editar/'.$key['id_cliente']) ?>" class="tip" title="Editar"><img src="<?php echo base_url('public/admin/images/bedit.png')?>" /></a>
                                <a href="<?php echo site_url('clientes/eliminar/'.$key['id_cliente'])?>" class="tip"  title="Eliminar" onclick="return delete_row()"><img src="<?php echo base_url('public/admin/images/bdelete.png')?>" /></a>
                                
                            </td>
                        </tr>
                   <?php 
					}
				   } ?>
                    
                </tbody>
                
            </table>
            
        </form>

		<script type="text/javascript">
            //$('.sortable_list').tablesorter();
            /*
        	$(function () {
				$("table.sortable_list").tablesorter({
					headers: { 0: { sorter: false}, 7: {sorter: false} },		// Disabled on the 1st and 6th columns
					widgets: ['zebra']
				}).tablesorterFilter({ filterContainer: $("#filtro"),
                    filterClearContainer: $("#filterClearTwo"),
                    filterCaseSensitive: false
                }).tablesorterPager({container: $("#pager"),positionFixed: false}
				);

			});
			*/
            $('.sortable_list_pen').DataTable({
                "order" : [[0,"asc"]],
                "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false}],
                "paging" : false,
                "info" : false,
                "language": {
                    "sSearch" : "Buscar:"
                }
            });
            $('td').dblclick(function(){
                var url = $(this).parent().children('td:last').children('a:first').attr('href');
                window.location = url;
            });
        </script>

        
    </div>
    
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>
<script>

</script>
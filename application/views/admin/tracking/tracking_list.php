<h3>Movimientos del viaje</h3>
<table style="width: 600px;" class="sortable_list_pen dataTable">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Movimientos</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 0;?>
    <?php foreach($result as $tracking):?>
        <tr class="<?php if($i%2 == 0):?>even<?php else:?>odd<?php endif?>">
            <td class="tracking_created_td"><?php echo date("d-m-Y H:i",strtotime($tracking['created'])) ?></td>
            <?php $tipo_tracking = 'Edición';?>
            <?php switch($tracking['tipo_tracking']){
                case 'edit':
                    $tipo_traking = 'Editado';
                    break;
                case 'add':
                    $tipo_tracking = 'Creado';
                    break;
                case 'documento':
                    $tipo_tracking = 'Documento';
            }?>
            <td><strong><?php echo $tipo_tracking;?></strong><br>
                <?php foreach($tracking['tracking_detalles'] as $tracking_detalle):?>
                    <?php echo $tracking_detalle['label']?> : <?php echo $tracking_detalle['value']?><br>
                <?php endforeach?>
            </td>
        </tr>
        <?php $i++;?>
    <?php endforeach?>
    </tbody>
</table>

<?php
/**
 * Created by PhpStorm.
 * User: malcaino
 * Date: 16/08/15
 * Time: 22:05
 */
?>
<table id="tramos_table">
    <thead>
        <tr>
            <th>Desde</th>
            <th>Hasta</th>
            <th>Valor</th>
            <th>Comentario</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($tramos as $tramo):?>
            <tr>
                <td><?php echo $tramo['desde']?></td>
                <td><?php echo $tramo['hasta']?></td>
                <td>$<?php echo number_format($tramo['monto'],0,",",".")?></td>
                <td><?php echo $tramo['comentario']?></td>
            </tr>
        <?php endforeach?>
    </tbody>
</table>

<button class="submit mid" id="add_tramo">Agregar tramo</button>

<script>

    initAddTramoRow($('#add_tramo'));

    function initAddTramoRow(button){
        button.click(function(event){
            event.preventDefault();
            button.text("Guardar Tramo");
            $.ajax({
                url: '<?php echo site_url("ajax/newTramoForm")?>',
                type: 'POST',
                success: function(data){
                    $('#tramos_table').children('tbody').append($.parseJSON(data).view);
                    button.unbind("click");
                    initButtonSendTramo(button);
                }
            });
        });
    }

    function initButtonSendTramo(button){
        button.click(function(event){
            event.preventDefault();
            button.text("Agregar Tramo");
            var tramo_desde = $('#tramo_desde');
            var tramo_hasta = $('#tramo_hasta');
            var tramo_monto = $('#tramo_monto');
            var tramo_comentario = $('#tramo_comentario');
            $.ajax({
                url: '<?php echo site_url("ajax/addTramoAjax")?>',
                type: 'POST',
                data:{
                    viaje_id: <?php echo $viaje_id?>,
                    tipo_viaje: 4,
                    desde: tramo_desde.val(),
                    hasta: tramo_hasta.val(),
                    monto: tramo_monto.val(),
                    comentario: tramo_comentario.val()
                },
                success: function(data){
                    button.unbind("click");
                    tramo_desde.parent("td").text(tramo_desde.val());
                    tramo_hasta.parent("td").text(tramo_hasta.val());
                    tramo_monto.parent("td").text(tramo_monto.val());
                    tramo_comentario.parent("td").text(tramo_comentario.val());
                    initAddTramoRow(button);
                }
            });
        });
    }
</script>
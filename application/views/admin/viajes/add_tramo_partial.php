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
<div class="alert" style="display: none;">Complete los campos requeridos del tramo</div>
<button class="submit mid" id="add_tramo">Agregar tramo</button>
<button style="display: none;" class="submit mid" id="cancel_tramo">Cancelar tramo</button>

<script>

    initAddTramoRow($('#add_tramo'));

    function initAddTramoRow(button){
        button.click(function(event){
            event.preventDefault();
            button.text("Guardar Tramo");
            $("#cancel_tramo").show();
            $.ajax({
                url: '<?php echo site_url("ajax/newTramoForm")?>',
                type: 'POST',
                success: function(data){
                    var view = $($.parseJSON(data).view);
                    view.find("#tramo_monto_num").autoNumeric('init', {aDec: ',',aSep: '.', aSign: '$ ', vMin:'0', vMax: '999999999', nBracket: '(,)'});
                    $(view.find("#tramo_monto_num")).change(function(){
                        $(view.find("#tramo_monto")).val(view.find("#tramo_monto_num").autoNumeric('get'));
                    });
                    $('#tramos_table').children('tbody').append(view);
                    button.unbind("click");
                    initButtonSendTramo(button);
                }
            });
        });
    }
    $("#cancel_tramo").click(function(event){
        event.preventDefault();
        $("#tramo_desde").parent("td").parent("tr").remove();
        $(this).prev("button").unbind("click");
        $(this).hide();
        $(this).prev("button").text("Agregar Tramo");
        initAddTramoRow($(this).prev("button"));
    });

    function initButtonSendTramo(button){
        button.click(function(event){
            event.preventDefault();
            button.text("Agregar Tramo");
            var tramo_desde = $('#tramo_desde');
            var tramo_hasta = $('#tramo_hasta');
            var tramo_monto = $('#tramo_monto');
            var tramo_comentario = $('#tramo_comentario');
            if($("#tramo_monto").val() == "" || $("#tramo_desde").val() == "" || $("#tramo_hasta").val() == ""){
                button.prev("div.alert").fadeIn();
            }else{
                $.ajax({
                    url: '<?php echo site_url("ajax/addTramoAjax")?>',
                    type: 'POST',
                    data:{
                        viaje_id: <?php echo $viaje_id?>,
                        tipo_viaje: <?php echo $tipo_viaje?>,
                        desde: tramo_desde.val(),
                        hasta: tramo_hasta.val(),
                        monto: tramo_monto.val(),
                        comentario: tramo_comentario.val()
                    },
                    success: function(data){
                        $("#cancel_tramo").hide();
                        button.unbind("click");
                        if(button.prev("div.alert").is(":visible")){
                            button.prev("div.alert").hide();
                        }
                        tramo_desde.parent("td").text(tramo_desde.val());
                        tramo_hasta.parent("td").text(tramo_hasta.val());
                        tramo_monto.parent("td").text("$ "+ new Intl.NumberFormat().format(tramo_monto.val()));
                        tramo_comentario.parent("td").text(tramo_comentario.val());
                        initAddTramoRow(button);
                    }
                });
            }
        });
    }
</script>
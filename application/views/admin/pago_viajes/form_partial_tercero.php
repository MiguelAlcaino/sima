<form id="form_nuevo_pago_viajes_propio" method="post" action="<?php echo site_url("pago_viajes/add")?>" enctype="multipart/form-data">
    <div style="float:left; width:900px">
        <div class="ui-widget">

            <p><label>Viaje</label><br /> <select name="viaje_id">
                    <option value="null">Sin viaje asociado</option>
                    <?php foreach($viajes_terceros as $viaje):?>
                        <option <?php echo $viaje['id'] == $id_viaje_tercero ? 'selected': ''?> value="<?php echo $viaje['id']?>"><?php echo $viaje['codigo_viaje']?></option>
                    <?php endforeach?>
                </select></p>
            <input type="hidden" name="tipo_viaje" value="4">
            <div class="registro_pagos">
                <div class="registro_pagos_titulo">Historial de pagos</div>
                <table>
                    <thead>
                        <tr>
                            <th>Pagador por</th>
                            <th>Fecha</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pagos_viaje as $pago_viaje):?>
                            <tr>
                                <td><?php echo $pago_viaje['pagado_por']?></td>
                                <td><?php echo $pago_viaje['fecha_pago']?></td>
                                <td><td>$<?php echo number_format($pago_viaje['monto'], 0, '', '.')?></td></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <p><label>Pagado por</label><br> <input type="text" name="pagado_por" size="55" class="text"></p>

            <p><label>Monto a pagar al tercero</label><br /> <input type="text" name="monto_num" size="55" class="text" >
                <input type="hidden" name="monto"></p>

            <p><label>Fecha de pago</label><br /> <input type="text" name="fecha_pago" size="55" class="text" ></p>

            <p><label>Hora de pago</label><br /> <input type="text" name="hora_pago" size="55" class="text" ></p>

            <p><label>Descripción</label><br /> <textarea name="descripcion"></textarea></p>

            <p><input id="anadir_pago_btn" type="submit" class="submit largo" value="Registrar pago" /></p>
        </div>
    </div>
</form>
<script>
    $("input[name=monto_num]").autoNumeric('init', {aDec: ',',aSep: '.', aSign: '$ ', vMin:'0', vMax: '999999999', nBracket: '(,)'});
    $("input[name=monto_num]").change(function(){
        $('input[name=monto]').val($("input[name=monto_num]").autoNumeric('get'));
    });
    $('input[name=fecha_pago]').datetimepicker({
        format:'Y-m-d',
        timepicker:false,
        defaultDate: new Date(),
        dayOfWeekStart: 1,
        lang: 'es'
    });

    $('input[name=hora_pago]').datetimepicker({
        datepicker: false,
        format: 'H:i'
    });
    $('#form_nuevo_pago_viajes_propio').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url("pago_viajes/add")?>',
            type: "POST",
            data: $(this).serializeArray(),
            success: function(data){
                $('.message').addClass('success');
                $('.message').fadeIn();
                $('.message').text("El pago ha sido registrado con éxito.");
                $.facebox.close();
            }
        });
    });
</script>
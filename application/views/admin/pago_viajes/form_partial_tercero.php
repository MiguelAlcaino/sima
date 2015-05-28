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
            <p><label>Pagado por</label><br> <input type="text" name="pagado_por" size="55" class="text"></p>

            <p><label>Monto a pagar al tercero</label><br /> <input type="text" name="monto_num" size="55" class="text" >
                <input type="hidden" name="monto"></p>

            <p><label>Fecha de pago</label><br /> <input type="text" name="fecha_pago" size="55" class="text" ></p>

            <p><label>Hora de pago</label><br /> <input type="text" name="hora_pago" size="55" class="text" ></p>

            <p><label>Descripción</label><br /> <textarea name="descripcion"></textarea></p>

            <p><input id="anadir_pago_btn" type="submit" class="submit largo" value="Registrar anticipo" /></p>
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
</script>
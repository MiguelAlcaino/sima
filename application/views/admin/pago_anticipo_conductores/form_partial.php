<form id="form_nuevo_pago_anticipo_conductor" method="post" action="<?php echo site_url("pago_anticipo_conductores/add")?>" enctype="multipart/form-data">
    <div style="float:left; width:900px">
        <div class="ui-widget">

            <p><label>Viaje</label><br /> <select name="viaje_id">
                    <option value="null">Sin viaje asociado</option>
                    <?php foreach($viajes as $viaje):?>
                        <option <?php echo $viaje['id'] == $id_viaje ? 'selected': ''?> value="<?php echo $viaje['id']?>"><?php echo $viaje['codigo_viaje']?></option>
                    <?php endforeach?>
                </select></p>

            <p><label>Conductor</label><br />
                <select name="conductor_id">
                    <?php foreach($conductores as $conductor):?>
                        <option <?php echo $conductor['id'] == $id_conductor ? 'selected' : ''?> value="<?php echo $conductor['id']?>"><?php echo $conductor['identificador']?> - <?php echo $conductor['nombre']?> <?php echo $conductor['apellido']?></option>
                    <?php endforeach?>
                </select>
            </p>

            <p><label>Monto a pagar</label><br /> <input type="text" name="monto_num" size="55" class="text" >
            <input type="hidden" name="monto"></p>

            <p><label>Fecha de anticipo</label><br /> <input type="text" name="fecha_anticipo" size="55" class="text" ></p>

            <p><label>Hora de anticipo</label><br /> <input type="text" name="hora_anticipo" size="55" class="text" ></p>

            <p><label>Descripción</label><br /> <textarea name="descripcion"></textarea></p>

            <p><input id="anadir_anticipo_btn" type="submit" class="submit largo" value="Registrar anticipo" /></p>
        </div>
    </div>
</form>
<script>
    $("input[name=monto_num]").autoNumeric('init', {aDec: ',',aSep: '.', aSign: '$ ', vMin:'0', vMax: '999999999', nBracket: '(,)'});
    $("input[name=monto_num]").change(function(){
        $('input[name=monto]').val($("input[name=monto_num]").autoNumeric('get'));
    });
    $('input[name=fecha_anticipo]').datetimepicker({
        format:'Y-m-d',
        timepicker:false,
        defaultDate: new Date(),
        dayOfWeekStart: 1,
        lang: 'es'
    });

    $('input[name=hora_anticipo]').datetimepicker({
        datepicker: false,
        format: 'H:i'
    });
</script>
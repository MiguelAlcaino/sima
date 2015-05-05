<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        <?php if($id_conductor != null):?>
            <h2>Lista de anticipos para <?php echo $pago_anticipo_conductores[0]['conductor_identificador']?> - <?php echo $pago_anticipo_conductores[0]['conductor_nombre']?> <?php echo $pago_anticipo_conductores[0]['conductor_apellido']?></h2>
        <?php else:?>
            <h2>Lista de anticipos de todos los conductores</h2>
        <?php endif?>
        <div class="filtro_conductor_pago_anticipo"><span>Filtro:</span> <select>
                <option value="null">Todos los conductores</option>
            <?php foreach($conductores_propios as $conductor):?>
                <option <?php echo $conductor['id'] == $id_conductor ? 'selected': ''?> value="<?php echo $conductor['id']?>"><?php echo $conductor['identificador']?> - <?php echo $conductor['nombre']?> <?php echo $conductor['apellido']?></option>
            <?php endforeach?>
        </select>
        </div>
        <ul>
            <li><?php if($id_conductor != null):?>
                    <?php echo anchor("pago_anticipo_conductores/nuevo/null/".$id_conductor, "Nuevo anticipo")?>
                <?php else:?>
                    <?php echo anchor("pago_anticipo_conductores/nuevo","Nuevo anticipo")?>
                <?php endif?>
            </li>
        </ul>

    </div>

    <div class="block_content">
        <?php

        if($this->session->flashdata('message'))
        { ?>
            <?php echo $this->session->flashdata('message'); ?>
        <?php
        } ?>
        <form action="" method="post">
            <table id="todos_los_viajes" cellpadding="0" cellspacing="0" width="100%" class="sortable_list_pen">

                <thead>
                <tr>

                    <th>Conductor</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Hora</th>
                    <th>Descripción</th>
                    <th>Viaje asoc.</th>

                </tr>
                </thead>


                <tbody>
                <?php $total = 0?>
                <?php foreach($pago_anticipo_conductores as $pago_anticipo_conductor):?>
                <tr>
                    <td><?php echo $pago_anticipo_conductor['conductor_identificador']?> - <?php echo $pago_anticipo_conductor['conductor_nombre']?> <?php echo $pago_anticipo_conductor['conductor_apellido']?></td>
                    <td><?php echo $pago_anticipo_conductor['pago_anticipo_conductores_fecha_anticipo']?></td>
                    <td>$<?php echo number_format($pago_anticipo_conductor['pago_anticipo_conductores_monto'],0,",",".")?></td>
                    <td><?php echo $pago_anticipo_conductor['pago_anticipo_conductores_hora_anticipo']?></td>
                    <td><?php echo $pago_anticipo_conductor['pago_anticipo_conductores_descripcion']?></td>
                    <td><?php echo $pago_anticipo_conductor['viaje_codigo_viaje']?></td>
                </tr>
                    <?php $total = $total + $pago_anticipo_conductor['pago_anticipo_conductores_monto']?>
                <?php endforeach?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2">Total</td>
                    <td>$<?php echo number_format($total,0,",",".")?></td>
                </tr>
                </tfoot>
            </table>

        </form>
    </div>

    <div class="bendl"></div>
    <div class="bendr"></div>
</div>
<script>
    $(".filtro_conductor_pago_anticipo select").change(function(){
        if($(this).val() == "null"){
            window.location = "<?php echo site_url("pago_anticipo_conductores/index")?>"
        }else{
            window.location = "<?php echo site_url("pago_anticipo_conductores/index")?>/"+$(this).val();
        }

    });
</script>

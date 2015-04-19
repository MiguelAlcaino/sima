<div id='popup' style='width:470px; height:495px' class='block'><h2>Añadir nuevo Proveedor tercero</h2>
    <div class="block">
        <div class="block_content">
            <form id="new_conductor_proveedor_tercero" method="post" action="<?php echo site_url('conductores_proveedor_terceros/add')?>" enctype="multipart/form-data">
                <div style="float:left; width:450px">
                    <div class="ui-widget">
                        <p><label>Proveedor de viajes</label> <?php echo $nombre_proveedor_tercero?><br />
                            <input type="hidden" name="proveedor_viajes_terceros_id" value="<?php echo $id_proveedor_tercero?>">
                        </p>

                        <p><label>Identificador del conductor</label><br /> <input required="required" type="text" name="identificador" size="55" class="text" ></p>

                        <p><label>Nombre</label><br /> <input required="required" type="text" name="nombre" size="55" class="text" ></p>

                        <p><label>Apellido</label><br /> <input type="text" name="apellidos" size="55" class="text" ></p>

                        <p><label>RUT</label><br /> <input type="text" name="rut" size="55" class="text" ></p>

                        <p><label>Patente de camión asociada</label><br /> <input type="text" name="patente_camion_asociada" size="55" class="text" ></p>

                        <p><label>Patente de rampla asociada</label><br /> <input type="text" name="patente_rampla_asociada" size="55" class="text" ></p>

                    </div>
                    <br clear="all" />
                    <hr>
                    <p>
                        <input type="submit" class="submit largo" value="Agregar conductor" />
                    </p>

            </form>
        </div>
    </div>
</div>
<script>
    $("#new_conductor_proveedor_tercero").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url("ajax/saveNewConductorProveedorTercero")?>',
            method: "POST",
            data: $("#new_conductor_proveedor_tercero").serializeArray(),
            success: function(data){
                var conductor_proveedor_tercero_id = JSON.parse(data).conductor_proveedor_tercero_id;
                var patente_camion = $('input[name=patente_camion_asociada]').val();
                var patente_rampla = $('input[name=patente_rampla_asociada]').val();
                var identificador = $('input[name=identificador]').val();
                var nombre = $('input[name=nombre]').val();
                var apellidos = $('input[name=apellidos]').val();
                $('#conductor_id option[selected=selected]').removeAttr("selected");
                $("#conductor_id").append('<option selected patente_camion="'+patente_camion+'" patente_rampla="'+patente_rampla+'" identificador="'+identificador+'" value="'+conductor_proveedor_tercero_id+'">'+identificador+' - '+nombre+' '+apellidos+'</option>');
                $.facebox.close();

            }
        });
    });
</script>

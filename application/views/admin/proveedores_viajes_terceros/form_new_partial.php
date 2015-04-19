<div id='popup' style='width:470px; height:495px' class='block'><h2>Añadir nuevo Proveedor tercero</h2>
    <div class="block">
        <div class="block_content">
            <form id="form_nuevo_proveedor_tercero" method="post" action enctype="multipart/form-data">
                <div style="float:left; width:900px">
                    <div class="ui-widget">

                        <p><label>Nombre del proveedor</label><br /> <input type="text" name="nombre_proveedor" size="55" class="text" ></p>

                        <p><label>RUT</label><br /> <input maxlength="10" type="text" name="rut" size="55" class="text" ></p>

                        <p><label>Razón social</label><br /> <input type="text" name="razon_social_proveedor" size="55" class="text" ></p>

                        <p><label>Dirección de contacto</label><br /> <input type="text" name="direccion_contacto" size="55" class="text" ></p>

                        <p><label>Persona de contacto</label><br /> <input type="text" name="persona_de_contacto" size="55" class="text" ></p>

                        <p><label>Teléfono</label><br /> <input type="text" name="telefono" size="55" class="text" ></p>

                        <p><input id="anadir_proveedor_tercero_btn" type="button" class="submit largo" value="Agregar proveedor" /></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $("#anadir_proveedor_tercero_btn").click(function(){
        $.ajax({
            url: '<?php echo site_url("ajax/saveNewProveedorTercero")?>',
            method: 'POST',
            data: $('#form_nuevo_proveedor_tercero').serializeArray(),
            success: function(data){
                $('select[name=proveedor_viajes_tercero_id] option[selected=selected]').removeAttr("selected");
                $('select[name=proveedor_viajes_tercero_id]').append("<option selected value='"+JSON.parse(data).proveedor_tercero_id+"'>"+$('input[name=nombre_proveedor]').val()+"</option>");
                $.facebox.close();
            }
        });
    });
</script>
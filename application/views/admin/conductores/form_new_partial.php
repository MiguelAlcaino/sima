<div id='popup' style='width:470px; height:495px' class='block'><h2>Añadir nuevo conductor</h2>
 <div class="block">
    <div class="block_content">
        <form id="form_anadir_conductor" method="post" action="<?php site_url('conductores/add')?>" enctype="multipart/form-data">
            <div style="float:left; width:450px">
                <div class="ui-widget">
                    <p>
                        <label>Identificador del conductor</label><br />
                        <input required="required" type="text" name="identificador" size="55" class="text" >
                    </p>

                    <p><label>Nombre</label><br /> <input required="required" type="text" name="nombre" size="55" class="text" ></p>

                    <p><label>Apellido</label><br /> <input required="required" type="text" name="apellido" size="55" class="text" ></p>

                    <p><label>Patente asociada</label><br /> <input type="text" name="patente_asociada" size="55" class="text" ></p>

                    <p><label>RUT</label><br /> <input type="text" name="rut" size="55" class="text" ></p>

                    <p><label>Fecha de nacimiento</label><br /> <input id="fecha_nacimiento" type="text" name="fecha_nacimiento" size="55" class="text" ></p>
                </div>
                <br clear="all" />
                <hr>
                <p>
                    <input type="button" id="anadir_conductor_btn" class="submit largo" value="Añadir" />
                </p>
            </div>
        </form>

        <script>
            $("#anadir_conductor_btn").click(function(){
                $.ajax({
                    url: "<?php echo site_url("ajax/saveNewConductorPropio")?>",
                    data: $("#form_anadir_conductor").serializeArray(),
                    method: "POST",
                    success: function(data){
                        $("#conductor_id").append("<option selected identificador='"+$('input[name=identificador]').val()+"' patente_camion='"+$('input[name=patente_asociada]').val()+"' value='"+JSON.parse(data).conductor_id+"'>"+$('input[name=identificador]').val()+" - "+$('input[name=nombre]').val()+" "+$('input[name=apellido]').val()+"</option>");
                        $("input[name=identificador_maquina]").val($('input[name=patente_asociada]').val());
                        $.facebox.close();
                    }
                });
            });
        </script>



<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        
        <h2> Clientes</h2>
        
        <ul>
            <li><a href="clientes/">Listar</a></li>
            <li><a href="clientes/nuevo">Nuevo Cliente</a></li>
        </ul>
    </div>		

    <div class="block_content">
				
		<?php if (validation_errors()){ ?>
            <div class="message error">
            <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
			<form method="post" action="clientes/actualizar/" enctype="multipart/form-data">
			  
			                  
                 <input type="hidden" name="id" id="id" value="<?php echo $data[0]['id_cliente']?>" />
                 
                <div style="float:left; width:450px">
                    <p>
                      
                      <label>Nombre Comercial</label><br /> <input type="text" name="nombre"  size="55" class="text" value="<?php echo $data[0]['nombre_comercial'] ?>"></p>
                    
                    <p><label>Razón Social</label><br /> <input type="text" name="razon" size="55" class="text" value="<?php echo $data[0]['razon_social'] ?>"></p>
                    
                    <p><label>RUT</label><br /> <input type="text" name="nif_cif" size="55" class="text" value="<?php echo $data[0]['nif_cif'] ?>"></p>
                    
                    <p><label>Persona de Contacto</label><br /> <input type="text" name="contacto" size="55" class="text" value="<?php echo $data[0]['contacto'] ?>"></p>
                    
                    <p><label>Página web </label><br /> <input type="text" name="pagina_web" size="55" class="text" value="<?php echo $data[0]['pagina_web'] ?>"></p>
                    
                    <p><label>Email</label><br /> <input type="text" name="email" size="55" class="text"  value="<?php echo $data[0]['email'] ?>"/></p>
                    
                    <p><label>Teléfono </label><br /> <input type="text" name="telefono" size="55" class="text" value="<?php echo $data[0]['telefono'] ?>"></p>
                    
                    <p><label>Móvil </label><br /> <input type="text" name="movil" size="55" class="text" value="<?php echo $data[0]['movil'] ?>"></p>
                    
                    <p><label>Fax</label><br /> <input type="text" name="fax" size="55" class="text" value="<?php echo $data[0]['fax'] ?>"></p>
                    	
                </div> 
                <div style="float:left; width:450px; margin-left:50px">
                 	<p><label>Ciudad</label><br /> <select class="styled" name="provincia"><option value=" ">- Seleccionar</option><?php 			foreach($provincias as $key){
								?><option value="<?php echo $key['id_provincia'] ?>" <?php if($data[0]['id_provincia']== $key['id_provincia']) echo "selected='selected'" ?>><?php echo $key['nombre_provincia'] ?></option><?php
						}
						 ?></select></p>
						 
						 <p><label>Comuna</label><br /> <select class="styled" name="comuna_id"><option value=" ">- Seleccionar</option><?php      foreach($comunas as $key){
                ?><option value="<?php echo $key['comuna_id'] ?>" <?php if($data[0]['comuna_id'] == $key['comuna_id']) echo "selected='selected'" ?>><?php echo $key['comuna_nombre'] ?></option><?php
            }
             ?></select></p>
                    
                    <p><label>Dirección</label><br /> <input type="text" name="direccion" size="55" class="text" value="<?php echo $data[0]['direccion'] ?>"></p>
                    
                    <p><label>Código postal </label><br /> <input type="text" name="cp" size="55" class="text" value="<?php echo $data[0]['cp'] ?>"></p>
                    
                    <p><label>Giro</label><br /> <input type="text" name="tipo" size="55" class="text" value="<?php echo $data[0]['tipo_empresa'] ?>"></p>
                    
                    <p><label>Entidad Bancaria</label><br /> <input type="text" name="entidad" size="55" class="text" value="<?php echo $data[0]['entidad_bancaria'] ?>"></p>
                    
                    <p><label>N° Cuenta</label><br /> <input type="text" name="numero_cuenta" size="55" class="text" value="<?php echo $data[0]['numero_cuenta'] ?>"></p>
                    
                    <p><label>Observaciones </label><br /> <textarea class="text m" name="observaciones"><?php echo $data[0]['observaciones'] ?></textarea></p>
                </div>
                <br clear="all" />
                <hr>
                <p>
                	<input type="submit" class="submit mid" value="Actualizar" />
                </p>
               
             </form>
					
		</div>
    
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>
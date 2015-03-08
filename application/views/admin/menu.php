 <li><a href="">Clientes</a>
   <ul>
     <li><?php echo anchor("clientes/nuevo","Nuevo Cliente")?></li>
     <li><?php echo anchor("clientes","Lista de clientes")?></li>
   </ul>
 </li>
 <li><a href="">Viajes Propios</a>
   <ul>
     <li><?php echo anchor("viajes/nuevo","Nuevo Viaje")?></li>
     <li><?php echo anchor("viajes","Lista de viajes")?></li>
     <li><?php echo anchor("conductores","Conductores")?></li>
   </ul>
 </li>
 <li><a href="">Viajes terceros</a>
   <ul>
     <li><?php echo anchor("viajes_proveedores_terceros/nuevo","Nuevo viaje")?></li>
     <li><?php echo anchor("viajes_proveedores_terceros","Lista de viajes")?></li>
     <li><?php echo anchor("proveedores_viajes_terceros","Proveedores terceros")?></li>
     <li><?php echo anchor("conductores_proveedor_terceros","Conductores de terceros")?></li>
   </ul>
 </li>
 <li><a href="">Facturación</a>
   <ul>
     <li><?php echo anchor("facturas/nueva","Nueva factura")?></li>
     <li><?php echo anchor("facturas","Lista de factura")?></li>
   </ul>
 </li>
 <li><a href="">Datos</a>
   <ul>
     <li><?php echo anchor("productos","Productos")?></li>
     <li><?php echo anchor("servicios","Servicios")?></li>
     <li><?php echo anchor("proveedores","Proveedores")?></li>
     <li><?php echo anchor("viajes_temporales","Viajes temporales")?></li>
   </ul>
 </li>
 <li><a href="">Informes</a>
   <ul>
     <li><?php echo anchor("viajes/informeViajesPorCliente","Viajes por cliente")?></li>
     <li><?php echo anchor("viajes/informeViajesConductorPropio","Viajes por conductor propio")?></li>
     <li><?php echo anchor("viajes/buscarViajesPorContenedor","Viajes por contenedor")?></li>
     <li><?php echo anchor("viajes/informeViajesTodos","Todos los viajes")?></li>
     
   </ul>
 </li>
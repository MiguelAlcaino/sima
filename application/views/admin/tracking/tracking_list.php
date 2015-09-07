<ul>
    <?php foreach($result as $tracking):?>
        <li><?php echo $tracking['tipo_tracking']?> <?php echo $tracking['created'] ?>
            <ul>
                <?php foreach($tracking['tracking_detalles'] as $tracking_detalle):?>
                    <li><?php echo $tracking_detalle['label']?> : <?php echo $tracking_detalle['value']?></li>
                <?php endforeach?>
            </ul>
        </li>
    <?php endforeach?>
</ul>

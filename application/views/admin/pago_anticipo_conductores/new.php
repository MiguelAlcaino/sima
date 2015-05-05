<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>

        <h2>Nuevo Anticipo</h2>

        <ul>
            <li class="active"><?php echo anchor("pago_anticipo_conductores/nuevo", "Nuevo anticipo")?></li>
        </ul>
    </div>

    <div class="block_content">

        <?php if (validation_errors()){ ?>
            <div class="message error">
                <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
        <?php $this->view("admin/pago_anticipo_conductores/form_partial")?>

    </div>

    <div class="bendl"></div>
    <div class="bendr"></div>
</div>

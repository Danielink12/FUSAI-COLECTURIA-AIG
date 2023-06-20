<div class="tablas">
    <h2 class="titulo">COMPROBACION</h2>
    <?php if($qpendientes[0]->FECHA!=null){ ?>
        <div class="alert alert-warning" role="alert" align="center">
            <?php echo "TIENE LIQUIDACIONES PENDIENTES DESDE ".$qpendientes[0]->FECHA; ?>
        </div>
        <?php } ?>
    <?= $data ?>
    <form action="<?= $urlpost ?>" method="post">
        <input type="hidden" id="desde" name="desde" value="<?= $desde ?>">
        <input type="hidden" id="hasta" name="hasta" value="<?= $hasta ?>">
        <?php if($qpendientes[0]->FECHA!=NULL){ ?>
            <button type="button" class="btn btn-primary btnnuevo" href="liquidacion/" role="button" disabled>LIQUIDAR</button>
        <?php }elseif($qpendientesn<1){ ?>
            <button type="button" class="btn btn-primary btnnuevo" href="liquidacion/" role="button" disabled>LIQUIDAR</button>
        <?php }else{ ?>
            <button type="submit" class="btn btn-primary btnnuevo" href="liquidacion/" role="button">LIQUIDAR</a>
        <?php } ?>
    </form>
</div>
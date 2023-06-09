<div class="formdivagencias">
  <h2 class="titulo"><?= $seccion ?></h2>
  <form class="row g-3" method="post" action="<?php echo base_url().$urlpost ?>">
      <?php if($datosTipoPago[0]==null){ ?>
        <input type="hidden" id="tipopagoid" name="tipopagoid">
      <?php } else { ?>
        <input type="hidden" id="tipopagoid" name="tipopagoid" value="<?= $datosTipoPago[0]->TIPOPAGOID ?>">
      <?php } ?>
    <div class="col-md-12">
      <label for="inputEmail4" class="form-label">Tipo de Pago</label>
      <?php if($datosTipoPago[0]==null){ ?>
        <input type="text" class="form-control" id="tipopago" name="tipopago" required>
      <?php } else { ?>
        <input type="text" class="form-control" id="tipopago" name="tipopago" value="<?= $datosTipoPago[0]->TIPOPAGO ?>" required>
      <?php } ?>
    </div>
      <button type="submit" class="btn btn-primary"><?= esc($txtbtn) ?></button>
    </div>
  </form>
</div>
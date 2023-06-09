<div class="formdivagencias">
  <h2 class="titulo"><?= $seccion ?></h2>
  <form class="row g-3" method="post" action="<?php echo base_url().$urlpost ?>">
      <?php if($datosFormaPago[0]==null){ ?>
        <input type="hidden" id="formapagoid" name="formapagoid">
      <?php } else { ?>
        <input type="hidden" id="formapagoid" name="formapagoid" value="<?= $datosFormaPago[0]->FORMAPAGOID ?>">
      <?php } ?>
    <div class="col-md-12">
      <label for="inputEmail4" class="form-label">Forma de Pago</label>
      <?php if($datosFormaPago[0]==null){ ?>
        <input type="text" class="form-control" id="formapago" name="formapago" required>
      <?php } else { ?>
        <input type="text" class="form-control" id="formapago" name="formapago" value="<?= $datosFormaPago[0]->FORMAPAGO ?>" required>
      <?php } ?>
    </div>
      <button type="submit" class="btn btn-primary"><?= esc($txtbtn) ?></button>
    </div>
  </form>
</div>
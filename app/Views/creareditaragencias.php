<div class="formdivagencias">
  <h2 class="titulo"><?= $seccion ?></h2>
  <form class="row g-3" method="post" action="<?php echo base_url().$urlpost ?>">
      <?php if($datosAgencia[0]==null){ ?>
        <input type="hidden" id="agenciaid" name="agenciaid">
      <?php } else { ?>
        <input type="hidden" id="agenciaid" name="agenciaid" value="<?= $datosAgencia[0]->AGENCIAID ?>">
      <?php } ?>
    <div class="col-md-12">
      <label for="inputEmail4" class="form-label">Nombre de la Agencia</label>
      <?php if($datosAgencia[0]==null){ ?>
        <input type="text" class="form-control" id="agencia" name="agencia" required>
      <?php } else { ?>
        <input type="text" class="form-control" id="agencia" name="agencia" value="<?= $datosAgencia[0]->AGENCIA ?>" required>
      <?php } ?>
    </div>
      <button type="submit" class="btn btn-primary"><?= esc($txtbtn) ?></button>
    </div>
  </form>
</div>
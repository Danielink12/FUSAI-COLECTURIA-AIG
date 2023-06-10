<div class="formdivagencias">
  <h2 class="titulo"><?= $seccion ?></h2>
  <form class="row g-3" method="post" action="<?php echo base_url().$urlpost ?>">
      <?php if($datosColector[0]==null){ ?>
        <input type="hidden" id="colectorid" name="colectorid">
      <?php } else { ?>
        <input type="hidden" id="colectorid" name="colectorid" value="<?= $datosColector[0]->COLECTORID ?>">
      <?php } ?>
    <div class="col-md-12">
      <label for="inputEmail4" class="form-label">Colector</label>
      <?php if($datosColector[0]==null){ ?>
        <input type="text" class="form-control" id="colector" name="colector" required>
      <?php } else { ?>
        <input type="text" class="form-control" id="colector" name="colector" value="<?= $datosColector[0]->COLECTOR ?>" required>
      <?php } ?>
    </div>
    <div class="col-md-12">
      <label for="inputEmail4" class="form-label">No. Registro</label>
      <?php if($datosColector[0]==null){ ?>
        <input type="text" class="form-control" id="noregistro" name="noregistro" required>
      <?php } else { ?>
        <input type="text" class="form-control" id="noregistro" name="noregistro" value="<?= $datosColector[0]->NUMEROREGISTRO ?>" required>
      <?php } ?>
    </div>
      <button type="submit" class="btn btn-primary"><?= esc($txtbtn) ?></button>
    </div>
  </form>
</div>
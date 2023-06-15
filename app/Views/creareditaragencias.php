<div class="formdivagencias">
  <h2 class="titulo"><?= $seccion ?></h2>
  <form class="row g-3" method="post" action="<?php echo base_url().$urlpost ?>">
      <?php if($datosAgencia[0]==null){ ?>
        <input type="hidden" id="agenciaid" name="agenciaid">
      <?php } else { ?>
        <input type="hidden" id="agenciaid" name="agenciaid" value="<?= $datosAgencia[0]->AGENCIAID ?>">
      <?php } ?>
      <div class="col-md-6">
      <label for="inputState" class="form-label">Departamento</label>
      <select id="departamentoid" name="departamentoid" class="form-select" required>
        <option <?php if($nuevo==true){echo "selected disabled";}else{echo "disabled";} ?> value="">ELEGIR...</option>
        <?php foreach ($departamentos->getResult() as $itemproducto): ?>
        <option value="<?= $itemproducto->DEPARTAMENTOID ?>" <?php if($nuevo==false){if($itemproducto->DEPARTAMENTOID==$datosAgencia[0]->DEPARTAMENTOID){echo "selected";}} ?>><?= $itemproducto->DEPARTAMENTO ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Nombre de la Agencia</label>
      <?php if($datosAgencia[0]==null){ ?>
        <input type="text" class="form-control" id="agencia" name="agencia" required>
      <?php } else { ?>
        <input type="text" class="form-control" id="agencia" name="agencia" value="<?= $datosAgencia[0]->AGENCIA ?>" required>
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Nombre del Contacto</label>
      <?php if($datosAgencia[0]==null){ ?>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
      <?php } else { ?>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $datosAgencia[0]->CONTACTO ?>" required>
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Telefono del Contacto</label>
      <?php if($datosAgencia[0]==null){ ?>
        <input type="number" class="form-control" id="telefono" name="telefono" required>
      <?php } else { ?>
        <input type="number" class="form-control" id="telefono" name="telefono" value="<?= $datosAgencia[0]->TELEFONO ?>" required>
      <?php } ?>
    </div>
      <button type="submit" class="btn btn-primary"><?= esc($txtbtn) ?></button>
    </div>
  </form>
</div>
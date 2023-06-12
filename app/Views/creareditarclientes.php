<div class="formdivagencias">
  <h2 class="titulo"><?= $seccion ?></h2>
  <form class="row g-3" method="post" action="<?php echo base_url().$urlpost ?>">
      <?php if($datosCliente[0]==null){ ?>
        <input type="hidden" id="clienteid" name="clienteid">
      <?php } else { ?>
        <input type="hidden" id="clienteid" name="clienteid" value="<?= $datosCliente[0]->CLIENTEID ?>">
      <?php } ?>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Primer nombre</label>
      <?php if($datosCliente[0]==null){ ?>
        <input type="text" class="form-control" id="primernombre" name="primernombre" required>
      <?php } else { ?>
        <input type="text" class="form-control" id="primernombre" name="primernombre" value="<?= $datosCliente[0]->PRIMERNOMBRE ?>" required>
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Segundo nombre</label>
      <?php if($datosCliente[0]==null){ ?>
        <input type="text" class="form-control" id="segundonombre" name="segundonombre">
      <?php } else { ?>
        <input type="text" class="form-control" id="segundonombre" name="segundonombre" value="<?= $datosCliente[0]->SEGUNDONOMBRE ?>" >
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Tercer nombre</label>
      <?php if($datosCliente[0]==null){ ?>
        <input type="text" class="form-control" id="tercernombre" name="tercernombre">
      <?php } else { ?>
        <input type="text" class="form-control" id="tercernombre" name="tercernombre" value="<?= $datosCliente[0]->TERCERNOMBRE ?>" >
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Primer apellido</label>
      <?php if($datosCliente[0]==null){ ?>
        <input type="text" class="form-control" id="primerapellido" name="primerapellido" required>
      <?php } else { ?>
        <input type="text" class="form-control" id="primerapellido" name="primerapellido" value="<?= $datosCliente[0]->PRIMERAPELLIDO ?>" required>
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Segundo apellido</label>
      <?php if($datosCliente[0]==null){ ?>
        <input type="text" class="form-control" id="segundoapellido" name="segundoapellido">
      <?php } else { ?>
        <input type="text" class="form-control" id="segundoapellido" name="segundoapellido" value="<?= $datosCliente[0]->SEGUNDOAPELLIDO ?>" >
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Tercer apellido</label>
      <?php if($datosCliente[0]==null){ ?>
        <input type="text" class="form-control" id="tercerapellido" name="tercerapellido">
      <?php } else { ?>
        <input type="text" class="form-control" id="tercerapellido" name="tercerapellido" value="<?= $datosCliente[0]->TERCERAPELLIDO ?>">
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">DPI</label>
      <?php if($datosCliente[0]==null){ ?>
        <input type="text" class="form-control" id="dpi" name="dpi" required>
      <?php } else { ?>
        <input type="text" class="form-control" id="dpi" name="dpi" value="<?= $datosCliente[0]->DPI ?>" required>
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">NIT</label>
      <?php if($datosCliente[0]==null){ ?>
        <input type="text" class="form-control" id="nit" name="nit" required>
      <?php } else { ?>
        <input type="text" class="form-control" id="nit" name="nit" value="<?= $datosCliente[0]->NIT ?>" required>
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Telefono</label>
      <?php if($datosCliente[0]==null){ ?>
        <input type="text" class="form-control" id="telefono" name="telefono" required>
      <?php } else { ?>
        <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $datosCliente[0]->TELEFONO ?>" required>
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputState" class="form-label">Departamento</label>
      <select id="departamentoid" name="departamentoid" class="form-select" required>
        <option <?php if($nuevo==true){echo "selected disabled";}else{echo "disabled";} ?> value="">ELEGIR...</option>
        <?php foreach ($departamentos->getResult() as $itemproducto): ?>
        <option value="<?= $itemproducto->DEPARTAMENTOID ?>" <?php if($nuevo==false){if($itemproducto->DEPARTAMENTOID==$datosCliente[0]->DEPARTAMENTOID){echo "selected";}} ?>><?= $itemproducto->DEPARTAMENTO ?></option>
        <?php endforeach; ?>
      </select>
    </div>
      <button type="submit" class="btn btn-primary"><?= esc($txtbtn) ?></button>
    </div>
  </form>
</div>
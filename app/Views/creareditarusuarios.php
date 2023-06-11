<div class="formdivagencias">
  <h2 class="titulo"><?= $seccion ?></h2>
  <form class="row g-3" method="post" action="<?php echo base_url().$urlpost ?>">
      <?php if($datosUsuario[0]==null){ ?>
        <input type="hidden" id="usuarioid" name="usuarioid">
      <?php } else { ?>
        <input type="hidden" id="usuarioid" name="usuarioid" value="<?= $datosUsuario[0]->USUARIOID ?>">
      <?php } ?>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Primer nombre</label>
      <?php if($datosUsuario[0]==null){ ?>
        <input type="text" class="form-control" id="primernombre" name="primernombre" required>
      <?php } else { ?>
        <input type="text" class="form-control" id="primernombre" name="primernombre" value="<?= $datosUsuario[0]->PRIMERNOMBRE ?>" required>
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Segundo nombre</label>
      <?php if($datosUsuario[0]==null){ ?>
        <input type="text" class="form-control" id="segundonombre" name="segundonombre">
      <?php } else { ?>
        <input type="text" class="form-control" id="segundonombre" name="segundonombre" value="<?= $datosUsuario[0]->SEGUNDONOMBRE ?>" >
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Tercer nombre</label>
      <?php if($datosUsuario[0]==null){ ?>
        <input type="text" class="form-control" id="tercernombre" name="tercernombre">
      <?php } else { ?>
        <input type="text" class="form-control" id="tercernombre" name="tercernombre" value="<?= $datosUsuario[0]->TERCERNOMBRE ?>" >
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Primer apellido</label>
      <?php if($datosUsuario[0]==null){ ?>
        <input type="text" class="form-control" id="primerapellido" name="primerapellido" required>
      <?php } else { ?>
        <input type="text" class="form-control" id="primerapellido" name="primerapellido" value="<?= $datosUsuario[0]->PRIMERAPELLIDO ?>" required>
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Segundo apellido</label>
      <?php if($datosUsuario[0]==null){ ?>
        <input type="text" class="form-control" id="segundoapellido" name="segundoapellido">
      <?php } else { ?>
        <input type="text" class="form-control" id="segundoapellido" name="segundoapellido" value="<?= $datosUsuario[0]->SEGUNDOAPELLIDO ?>" >
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Tercer apellido</label>
      <?php if($datosUsuario[0]==null){ ?>
        <input type="text" class="form-control" id="tercerapellido" name="tercerapellido">
      <?php } else { ?>
        <input type="text" class="form-control" id="tercerapellido" name="tercerapellido" value="<?= $datosUsuario[0]->TERCERAPELLIDO ?>">
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Usuario</label>
      <?php if($datosUsuario[0]==null){ ?>
        <input type="text" class="form-control" id="usuario" name="usuario" required>
      <?php } else { ?>
        <input type="text" class="form-control" id="usuario" name="usuario" value="<?= $datosUsuario[0]->USUARIO ?>" required>
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Clave</label>
      <?php if($datosUsuario[0]==null){ ?>
        <input type="text" class="form-control" id="clave" name="clave" required>
      <?php } else { ?>
        <input type="text" class="form-control" id="clave" name="clave" value="<?= decrypt(utf8_decode($datosUsuario[0]->CLAVE)) ?>" required>
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Correo</label>
      <?php if($datosUsuario[0]==null){ ?>
        <input type="text" class="form-control" id="correo" name="correo" required>
      <?php } else { ?>
        <input type="text" class="form-control" id="correo" name="correo" value="<?= $datosUsuario[0]->CORREO ?>" required>
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputState" class="form-label">Agencia</label>
      <select id="agenciaid" name="agenciaid" class="form-select" required>
        <option <?php if($nuevo==true){echo "selected disabled";}else{echo "disabled";} ?> value="">ELEGIR...</option>
        <?php foreach ($agencia->getResult() as $itemproducto): ?>
        <option value="<?= $itemproducto->AGENCIAID ?>" <?php if($nuevo==false){if($itemproducto->AGENCIAID==$datosUsuario[0]->AGENCIAID){echo "selected";}} ?>><?= $itemproducto->AGENCIA ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-6">
      <label for="inputState" class="form-label">Tipo usuario</label>
      <select id="tipousuarioid" name="tipousuarioid" class="form-select" required>
        <option <?php if($nuevo==true){echo "selected disabled";}else{echo "disabled";} ?> value="">ELEGIR...</option>
        <?php foreach ($tipousuario->getResult() as $itemproducto): ?>
        <option value="<?= $itemproducto->TIPOUSUARIOID ?>" <?php if($nuevo==false){if($itemproducto->TIPOUSUARIOID==$datosUsuario[0]->TIPOUSUARIOID){echo "selected";}} ?>><?= $itemproducto->TIPOUSUARIO ?></option>
        <?php endforeach; ?>
      </select>
    </div>
      <button type="submit" class="btn btn-primary"><?= esc($txtbtn) ?></button>
    </div>
  </form>
</div>
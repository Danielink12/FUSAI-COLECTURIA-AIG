<div class="formdivagencias">
  <h2 class="titulo"><?= $seccion ?></h2>
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    BUSCAR CLIENTE O CREDITO
  </button>

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Elige un cliente o credito</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?= $data ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <form class="row g-3" method="post" action="<?php echo base_url().$urlpost ?>">
      <?php if($datosPago[0]==null){ ?>
        <input type="hidden" id="usuarioid" name="usuarioid">
      <?php } else { ?>
        <input type="hidden" id="usuarioid" name="usuarioid" value="<?= $datosPago[0]->USUARIOID ?>">
      <?php } ?>
      <?php if($clienteid==null){ ?>
        <input type="hidden" id="clienteid" name="clienteid">
      <?php } else { ?>
        <input type="hidden" id="clienteid" name="clienteid" value="<?= $clienteid ?>">
      <?php } ?>
      <div class="col-md-6">
      <label for="inputState" class="form-label">Agencia</label>
      <select id="agenciaid" name="agenciaid" class="form-select" required>
        <option <?php if($nuevo==true){echo "selected disabled";}else{echo "disabled";} ?> value="">ELEGIR...</option>
        <?php foreach ($agencias->getResult() as $itemproducto): ?>
        <option value="<?= $itemproducto->AGENCIAID ?>" <?php if($nuevo==false){if($itemproducto->AGENCIAID==$datosPago[0]->AGENCIAID){echo "selected";}} ?>><?= $itemproducto->AGENCIA ?></option>
        <?php endforeach; ?>
      </select>
    </div>
      <div class="col-md-6">
      <label for="inputState" class="form-label">Tipo de Pago</label>
      <select id="tipopagoid" name="tipopagoid" class="form-select" required>
        <option <?php if($nuevo==true){echo "selected disabled";}else{echo "disabled";} ?> value="">ELEGIR...</option>
        <?php foreach ($tipopago->getResult() as $itemproducto): ?>
        <option value="<?= $itemproducto->TIPOPAGOID ?>" <?php if($nuevo==false){if($itemproducto->TIPOPAGOID==$datosPago[0]->TIPOPAGOID){echo "selected";}} ?>><?= $itemproducto->TIPOPAGO ?></option>
        <?php endforeach; ?>
      </select>
    </div>
      <div class="col-md-6">
      <label for="inputState" class="form-label">Colectores</label>
      <select id="colectorid" name="colectorid" class="form-select" required>
        <option <?php if($nuevo==true){echo "selected disabled";}else{echo "disabled";} ?> value="">ELEGIR...</option>
        <?php foreach ($colectores->getResult() as $itemproducto): ?>
        <option value="<?= $itemproducto->COLECTORID ?>" <?php if($nuevo==false){if($itemproducto->COLECTORID==$datosPago[0]->COLECTORID){echo "selected";}} ?>><?= $itemproducto->COLECTOR ?></option>
        <?php endforeach; ?>
      </select>
    </div>
      <div class="col-md-6">
      <label for="inputState" class="form-label">Tipo de Movimiento</label>
      <select id="tipomovimientoid" name="tipomovimientoid" class="form-select" required>
        <option <?php if($nuevo==true){echo "selected disabled";}else{echo "disabled";} ?> value="">ELEGIR...</option>
        <?php foreach ($tipomovimiento->getResult() as $itemproducto): ?>
        <option value="<?= $itemproducto->TIPOMOVIMIENTOID ?>" <?php if($nuevo==false){if($itemproducto->TIPOMOVIMIENTOID==$datosPago[0]->TIPOMOVIMIENTOID){echo "selected";}} ?>><?= $itemproducto->TIPOMOVIMIENTO ?></option>
        <?php endforeach; ?>
      </select>
    </div>
      <div class="col-md-6">
      <label for="inputState" class="form-label">Forma de Pago</label>
      <select id="formapagoid" name="formapagoid" class="form-select" required>
        <option <?php if($nuevo==true){echo "selected disabled";}else{echo "disabled";} ?> value="">ELEGIR...</option>
        <?php foreach ($formapago->getResult() as $itemproducto): ?>
        <option value="<?= $itemproducto->FORMAPAGOID ?>" <?php if($nuevo==false){if($itemproducto->FORMAPAGOID==$datosPago[0]->FORMAPAGOID){echo "selected";}} ?>><?= $itemproducto->FORMAPAGO ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <?php if($clienteelegido){ ?>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">CLIENTE</label>
      <?php if($cliente!=null){ ?>
          <input type="text" class="form-control" id="nombrecliente" name="nombrecliente" value="<?= $cliente ?>" >
      <?php } elseif ($datosPago[0]==null) { ?>
          <input type="text" class="form-control" id="nombrecliente" name="nombrecliente" >
      <?php } ?>
    </div>
    <?php }?>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Referencia</label>
      <?php if($ref!=null){ ?>
          <input type="text" class="form-control" id="referencia" name="referencia" value="<?= $ref ?>" required>
      <?php } elseif ($datosPago[0]==null) { ?>
          <input type="text" class="form-control" id="referencia" name="referencia" required>
      <?php } else { ?>
        <input type="text" class="form-control" id="referencia" name="referencia" value="<?= $datosPago[0]->REFERENCIA ?>" required>
      <?php } ?>
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Monto</label>
      <?php if($datosPago[0]==null){ ?>
        <input type="number" step=".01" class="form-control" id="monto" name="monto" required>
      <?php } else { ?>
        <input type="number" step=".01" class="form-control" id="monto" name="monto" value="<?= $datosPago[0]->MONTO ?>" required >
      <?php } ?>
    </div>
      <button type="submit" class="btn btn-primary"><?= esc($txtbtn) ?></button>
    </div>
  </form>
</div>
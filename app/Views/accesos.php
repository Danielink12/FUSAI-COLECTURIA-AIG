<div class="formdivaccesos">
    <h2 class="titulo">ACCESOS</h2>
    <form action="">
    <div class="col-md-6">
      <label for="inputState" class="form-label">Tipos de Usuario</label>
      <select id="tipousuarioid" name="tipousuarioid" class="form-select">
        <option value="">TODOS...</option>
        <?php foreach ($tipousuarios->getResult() as $itemtp): ?>
        <option value="<?= $itemtp->TIPOUSUARIOID ?>" ><?= $itemtp->TIPOUSUARIO ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-6">
      <label for="inputState" class="form-label">Usuarios</label>
      <select id="agenciaid" name="agenciaid" class="form-select" >
        <option value="">TODOS...</option>
        <?php foreach ($usuarios->getResult() as $itemu): ?>
        <option value="<?= $itemu->USUARIOID ?>" ><?= $itemu->USUARIO ?></option>
        <?php endforeach; ?>
      </select>
      <br>
    </div>
        <?php foreach ($accesos->getResult() as $itemmenu): ?>
            <div>
                <?php if(($itemmenu->PADREID)==0){ ?>
                    <ul>
                        <?= $itemmenu->MENU ?>
                        <label><input class="form-check-input" type="checkbox" id="<?= "ck".$itemmenu->MENUID ?>" value=""></label>
                        <?php foreach ($accesos->getResult() as $itemmenu2): ?>
                        <?php if(($itemmenu->MENUID)==$itemmenu2->PADREID){ ?>
                            <li>
                                <?= $itemmenu2->MENU ?>
                                <label><input class="form-check-input" type="checkbox" id="<?= "ck".$itemmenu2->MENUID ?>" value=""></label>
                            </li>
                        <?php } ?>
                        <?php endforeach; ?>
                    </ul>
                <?php } ?>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-primary">GUARDAR</button>
    </form>
    <!-- <a class="btn btn-primary btnnuevo" href="Pagos/vistaCrearPago/" role="button">Nuevo</a> -->
</div>
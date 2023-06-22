<div class="formdivaccesos">
    <h2 class="titulo">ACCESOS</h2>
    <form class="form1" id="form1" action="<?= $urlpost ?>" method="post">
    <div class="col-md-6">
      <label for="inputState" class="form-label">Tipos de Usuario</label>
      <select id="tipousuarioid" name="tipousuarioid" onchange="onSelectChange()" class="form-select">
        <option value="">TODOS...</option>
        <?php foreach ($tipousuarios->getResult() as $itemtp): ?>
        <option value="<?= $itemtp->TIPOUSUARIOID ?>" <?php if($tipousuarioid!=null){if($itemtp->TIPOUSUARIOID==$tipousuarioid){echo "selected";}} ?>><?= $itemtp->TIPOUSUARIO ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-6">
      <label for="inputState" class="form-label">Usuarios</label>
      <select id="usuarioid" name="usuarioid" onchange="onSelectChange()" class="form-select" >
        <option value="">TODOS...</option>
        <?php foreach ($usuarios->getResult() as $itemu): ?>
        <option value="<?= $itemu->USUARIOID ?>" <?php if($usuarioid!=null){if($itemu->USUARIOID==$usuarioid){echo "selected";}} ?>><?= $itemu->USUARIO ?></option>
        <?php endforeach; ?>
      </select>
      <br>
    </div>
        <?php if($accesos!=null){ ?>
            <?php foreach ($accesos->getResult() as $itemmenu): ?>
                <div>
                    <?php if(($itemmenu->PADREID)==0){ ?>
                        <ul>
                            <?= $itemmenu->MENU ?>
                            <label><input class="form-check-input" type="checkbox" id="<?= "ck".$itemmenu->MENUID ?>"  name="<?= "ck".$itemmenu->MENUID ?>" value="" <?php foreach ($axtu->getResult() as $axtuf): 
                                                                                                                                      if($itemmenu->MENUID==$axtuf->MENUID){
                                                                                                                                        echo "checked";
                                                                                                                                      }
                                                                                                                                     endforeach?>></label>
                            <?php foreach ($accesos->getResult() as $itemmenu2): ?>
                            <?php if(($itemmenu->MENUID)==$itemmenu2->PADREID){ ?>
                                <li>
                                    <?= $itemmenu2->MENU ?>
                                    <label><input class="form-check-input" type="checkbox" id="<?= "ck".$itemmenu2->MENUID ?>" name="<?= "ck".$itemmenu2->MENUID ?>" value="" <?php if($axu!=null){ 
                                                                                                                                                  foreach ($axu->getResult() as $axuf): 
                                                                                                                                                    if($itemmenu2->MENUID==$axuf->MENUID){
                                                                                                                                                      echo "checked";
                                                                                                                                                    };
                                                                                                                                                  endforeach;
                                                                                                                                                }?>></label>
                                </li>
                            <?php } ?>
                            <?php endforeach; ?>
                        </ul>
                    <?php } ?>
                </div>
            <?php endforeach; ?>
          <button type="submit" class="btn btn-primary">GUARDAR</button>
        <?php } ?>
    </form>
    <script>
      function onSelectChange(){
       document.getElementById('form1').submit();
      }
    </script>
    <!-- <a class="btn btn-primary btnnuevo" href="Pagos/vistaCrearPago/" role="button">Nuevo</a> -->
</div>
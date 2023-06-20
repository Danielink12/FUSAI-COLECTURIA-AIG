<div class="formdivagencias">
    <h2 class="titulo">REPORTE EXCEL</h2>
    <form class="row g-3" method="post" action="<?= $urlpost ?>">
        <div class="col-md-6">
            <label for="date" class="form-label">Desde</label>
            <div class="input-group date" id="datepicker">
                    <input type="text" class="form-control" id="desde" name="desde">
                    <span class="input-group-append">
                        <span class="input-group-text bg-white d-block">
                            <i class="fa fa-calendar"></i>
                        </span>
                       </span>
            </div>
        </div>
        <div class="col-md-6">
            <label for="date" class="form-label">Hasta</label>
            <div class="input-group date" id="datepicker2">
                    <input type="text" class="form-control" id="hasta" name="hasta">
                    <span class="input-group-append">
                        <span class="input-group-text bg-white d-block">
                            <i class="fa fa-calendar"></i>
                        </span>
                       </span>
                </div>
        </div>
        <div class="col-md-6">
          <label for="inputState" class="form-label">Agencias</label>
            <select id="agenciaid" name="agenciaid" class="form-select" required>
              <option value="0" value="">TODOS...</option>   
              <?php foreach ($agencias->getResult() as $itemagencias): ?>
              <option value="<?= $itemagencias->AGENCIAID ?>" ><?= $itemagencias->AGENCIA ?></option>
              <?php endforeach; ?> 
            </select>
        </div>
        <div class="col-md-6">
          <label for="inputState" class="form-label">Colectores</label>
            <select id="colectorid" name="colectorid" class="form-select" required>
              <option value="0" value="">TODOS...</option>   
              <?php foreach ($colectores->getResult() as $itemcolectores): ?>
              <option value="<?= $itemcolectores->COLECTORID ?>"><?= $itemcolectores->COLECTOR ?></option>
              <?php endforeach; ?> 
            </select>
        </div>
        <div class="col-md-6">
          <label for="inputState" class="form-label">Clientes</label>
            <select id="clienteid" name="clienteid" class="form-select" required>
              <option value="0" value="">TODOS...</option>   
              <?php foreach ($clientes->getResult() as $itemclientes): ?>
              <option value="<?= $itemclientes->CLIENTEID ?>"><?= $itemclientes->CLIENTE ?></option>
              <?php endforeach; ?> 
            </select>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">DESCARGAR</button>
        </div>
    </form>
    <script type="text/javascript">
        $(function() {
            $('#datepicker').datepicker({
                format: 'dd/mm/yyyy'
            });
            $('#datepicker2').datepicker({
                format: 'dd/mm/yyyy'
            });
        });
    </script>
    <!-- <a class="btn btn-primary btnnuevo" href="Categoria/vistaCrearCategoria/" role="button">Nuevo</a> -->
</div>
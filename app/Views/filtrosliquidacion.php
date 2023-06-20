<div class="formdivagencias">
    <h2 class="titulo">LIQUIDACION</h2>
    <form class="row g-3" method="post" action="<?= $urlpost ?>">
        <div class="col-md-6">
            <label for="date" class="form-label">Desde</label>
            <div class="input-group date" id="datepicker">
                    <input type="text" class="form-control" id="desde" name="desde" required>
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
                    <input type="text" class="form-control" id="hasta" name="hasta" required>
                    <span class="input-group-append">
                        <span class="input-group-text bg-white d-block">
                            <i class="fa fa-calendar"></i>
                        </span>
                       </span>
                </div>
        </div>
        <?php if($liqpendiente[0]->FECHA!=null){ ?>
        <div class="alert alert-warning" role="alert" align="center">
            <?php echo "TIENE LIQUIDACIONES PENDIENTES DESDE ".$liqpendiente[0]->FECHA; ?>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                VER AQUI
            </button>
        </div>
        <?php } ?>
        <div class="col-12" align="center">
            <button type="submit" class="btn btn-primary">COMPROBAR</button>
        </div>
    </form>
    <button type="button" class="btn btn-primary" align="center" data-bs-toggle="modal" data-bs-target="#liquidaciones">
                VER LIQUIDACIONES
    </button>
    <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Pagos pendientes de liquidacion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?= $tablapendientes ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="liquidaciones" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Historico de Liquidaciones</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?= $tablaliquidaciones ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
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
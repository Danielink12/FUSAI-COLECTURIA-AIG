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
        </div>
        <?php } ?>
        <div class="col-12" align="center">
            <button type="submit" class="btn btn-primary">COMPROBAR</button>
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
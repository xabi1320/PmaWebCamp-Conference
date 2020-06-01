<?php
    include_once 'functions/sessions.php';
    include_once 'templates/header.php';
    include_once 'functions/functions.php';
    include_once 'templates/bar.php';
    include_once 'templates/nav.php';
?>




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Crear Categoría de Eventos
        <small>llenar el formulario  para crear una Categoría</small>
      </h1>
    </section>

    <div class="row">
        <div class="col-md-8">

        
            <!-- Main content -->
            <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Crear Administrador</h3>
                </div>
                <div class="box-body">
                    <!-- form start -->
                    <form role="form"  name="guardar-registro" id="guardar-registro" method="post" action="modelo-categoria.php">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="usuario">Nombre</label>
                                <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" placeholder="Categoría">
                            </div>

                            <div class="form-group">
                                <label for="">Icono</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-address-book"></i>
                                    </div>
                                    <input type="text" name="icono" id="icono" class="form-control pull-right" placeholder="fa-icon">
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="hidden" name="registro" value="nuevo">
                            <button type="submit" class="btn btn-primary" id="crear_registro">Añadir</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            </section>
            <!-- /.content -->
            </div>

        </div>
    </div>
  <!-- /.content-wrapper -->

<?php
    include_once 'templates/footer.php';
?>




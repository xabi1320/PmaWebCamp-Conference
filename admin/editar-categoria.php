<?php

    $id = $_GET['id'];

    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        die("¡ERROR!");
    }
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
        Editar Categoría de Eventos
        <small>Llenar el formulario para editar una Categoría</small>
      </h1>
    </section>

    <div class="row">
        <div class="col-md-8">

        
            <!-- Main content -->
            <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar Categoría</h3>
                </div>
                <div class="box-body">
                    <?php 
                        $sql = "SELECT * FROM categoria_evento WHERE id_categoria = $id";
                        $resultado = $conn->query($sql);
                        $categoria = $resultado->fetch_assoc();
                    ?>
                    <!-- form start -->
                    <form role="form"  name="guardar-registro   " id="guardar-registro" method="post" action="modelo-categoria.php">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control" name="nombre_categoria" id="nombre_categoria" placeholder="Categoría" value="<?php echo $categoria['cat_evento']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Icono</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-address-book"></i>
                                    </div>
                                    <input type="text" name="icono" id="icono" class="form-control pull-right" placeholder="fa-icon" value="<?php echo $categoria['icono']; ?>">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="hidden" name="registro" value="actualizar">
                            <input type="hidden" name="id_registro" value="<?php echo $id ?>">
                            <button type="submit" class="btn btn-primary">Guardar</button>
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




<?php
    include_once 'functions/sessions.php';
    include_once 'templates/header.php';
    include_once 'functions/functions.php';
    $id = $_GET['id'];

    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        die("¡ERROR!");
    }
    include_once 'templates/bar.php';
    include_once 'templates/nav.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Administrador
        <small>Puede Editar los datos del administrador aquí</small>
      </h1>
    </section>

    <div class="row">
        <div class="col-md-8">

        
            <!-- Main content -->
            <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar Administrador</h3>
                </div>
                <div class="box-body">
                    <?php 
                        $sql = "SELECT * FROM admins WHERE id_admin = $id";
                        $resultado = $conn->query($sql);
                        $admin = $resultado->fetch_assoc();
                    ?>
                    <!-- form start -->
                    <form role="form"  name="guardar-registro   " id="guardar-registro" method="post" action="modelo-admin.php">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control" name="usuario" placeholder="Usuario" value="<?php echo $admin['usuario'] ?>">
                            </div>

                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control"  name="nombre" placeholder="Tu Nombre Completo" value="<?php echo $admin['nombre'] ?>">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password  para iniciar sesion">
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




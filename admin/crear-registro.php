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
        Crear Registro de Usuario
        <small>llenar el formulario para crear un Usuario manualmente</small>
      </h1>
    </section>

    <div class="row">
        <div class="col-md-8">

        
            <!-- Main content -->
            <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Crear Usuario</h3>
                </div>
                <div class="box-body">
                    <!-- form start -->
                    <form role="form"  name="guardar-registro" id="guardar-registro" method="post" action="modelo-registrado.php">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nombre_registrado">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                            </div>

                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="email">
                            </div>

                            <div class="form-group">
                                    <div id="packages" class="packages">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Elige el número de Boletos</h3>
                                        </div>
                                        <ul class="prices-list clearfix row">
                                            <li class="col-md-4">
                                                <div class="price-table text-center">
                                                    <h3>Pase por día (Viernes)</h3>
                                                    <p class="numbers">$30</p>
                                                    <ul>
                                                        <li>Bocadillos gratis</li>
                                                        <li>Todas las conferencias</li>
                                                        <li>Todos los talleres</li>
                                                    </ul>
                                                    <div class="order">
                                                        <label for="day_pass">Boletos deseados</label>
                                                        <input type="number" class="form-control" id="day_pass" min="0" size="3" name="tickets[un_dia][quantity]" placeholder="0">
                                                        <input type="hidden" value="30" name="tickets[un_dia][price]">
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="col-md-4">
                                                <div class="price-table text-center">
                                                    <h3>Todos los días</h3>
                                                    <p class="numbers">$50</p>
                                                    <ul>
                                                        <li>Bocadillos gratis</li>
                                                        <li>Todas las conferencias</li>
                                                        <li>Todos los talleres</li>
                                                    </ul>
                                                    <div class="order">
                                                        <label for="full_pass">Boletos deseados</label>
                                                        <input type="number" class="form-control" id="full_pass" min="0" size="3" name="tickets[completo][quantity]" placeholder="0">
                                                        <input type="hidden" value="50" name="tickets[completo][price]">
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="col-md-4">
                                                <div class="price-table text-center">
                                                    <h3>Pase por 2 días (Viernes y Sábado)</h3>
                                                    <p class="numbers">$45</p>
                                                    <ul>
                                                        <li>Bocadillos gratis</li>
                                                        <li>Todas las conferencias</li>
                                                        <li>Todos los talleres</li>
                                                    </ul>
                                                    <div class="order">
                                                        <label for="day2_pass">Boletos deseados</label>
                                                        <input type="number" class="form-control" id="day2_pass" min="0" size="3" name="tickets[dos_dias][quantity]" placeholder="0">
                                                        <input type="hidden" value="45" name="tickets[dos_dias][price]">
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                            </div>

                            <div class="form-group">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Elige los talleres</h3>
                                </div>
                                <div id="eventos" class="eventos clearfix">
                                        <div class="box">
                                            <?php
                                                try {
                                                    $sql = "SELECT eventos.*, categoria_evento.cat_evento, invitados.nombre_invitado, invitados.apellido_invitado ";
                                                    $sql .= " FROM eventos ";
                                                    $sql .= " JOIN categoria_evento ";
                                                    $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                                                    $sql .= " JOIN invitados ";
                                                    $sql .= " ON eventos.id_inv = invitados.invitado_id ";
                                                    $sql .= " ORDER BY eventos.fecha_evento, eventos.id_cat_evento, eventos.hora_evento ";
                                                    $resultado = $conn->query($sql);
                                                } catch (Exception $e) {
                                                    echo $e->getMessage();
                                                }

                                                $eventos_dias = array();
                                                while ($eventos = $resultado->fetch_assoc()) {
                                                    $fecha = $eventos['fecha_evento'];
                                                    setlocale(LC_ALL, 'esm.UTF-8');
                                                    $dia_semana = strftime("%A", strtotime($fecha));
                                                    
                                                    $categoria = $eventos['cat_evento'];

                                                    $dia = array(
                                                        'nombre' => $eventos['nombre_evento'],
                                                        'hora' => $eventos['hora_evento'],
                                                        'id' => $eventos['evento_id'],
                                                        'nombre_invitado' => $eventos['nombre_invitado'],
                                                        'apellido_invitado' => $eventos['apellido_invitado']
                                                    );
                                                    $eventos_dias[$dia_semana]['eventos'][$categoria][] = $dia;
                                                }

                                            ?>

                                            <?php foreach ($eventos_dias as $dia => $eventos) { ?>
                                                <div id="<?php echo str_replace('á', 'a', $dia); ?>" class="day-content clearfix row">
                                                    <h4 class="text-center nombre_dia"><?php echo $dia; ?></h4>

                                                    <?php foreach($eventos['eventos'] as $tipo => $evento_dia): ?>
                                                        <div class="col-md-4">
                                                            <p><?php echo $tipo; ?></p>

                                                            <?php foreach($evento_dia as $evento) { ?>
                                                                <label>
                                                                    <input type="checkbox" class="minimal" name="registro_evento[]" id="<?php echo $evento['id']; ?>" value="<?php echo $evento['id']; ?>">
                                                                    <time><?php echo $evento['hora']; ?></time> <?php echo $evento['nombre']; ?>
                                                                    <br>
                                                                    <span class="autor"><?php echo $evento['nombre_invitado'] . " " . $evento['apellido_invitado']; ?></span>
                                                                </label>
                                                            <?php } //foreach ?>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <!--.contenido-dia-->
                                            <?php } ?>
                                        </div>
                                        <!--.box-->
                                    </div>
                                    <!--#eventos-->

                                    <div id="resumen" class="resumen clearfix">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Pago y Extras</h3>
                                        </div>
                                        <br>
                                        <div class="box clearfix row">
                                            <div class="extras col-md-6">
                                                <div class="order">
                                                    <label for="shirt_event">Camisa del evento $10 <small>(promocion 7% dto.)</small></label>
                                                    <input type="number" class="form-control" min="0" id="shirt_event" name= "order_xtra[shirt][quantity]" size="3" placeholder="0">
                                                    <input type="hidden" value="10" name="order_xtra[shirt][price]">
                                                </div>
                                                <!--Order-->

                                                <div class="order">
                                                    <label for="labels">Paquete de 10 etiquetas $2<small>(HTML5, CSS3, JavaScript, Chrome)</small></label>
                                                    <input type="number" class="form-control" min="0" id="labels" size="3" name= "order_xtra[labels][quantity]"  placeholder="0">
                                                    <input type="hidden" value="2" name="order_xtra[labels][price]">
                                                </div>
                                                <!--Order-->

                                                <div class="order">
                                                    <label for="gift">Selecione  un regalo</label><br>
                                                    <select id="gift" name="gift" required class="form-control seleccionar">
                                                        <option value="">--Seleccione un regalo--</option>
                                                        <option value="2" >Etiqueta</option>
                                                        <option value="1" >Pulseras</option>
                                                        <option value="3" >Boligrafos</option>
                                                    </select>
                                                </div>
                                                <!--Order-->
                                                <br>

                                                <input type="button" id="calculate" class="btn btn-success" value="Calcular">
                                            </div>
                                            <!--Extras-->

                                            <div class="total col-md-6">
                                                <p>Resumen</p>

                                                <div id="products-list">

                                                </div>
                                                <p>Total</p>
                                                <div id="total-sum">

                                                </div>
                                                <input type="hidden" name="total_order" id="total_order">
                                            </div>
                                            <!--Total-->
                                        </div>
                                        <!--Box-->
                                    </div>
                                    <!--Resumen-->
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="hidden" name="registro" value="nuevo">
                            <button type="submit" class="btn btn-primary" id="btnRegistry">Añadir</button>
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




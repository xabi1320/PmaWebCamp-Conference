<?php include_once 'includes/templates/header.php';?>

    <section class="section container">
        <h2>Registro de Usuarios</h2>

        <form action="pagar.php" class="registry" id="registry" method="POST">
            <div id="user_data" class="registry box clearfix">
                <div class="field">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre">
                </div>

                <div class="field">
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" placeholder="Tu Apellido">
                </div>

                <div class="field">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" placeholder="Tu Email">
                </div>
                <div id="error"></div>
            </div>
            <!--User_Data-->

            <div id="packages" class="packages">
                <h3>Elige el número de boletos</h3>

                <ul class="prices-list clearfix">
                    <li>
                        <div class="price-table">
                            <h3>Pase por día (Viernes)</h3>
                            <p class="numbers">$30</p>
                            <ul>
                                <li>Bocadillos gratis</li>
                                <li>Todas las conferencias</li>
                                <li>Todos los talleres</li>
                            </ul>
                            <div class="order">
                                <label for="day_pass">Boletos deseados</label>
                                <input type="number" id="day_pass" min="0" size="3" name="tickets[un_dia][quantity]" placeholder="0">
                                <input type="hidden" value="30" name="tickets[un_dia][price]">
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="price-table">
                            <h3>Todos los días</h3>
                            <p class="numbers">$50</p>
                            <ul>
                                <li>Bocadillos gratis</li>
                                <li>Todas las conferencias</li>
                                <li>Todos los talleres</li>
                            </ul>
                            <div class="order">
                                <label for="full_pass">Boletos deseados</label>
                                <input type="number" id="full_pass" min="0" size="3" name="tickets[completo][quantity]" placeholder="0">
                                <input type="hidden" value="50" name="tickets[completo][price]">
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="price-table">
                            <h3>Pase por 2 días (Viernes y Sábado)</h3>
                            <p class="numbers">$45</p>
                            <ul>
                                <li>Bocadillos gratis</li>
                                <li>Todas las conferencias</li>
                                <li>Todos los talleres</li>
                            </ul>
                            <div class="order">
                                <label for="day2_pass">Boletos deseados</label>
                                <input type="number" id="day2_pass" min="0" size="3" name="tickets[dos_dias][quantity]" placeholder="0">
                                <input type="hidden" value="45" name="tickets[dos_dias][price]">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!--Packages-->

            <div id="eventos" class="eventos clearfix">
                <h3>Elige tus talleres</h3>
                <div class="box">
                    <?php
                         try {
                            require_once('includes/functions/bd_connection.php');
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
                        <div id="<?php echo str_replace('á', 'a', $dia); ?>" class="day-content clearfix">
                            <h4><?php echo $dia; ?></h4>

                            <?php foreach($eventos['eventos'] as $tipo => $evento_dia): ?>
                                <div>
                                    <p><?php echo $tipo; ?></p>

                                    <?php foreach($evento_dia as $evento) { ?>
                                        <label>
                                            <input type="checkbox" name="registro[]" id="<?php echo $evento['id']; ?>" value="<?php echo $evento['id']; ?>">
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
                <h3>Pago y Extras</h3>

                <div class="box clearfix">
                    <div class="extras">
                        <div class="order">
                            <label for="shirt_event">Camisa del evento $10 <small>(promocion 7% dto.)</small></label>
                            <input type="number" min="0" id="shirt_event" name= "order_xtra[shirt][quantity]" size="3" placeholder="0">
                            <input type="hidden" value="10" name="order_xtra[shirt][price]">
                        </div>
                        <!--Order-->

                        <div class="order">
                            <label for="labels">Paquete de 10 etiquetas $2<small>(HTML5, CSS3, JavaScript, Chrome)</small></label>
                            <input type="number" min="0" id="labels" size="3" name= "order_xtra[labels][quantity]"  placeholder="0">
                            <input type="hidden" value="2" name="order_xtra[labels][price]">
                        </div>
                        <!--Order-->

                        <div class="order">
                            <label for="gift">Selecione  un regalo</label><br>
                            <select id="gift" name="gift" required>
                                <option value="">--Seleccione un regalo--</option>
                                <option value="2" >Etiqueta</option>
                                <option value="1" >Pulseras</option>
                                <option value="3" >Boligrafos</option>
                            </select>
                        </div>
                        <!--Order-->

                        <input type="button" id="calculate" class="button" value="Calcular">
                    </div>
                    <!--Extras-->

                    <div class="total">
                        <p>Resumen</p>

                        <div id="products-list">

                        </div>
                        <p>Total</p>
                        <div id="total-sum">

                        </div>
                        <input type="hidden" name="total_order" id="total_order">
                        <input type="submit" id="btnRegistry" name="submit" class="button" value="Pagar">
                    </div>
                    <!--Total-->
                </div>
                <!--Box-->
            </div>
            <!--Resumen-->
        </form>
    </section>

<?php include_once 'includes/templates/footer.php';?>
<?php include_once 'includes/templates/header.php';?>
    <section class="section container">
        <h2>La Mejor conferencia de diseño web en español</h2>
        <p>Duis ac erat mattis quam faucibus tempor in quis odio. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc condimentum sit amet nibh vitae luctus. Pellentesque at vulputate dui
        </p>

    </section>
    <!--Section-->

    <section class="program">
        <div class="video-container">
            <video muted>
                <source  src="video/video.mp4" type="video/mp4" autoplay loop>
                <source src="video/video.webm" type="video/mp4" autoplay loop>
                <source src="video/video.ogv" type="video/mp4" autoplay loop>
            </video>
        </div>
        <!--Video-container--->

        <div class="program-content">
            <div class="container">
                <div class="program-event">
                    <h2>Programa del Evento</h2>

                    <?php
                        try{
                            require_once('includes/functions/bd_connection.php');
                            $sql = " SELECT * FROM `categoria_evento` ";
                            $result = $conn->query($sql);
                        } catch(Exception $e){ 
                            $error = $e->getMessage();
                        }
                    ?>

                    <nav class="menu-program">
                        <?php while($cat = $result->fetch_array(MYSQLI_ASSOC)) {?>
                            <?php $category = $cat['cat_evento'] ?>    
                                <a href="#<?php echo strtolower($category) ?>">
                                    <i class="fa <?php echo $cat['icono'] ?>" aria-hidden="true"></i><?php echo $category ?>
                                </a>
                        <?php } ?>    
                    </nav>

                    <?php
                        try{
                            require_once('includes/functions/bd_connection.php');
                            $sql = " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";
                            $sql .= " FROM eventos ";
                            $sql .= " INNER JOIN categoria_evento ";
                            $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                            $sql .= " INNER JOIN invitados ";
                            $sql .= " ON eventos.id_inv = invitados.invitado_id ";
                            $sql .= " and eventos.id_cat_evento = 1 ";
                            $sql .= " ORDER BY `evento_id` LIMIT 2; ";
                            $sql .= " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";
                            $sql .= " FROM eventos ";
                            $sql .= " INNER JOIN categoria_evento ";
                            $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                            $sql .= " INNER JOIN invitados ";
                            $sql .= " ON eventos.id_inv = invitados.invitado_id ";
                            $sql .= " and eventos.id_cat_evento = 2 ";
                            $sql .= " ORDER BY `evento_id` LIMIT 2; ";
                            $sql .= " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";
                            $sql .= " FROM eventos ";
                            $sql .= " INNER JOIN categoria_evento ";
                            $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                            $sql .= " INNER JOIN invitados ";
                            $sql .= " ON eventos.id_inv = invitados.invitado_id ";
                            $sql .= " and eventos.id_cat_evento = 3 ";
                            $sql .= " ORDER BY `evento_id` LIMIT 2; "; 
                        } catch(Exception $e){
                            echo $e->getMessage();
                        }
                    ?>


                    <?php $conn->multi_query($sql); ?>

                    <?php 
                        do {
                            $result = $conn->store_result();
                            $row = $result->fetch_all(MYSQLI_ASSOC); ?>

                            <?php $i=0; ?>
                            <?php foreach($row as $event): ?>
                               <?php if($i % 2 == 0) { ?> 
                                    <div  id="<?php echo strtolower
                                    ($event['cat_evento']) ?>" class="info-curso hide clearfix">    
                               <?php } ?>
                                        <div class="event-detail">
                                            <h3><?php echo $event['nombre_evento'] ?></h3>
                
                                            <p><i class="fas fa-clock" aria-hidden="true"></i><?php echo $event['hora_evento']; ?></p>
                                            <p><i class="fas fa-calendar" aria-hidden="true"></i><?php echo $event['fecha_evento']; ?></p>
                                            <p><i class="fas fa-user" aria-hidden="true"></i><?php echo $event['nombre_invitado'] . " ". $event['apellido_invitado']; ?></p>
                                        </div>
                            
                                        
                                <?php if($i % 2 ==1): ?>
                                        <a href="calendario.php" class="button float-right">Ver Todos</a>
                                    </div>
                                    <!--Info-Curso-->
                                <?php endif; ?>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                            <?php $result->free(); ?>
                       <?php } while ($conn->more_results() && $conn->next_result()); 
                    
                    ?>


                </div>
                <!--Program-Event-->
            </div>
            <!--Container-->
        </div>
        <!--Program-Content-->
    </section>
    <!--Program-->

    <?php include_once 'includes/templates/invitados.php';?>

    <div class="counter parallax">
        <div class="container">
            <ul class="event-summary clearfix">

                <li>
                    <p class="numbers"></p>Invitados</li>

                <li>
                    <p class="numbers"></p>Talleres</li>

                <li>
                    <p class="numbers"></p>Días</li>

                <li>
                    <p class="numbers"></p>conferencias</li>

            </ul>
        </div>
        <!--Container-->
    </div>
    <!--Counter-->

    <section class="prices section">
        <h2>Precios</h2>
        <div class="container">
            <ul class="prices-list clearfix">
                <li>
                    <div class="price-table">
                        <h3>Pase por día</h3>
                        <p class="numbers">$30</p>
                        <ul>
                            <li>Bocadillos gratis</li>
                            <li>Todas las conferencias</li>
                            <li>Todos los talleres</li>
                        </ul>
                        <a href="#" class="button hollow">Comprar</a>
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
                        <a href="#" class="button">Comprar</a>
                    </div>
                </li>

                <li>
                    <div class="price-table">
                        <h3>Pase por 2 días</h3>
                        <p class="numbers">$45</p>
                        <ul>
                            <li>Bocadillos gratis</li>
                            <li>Todas las conferencias</li>
                            <li>Todos los talleres</li>
                        </ul>
                        <a href="#" class="button hollow">Comprar</a>
                    </div>
                </li>
            </ul>
            <!--Prices-List-->
        </div>
        <!--Container-->
    </section>
    <!--Prices-->

    <div class="map" id="map"></div>
    <!--Map-->

    <section class="section">
        <h2>Testimoniales</h2>

        <div class="testimonials container clearfix">
            <div class="testimonial">
                <blockquote>
                    <p>Suspendisse eu euismod arcu. Vestibulum at metus dapibus, lobortis risus ut, bibendum nunc. Quisque molestie faucibus elit, vitae dictum sem commodo sit amet. Quisque consequat dictum neque sed porttitor.</p>

                    <footer class="info-testimonial clearfix">
                        <img src="img/testimonial.jpg" alt="Image Testimonial">
                        <cite>Luis Villarreal <span>Diseñador en @prisma</span></cite>
                    </footer>
                </blockquote>
            </div>
            <!--Testimonial-->

            <div class="testimonial">
                <blockquote>
                    <p>Suspendisse eu euismod arcu. Vestibulum at metus dapibus, lobortis risus ut, bibendum nunc. Quisque molestie faucibus elit, vitae dictum sem commodo sit amet. Quisque consequat dictum neque sed porttitor.</p>

                    <footer class="info-testimonial clearfix">
                        <img src="img/testimonial.jpg" alt="Image Testimonial">
                        <cite>Luis Villarreal <span>Diseñador en @prisma</span></cite>
                    </footer>
                </blockquote>
            </div>
            <!--Testimonial-->

            <div class="testimonial">
                <blockquote>
                    <p>Suspendisse eu euismod arcu. Vestibulum at metus dapibus, lobortis risus ut, bibendum nunc. Quisque molestie faucibus elit, vitae dictum sem commodo sit amet. Quisque consequat dictum neque sed porttitor.</p>

                    <footer class="info-testimonial clearfix">
                        <img src="img/testimonial.jpg" alt="Image Testimonial">
                        <cite>Luis Villarreal <span>Diseñador en @prisma</span></cite>
                    </footer>
                </blockquote>
            </div>
            <!--Testimonial-->
        </div>
        <!--testimonials-->
    </section>

    <div class="newsletter parallax">
        <div class="content container">
            <p>Registrate al Newsletter</p>
            <h3>pmawebcamp</h3>
            <a href="#mc_embed_signup" class="button_newsletter button transparent">Registro</a>
        </div>
        <!--Content-->
    </div>
    <!--Newsletter-->

    <section class="section">
        <h2>Faltan</h2>

        <div class="countdown container">
            <ul class="clearfix">
                <li>
                    <p id="days" class="numbers"></p>Días</li>
                <li>
                    <p id="hours" class="numbers"></p>Horas</li>
                <li>
                    <p id="minutes" class="numbers"></p>Minutos</li>
                <li>
                    <p id="seconds" class="numbers"></p>Segundos</li>
            </ul>
            <!--Clearfix-->
        </div>
        <!--Countdown-->
    </section>
    <!--Section-->
<?php include_once 'includes/templates/footer.php';?>

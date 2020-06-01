<?php include_once 'includes/templates/header.php';?>


    <section class="section container">
        <h2>Calendario de eventos</h2>

        <?php
            try{
                require_once('includes/functions/bd_connection.php');
                $sql = " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";
                $sql .= " FROM eventos ";
                $sql .= " INNER JOIN categoria_evento ";
                $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                $sql .= " INNER JOIN invitados ";
                $sql .= " ON eventos.id_inv = invitados.invitado_id ";
                $sql .= " ORDER BY evento_id "; 
                $result = $conn->query($sql);
            } catch(\Exception $e){
                echo $e->getMessage();
            }
        ?>

        <div class="calendar">
            <?php
                $calendar = array();
                while(  $events = $result->fetch_assoc()){
                    
                    //Obtiene fecha del evento

                    $date = $events['fecha_evento'];
                   

                    $event = array(
                        'title' => $events['nombre_evento'],
                        'date' => $events['fecha_evento'],
                        'hour' => $events['hora_evento'],
                        'category' => $events['cat_evento'],
                        'icon' => $events['icono'],
                        'invited' => $events['nombre_invitado']. " " . $events['apellido_invitado']     
                    );

                    $calendar[$date][] = $event;
                    
                    ?>
                     
                <?php } // While de Fetch Assoc()?>

                <?php 
                    //Imprime todo los eventos
                    foreach($calendar as $day => $eventsList){ ?>
                    <h3>
                        <i class="fa fa-calendar"></i>

                        <?php 
                            //Unix
                            setlocale(LC_TIME, 'es_ES.UTF-8');
                            //Windows
                            setlocale(LC_TIME, 'spanish.UTF-8');

                            echo strftime( "%A, %d de %B del %Y", strtotime($day));
                        ?>
                    </h3>

                    <?php foreach($eventsList as $event) {?>
                        <div class="day">
                            <p class="title"><?php echo $event['title']; ?></p>
                            <p class="hour">
                                <i class="fa fa-clock" aria-hidden="true"></i>
                                <?php echo $event['date'] . " " . $event['hour']; ?>
                            </p>
                            <p>
                                <i class="fa <?php echo $event['icon']; ?>" aria-hidden="true"></i>
                                <?php echo $event['category']; ?>
                            </p>
                            <p>
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <?php echo $event['invited']; ?>
                            </p>

                    
                        </div> <!--Day-->
                <?php } //Fin forEach eventos ?>        
                <?php } //Fin forEach dias ?>

        </div> <!--Calendar-->

            <?php
                $conn->close();
            ?>
    </section>
    <!--Section-->

<?php include_once 'includes/templates/footer.php';?>
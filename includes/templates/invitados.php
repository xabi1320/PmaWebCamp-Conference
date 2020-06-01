<section class="section container">
        <?php
            try{
                require_once('includes/functions/bd_connection.php');
                $sql = " SELECT * FROM invitados ";
                $result = $conn->query($sql);
            } catch(Exception $e){
                echo $e->getMessage();
            }
        ?>

        <section class="guests container section">
            <h2>Nuestros Invitados</h2>
            <ul class="guests-list clearfix">
                <?php while(  $inviteds = $result->fetch_assoc()){ ?>
                    <li>
                        <div class="invited">
                            <a class="info-invited" href="#invited<?php echo $inviteds['invitado_id']; ?>">
                                <img src="img/invitados/<?php echo $inviteds['url_imagen']; ?>" alt="Imagen Invitado">
                                <p><?php echo $inviteds['nombre_invitado'] . " " .$inviteds['apellido_invitado']; ?></p>
                            </a>
                        </div>
                    </li>
                    <div style = "display:none">
                        <div class="info-invited" id="invited<?php echo $inviteds['invitado_id']; ?>">
                            <h2><?php echo $inviteds['nombre_invitado'] . " " . $inviteds['apellido_invitado']; ?></h2>
                            <img src="img/<?php echo $inviteds['url_imagen']; ?>" alt="Imagen Invitado">
                            <p><?php echo $inviteds['descripcion']; ?></p>
                        </div>
                    </div>
                <?php } // While de Fetch Assoc()?>

            </ul>
        </section>     

       

        <?php
             $conn->close();
        ?>

    </section>
    <!--Section-->
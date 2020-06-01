<?php if(isset($_POST['submit'])):
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email = $_POST['email'];
  $regalo = $_POST['gift'];
  $total = $_POST['total_order'];
  $fecha = date('Y-m-d H:i:s');
  //PEDIDOS
  $tickets = $_POST['tickets'];
  $shirts = $_POST['order_shirts'];
  $labels = $_POST['order_labels']; 
  include_once 'includes/functions/functions.php';
  $pedidos = productos_json($tickets, $shirts, $labels);
  //EVENTOS
  $events = $_POST['registro'];
  $registry = eventos_json($events);
  try{
   require_once('includes/functions/bd_connection.php');
   $stmt = $conn->prepare("INSERT INTO registrados(nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado) VALUES (?,?,?,?,?,?,?,?)");
   $stmt->bind_param("ssssssis", $nombre, $apellido, $email, $fecha, $pedidos, $registry, $regalo, $total); // por cada cadena de texto se usa la INCIAL del tipo de dato ejemplo un STRING se usaria una 'S' y debe ir en el orden
   $stmt->execute();
   $stmt->close();
   $stmt->close();
   header('Location: validar_registro.php?exitoso=1');
   } catch(Exception $e){
     $error = $e->getMessage();
   } 
   ?>
<?php endif; ?> 
   <?php include_once 'includes/templates/header.php';?>
    <section class="section container">
        <h2>Registro de Usuarios</h2>

        <?php if(isset($_GET['exitoso'])):
            if ($_GET['exitoso'] == "1"):
                echo "Registro exitoso";
            endif;    
        endif; ?>

    </section>
   <?php include_once 'includes/templates/footer.php';?>
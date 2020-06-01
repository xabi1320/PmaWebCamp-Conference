<?php include_once 'includes/templates/header.php';

use PayPal\Rest\ApiContext;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Payment;
require 'includes/paypal.php';
?>
    <section class="section container">
        <h2>Registro de Usuarios</h2>

        <?php
            $paymentId = $_GET['paymentId'];
            $id_pago = (int) $_GET['id_pago'];

            //Peticion a REST API
            $pago = Payment::get($paymentId, $apiContext);
            $execution = new PaymentExecution();
            $execution->setPayerId($_GET['PayerID']);

            //Resultado  tiene la informacion de la transacción
            $resultado = $pago->execute($execution, $apiContext);
            
            $respuesta = $resultado->transactions[0]->related_resources[0]->sale->state;

            //var_dump($respuesta);

            if ($respuesta == "completed") {
                echo "<div class='correct result'>";
                echo "El pago se ha realizado correctamente <br/>";
                echo "el ID es {$paymentId}";
                echo "</div>";

                require_once('includes/functions/bd_connection.php');
                $stmt = $conn->prepare('UPDATE registrados SET pagado = ? WHERE ID_Registrado = ?');
                $pagado = 1;
                $stmt->bind_param('ii', $pagado, $id_pago);
                $stmt->execute();
                $stmt->close();
                $conn->close();
            }else{
                echo "<div class='error result'>";
                echo "El pago no se realizo";
                echo "</div>";
            }
        ?>

    </section>

<?php include_once 'includes/templates/footer.php';?>
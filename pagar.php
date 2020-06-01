<?php

if (!isset($_POST['submit'])) {
    exit("Hubo un Error");
}

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

require 'includes/paypal.php';

if(isset($_POST['submit'])):
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $regalo = $_POST['gift'];
    $total = $_POST['total_order'];
    $fecha = date('Y-m-d H:i:s');
    //PEDIDOS
    $tickets = $_POST['tickets'];
    $number_tickets = $tickets;
    $shirts = $_POST['order_xtra']['shirt']['quantity'];
    $precioCamisa = $_POST['order_xtra']['shirt']['price'];
    $orderXtra = $_POST['order_xtra'];
    $labels = $_POST['order_xtra']['labels']['quantity'];
    $precioEtiqueta = $_POST['order_xtra']['labels']['price'];
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
     $ID_Registro = $stmt->insert_id;
     $stmt->close();
     $stmt->close();
     //header('Location: validar_registro.php?exitoso=1');
     } catch(Exception $e){
       $error = $e->getMessage();
     } 

endif;

$compra = new Payer();
$compra->setPaymentMethod('paypal');


$articulo = new Item();
$articulo->setName($producto)
         ->setCurrency('USD')
         ->setQuantity(1)
         ->setPrice($precio);

$i = 0;
$arreglo_pedido = array();
foreach ($number_tickets as $key => $value) {
    if ((int) $value['quantity'] > 0) {
        ${"articulo$i"} = new Item();
        $arreglo_pedido[]=  ${"articulo$i"};
        ${"articulo$i"}->setName('Pase: ' . $key)
                       ->setCurrency('USD')
                       ->setQuantity((int) $value['quantity'])
                       ->setPrice((float) $value['price']);
        
        $i++;
    }
}

foreach ($orderXtra as $key => $value) {
    if ((int) $value['quantity'] > 0) {

        if ($key == 'shirt') {
            $precio = (float) $value['price'] * .93;
        } else {
            $precio = (int) $value['price'];
        }
        

        ${"articulo$i"} = new Item();
        $arreglo_pedido[]=  ${"articulo$i"};
        ${"articulo$i"}->setName('Extras: ' . $key)
                       ->setCurrency('USD')
                       ->setQuantity((int) $value['quantity'])
                       ->setPrice($precio);
        
        $i++;
    }
}

$listaArticulos = new ItemList();
$listaArticulos->setItems($arreglo_pedido);


$cantidad = new Amount();
$cantidad->setCurrency('USD')
         ->setTotal($total);


$transaccion = new Transaction();
$transaccion->setAmount($cantidad)
            ->setItemList($listaArticulos)
            ->setDescription('Pago PMAWEBCAMP')
            ->setInvoiceNumber($ID_Registro);

$redireccionar = new RedirectUrls();
$redireccionar->setReturnUrl(URL_SITIO . "/pago_finalizado.php?&id_pago={$ID_Registro}")
              ->setCancelUrl(URL_SITIO . "/pago_finalizado.php?&id_pago={$ID_Registro}");




$pago = new Payment();
$pago->setIntent("sale")
     ->setPayer($compra)
     ->setRedirectUrls($redireccionar)
     ->setTransactions(array($transaccion));

try {
    $pago->create($apiContext); 
} catch (PayPal\Exception\PayPalConnectionException $pce) {
    echo "<pre>";
    print_r(json_decode($pce->getData()));
    exit;
    echo "</pre>";
}

$aprobado = $pago->getApprovalLink();

header("Location: {$aprobado}");

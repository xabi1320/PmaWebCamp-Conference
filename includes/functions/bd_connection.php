<?php 
    $conn = new mysqli('localhost', 'root', 'root', 'pmawebcamp');

    if($conn->connect_error){
        echo $error -> $conn->connect_error;
    }

    if(!mysqli_set_charset($conn, 'utf8')) {
        printf('Error cargando los caracteres', mysqli_error($conn)); 
        exit(); 
    }
?>
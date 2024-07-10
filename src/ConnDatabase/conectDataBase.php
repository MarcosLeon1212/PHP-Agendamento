<?php  
    $servername = 'localhost';
    $dbname = 'schedule';
    $username = 'root';
    $password = "";

    $conn = new mysqli ($servername,  $username, $password, $dbname);
        if($conn -> connect_errno){
            echo 'Falha ao conectar: (' . $conn->connect_errno . ')' . $conn->connect_errno;
        } else {
            echo '';
        }
?>
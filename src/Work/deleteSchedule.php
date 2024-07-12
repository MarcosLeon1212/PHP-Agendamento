<?php 

$servername = 'localhost';
$dbname = 'schedule';
$username = 'root';
$password = "";

$conn = new mysqli ($servername,  $username, $password, $dbname);
    if($conn -> connect_errno){
        echo 'Falha ao conectar: (' . $conn->connect_errno . ')' . $conn->connect_errno;
    }

    session_start();

    if(isset($_POST['id'])){

        $id = $_POST['id'];

    $sql = 'DELETE FROM schedules where id = ?';

        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param('i', $id);

            if($stmt->execute()){
                echo 'Registro deletado com sucesso!<a href="../../public/view/home.php">Voltar</a>';
            } else{
                echo 'Falha ao deletar registo!';
            }

            $stmt->close();
        } else{
            echo 'Erro na preparação da declaração' . $conn->error;
        }
        
            $conn->close();

    } else{
        echo 'ID não fornecido';
    }

    
?>
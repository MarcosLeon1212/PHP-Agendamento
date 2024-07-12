<?php 
    $servername = 'localhost';
    $dbname = 'schedule';
    $username = 'root';
    $password = '';

    $conn = new mysqli ($servername,  $username, $password, $dbname);
    if($conn -> connect_errno){
        echo 'Falha ao conectar: (' . $conn->connect_errno . ')' . $conn->connect_errno;
    } else {
        echo '';
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = 'SELECT * FROM users WHERE email = ?';
        $stmt = $conn->prepare($sql);

        if($stmt){
            echo 'Erro na preparação da consulta: ' . $conn->error;
        }

        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['senha'] = $user['senha'];

                $conn->close();
                $stmt->close();

                header('Location: ../../public/view/home.php');
        }else{
            $conn->close();
            $stmt->close();

            echo 'Senha incorreta. <a href="../../public/view/loginClients.php">Voltar</a>';
        } 
    } else{
        $conn->close();
        $stmt->close();

        echo 'Email não encontrado. <a href="../../public/view/loginClients.php">Voltar</a>';
    }
?>
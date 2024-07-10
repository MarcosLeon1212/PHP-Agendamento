<?php 
    session_start();
    include '../ConnDataBase/conectDataBase.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $name = $_POST['name'];
        $date = $_POST['date'];
        $work = $_POST['work'];
        $price = $_POST['price'];
        $hour = $_POST['hour'];

        $sql = 'INSERT INTO schedules (name, date, work, price, hour) VALUES (?, ?, ?, ?, ?)';

        if ($stmt = $conn->prepare($sql)){
            $stmt->bind_param("sssss", $name, $date, $work, $price, $hour);

            if($stmt -> execute()){
                echo 'Agendamento inserido com sucesso! <a href="../../public/view/home.php">Voltar</a>';
            } else{
                echo 'Falha ao agendar' . $stmt->error;
            }

            $stmt -> close();
        } else {
            echo 'Erro na preparação da declaração' . $conn->error;
        }

        $conn->close();
    } else{
        echo 'Método de Solicitação enviado';
    }

    
    

?>
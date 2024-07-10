<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Boas Vindas</title>
    <link rel="stylesheet" href="../CSS/home.css">
</head>
<body>
    <header>
        <h1 class="header-title">Sistema de Agendamento</h1>
    </header>

    <fieldset class="client-form">
        <legend>Adicione um Cliente</legend>
        <form action="../../src/Work/processHome.php" method="post">
            <label for="name">Nome do Cliente:</label>
            <input type="text" placeholder="Nome do Cliente" id="name" name="name"><br><br>
            <label for="date">Dia do Agendamento:</label>
            <input type="text" onkeyup="formatDate(this)" placeholder="00/00/0000" id="date" name="date"><br><br>
            <label for="work">Serviço:</label>
            <input type="text" placeholder="Digite o Serviço" id="work" name="work"><br><br>
            <label for="price">Preço:</label>
            <input type="text" placeholder="Digite o Preço" id="price" name="price"><br><br>
            <label for="hour">Hora:</label>
            <input type="text" id="hour" name="hour" placeholder="Digite o horário"><br><br>
            <input type="submit" value="Agendar" class="button-schedule">
        </form>
    </fieldset>

    <section id="scheduleList">
        <h2>Agendamentos</h2>
        <?php 
            session_start();

            $servername = 'localhost';
            $dbname = 'schedule';
            $username = 'root';
            $password = "";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_errno) {
                echo 'Falha ao conectar: (' . $conn->connect_errno . ')' . $conn->connect_errno;
            } 

            $sql = 'SELECT * FROM schedules';
            $result = $conn->query($sql);

            $sqlDelete = "DELETE FROM schedules WHERE name = ?";
            $resultDelete = $conn->query($sqlDelete);
            $resultExclude = false;

            if ($result->num_rows) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='schedule-item'>";
                    echo "<p><strong>Nome:</strong> " . $row['name'] . "</p>";
                    echo "<p><strong>Data:</strong> " . $row['date'] . "</p>";
                    echo "<p><strong>Serviço:</strong> " . $row['work'] . "</p>";
                    echo "<p><strong>Preço:</strong> " . $row['price'] . "</p>";
                    echo "<p><strong>Horário:</strong>" . $row['hour'] . "</p>";
                    echo '<button>Exluir Agendamento</button>';
                    echo "</div>";
            }
                
            } else {
                echo "<p>Nenhum agendamento encontrado.</p>";
            }

            $conn->close();
        ?>
    </section>
    
    <script>
        function formatDate(input) {
            var value = input.value;
            value = value.replace(/\D/g, ""); 
            value = value.replace(/^(\d{2})(\d)/, "$1/$2"); 
            value = value.replace(/(\d{2})(\d)/, "$1/$2"); 
            input.value = value; 
        }
    </script>

    <style>
       
    </style>
</body>
</html>

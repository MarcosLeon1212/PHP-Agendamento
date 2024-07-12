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
        <ul class="menu">
            <li><a href="./loginClients.php">É cliente? Fazer Login</a></li>
            <li><a href="./about.php">Sobre</a></li>
            <li><a href="./contact.php">Contatos</a></li>
        </ul>
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
        <form onsubmit="return false;">
            <input type="text" placeholder="Pesquise por um nome" id="search" onkeyup="searchSchedule()">
        </form>
        <div id="result">
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

                $sqlDelete = "DELETE FROM schedules WHERE id = ?";
                $resultDelete = $conn->query($sqlDelete);

                if ($result->num_rows) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='schedule-item'>";
                        echo "<p><strong>Nome:</strong> " . $row['name'] . "</p>";
                        echo "<p><strong>Data:</strong> " . $row['date'] . "</p>";
                        echo "<p><strong>Serviço:</strong> " . $row['work'] . "</p>";
                        echo "<p><strong>Preço:</strong> " . $row['price'] . "</p>";
                        echo "<p><strong>Horário:</strong> " . $row['hour'] . "</p>";
                        echo '<form action="../../src/Work/deleteSchedule.php" method="post">';
                        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                        echo '<input type="submit" value="Excluir Agendamento" class="button-delete">';
                        echo '</form>';
                        echo "</div>";
                    }
                } else {
                    echo "<p class='no-results'>Nenhum agendamento encontrado.</p>";
                }

                $conn->close();
            ?>
        </div>
    </section>
    
    <script>
        function formatDate(input) {
            var value = input.value;
            value = value.replace(/\D/g, ""); 
            value = value.replace(/^(\d{2})(\d)/, "$1/$2"); 
            value = value.replace(/(\d{2})(\d)/, "$1/$2"); 
            input.value = value; 
        }

        function searchSchedule() {
            var search = document.getElementById("search").value;

            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../../src/Work/searchSchedule.php?search=" + encodeURIComponent(search), true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("result").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5; 
            color: #333; 
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #2e8b57; 
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .header-title {
            margin: 0;
            font-size: 2em;
        }

        .menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 20px;
        }

        .menu li {
            display: inline;
        }

        .menu a {
            color: white;
            text-decoration: none;
            font-size: 1.2em;
            padding: 10px 15px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .menu a:hover {
            background-color: #3cb371;
            border-radius: 5px;
        }

        .client-form {
            width: 80%;
            margin: 20px auto;
            background-color: #fff; 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
            transition: box-shadow 0.3s ease; 
        }

        .client-form:hover {
            box-shadow: 0 0 15px rgba(0,0,0,0.2); 
        }

        .client-form legend {
            font-size: 1.2em;
            font-weight: bold;
            color: #2e8b57; 
        }

        .client-form label {
            display: block;
            margin-bottom: 8px;
        }

        .client-form input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc; 
            border-radius: 4px;
            transition: border-color 0.3s ease; 
        }

        .client-form input[type="text"]:focus {
            border-color: #2e8b57; 
        }

        .client-form .button-schedule {
            background-color: #2e8b57; 
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease; 
        }

        .client-form .button-schedule:hover {
            background-color: #3cb371; 
        }

        #scheduleList {
            width: 80%;
            margin: 20px auto;
            background-color: #fff; 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
        }

        #scheduleList h2 {
            color: #2e8b57; 
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        #scheduleList form {
            margin-bottom: 20px;
        }

        #scheduleList input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc; 
            border-radius: 4px;
            transition: border-color 0.3s ease; 
        }

        #scheduleList input[type="text"]:focus {
            border-color: #2e8b57; 
        }

        .schedule-item {
            background-color: #e6ffe6; 
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .schedule-item:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .schedule-item p {
            margin: 5px 0;
            color: #
        }
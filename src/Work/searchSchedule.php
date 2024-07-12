<?php
$servername = 'localhost';
$dbname = 'schedule';
$username = 'root';
$password = "";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_errno) {
    die('Falha ao conectar: (' . $conn->connect_errno . ') ' . $conn->connect_error);
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$search = $conn->real_escape_string($search);

$sqlSearch = "SELECT * FROM schedules WHERE LOWER(name) LIKE LOWER('%$search%')";
$searchResult = $conn->query($sqlSearch);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados da Pesquisa</title>
    
</head>
<body>

<?php
if ($searchResult->num_rows > 0) {
    while ($row = $searchResult->fetch_assoc()) {
        echo "<div class='schedule-item'>";
        echo "<p><strong>Nome:</strong> " . $row['name'] . "</p>";
        echo "<p><strong>Data:</strong> " . $row['date'] . "</p>";
        echo "<p><strong>Serviço:</strong> " . $row['work'] . "</p>";
        echo "<p><strong>Preço:</strong> " . $row['price'] . "</p>";
        echo "<p><strong>Horário:</strong> " . $row['hour'] . "</p>";
        echo '<form action="deleteSchedule.php" method="post">';
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

</body>
</html>

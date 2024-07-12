<?php 
session_start();

$servername = 'localhost';
$dbname = 'schedule';
$username = 'root';
$password = '';

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_errno){
    echo 'Falha ao conectar: (' . $conn->connect_errno . ')' . $conn->connect_error;
    exit();
}

$name = $_POST['name'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$sqlVerificaEmail = 'SELECT * FROM users WHERE email = ?';
$stmtVerificaEmail = $conn->prepare($sqlVerificaEmail);

if(!$stmtVerificaEmail){
    die('Erro na preparação da consulta: ' . $conn->error);
}

$stmtVerificaEmail->bind_param('s', $email);
$stmtVerificaEmail->execute();
$resultVerificaEmail = $stmtVerificaEmail->get_result();

if($resultVerificaEmail->num_rows > 0){
    echo 'Email já cadastrado. Tente outro.';
    $stmtVerificaEmail->close();
    $conn->close();
    exit();
}

$sqlInsereConta = 'INSERT INTO users (name, email, senha) VALUES(?, ?, ?)';
$stmtInsereConta = $conn->prepare($sqlInsereConta);

if(!$stmtInsereConta){
    die('Erro na preparação da consulta: ' . $conn->error);
}

$stmtInsereConta->bind_param('sss', $name, $email, $senha);
if($stmtInsereConta->execute()){
    echo 'Conta cadastrada com sucesso. <a href="../../public/view/loginClients.php">Ir para login</a>';
} else {
    echo 'Erro ao cadastrar conta: ' . $stmtInsereConta->error;
}

$stmtVerificaEmail->close();
$stmtInsereConta->close();
$conn->close();
?>

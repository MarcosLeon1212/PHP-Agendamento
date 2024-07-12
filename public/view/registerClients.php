<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área de Registro</title>
</head>
<body>
    <header>
        <h1>Área de Registro</h1>
        <a href="./loginClients.php">Já tem conta? Faça o login</a>
    </header>

        <form action="../../src/Work/registerProcess.php" method="post">
            <label for="namee">Digite o nome de usuário:</label>
            <input type="text" id="name" name="name"><br><br>

            <label for="email">Digite um email:</label>
            <input type="text" id="email" name="email"><br><br>

            <label for="senha">Digite uma senha segura:</label>
            <input type="password" id="senha" name="senha"><br><br>

            <input type="submit" value="Registrar Conta">
        </form>
</body>
</html>
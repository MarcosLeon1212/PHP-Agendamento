<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área de Login</title>
</head>
<body>
        <header>
                <h1>Área de Login</h1>
                <a href="./registerClients.php">Não tem uma conta?Se registre</a>
        </header>

        <form action="../../src/Work/loginProcess.php" method="post">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email"><br><br>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha"><br><br>
            <input type="submit" value="Login">
        </form>
</body>
</html>
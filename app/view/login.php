<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="./?c=login" method="POST">
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="" required><br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="" required><br>
        <input type="submit" value="Logar">  <a href="./?c=cadastro">Cadastre-se</a>
    </form>
    <p>
        <?= $msg ?>
    </p>
</body>
</html> 
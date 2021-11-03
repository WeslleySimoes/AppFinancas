<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro</title>
    </head>
    <body>
        <a href="./">&lt;&lt;Voltar ao Login</a>
        <h1>Página de Cadastro</h1> 
        <form action="./?c=cadastro" method="post">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required><br>
            <label for="sobrenome">Sobrenome:</label>
            <input type="text" name="sobrenome" required><br>
            <label for="email">E-mail:</label>
            <input type="email" name="email" required><br>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" required><br>
            <label for="confSenha">Confirmar Senha:</label>
            <input type="password" name="confSenha" required><br>
            <input type="submit" value="Cadastrar">
        </form>
        <p>
            <?= $msg ?>
        </p>
    </body>
</html>
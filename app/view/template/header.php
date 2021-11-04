<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">

    <title>Categorias</title>
</head>
<body>
    <div id="menu">
        <h4 id="logo-sistema">Usuario: <?= $usuario_logado ?> | <a href="./?c=deslogar" style="color: white;">Sair</a></h4>
        <ul>
            <li><a href="./?c=home">DashBoard</a></li>
            <li><a href="#">Contas</a></li>
            <li><a href="#">Receitas</a></li>
            <li><a href="#">Despesas</a></li>
            <li><a href="./?c=categorias">Categorias</a></li>
        </ul>
    </div>
    <div id="conteudo">
        <div class="exemplo">
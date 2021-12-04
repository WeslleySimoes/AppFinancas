<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/logo.ico" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">

    <title>Categorias</title>
</head>
<style>
    #sdsd
    {
        /*border: 1px solid black;*/
        background-color: #20293b;
        height: 5vh;
        width: 100%;
        position: fixed;
    }
    #ini-menu{
        width: 20%;
        background-color: #20293b;
        float: left;
        height: 5vh;
    }
    #ini-menu a{
        display: inline-block;
        width: 100%;
        text-align: center;
        color: #EF305E;
        text-decoration: none;
        font-weight: bold;
        padding: 5px;
        font-size: 20px;
    }
    #sdsd h4
    {
        color: white;
        float: right;
        margin-right: 26px;
    }
    #circulo-on{
        display: inline-block;
        background-color: greenyellow;
        width: 10px;
        height: 10px;
        border-radius: 10px;
        margin-right: 2px;
        
    }

    .dropbtn {
        background-color: #20293B;
        height: 5vh;
        color: white;
        font-size: 16px;
        border: none;
        font-weight: bold;
    }

.dropdown {
  position: relative;
  float: right;
  /*display: inline-block;*/
  margin-right: 35px;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #20293b;
  min-width: 200px;
  right: 0.2px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: white;
  font-weight: bold;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #232D3F; color: #EF305E;}

.dropdown:hover .dropdown-content {display: block;}
</style>
<body>
    <div id="sdsd">
        <div id="ini-menu">
            <a href="./">Finanças Pessoais</a>
        </div> 
        <div class="dropdown">
            <button class="dropbtn"> <div id="circulo-on"></div> <?= $usuario_logado ?> &#9207</button> 
            <div class="dropdown-content">
                <a href="./?c=deslogar">Sair</a>
            </div>
        </div> 
    </div>
    <div id="menu">
        <ul>
            <li><a href="./?c=home">DashBoard</a></li>
            <li><a href="./?c=contas">Contas</a></li>
            <li><a href="./?c=receita">Receitas</a></li>
            <li><a href="./?c=despesa">Despesas</a></li>
            <li><a href="./?c=categorias">Categorias</a></li>
            <li><a href="./?c=relatorios">Relatórios</a></li>
        </ul>
    </div>
    <div id="conteudo">
        <div class="exemplo">
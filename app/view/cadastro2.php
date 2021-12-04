<!DOCTYPE html>
<html>
<head>
  <title>Cadastro</title>
  <link rel="shortcut icon" href="assets/logo.ico" type="image/x-icon">
</head>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Full-width input fields */
input[type=text],input[type=email], input[type=password], input[type=submit] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
  font-size: 16px;
}

/* Add a background color when the inputs get focus */
input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width:200%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* The Modal (background) */
.modal {
  display:block; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  padding-top: 50px;
  background-color: #181F2C;;
}

/* Modal Content/Box */
.modal-content {
  background-color: white;
  /*margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  margin: 5vh auto 0 auto;
  border: 1px solid #888;
  width: 40%; /* Could be more or less, depending on screen size */
  /*color: white;*/
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

#titulo-login
{
	text-align: center;
}

.signupbtn
{
	width: 100%;
	font-weight: bold;
	font-size: 19px;
}

#esqueceuSenha, #criarConta{
  display: inline-block;
	text-decoration: none;
	color: black;
	font-weight: bold;
}

#criarConta
{
  float: right;
}

#esqueceuSenha:hover,#criarConta:hover{
	text-decoration: underline;
}

.voltar{
    text-decoration: none;
    color: red;
    font-weight: bold;
}
label{
    font-weight: bold;
}
</style>
<body>
<div id="id01" class="modal">
  <form class="modal-content" action="./?c=cadastro" method="POST">
    <div class="container">
        <a href="./?c=home" class="voltar">&#9204;Voltar</a>
        <h1 id="titulo-login">Cadastro</h1>
        <hr>
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>
    <!--    <label for="sobrenome">Sobrenome:</label>
        <input type="text" name="sobrenome" required><br> -->
        <label for="email">E-mail:</label>
        <input type="email" name="email" required><br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br>
        <label for="confSenha">Confirmar Senha:</label>
        <input type="password" name="confSenha" required><br>
        <div class="clearfix">
            <button type="submit" class="signupbtn">Criar</button>
        </div>
        <p>
            <?= $msg ?>
        </p>
    </div>
  </form>
</div>
</body>
</html>

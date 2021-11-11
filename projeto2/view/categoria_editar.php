<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
    <form action="./editar?id=<?=$_GET['id']?>" method="POST" id="form-categoria">
        <label for="pesquisa">Pesquisar:</label>
        <input type="text" name="pesquisa">
        <input type="submit" value="Enviar"> 
    </form>
    </body>
</html>
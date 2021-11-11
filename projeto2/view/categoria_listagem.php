<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Listagem</title>
    </head>
    <body>
        <div>
            <?= $pesquisa ?> <br><br>
        </div>
        <form action="<?= BASE_URL?>/categoria/listagem" method="GET">
            <label for="pesquisa">Pesquisar:</label>
            <input type="text" name="s"><br>
            <label for="pesquisa2">Pesquisar2:</label>
            <input type="text" name="s2">
            <input type="submit" value="Enviar"> 
        </form>
    </body>
</html>
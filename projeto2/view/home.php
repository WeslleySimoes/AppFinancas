<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Home</title>
</head>
<body>
    <h1><?= $titulo ?></h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero velit porro quidem quis iure iusto. Est esse expedita dignissimos odio, explicabo alias. Excepturi quis, nisi iste qui nobis asperiores repellendus.</p>
    <a href="<?= BASE_URL ?>/categoria/editar?id=2">Link</a>
    <a href="<?= BASE_URL?>/categoria/listagem">Listagem de categorias</a>

    <form action="./" method="GET">
        <label for="s">Pesquisar:</label>
        <input type="text" name="s">
        <input type="submit" value="Enviar"> 
    </form>
</body>
</html>
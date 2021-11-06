<?php 
    session_start();
 
    $_SESSION['pg_atual'] = [
        "classe" => isset($_GET['c']) ? $_GET['c'] : 'Home',
        'metodo' => isset($_GET['m']) ? $_GET['m'] : 'index',
    ];

    unset($_GET['classe']);
    unset($_GET['metodo']);

    echo '<pre>';
    var_dump($_GET);
    echo '</pre>';

    echo '<pre>';
    var_dump($_SESSION['pg_atual']);
    echo '</pre>';
    /*  

    $url = array_merge($_SESSION['pg_atual'],$_GET);
    echo http_build_query($url);


    
    echo '<pre>';
    var_dump($_SESSION['pg_atual']);
    echo '</pre>';*/
?>

<form action="<?php echo $_SERVER["PHP_SELF"].'?'.http_build_query($_GET);?>">
    <label for="nome">Nome: </label>
    <input type="text" name="nome"><br>
    <label for="email">E-mail: </label>
    <input type="email" name="email"><br>
    <input type="submit" value="Enviar">
</form>
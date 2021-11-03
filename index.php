<?php 
    //Inicializa Sessão
    session_start();
    require_once __DIR__.'/vendor/autoload.php';

    const NAMESPACE_CONTROLLER = 'app\\controller\\';

    $classe = isset($_GET['c']) ? NAMESPACE_CONTROLLER.ucfirst($_GET['c']) : NAMESPACE_CONTROLLER.'Login';
    $metodo = isset($_GET['m']) ? strtolower($_GET['m']) : 'index';

    if(class_exists($classe))
    {
        $c = new $classe;
        if(method_exists($c,$metodo))
        {
            $m = $metodo;
            $c->$m();
            exit();
        }
    }
    http_response_code(404);
    echo '<h1>Página não existe</h1>';

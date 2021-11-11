<?php
    session_start();
    
    require_once __DIR__.'/config.php';

    spl_autoload_register(function($classe){
        if(file_exists(__DIR__."/classes/{$classe}.php"))
        {
            require_once __DIR__."/classes/{$classe}.php";
        }
    });

    $routes = array(
        '/'                      => 'home@index',
        '/listagem'              => 'listagem@index',
        '/categoria/editar'      => 'categoria@editar',
        '/categoria/listagem'    => 'categoria@index'
    );
    
    // This is our router.
    function router($routes)
    {
        $path = '/projeto2';
        $final = str_replace($path,'',$_SERVER['REQUEST_URI']);
        $final = explode('?',$final);

        // Iterate through a given list of routes.
        foreach ($routes as $path => $content) {
            $quebra = explode('@',$content);

            $classe = ucfirst($quebra[0]);
            $metodo = $quebra[1];
            
            if ($path == $final[0]) {
                if(class_exists($classe))
                {
                    $c = new $classe;  
                    
                    if(method_exists($c,$metodo))
                    {
                        $m = $metodo;
                        $c->$m();
                    }
                }
                return;
            }
        }
    
        // This can only be reached if none of the routes matched the path.
        http_response_code(404);
        echo 'Desculpe! Página não encontrada.';
    }
    
    // Execute the router with our list of routes.
    router($routes);

    /*
    Site com explicação:
        https://stackoverflow.com/questions/20960877/the-basics-of-php-routing
    */  
?>


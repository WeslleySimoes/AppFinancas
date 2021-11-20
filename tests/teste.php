<?php 

    $arr = [
        'Feira' => 20.3,
        'Mercado' => 4000.30
    ];

    $chaves = array_keys($arr);
    $valor  = array_values($arr);

    echo '<pre>';
    var_dump($chaves);
    var_dump($valor);
    echo '</pre>';
<?php 

    $desp = [
        '7' => 21,
        '10' => 656,
        '11' => 4307
    ];  

    $meses = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];

    $valores = [0,0,0,0,0,0,0,0,0,0,0,0];

    foreach($desp as $mes => $total)
    {
        $valores[$mes-1] = $total;
    }

    echo '<pre>';
    print_r($valores);
    echo '</pre>';
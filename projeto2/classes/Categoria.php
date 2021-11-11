<?php 

    class Categoria extends Controlador
    {
        public function index()
        {   
            if(isset($_GET['s']))
            {
                $pesq = 'Pesquisa: '.$_GET['s'];
            }
            $this->view([
                'categoria_listagem'
            ],[
                'pesquisa' => isset($pesq) ? $pesq : null
            ]);
        }
        public function editar()
        {   
            if(!isset($_GET['id'])){header('location: ./');exit;}

            if(!empty($_POST))
            {   
                echo '<pre>';
                var_dump($_POST);
                echo '</pre>';
            }
            $this->view([
                'categoria_editar'
            ]);
        }
    }
<?php 
    namespace app\controller;
    use app\session\Usuario;

    class Categorias extends Controller
    {
        public function index()
        {
            if(!Usuario::logado()){header('location: ./');exit;}
        
            $this->view([
                'template/header',
                'template/footer'
            ],[
                'usuario_logado' => Usuario::get('nome')
            ]);
        }

        public function inserir()
        {
            if(!Usuario::logado()){header('location: ./');exit;}
            echo 'Id:',Usuario::get('id');
            $this->view(['categorias_inserir'],[
                'usuario_logado' => Usuario::get('nome')
            ]);
        }
    }
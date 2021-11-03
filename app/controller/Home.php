<?php 
    namespace app\controller;
    use app\session\Usuario;

    class Home extends Controller
    {
        public function index()
        {
            if(!Usuario::logado()){header('location: ./');exit;}
        
            $this->view(['home'],[
                'usuario_logado' => Usuario::get('nome')
            ]);
        }
    }
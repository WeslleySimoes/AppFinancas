<?php 
    namespace app\controller;
    use app\session\Usuario;

    class Home extends Controller
    {
        public function index()
        {
            //Verifica se o Usuário está logado, caso contrário vai para a página de login
            Usuario::is_logado();
        
            $this->view([
                'template/header',
                'home',
                'template/footer'
            ],[
                'usuario_logado' => Usuario::get('nome')
            ]);
        }
    }
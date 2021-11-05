<?php 
    namespace app\controller;
    
    use app\session\Usuario;

    class Deslogar extends Controller
    {
        public function index()
        {
            Usuario::deslogar();
        }
    }
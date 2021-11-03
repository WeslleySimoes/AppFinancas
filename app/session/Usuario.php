<?php 
    namespace app\session;

    class Usuario
    {
        public static function logado()
        {
            return isset($_SESSION['usuario']);
        }

        public static function iniciar($nome)
        {
            $_SESSION['usuario'] = $nome;
        }

        public static function get($prop = null)
        {
            if(isset($prop))
            {
                return $_SESSION['usuario'][$prop];
            }
            return $_SESSION['usuario'];
        }

        public static function deslogar()
        {
            session_destroy();
        }
    }
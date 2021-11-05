<?php 
    namespace app\session;

    class Usuario
    {
        public static function is_logado()
        {
            if(!isset($_SESSION['usuario']))
            {
                header('location: ./');
                exit;
            }
        }

        public static function is_deslogado()
        {
            if(isset($_SESSION['usuario']))
            {
                header('location: ./?c=home');
                exit;
            }
        }

        public static function iniciar(array $nome)
        {
            $_SESSION['usuario'] = $nome;
            
            header('location: ./?c=home');
            exit;
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
            header("location: ./");
            exit();
        }
    }
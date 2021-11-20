<?php 

    namespace app\utils;

    class FlashMessage
    {
        public static function set($message,$local=null,$redirecionamento=true)
        {
            $_SESSION['msg'] = $message;

            if($redirecionamento)
            {
                if(isset($local))
                {
                    header('location: ./?'.$local);
                }
                else{
                    header('location: ./?'.$_SERVER['QUERY_STRING']);
                }
                exit();
            }
        }

        public static function get()
        {
            if(isset($_SESSION['msg']))
            {
                $msg = $_SESSION['msg'];

                unset($_SESSION['msg']);
            }

            return isset($msg) ? $msg : null;   
        }
    }
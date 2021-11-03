<?php 

    namespace app\utils;

    class FlashMessage
    {
        public static function set($message)
        {
            $_SESSION['msg'] = $message;
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
<?php 
    namespace app\utils;

    final class Validacao
    {
        private function __construct(){}
        private function __clone(){}

        public static function string($var)
        {
            return trim(filter_var($var,FILTER_SANITIZE_STRING));
        }

        public static function int($var)
        {
            return filter_var($var,FILTER_SANITIZE_NUMBER_INT);
        }

        public static function senha($senha)
        {
            if(strlen($senha) == 8)
            {
                return true;
            }
            
            return false;
        }
    }
    
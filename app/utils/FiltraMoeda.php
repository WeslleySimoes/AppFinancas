<?php 

    namespace app\utils;

    use NumberFormatter;

    class FiltraMoeda{

        public static function currency(float $valor): string
        {
           return number_format($valor,2,",",".");
        }

        public static function data($data){
            return date("d/m/Y", strtotime($data));
        }
    }
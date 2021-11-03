<?php 
    namespace app\log;
    
    final class LoggerTXT extends Logger
    {
        public function write($message)
        {
            date_default_timezone_set('America/Sao_Paulo');
            $time = date('Y-m-d H:i:s');

            //Monta a string
            $text = "{$time} :: {$message}\n";

            //Adiciona ao final do arquivo
            $handler = fopen($this->filename,'a');
            fwrite($handler,$text);
            fclose($handler);
        }


    }
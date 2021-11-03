<?php 
    namespace app\log;

    abstract class Logger
    {
        protected $filename; //local do arquivo de Log
        
        public function __construct($filename)
        {
            $this->filename = $filename;
            file_put_contents($filename,''); //Limpa o comnteudo do arquivo
        }

        //Define o método write como obrigatório
        abstract function write($message);
    }

    
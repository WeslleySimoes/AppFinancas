<?php 

    abstract class  Controlador
    {
        protected function view(array $templates,array $dados = [])
        {
            if(!empty($dados))
            {
                extract($dados);
            }
            if(!empty($templates)){
                foreach($templates as $tp)
                {
                    $arquivo = __DIR__."/../view/{$tp}.php";
    
                    if(file_exists($arquivo))
                    {
                        require_once $arquivo;
                    }
                }
            }
        }
            
    }
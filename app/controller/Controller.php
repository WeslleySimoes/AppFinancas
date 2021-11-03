<?php 
    namespace app\controller;

    abstract class Controller
    {
        protected function view(array $templates,array $dados = array())
        {
            if(!isset($templates))
            {
                throw new \Exception('Array {$templates} vazio!');
            }

            if(isset($dados))
            {
                extract($dados);
            }

            //Apresenta os templates
            foreach($templates as $template)
            {
                require_once __DIR__."/../view/{$template}.php";
            }
        }
    }
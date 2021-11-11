<?php 

    class Home extends controlador
    {
        public function index()
        {

            ///echo BASE_URL;
            $this->view([
                'home'
            ],[
                'titulo' => 'Seja Bem Vindos a Página Home!'
            ]);
        }
    }
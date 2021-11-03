<?php 
    namespace app\controller;
    
    use app\model\{Transaction};
    use app\model\class\Usuario;
    use app\utils\{FlashMessage,Validacao};

    class Cadastro extends Controller
    {
        public function index()
        {  
            if(isset($_POST['nome']))
            {
                Transaction::open('db');

                $usuario = new Usuario;
                $usuario->nome  = $_POST['nome'];
                $usuario->email = $_POST['email'];
                $usuario->senha = $_POST['senha'];

                if($usuario->store()){
                    FlashMessage::set("Cadastrado com Sucesso!");
                }
                else{
                    FlashMessage::set("Erro ao Cadastra-lo!");
                }
                Transaction::close();

                header('location: ./?c=cadastro');
                exit();
            }
            
           $this->view(['cadastro'],[
               "msg" => FlashMessage::get()
           ]);
        }
    }
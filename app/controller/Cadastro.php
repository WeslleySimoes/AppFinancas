<?php 
    namespace app\controller;
    
    use app\session\Usuario as UsuarioSession;
    use app\model\{Transaction};
    use app\model\class\Usuario;
    use app\utils\{FlashMessage,Validacao};

    class Cadastro extends Controller
    {
        public function index()
        {  
            //Verifica se o usuário está deslogado, caso contrário, o encaminhará para a página Home
            UsuarioSession::is_deslogado();

            if(isset($_POST['nome']))
            {
                try {
                    
                    Transaction::open('db');

                    $usuario = new Usuario;
                    $usuario->nome  = $_POST['nome'];
                    $usuario->email = $_POST['email'];
                    $usuario->senha = $_POST['senha'];
                    $resultado = $usuario->store();

                    Transaction::close();
                   
                    if($resultado){
                        FlashMessage::set("Cadastrado com Sucesso!");
                    }
                    else{
                        FlashMessage::set("Erro ao Cadastra-lo!");
                    }

                } catch (\Exception $e) {
                    echo $e->getMessage();
                    Transaction::rollback();
                }
            }
            
           $this->view(['cadastro2'],[
               "msg" => FlashMessage::get()
           ]);
        }
    }
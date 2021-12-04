<?php 
    namespace app\controller;
    
    use app\session\Usuario as UsuarioSession;
    use app\model\{Transaction,Repository,Criteria};
    use app\model\class\Usuario;
    use app\utils\{FlashMessage,Validacao};

    class Cadastro extends Controller
    {
        public function index()
        {  
            //Verifica se o usuário está deslogado, caso contrário, o encaminhará para a página Home
            UsuarioSession::is_deslogado();

            if(!empty($_POST))
            {
                try {   
                    Transaction::open('db');

                    $criteria = new Criteria;
                    $criteria->add('email','=',$_POST['email']);

                    $respUsuario = new Repository('app\model\class\Usuario');
                    $totalCountEmail = $respUsuario->count($criteria);
                    
                    Transaction::close();
                    
                    if($totalCountEmail > 0)
                    {
                        FlashMessage::set("E-mail já cadastrado!");
                        exit;
                    }
                    if($_POST['senha'] != $_POST['confSenha'])
                    {
                        FlashMessage::set("Senha e confirmar senha devem ser iguais!");
                        exit;
                    }
                    if(strlen($_POST['senha'])<3 || strlen($_POST['senha'])>8)
                    {
                        FlashMessage::set("Insira de 3 a 8 caracteres em sua senha!");
                        exit;
                    }



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
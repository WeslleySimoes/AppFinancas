<?php 
    namespace app\controller;
    use app\session\Usuario as UsuarioSession;
    use app\model\{Connection,Transaction,Criteria,Repository};
    use app\model\class\Usuario;
    use app\utils\FlashMessage;

    class Login extends Controller
    {
        public function index()
        {   
            //Verifica se o usuário está deslogado, caso contrário, o encaminhará para a página Home
            UsuarioSession::is_deslogado();
            
            if(isset($_POST['email']) && isset($_POST['senha']))
            {
                try {
                    Transaction::open('db');

                    $criteria = new Criteria;
                    $criteria->add('email','=',$_POST['email']);
                    $criteria->add('senha','=',$_POST['senha']);

                    $usuario = new Repository('app\model\class\Usuario');

                    $usuario = $usuario->load($criteria);

                    Transaction::close();

                    if(isset($usuario) && !empty($usuario))
                    {
                        UsuarioSession::iniciar([
                            'id' => $usuario[0]->id,
                            'nome' => $usuario[0]->nome
                        ]);
                    }

                    FlashMessage::set('Usuario ou Senha incorreto!');
                    header('location: ./?c=login');
                    exit();

                } catch (\Exception $e) {
                    $e->getMessage();
                    Transaction::rollback();
                }
            }

           $this->view(['login'],['msg' => FlashMessage::get()]);
        }
    }
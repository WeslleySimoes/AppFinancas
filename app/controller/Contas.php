<?php 
    namespace app\controller;
    
    use app\session\Usuario;
    use app\model\class\Conta;
    use app\utils\{FlashMessage,Validacao,FiltraMoeda};
    use app\model\{Transaction,Repository,Criteria};

class Contas extends Controller
    {
        public function index()
        {
            Usuario::is_logado();

            try {
                Transaction::open('db');

                $respContas = new Repository('app\model\class\Conta');
                
                $criteria = new Criteria;
                $criteria->add('id_usuario','=',Usuario::get('id'));

                $resultContas = $respContas->load($criteria);

                array_map(function($obj){
                    return $obj->valor = FiltraMoeda::currency($obj->valor);
                }, $resultContas);

                Transaction::close();
            } catch (\Exception $e) {
                Transaction::rollback();
                echo $e->getMessage();
            }

            $this->view([
                'template/header',
                'conta/listagem',
                'template/footer'
            ],[
                'usuario_logado' => Usuario::get('nome'),
                'contasListagem' =>  $resultContas,
                'msg'            => FlashMessage::get()
            ]);            
        }

        public function inserir()
        {
            Usuario::is_logado();

            try {
                Transaction::open('db');
                
                if(!empty($_POST) && isset($_POST['valor']))
                {
                    $conta = new Conta;
                    $conta->valor       = $_POST['valor'];
                    $conta->instFinanca = $_POST['instFinanceira'];
                    $conta->descricao   = $_POST['descricao'];
                    $conta->tipo_conta  = $_POST['tipo_conta'];
                    $conta->id_usuario  = Usuario::get('id');
                    
                    $resultado = $conta->store();

                    Transaction::close();
                    
                    if($resultado)
                    {
                        FlashMessage::set('Conta criada com sucesso!');
                    }
                    else{
                        FlashMessage::set('Erro ao criar a conta!');
                    }
                }

            } catch (\Exception $e) {
                Transaction::rollback();
                echo $e->getMessage();
            }
            
            $this->view([
                'template/header',
                'conta/inserir',
                'template/footer'
            ],[
                'usuario_logado' => Usuario::get('nome'),
                'msg'            => FlashMessage::get()
            ]);
        }

        public function editar()
        {
            Usuario::is_logado();
            if(!$id = Validacao::id('id')){header('location: ./?c=contas');exit;}
            try {
                Transaction::open('db');
                $conta = Conta::find($id);
                Transaction::close();

                if(!empty($_POST) && isset($_POST['valor']))
                {
                    Transaction::open('db');

                    $contaModel = new Conta;
                    $contaModel->id             = $id;
                    $contaModel->valor          = $_POST['valor'];
                    $contaModel->instFinanca    = $_POST['instFinanceira'];
                    $contaModel->descricao      = $_POST['descricao'];
                    $contaModel->tipo_conta     = $_POST['tipo_conta'];
                    $contaModel->id_usuario     = Usuario::get('id');

                    $resultadoConta = $contaModel->store();

                    Transaction::close();

                    if($resultadoConta)
                    {
                        FlashMessage::set('Conta alterada com sucesso!');
                    }
                    else{
                        FlashMessage::set('Erro ao alterar conta!');
                    }
                }
            }
            catch(\Exception $e)
            {
                Transaction::rollback();
                echo $e->getMessage();

            }

            $this->view([
                'template/header',
                'conta/editar',
                'template/footer'
            ],[
                'usuario_logado' => Usuario::get('nome'),
                'contaItem'      => $conta,
                'msg'            => FlashMessage::get()
            ]);
        }

        public function excluir(){
            Usuario::is_logado();
            if(!$id = Validacao::id('id')){header('location: ./?c=despesa');exit;}

            try {
                Transaction::open('db');

                $conta = Conta::find($id);
                $resultado = $conta->delete();

                Transaction::close();

                if($resultado)
                {
                    FlashMessage::set('Conta removida com sucesso!','c=contas');
                }
                else{
                    FlashMessage::set('Erro ao remover Conta','c=contas');
                }

            } catch (\Exception $e) {
                echo $e->getMessage();
                Transaction::rollback();
            } 
        }
    }
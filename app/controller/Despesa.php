<?php 

    namespace app\controller;

    use app\session\Usuario;
    use app\utils\ValidaData;
    use app\model\{Transaction,Repository,Criteria};
    use app\model\class\{Categoria,Despesa as DespesaModel};
    use app\utils\{FlashMessage,Validacao,FiltraMoeda};

    class Despesa extends Controller
    {
        public function index()
        {
            //Verifica se o Usuário está logado, caso contrário vai para a página de login
            Usuario::is_logado();

            try{
                Transaction::open('db');

                $resp = new Repository('app\model\class\Despesa');

                $sql = "SELECT d.id, d.valor, d.descricao, d.desp_data ,c.nome as categoria FROM despesa as d INNER JOIN categoria as c ON d.id_categoria = c.id WHERE d.id_usuario =".Usuario::get('id')." AND MONTH(d.desp_data) = MONTH(CURRENT_DATE()) AND YEAR(d.desp_data) = YEAR(CURRENT_DATE())";

              //  echo $sql;
                $resultado = $resp->loadCustom($sql);


                foreach($resultado as $despesa)
                {
                    $despesa->valor = FiltraMoeda::currency($despesa->valor);
                    $despesa->desp_data = FiltraMoeda::data($despesa->desp_data);
                }
                /*
                echo '<pre>';
                var_dump($resultado);
                echo '</pre>';*/

                Transaction::close();

                $this->view([
                    'template/header',
                    'despesa/listagem',
                    'template/footer'
                ],[
                    'usuario_logado' => Usuario::get('nome'),
                    'despesa' => $resultado,
                    'msg' => FlashMessage::get()
                ]);  
            }
            catch (\Exception $e) {
                echo $e->getMessage();
                Transaction::rollback();
            }
        }
        public function inserir()
        {
            //Verifica se o Usuário está logado, caso contrário vai para a página de login
            Usuario::is_logado();

            $vData= new ValidaData('2021-11-20');
            //var_dump($vData->validar());

            try {
                Transaction::open('db');

                $criteria = new Criteria;
                $criteria->add('idUsuario','=',Usuario::get('id'));
                $criteria->add('tipo','=','Despesa');
                $criteria->add('statusCat','=','1');

                $carRespository = new Repository('app\model\class\Categoria');
                $resultado = $carRespository->load($criteria);

                Transaction::close();      

                if(empty($resultado))
                {
                    FlashMessage::set('Atenção! Cadastre uma categoria para inserir uma Despesa.',null,false);
                }
                
                if(!empty($_POST) && isset($_POST['valor']))
                {
                    Transaction::open('db');
                    $despesa = new DespesaModel;
                    $despesa->valor         = (float)$_POST['valor'];
                    $despesa->descricao     = $_POST['descricao'];
                    $despesa->id_categoria  = (int)$_POST['categoria'];
                    $despesa->desp_data     = $_POST['data'];
                    $despesa->id_usuario    = Usuario::get('id');

                    $resultadoDesp = $despesa->store();

                    Transaction::close();       
                    if($resultadoDesp)
                    {
                        FlashMessage::set('Despesa Cadastrada com sucesso!');
                    }
                    else{
                        FlashMessage::set('Erro ao cadastrar despesa!');   
                    }
                }

                
                $this->view([
                    'template/header',
                    'despesa/inserir',
                    'template/footer'
                ],[
                    'usuario_logado' => Usuario::get('nome'),
                    'categorias' => $resultado,
                    'msg' => FlashMessage::get()
                ]);            

            } catch (\Exception $e) {
                echo $e->getMessage();
                Transaction::rollback();
            }
        }
        
        public function editar()
        {
            //Verifica se o Usuário está logado, caso contrário vai para a página de login
            Usuario::is_logado();

            if(!$id = Validacao::id('id')){header('location: ./?c=despesa');exit;}

            try {
                Transaction::open('db');

                $criteria = new Criteria;
                $criteria->add('idUsuario','=',Usuario::get('id'));
                $criteria->add('tipo','=','Despesa');
                $criteria->add('statusCat','=','1');

                $carRespository = new Repository('app\model\class\Categoria');
                $resultado = $carRespository->load($criteria);

                $despesa = DespesaModel::find($id);

                Transaction::close();      

                if(empty($resultado))
                {
                    FlashMessage::set('Atenção! Cadastre uma categoria para inserir uma Despesa.',null,false);
                }
                
                if(!empty($_POST) && isset($_POST['valor']))
                {
                    Transaction::open('db');
                    $despesa = new DespesaModel;
                    $despesa->id            = $id; 
                    $despesa->valor         = (float)$_POST['valor'];
                    $despesa->descricao     = $_POST['descricao'];
                    $despesa->id_categoria  = (int)$_POST['categoria'];
                    $despesa->desp_data     = $_POST['data'];
                    $despesa->id_usuario    = Usuario::get('id');

                    $resultadoDesp = $despesa->store();

                    Transaction::close();       
                    if($resultadoDesp)
                    {
                        FlashMessage::set('Despesa alterada com sucesso!');
                    }
                    else{
                        FlashMessage::set('Erro ao alterar despesa!');   
                    }
                }

                $this->view([
                    'template/header',
                    'despesa/editar',
                    'template/footer'
                ],[
                    'usuario_logado' => Usuario::get('nome'),
                    'categorias' => $resultado,
                    'despesa' => $despesa,
                    'msg' => FlashMessage::get()
                ]);            

            } catch (\Exception $e) {
                echo $e->getMessage();
                Transaction::rollback();
            }
        }
        public function remover()
        {
            //Verifica se o Usuário está logado, caso contrário vai para a página de login
            Usuario::is_logado();

            if(!$id = Validacao::id('id')){header('location: ./?c=despesa');exit;}

            try {
                Transaction::open('db');

                $despesa = DespesaModel::find($id);
                $resultado = $despesa->delete();

                Transaction::close();

                if($resultado)
                {
                    FlashMessage::set('Despesa removida com sucesso!','c=despesa');
                }
                else{
                    FlashMessage::set('Erro ao remover despesa','c=despesa');
                }

            } catch (\Exception $e) {
                echo $e->getMessage();
                Transaction::rollback();
            }                    
        }

    }
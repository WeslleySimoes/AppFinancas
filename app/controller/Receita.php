<?php 

    namespace app\controller;

    use app\session\Usuario;
    use app\utils\ValidaData;
    use app\model\{Transaction,Repository,Criteria};
    use app\model\class\{Categoria,Receita as ReceitaModel};
    use app\utils\{FlashMessage,Validacao,FiltraMoeda};

    class Receita extends Controller
    {
        public function index()
        {
            //Verifica se o Usuário está logado, caso contrário vai para a página de login
            Usuario::is_logado();

            try{
                Transaction::open('db');

                $resp = new Repository('app\model\class\Receita');

                $sql = "SELECT d.id, d.valor, d.descricao, d.desp_data ,c.nome as categoria FROM receita as d INNER JOIN categoria as c ON d.id_categoria = c.id WHERE d.id_usuario =".Usuario::get('id')." AND MONTH(d.desp_data) = MONTH(CURRENT_DATE()) AND YEAR(d.desp_data) = YEAR(CURRENT_DATE())";

              //  echo $sql;
                $resultado = $resp->loadCustom($sql);


                foreach($resultado as $receita)
                {
                    $receita->valor = FiltraMoeda::currency($receita->valor);
                    $receita->desp_data = FiltraMoeda::data($receita->desp_data);
                }

                Transaction::close();

                $this->view([
                    'template/header',
                    'receita/listagem',
                    'template/footer'
                ],[
                    'usuario_logado' => Usuario::get('nome'),
                    'receita' => $resultado,
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
                $criteria->add('tipo','=','receita');
                $criteria->add('statusCat','=','1');

                $carRespository = new Repository('app\model\class\Categoria');
                $resultado = $carRespository->load($criteria);

                Transaction::close();      

                if(empty($resultado))
                {
                    FlashMessage::set('Atenção! Cadastre uma categoria para inserir uma Receita.',null,false);
                }
                
                if(!empty($_POST) && isset($_POST['valor']))
                {
                    Transaction::open('db');

                    $receita = new ReceitaModel;
                    $receita->valor         = (float)$_POST['valor'];
                    $receita->descricao     = $_POST['descricao'];
                    $receita->id_categoria  = (int)$_POST['categoria'];
                    $receita->desp_data     = $_POST['data'];
                    $receita->id_usuario    = Usuario::get('id');

                    $resultadoResc = $receita->store();

                    Transaction::close();       
                    if($resultadoResc)
                    {
                        FlashMessage::set('Receita Cadastrada com sucesso!');
                    }
                    else{
                        FlashMessage::set('Erro ao cadastrar receita!');   
                    }
                }
                
                $this->view([
                    'template/header',
                    'receita/inserir',
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

        public function remover()
        {
            //Verifica se o Usuário está logado, caso contrário vai para a página de login
            Usuario::is_logado();

            if(!$id = Validacao::id('id')){header('location: ./?c=receita');exit;}

            try {
                Transaction::open('db');

                $receita = ReceitaModel::find($id);
                $resultado = $receita->delete();

                Transaction::close();

                if($resultado)
                {
                    FlashMessage::set('Receita removida com sucesso!','c=receita');
                }
                else{
                    FlashMessage::set('Erro ao remover receita','c=receita');
                }

            } catch (\Exception $e) {
                echo $e->getMessage();
                Transaction::rollback();
            }                    
        }      
        
        public function editar()
        {
            //Verifica se o Usuário está logado, caso contrário vai para a página de login
            Usuario::is_logado();

            if(!$id = Validacao::id('id')){header('location: ./?c=receita');exit;}

            try {
                Transaction::open('db');

                $criteria = new Criteria;
                $criteria->add('idUsuario','=',Usuario::get('id'));
                $criteria->add('tipo','=','receita');
                $criteria->add('statusCat','=','1');

                $carRespository = new Repository('app\model\class\Categoria');
                $resultado = $carRespository->load($criteria);

                $receita = ReceitaModel::find($id);

                Transaction::close();      

                if(empty($resultado))
                {
                    FlashMessage::set('Atenção! Cadastre uma categoria para alterar a receita.',null,false);
                }
                
                if(!empty($_POST) && isset($_POST['valor']))
                {
                    Transaction::open('db');
                    $receita = new ReceitaModel;
                    $receita->id            = $id; 
                    $receita->valor         = (float)$_POST['valor'];
                    $receita->descricao     = $_POST['descricao'];
                    $receita->id_categoria  = (int)$_POST['categoria'];
                    $receita->desp_data     = $_POST['data'];
                    $receita->id_usuario    = Usuario::get('id');

                    $resultadoResc = $receita->store();

                    Transaction::close();       
                    if($resultadoResc)
                    {
                        FlashMessage::set('Receita alterada com sucesso!');
                    }
                    else{
                        FlashMessage::set('Erro ao alterar receita!');   
                    }
                }

                $this->view([
                    'template/header',
                    'receita/editar',
                    'template/footer'
                ],[
                    'usuario_logado' => Usuario::get('nome'),
                    'categorias' => $resultado,
                    'receita' => $receita,
                    'msg' => FlashMessage::get()
                ]);            

            } catch (\Exception $e) {
                echo $e->getMessage();
                Transaction::rollback();
            }
        }          
    }
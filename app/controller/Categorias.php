<?php 
    namespace app\controller;

    use app\session\Usuario;
    use app\model\{Transaction,Repository,Criteria};
    use app\model\class\Categoria;
    use app\utils\{FlashMessage,Validacao};

    class Categorias extends Controller
    {
        public function index()
        {
            //Verifica se o Usuário está logado, caso contrário vai para a página de login
            Usuario::is_logado();

            try {
                Transaction::open('db');

                $carRespository = new Repository('app\model\class\Categoria');

                $criteria = new Criteria;
                $criteria->add('idUsuario','=',Usuario::get('id'));

                if(isset($_GET['f'])&& $_GET['f'] =='arquivados')
                {
                    $criteria->add('statusCat','=','0');
                }
                else{
                    $criteria->add('statusCat','=','1');
                }
                
                $resultado = $carRespository->load($criteria);

                Transaction::close();
            } catch (\Exception $e) {
                echo $e->getMessage();
                Transaction::rollback();
            }
        
            $this->view([
                'template/header',
                'categoria/listagem',
                'template/footer'
            ],[
                'usuario_logado' => Usuario::get('nome'),
                'catItens' => $resultado,
                'msg' => FlashMessage::get()
            ]);
        }

        public function inserir()
        {
            //Verifica se o Usuário está logado, caso contrário vai para a página de login
            Usuario::is_logado();

            if(isset($_POST['categoria']))
            {
                try {
                    Transaction::open('db');

                    /*Verifica se Existe uma categoria com o mesmo nome*/
                    $criteria = new Criteria;
                    $criteria->add('nome','=',$_POST['categoria']);
                    $criteria->add('idUsuario','=',Usuario::get('id'));

                    $repositorio_valida = new Repository('app\model\class\Categoria');
                    $total_igual = $repositorio_valida->count($criteria);

                    //Se não houver categoria com o mesmo nome, irá inseri-la no banco de dados
                    if($total_igual == 0){
                        $categoria = new Categoria;

                        $categoria->nome = ucfirst(strtolower(trim($_POST['categoria'])));
                        $categoria->tipo = ucfirst(strtolower($_POST['tipos']));
                        $categoria->statusCat = 1;
                        $categoria->idUsuario = Usuario::get('id');

                        if(!empty($categoria->nome))
                        {
                            $resultado = $categoria->store();
                        }
                        else{
                            FlashMessage::set('Preencha o campo vazio!');
                        }
                    }
                    else{
                        FlashMessage::set('Esta Categoria já existe!');
                    }

                    Transaction::close();
                    
                    if($resultado)
                    {
                        FlashMessage::set('Categoria cadastrada com sucesso!');
                    }
                    else{
                        FlashMessage::set('Erro ao inserir categoria!');
                    }

                } catch (\Exception $e) {   
                    echo $e->getMessage();
                    Transaction::rollback();
                }
            }

            $this->view([
                'template/header',
                'categoria/inserir',
                'template/footer'
            ],[
                'usuario_logado' => Usuario::get('nome'),
                "msg" => FlashMessage::get()
            ]);
        }

        public function editar()
        {
            //Verifica se o Usuário está logado, caso contrário vai para a página de login
            Usuario::is_logado();

            if(!$id = Validacao::id('id')){header('location: ./?c=categorias');exit;}

            try {
                Transaction::open('db');
                $categoria = Categoria::find($id);

                if(isset($_POST['categoria']))
                {
                    $criteria = new Criteria;
                    $criteria->add('nome','=',$_POST['categoria']);
                    $criteria->add('idUsuario','=',Usuario::get('id'));

                    $repositorio_valida = new Repository('app\model\class\Categoria');
                    $total_igual = $repositorio_valida->count($criteria);

                    //Se não houver categoria com o mesmo nome, irá inseri-la no banco de dados
                    if($total_igual == 0 || strcmp($categoria->nome,$_POST['categoria']) == 0){

                        $categoria = new Categoria;
                        $categoria->id = $id;
                        $categoria->nome = ucfirst(strtolower($_POST['categoria']));
                        $categoria->tipo = ucfirst(strtolower($_POST['tipos']));

                        $resultado = $categoria->store();
                    }
                    else{
                        FlashMessage::set('Esta Categoria já existe!');
                    }

                    Transaction::close();

                    if($resultado)
                    {
                        FlashMessage::set('Categoria alterada com sucesso!');
                    }
                    else{
                        FlashMessage::set('Erro ao alterar categoria!');
                    }
                }
            }catch (\Exception $e) {
                $e->getMessage();
                Transaction::rollback();
            }

            $this->view([
                'template/header',
                'categoria/editar',
                'template/footer'
            ],[
                'usuario_logado' => Usuario::get('nome'),
                "msg" => FlashMessage::get(),
                'categoria' => $categoria
            ]);
        }
        public function arquivar()
        {
            //Verifica se o Usuário está logado, caso contrário vai para a página de login
            Usuario::is_logado();

            if(!$id = Validacao::id('id')){header('location: ./?c=categorias');exit;}

            try {
                Transaction::open('db');
                $categoria = Categoria::find($id);
                $categoria->statusCat = '0';
                $resultado = $categoria->store();
                Transaction::close();

                if($resultado)
                {
                    FlashMessage::set('Categoria Arquivada com sucesso!','c=categorias');
                }
                else{
                    FlashMessage::set('Erro ao arquivar categoria','c=categorias');
                }

            } catch (\Exception $e) {
                echo $e->getMessage();
                Transaction::rollback();
            }    
        }

        public function ativar()
        {
            //Verifica se o Usuário está logado, caso contrário vai para a página de login
            Usuario::is_logado();

            if(!$id = Validacao::id('id')){header('location: ./?c=categorias');exit;}

            try {
                Transaction::open('db');
                $categoria = Categoria::find($id);
                $categoria->statusCat = '1';
                $resultado = $categoria->store();
                Transaction::close();

                if($resultado)
                {
                    FlashMessage::set('Categoria reativada com sucesso!','c=categorias&f=arquivados');
                }
                else{
                    FlashMessage::set('Erro ao reativar categoria','c=categorias&f=arquivados');
                }

            } catch (\Exception $e) {
                echo $e->getMessage();
                Transaction::rollback();
            }    
        }

    }
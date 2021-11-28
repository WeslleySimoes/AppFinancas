<?php 
    namespace app\controller;
    use app\session\Usuario;
    use app\model\{Transaction,Repository,Criteria};
    use app\model\class\{Categoria,Despesa,Receita,Conta};
    use app\utils\{FlashMessage,Validacao,FiltraMoeda};

    class Home extends Controller
    {
        public function index()
        {
            //Verifica se o Usuário está logado, caso contrário vai para a página de login
            Usuario::is_logado();

            try {
                Transaction::open('db');

                /*Criterio de seleção */
                $criteria1 = new Criteria;
                $criteria1->add('id_usuario','=',Usuario::get('id'));

                /*Soma total das Contas Inseridas */
                $respConta = new Repository('app\model\class\Conta');
                $totalContas = $respConta->sum($criteria1,'valor');

                //AND MONTH(d.desp_data) = MONTH(CURRENT_DATE()) AND YEAR(d.desp_data) = YEAR(CURRENT_DATE()) 

                /*Soma total das Receitas Inseridas */
                $criteria2 = new Criteria;
                $criteria2->add('id_usuario','=',Usuario::get('id'));
                $criteria2->add('MONTH(desp_data)','=','MONTH(CURRENT_DATE())','AND',false);
                $criteria2->add('YEAR(desp_data)','=','YEAR(CURRENT_DATE())','AND',false);


                $respReceita = new Repository('app\model\class\Receita');
                $totalReceitas = $respReceita->sum($criteria2,'valor');

                /*Soma total das Despesas Inseridas */
                $respDespesa = new Repository('app\model\class\Despesa');
                $totalDespesa = $respDespesa->sum($criteria2,'valor');

                /************************* Calcula Saldo Restante ***************************/
                if(isset($totalReceitas) || isset($totalDespesa))
                {
                    $saldo = $totalReceitas - $totalDespesa;
                }

                /*************************  Retorna total despesa por Categoria *************************/
                $resp = new Repository('app\model\class\Conta');

                $sql = "SELECT c.nome as categoria, SUM(d.valor) as total FROM despesa as d INNER JOIN categoria as c ON d.id_categoria = c.id WHERE d.id_usuario = ".Usuario::get('id')." AND MONTH(d.desp_data) = MONTH(CURRENT_DATE()) AND YEAR(d.desp_data) = YEAR(CURRENT_DATE()) GROUP BY categoria;";

                $resultado = $resp->loadCustom($sql);  

                $arrTotalCategoria = [];
                foreach($resultado as $obj)
                {
                    $arrTotalCategoria[$obj->categoria] = $obj->total;
                }   

                $listaCategoria = "['".implode("','",array_keys($arrTotalCategoria))."']";
                $ListaValores = "[".implode(",",array_values($arrTotalCategoria))."]";

                /*************************  Retorna total Receita por Categoria *************************/
                $respReceita = new Repository('app\model\class\Conta');

                $sql = "SELECT c.nome as categoria, SUM(d.valor) as total FROM receita as d INNER JOIN categoria as c ON d.id_categoria = c.id WHERE d.id_usuario = ".Usuario::get('id')." AND MONTH(d.desp_data) = MONTH(CURRENT_DATE()) AND YEAR(d.desp_data) = YEAR(CURRENT_DATE()) GROUP BY categoria;";

                $resultadoReceita = $respReceita->loadCustom($sql);  

                $arrTotalCategoriaReceita = [];
                foreach($resultadoReceita as $obj)
                {
                    $arrTotalCategoriaReceita[$obj->categoria] = $obj->total;
                }   

                $listaCategoriaReceita = "['".implode("','",array_keys($arrTotalCategoriaReceita))."']";
                $ListaValoresReceita = "[".implode(",",array_values($arrTotalCategoriaReceita))."]";

                /******* Retorna total de despesa de cada mes do ano *******/
                $despesaMes = new Repository('StdClass');

                $sqlDepesaMes = "SELECT MONTH(desp_data) as mes,SUM(valor) as total FROM despesa WHERE id_usuario = ".Usuario::get('id')." AND YEAR(desp_data) = YEAR(CURRENT_DATE())  GROUP BY mes";

                $resultadoDespesaMes = $despesaMes->loadCustom($sqlDepesaMes); 

                $arrTotalCategoria = [];
                foreach($resultadoDespesaMes as $obj)
                {
                    $arrTotalCategoria[$obj->mes] = $obj->total;
                }   

                //Pega cada valor do ano a inseri em uma posição no array equivalente ao mes do ano
                $valoresDespesaMes = [0,0,0,0,0,0,0,0,0,0,0,0];
                foreach($arrTotalCategoria as $mes => $total)
                {
                    $valoresDespesaMes[$mes-1] = $total;
                }           

                //Retorna array dos totais de cada Mes do ano
                $listaValoresDespesaMes = "[".implode(",",$valoresDespesaMes)."]";


                /******* Retorna total de receita de cada mes do ano *******/
                $receitaMes = new Repository('StdClass');

                $sqlReceitaMes = "SELECT MONTH(desp_data) as mes,SUM(valor) as total FROM receita WHERE id_usuario = ".Usuario::get('id')." AND YEAR(desp_data) = YEAR(CURRENT_DATE()) GROUP BY mes";

                $resultadoReceitaMes = $receitaMes->loadCustom($sqlReceitaMes); 

                $arrTotalReceita = [];
                foreach($resultadoReceitaMes as $obj)
                {
                    $arrTotalReceita[$obj->mes] = $obj->total;
                }   

                //Pega cada valor do ano a inseri em uma posição no array equivalente ao mes do ano
                $valoresReceitaMes = [0,0,0,0,0,0,0,0,0,0,0,0];
                foreach($arrTotalReceita as $mes => $total)
                {
                    $valoresReceitaMes[$mes-1] = $total;
                }           

                //Retorna array dos totais de cada Mes do ano
                $listaValoresReceitaMes = "[".implode(",",$valoresReceitaMes)."]";

               // echo $listaValoresReceitaMes;

                Transaction::close();
            } catch (\Exception $e) {
                echo $e->getMessage();
                Transaction::rollback();
            }
        
            $this->view([
                'template/header',
                'home',
                'template/footer'
            ],[
                'usuario_logado' => Usuario::get('nome'),
                'total_contas'   => FiltraMoeda::currency($totalContas ? $totalContas : 0),
                'total_receitas' => FiltraMoeda::currency($totalReceitas ? $totalReceitas : 0),
                'total_despesas' => FiltraMoeda::currency($totalDespesa ? $totalDespesa : 0),
                'total_saldo'    => FiltraMoeda::currency(isset($saldo) ? $saldo : 0),
                'lista_categoria' => $listaCategoria,
                'listaValores'    => $ListaValores,
                'listaValoresDespesaMes' =>   $listaValoresDespesaMes,
                'listaValoresReceitaMes' => $listaValoresReceitaMes,
                'listaCategoriaReceita' => $listaCategoriaReceita,
                'ListaValoresReceita'  => $ListaValoresReceita
            ]);

        }
    }
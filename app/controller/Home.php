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

                /*Soma total das Receitas Inseridas */
                $respReceita = new Repository('app\model\class\Receita');
                $totalReceitas = $respReceita->sum($criteria1,'valor');

                /*Soma total das Despesas Inseridas */
                $respDespesa = new Repository('app\model\class\Despesa');
                $totalDespesa = $respDespesa->sum($criteria1,'valor');

                /*Calcula Saldo Restante */
                if(isset($totalReceitas) || isset($totalDespesa))
                {
                    $saldo = $totalReceitas - $totalDespesa;
                }

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
                'total_saldo'    => FiltraMoeda::currency(isset($saldo) ? $saldo : 0)
            ]);
        }
    }
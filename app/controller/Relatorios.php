<?php 
    namespace app\controller;

    use app\session\Usuario;
    use app\model\{Transaction,Repository,Criteria};
    use app\utils\{FlashMessage,Validacao,FiltraMoeda};

    class Relatorios extends Controller
    {
        public function index()
        {   
            Usuario::is_logado();
            
            $mesesRelatorio = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];

            try {
                Transaction::open('db');

                $resp = new Repository('StdClass');

                $sql ="SELECT MONTH(desp_data) as mes,YEAR(desp_data) as ano FROM receita WHERE id_usuario = ".Usuario::get('id')." GROUP BY ano,mes";

                $listaDatas = $resp->loadCustom($sql);

                $respFiltro = new Repository('StdClass');

                if(!empty($_POST) && isset($_POST['tipos']) && isset($_POST['mes-ano']))
                {

                    $mesAno = explode('/', $_POST['mes-ano']);
                    
                    /*Soma total das Receitas Inseridas */
                    $criteria2 = new Criteria;
                    $criteria2->add('id_usuario','=',Usuario::get('id'));
                    $criteria2->add('MONTH(desp_data)','=',$mesAno[0],'AND',false);
                    $criteria2->add('YEAR(desp_data)','=',$mesAno[1],'AND',false);

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

                    switch ($_POST['tipos']) {
                        case 1:
                            $sql = "SELECT SUM(d.valor) as total,c.nome as categoria FROM despesa as d INNER JOIN categoria as c ON d.id_categoria = c.id WHERE d.id_usuario = ".Usuario::get('id')." AND MONTH(d.desp_data) = {$mesAno[0]} AND YEAR(d.desp_data) = {$mesAno[1]} GROUP BY categoria";
                            break;
                        case 2:
                            $sql = "SELECT SUM(d.valor) as total,c.nome as categoria FROM receita as d INNER JOIN categoria as c ON d.id_categoria = c.id WHERE d.id_usuario = ".Usuario::get('id')." AND MONTH(d.desp_data) = {$mesAno[0]} AND YEAR(d.desp_data) = {$mesAno[1]} GROUP BY categoria";
                            break;
                        case 3:
                            break;
                    }

                }else{
                    $sql = "SELECT SUM(d.valor) as total,c.nome as categoria FROM despesa as d INNER JOIN categoria as c ON d.id_categoria = c.id WHERE d.id_usuario = ".Usuario::get('id')." AND MONTH(d.desp_data) = MONTH(CURRENT_DATE()) AND YEAR(d.desp_data) = YEAR(CURRENT_DATE()) GROUP BY categoria";
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

                }

                $resultFiltro= $respFiltro->loadCustom($sql);

                $arrTotal= [];
                foreach($resultFiltro as $obj)
                {
                    $arrTotal[$obj->categoria] = $obj->total;
                }   

                $listaLabel= "['".implode("','",array_keys($arrTotal))."']";
                $ListaValores = "[".implode(",",array_values($arrTotal))."]";
                
                Transaction::close();

            } catch (\Exception $e) {
                echo $e->getMessage();
                Transaction::rollback();
            }
            
            $this->view([
                'template/header',
                'relatorios',
                'template/footer'
            ],[
                'usuario_logado' => Usuario::get('nome'),
                'msg' => FlashMessage::get(),
                'lista_data' => $listaDatas,
                'mesesRelatorios' => $mesesRelatorio,
                'listaLabel' => $listaLabel,
                'ListaValores' => $ListaValores,
                'total_receitas' => FiltraMoeda::currency($totalReceitas ? $totalReceitas : 0),
                'total_despesas' => FiltraMoeda::currency($totalDespesa ? $totalDespesa : 0),
                'total_saldo'    => FiltraMoeda::currency(isset($saldo) ? $saldo : 0),
            ]);
        }

    }


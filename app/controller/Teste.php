<?php 
    namespace app\controller;

    use app\model\{Connection,Transaction};
    use app\model\class\Produto;

    class Teste extends Controller
    {
        public function index()
        {
            try {
                Transaction::open('db');

                $prod = Produto::find(1);
                echo '<pre>';
                var_dump($prod);
                echo '</pre>';

                Transaction::close();
                
                $dados = array(
                    'id_prod' => $prod->id,
                    'desc_prod' => $prod->descricao,
                    'estoque_prod' => $prod->estoque
                );
                $this->view(['teste'],$dados);

            } catch (\Exception $e) {
                echo $e->getMessage();
                Transaction::rollback();
            }
        }
    }
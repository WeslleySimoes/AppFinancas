<?php 
    namespace app\controller;

    use app\session\Usuario;
    use app\model\{Transaction,Repository,Criteria};
    use app\utils\FlashMessage;

    class Relatorios extends Controller
    {
        public function index()
        {   
            Usuario::is_logado();
            
            $mesesRelatorio = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
            
            if(!empty($_POST))
            {
                echo '<pre>';
                var_dump($_POST);
                echo '</pre>';
            }


            try {
                Transaction::open('db');

                $resp = new Repository('StdClass');

                $sql ="SELECT MONTH(desp_data) as mes,YEAR(desp_data) as ano FROM receita WHERE id_usuario = ".Usuario::get('id')." GROUP BY ano,mes";

                $listaDatas = $resp->loadCustom($sql);
                
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
                'mesesRelatorios' => $mesesRelatorio 
            ]);
        }

    }


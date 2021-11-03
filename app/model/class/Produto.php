<?php 
    namespace app\model\class;

    use app\model\Record;

    class Produto extends Record
    {
        const TABLENAME = 'produto';

        /*SETTERS */
        public function set_estoque($estoque)
        {
            if(is_numeric($estoque) && $estoque >0)
            {
                $this->data['estoque'] = $estoque;
            }
            else{
                throw new \Exception("Estoque {$estoque} inválido em ".__CLASS__);
            }
        }

        /*GETTERS */
        public function get_estoque()
        {
            return $this->data['estoque'];
        }

        /*MÉTODO DE NEGÓCIO */
        public function lucroLiquido()
        {
            if(isset($this->preco_venda) && isset($this->preco_custo))
            {
                return $this->preco_venda-$this->preco_custo;
            }

            return null;
        }     
    }

    
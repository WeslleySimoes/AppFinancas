<?php 
    namespace app\model;

    final class Repository
    {
        //Classe manipulada pelo Repositório
        private $activeRecord; 

        public function __construct($class)
        {
            $this->activeRecord = $class;
        }

        public function loadCustom($sql)
        {
            //Obtém a transação ativa
            if($conn = Transaction::get())
            {
                //Registra mensagem de Log
                Transaction::log($sql);

                //Executa a consulta no banco de dados
                $result = $conn->query($sql);

                $results = array();

                if($result)
                {
                    //Percorre os resultados da pesquisa retornando um objeto
                    while($row = $result->fetchObject($this->activeRecord))
                    {
                        //Armazena no array result
                        $results[] = $row;
                    }

                    return $results;
                }
            }
            else
            {
                throw new \Exception('Não há transação ativa!');
            }
        }

        public function load(Criteria|null $criteria = null)
        {
            //instancia a instrução de SELECT
            $sql = "SELECT * FROM ".constant($this->activeRecord.'::TABLENAME');

            if($criteria)
            {
                $expressao = $criteria->dump();

                if($expressao)
                {
                    $sql .= " WHERE ".$expressao;
                }

                //Obtém as propriedades do critério
                $order = $criteria->getProperty('order');
                $limit = $criteria->getProperty('limit');
                $offset = $criteria->getProperty('offset');

                //Obtém a ordenação do SELECT
                if($order)
                {
                    $sql .= ' ORDER BY '.$order;
                }
                if($limit)
                {
                    $sql .= ' LIMIT '.$limit;
                }
                if($offset)
                {
                    $sql .= ' OFFSET '.$offset;
                }
            }

            //Obtém a transação ativa
            if($conn = Transaction::get())
            {
                //Registra mensagem de Log
                Transaction::log($sql);

                //Executa a consulta no banco de dados
                $result = $conn->query($sql);

                $results = array();

                if($result)
                {
                    //Percorre os resultados da pesquisa retornando um objeto
                    while($row = $result->fetchObject($this->activeRecord))
                    {
                        //Armazena no array result
                        $results[] = $row;
                    }

                    return $results;
                }
            }
            else
            {
                throw new \Exception('Não há transação ativa!');
            }
        }

        public function delete(Criteria $criteria)
        {
            $sql = "DELETE FROM ".constant($this->activeRecord.'::TABLENAME');
            
            $expression = $criteria->dump();

            if($expression)
            {
                $sql .= " WHERE ".$expression;
            }

            //Obtém a transação ativa
            if($conn = Transaction::get())
            {
                //Registra instrução sql no log
                Transaction::log($sql);

                //Executa instrução de DELETE
                $result = $conn->exec($sql);

                return $result;
            }
            else
            {
                throw new \Exception('Não há transação ativa!');
            }
        }

        public function count(Criteria $criteria)
        {
            $expression = $criteria->dump();

            $sql = "SELECT count(*) FROM ".constant($this->activeRecord.'::TABLENAME');

            if($expression)
            {
                $sql .= ' WHERE '.$expression;
            }

            //Obtém transação ativa
            if($conn = Transaction::get())
            {
                //Inseri a string de consulta no log
                Transaction::log($sql);

                //Executa a consulta
                $result = $conn->query($sql);

                if($result)
                {
                    $row = $result->fetch();
                }

                return $row[0]; // Retorna o resultado
            }
            else
            {
                throw new \Exception('Não há transação ativa!');
            }
        }

        public function sum(Criteria $criteria,$coluna = '*')
        {
            $expression = $criteria->dump();

            $sql = "SELECT sum($coluna) FROM ".constant($this->activeRecord.'::TABLENAME');

            if($expression)
            {
                $sql .= ' WHERE '.$expression;
            }

            //Obtém transação ativa
            if($conn = Transaction::get())
            {
                //Inseri a string de consulta no log
                Transaction::log($sql);

                //Executa a consulta
                $result = $conn->query($sql);

                if($result)
                {
                    $row = $result->fetch();
                }

                return $row[0]; // Retorna o resultado
            }
            else
            {
                throw new \Exception('Não há transação ativa!');
            }
        }        

    }
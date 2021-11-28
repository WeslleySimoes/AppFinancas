<?php 
    namespace app\model;
    
    class Criteria
    {
        private $filters; //armazena a lista de filtros
        private $properties;

        function __construct()
        {
            $this->filters = array();
        }

        public function add($variable,$compare_operator,$value,$logic_operator = 'and',$transform = true)
        {
            //Na primeira vez não precisamos concatenar
            if(empty($this->filters))
            {
                $logic_operator = null;
            }
            if($transform)
            {
                $this->filters[] = [$variable,$compare_operator,$this->transform($value),$logic_operator];
            }
            else{
                $this->filters[] = [$variable,$compare_operator,$value,$logic_operator];
            }
        }

        public function transform($value)
        {
            //Caso seja um array
            if(is_array($value))
            {
                foreach($value as $x)
                {
                    if(is_integer($x)){
                        $foo[] = $x;
                    }
                    else if(is_string($x))
                    {
                        $foo[] = "'$x'";
                    }
                }
                //converte o array em string separada por ","
                $result = '('.implode(',',$foo).')';
                
            }
            else if(is_string($value))
            {
                $result = "'$value'";
            }
            else if(is_null($value))
            {
                $result = 'NULL';
            }
            else if(is_bool($value))
            {
                $result = $value ? 'TRUE' : 'FALSE';
            }
            else{
                $result = $value;
            }

            return $result; //retorna o valor
        }

        public function dump()
        {
            //Concatena a lista de expressões
            if(is_array($this->filters) and count($this->filters) > 0)
            {
                $result = '';
                foreach($this->filters as $filter)
                {
                    $result .= $filter[3].' '.$filter[0].' '.$filter[1].' '.$filter[2].' '; 
                }
                $result = trim($result);

                return "({$result})";
            }
        }

        public function setProperty($property,$value)
        {
            if(isset($value))
            {
                $this->properties[$property] = $value;
            }
            else{
                $this->properties[$property] = null;
            }
        }

        public function getProperty($property)
        {
            if(isset($this->properties[$property]))
            {
                return $this->properties[$property];
            }
        }
    }
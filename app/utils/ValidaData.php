<?php 
    namespace app\utils;

    final class ValidaData
    {
        //guarda primeira data do mês
        private $dataInicioMes;
        //guarda ultima data do mês
        private $dataFinalMes;
        private $dataParam;

        public function __construct($data)
        {
            $this->dataParam = $data;
            $this->dataInicioMes =  date('Y-m').'-01';
            $this->dataFinalMes  =  date('Y-m').'-'.date("t", mktime(0,0,0,date('m'),'01',date('Y')));

            return $this;
        }

        public function validar()
        {

            $dataRecebida = new \DateTime($this->dataParam);
            echo $dataRecebida->format('m');    

            if($this->dataParam < $this->dataInicioMes || $this->dataParam > $this->dataFinalMes)
            {
                return false;
            }

            return true;
        }

        public function getDataInicioMes()
        {
            return $this->dataInicioMes;
        }

        public function getDataFinalMes()
        {
            return $this->dataFinalMes;
        }
    }
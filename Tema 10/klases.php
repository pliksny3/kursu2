<?php

//Tema 10: lentele su duomenimis
class Mokinys{
    public $vardas;
    public $pavarde;

    function __construct($vardas,$pavarde)
    {
        $this->vardas=$vardas;
        $this->pavarde=$pavarde;
    }

    function pilnasVardas(){
        return $this->vardas.' '.$this->pavarde;
    }
}

class Trimestras extends Mokinys{
    public $trimestras;

    function __construct($vardas, $pavarde, $trimestras)
    {
        parent::__construct($vardas, $pavarde);
        $this->trimestras=$trimestras;
    }
    public function vid(){
        $vid=array_sum($this->trimestras)/count($this->trimestras);
        return round($vid, 2);
    }
}

//===============================================


?>
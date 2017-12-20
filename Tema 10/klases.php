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
    function duomenys(){
        $vid=array_sum($this->trimestras)/count($this->trimestras);
        return '<tr><td>'.$this->vardas.'</td><td>'.$this->pavarde.'</td><td>'.round($vid,2).'</td></tr>';
    }
}

$mokinys1= new Trimestras('Jonas','Jonaitis', ['lietuviu'=>8, 'matematika'=>9, 'anglu'=>8]);
$mokinys2= new Trimestras('Asta','Astaite', ['lietuviu'=>5, 'matematika'=>10, 'anglu'=>8]);
$mokinys3= new Trimestras('Domas','Domaitis', ['lietuviu'=>4, 'matematika'=>8, 'anglu'=>7]);
$mokinys4= new Trimestras('Jurga','Jurgaite', ['lietuviu'=>3, 'matematika'=>2, 'anglu'=>10]);
//===============================================


?>
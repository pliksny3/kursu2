<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        table, th, td{
            border: 2px solid black;
            border-collapse: collapse;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<?php
date_default_timezone_set('EET');
class Zmogus{
    public $vardas;
    public $pavarde;

    function __construct($vardas, $pavarde){
        $this->vardas=$vardas;
        $this->pavarde=$pavarde;
    }
    function pilnasVardas(){
        return $this->vardas.' '.$this->pavarde;
    }
}
class Mokinys extends Zmogus{
    public $lygis;
    public $trimestras;
    public $gimimoData;
    function __construct($lygis,$vardas, $pavarde,$gimimoData){
        parent::__construct($vardas, $pavarde);
        $this->lygis=$lygis;
        $this->gimimoData=new DateTime($gimimoData);
    }
    function mokinioMetai($x){
        $date= date_create();
        $age=date_diff($date,$x->gimimoData)->format('%y');
        return $age;
    }
}

$mokiniai= [
    new Mokinys('3a','Jonas','Jonaitis','1995-12-27'),
    new Mokinys('4a','Domas','Domulis','2000-12-27'),
    new Mokinys('3m','Asta','Astaite','2010-12-27'),
    new Mokinys('5h','Jonas','Paplaukes','1800-12-27')
];
?>

<table>
    <thead>
    <tr>
        <td>LYGIS</td>
        <td>VARDAS</td>
        <td>PAVARDE</td>
        <td>GIMIMO DATA</td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($mokiniai as $Mokinys){
        if($Mokinys->mokinioMetai($Mokinys) >= 18){
            echo '<tr><td>'.$Mokinys->lygis.'</td><td>'.$Mokinys->vardas.'</td><td>'.$Mokinys->pavarde.'</td><td>'.$Mokinys->mokinioMetai($Mokinys).'</td></tr>';
        }
    }
    ?>
    </tbody>
</table>
</body>
</html>
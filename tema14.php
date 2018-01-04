<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        table, th, td {
            border: 2px solid black;
            border-collapse: collapse;
            padding: 10px;
        }
        table{margin: auto;
            margin-top: 20px}
    </style>
</head>
<body>


<form action="" method='post'>
    <input name='date' type='datetime-local' placeholder="Date & Time">
    <input name='number' type='text' placeholder="License Plate">
    <input name='distance' type='number' placeholder="Distance">
    <input name='time' type='number' placeholder="Time">
    <input type='submit' value='Submit'>

    <input name='filter' type='text' placeholder="Filter data">
    <input type='submit' value='Filter'>
</form>


<?php
session_start();
class Radar{
    public $data;
    public $number;
    public $distance;
    public $time;

    function __construct($data,$number,$distance,$time)
    {
        $this->data = $data;
        $this->number = $number;
        $this->distance = $distance;
        $this->time = $time;
    }
    public function speed(){
        $speed=round(($this->distance/$this->time)*3.6,1);
        return $speed;
    }
}

if(!empty($_POST) && !empty($_POST['date']) && !empty($_POST['number'])
    && !empty($_POST['distance']) && !empty($_POST['time'])){
    $_SESSION['data'][]=$_POST;
    echo '<script>window.location=window.location;</script>'; exit();
}

if(!empty($_SESSION['data'])){
    $array=[];

    foreach ($_SESSION['data'] as $value){
        if (!empty($_POST) && $_POST['filter']!=''){
            if (!preg_match('/'.preg_quote($_POST['filter'],'/').'/i',$value['number'])){
                continue;
            }
        }
        $array[]= new Radar($value['date'], $value['number'], $value['distance'], $value['time']);
    }

    usort($array, function ($a, $b){
        return ($a->speed() < $b->speed());
    });
}

function lentele($array){
    foreach ($array as $data) {
        echo '<tr><td>'.$data->data.'</td><td>'.$data->number.'</td><td>'.$data->distance.
            '</td><td>'.$data->time.'</td><td>'.$data->speed().'</td></tr>';
    }
}

?>


<table>
    <thead>
    <tr>
        <th>DATE/TIME</th>
        <th>LICENSE NUMBER</th>
        <th>DISTANCE</th>
        <th>TIME</th>
        <th>SPEED</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if(empty($array)){

    }else{
        lentele($array);
    }
    ?>
    </tbody>
</table>
</body>
</html>
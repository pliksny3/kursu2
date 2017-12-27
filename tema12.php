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
    </style>
</head>
<body>

<?php

class Radar
{
    public $date;
    public $number;
    public $distance;
    public $time;

    public function __construct($date, $number, $distance, $time)
    {
        $this->date = $date;
        $this->number = $number;
        $this->distance = $distance;
        $this->time = $time;
    }

    function speed()
    {
        $speed = ($this->distance / 1000) / ($this->time / 3600);
        return $speed;
    }
}

$objArray = [
    new Radar(new DateTime('2017-01-01'), 'AAA111', (double)1000, (double)3600),
    new Radar(new DateTime('2017-02-02'), 'BBB222', (double)4000, (double)4600),
    new Radar(new DateTime('2017-05-10'), 'CCC333', (double)5000, (double)5600),
    new Radar(new DateTime('2017-01-28'), 'DDD444', (double)6000, (double)6600)
];


usort($objArray, function ($a, $b) {
    return ($a->speed() < $b->speed());
});
foreach ($objArray as $radar) {
    echo $radar->date->format("Y-m-d") . ' * ' . $radar->number . ' * ' . $radar->distance . ' * ' .
        $radar->time . ' * ' . round($radar->speed(), 1) . '<br><br>';
}
?>


<table>
    <thead>
    <tr>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</body>
</html>
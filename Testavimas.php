<!DOCTYPE html>
<html>
<head>
    <title>php2uzduotis</title>
    <meta charset="utf-8">
    <style>
        table, td{border: 2px solid black;border-collapse: collapse;padding: 10px}
    </style>
</head>

<body>

<h1>Radaro duomenys</h1>
<table>
    <tr>
        <th>Automobilio numeris</th>
        <th>Registracijos data</th>
        <th>Greitis km/h</th>
    </tr>


    <?php
    $serverName = "localhost";
    $useName = "Auto";
    $password = "LabaiSlaptas123";
    $dbName = "auto";
    $puslapis = @$_GET['puslapis'];
    if ($puslapis < 1){
        $puslapis = 0;
    }
    $conn = new mysqli($serverName, $useName, $password, $dbName);
    if ($conn->connect_error){
        die("connection failed ". $conn->connect_error);
    }
    $sql = "SELECT count(1) as viso FROM radars";
    $rezult = $conn->query($sql);
    $row = $rezult->fetch_assoc();
    $visoIrasu = $row['viso'];
    $sql = "SELECT date, number, distance, time, distance/time*3.6 AS speed FROM radars ORDER BY speed DESC, date DESC LIMIT ".(10*$puslapis).", 10";
    $rezult = $conn->query($sql);
    if ($rezult->num_rows > 0){
        while ($row = $rezult->fetch_assoc()){
            echo '<tr><td>' .$row['number']. '</td><td>' .$row['date']. '</td><td>' .$row['speed']. '</td></tr>';
        }
    } else {
        echo '0 rezultatu';
    }
    $conn->close();
    ?>

</table>

<?php
if ($puslapis > 0){
    echo '<a href="?puslapis='.($puslapis-1).'" >Atgal</a>';
}
$viso = ceil($visoIrasu/10);
for ($i = 0; $i < $viso; $i++){
    $stilius = '';
    if ($i == $puslapis){
        $stilius = 'active';
    }
    echo '<a class="'.$stilius.'" href="?puslapis=' .($i).'" >'.($i+1).'</a>';
}
if ($rezult->num_rows >= 10){
    echo '<a href="?puslapis=' .($puslapis+1).'" >Pirmyn</a>';
}
?>

</body>
</html>
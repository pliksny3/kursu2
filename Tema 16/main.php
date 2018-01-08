<!DOCTYPE html>
<html>
<head>
    <title>title</title>
    <meta charset="UTF-8">
    <style>
        table, td, th{
            border: 2px solid black;border-collapse: collapse;padding: 10px;}
            input{ border: 2px solid black; border-radius: 10px; padding: 5px}
            table{margin: auto;}
            .scroll{max-height: 600px; overflow: auto}
    </style>
</head>
<body>

<form action="" method="POST">
    <input name="date" type="date" placeholder="date">
    <input name="number" type="text" placeholder="number">
    <input name="distance" type="number" placeholder="distance">
    <input name="time" type="number" placeholder="time">
    <input type="submit" value="submit/edit">
    <input name="id" type="number" placeholder="id">
</form>
<hr>

<?php
require_once 'functions.php';

$conn = conn();
    if(empty($_REQUEST['id'])){
        $sql = $conn->prepare("INSERT INTO radars (date, number, distance, time) VALUE (?, ?, ?, ?)");

        $sql -> bind_param("ssdd", $_REQUEST['date'], $_REQUEST['number'], $_REQUEST['distance'], $_REQUEST['time']);

        $sql -> execute();
    }else{
        $id = $_REQUEST['id'];
        $date = $_REQUEST['date'];
        $number = $_REQUEST['number'];
        $distance = $_REQUEST['distance'];
        $time = $_REQUEST['time'];

        $sql = "UPDATE radars SET date = ?, number = ?, distance = ?, time = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ssddi", $date, $number, $distance, $time, $id);

        $stmt->execute();
    }


    return table($conn);


//$sql = "UPDATE radars SET distance = ?, time = ? WHERE id = ?";
//$stmt = $conn->prepare($sql);
//
//$stmt->bind_param("ddi", $kelias, $laikas, $id);
//
//$stmt->execute();


$conn->close();
?>

</body>
</html>
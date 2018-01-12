<!DOCTYPE html>
<html>
<head>
    <title>title</title>
    <meta charset="UTF-8">
    <style>
        table, td, th {
            border: 2px solid black;
            border-collapse: collapse;
            padding: 10px;
        }

        input {
            border: 2px solid black;
            border-radius: 10px;
            padding: 5px
        }

        table {
            margin: auto;
        }

        .scroll {
            max-height: 600px;
            overflow: auto
        }
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

if(!$_POST){exit();}
if (!empty($_REQUEST['date']) && !empty($_REQUEST['number']) && !empty($_REQUEST['distance']) && !empty($_REQUEST['time'])
    && empty($_REQUEST['id'])) {
    $sql = $conn->prepare("INSERT INTO radars (date, number, distance, time) VALUE (?, ?, ?, ?)");
    $sql->bind_param("ssdd", $_REQUEST['date'], $_REQUEST['number'], $_REQUEST['distance'], $_REQUEST['time']);
    $sql->execute();
}elseif (empty($_REQUEST['date']) && empty($_REQUEST['number']) && empty($_REQUEST['distance']) && empty($_REQUEST['time'])
    && !empty($_REQUEST['id'])){
    $sql = $conn->prepare("DELETE FROM radars WHERE id = ?");
    $sql->bind_param("i", $_REQUEST['id']);
    $sql->execute();
} elseif (!empty($_REQUEST['date']) && !empty($_REQUEST['number']) && !empty($_REQUEST['distance']) && !empty($_REQUEST['time'])
    && !empty($_REQUEST['id'])) {
    $sql = $conn->prepare("UPDATE radars SET date = ?, number = ?, distance = ?, time = ? WHERE id = ?");
    $sql->bind_param("ssddi", $_REQUEST['date'], $_REQUEST['number'], $_REQUEST['distance'], $_REQUEST['time'], $_REQUEST['id']);
    $sql->execute();
}elseif(empty($_REQUEST['date']) && empty($_REQUEST['number']) && empty($_REQUEST['distance']) && empty($_REQUEST['time'])
    && empty($_REQUEST['id'])){

}


table($conn);

$conn->close();
?>

</body>
</html>
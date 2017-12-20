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
        }
    </style>
</head>
<body>

<?php

include('masyvai.php');
include('funkcijos.php');

poros($zmones);
echo '<br><br>';
grupes($zmones);
echo '<br><br>';




?>

<table>
    <thead>
    <tr>
        <th>Vardas</th>
        <th>Lietuviu pazymiai</th>
        <th>Lietuviu vidurkis</th>
        <th>Anglu pazymiai</th>
        <th>Anglu vidurkis</th>
        <th>Matematikos pazymiai</th>
        <th>Matematikos vidurkis</th>
        <th>Bendras vidurkis</th>
    </tr>
    </thead>
    <tbody>
    <?php
    pazymiai($mokiniai);
    ?>
    </tbody>
</table>
</body>
</html>
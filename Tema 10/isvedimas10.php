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



<table>
    <thead>
        <tr>
            <th>Vardas</th>
            <th>Pavarde</th>
            <th>Vidurkis</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include ('klases.php'); include ('funkcijos10.php'); include ('masyvai10.php');
            mokinys($objektaiMokiniai);
        ?>
    </tbody>
</table>

</body>
</html>

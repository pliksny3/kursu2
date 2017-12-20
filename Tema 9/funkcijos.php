<?php
//Tema 9: poru suradimas (isvedimas.php)
function poros(array $array)
{
    foreach ($array as $key => $value) {
        foreach ($array as $key2 => $value2) {
            if ($value['lytis'] != $value2['lytis'] && $key < $key2)
                echo $value['vardas'] . '+' . $value2['vardas'] . '<br>';
        }
    }
}

//Tema 9: grupiu suradimas (isvedimas.php)
function grupes(array $array)
{
    foreach ($array as $key => $value) {
        foreach ($array as $key2 => $value2) {
            foreach ($array as $key3 => $value3) {
                if ($value['lytis'] == $value2['lytis'] && $value['lytis'] == $value3['lytis']) {
                    continue;
                } elseif ($key < $key2 && $key2 < $key3) {
                    echo $value['vardas'] . '+' . $value2['vardas'] . '+' . $value3['vardas'] . '<br>';
                }
            }
        }
    }
}

//Tema 9: lentele su mokiniu pazymiais ir vidurkiais (isvedimas.php)
function pazymiai(array $array)
{
    foreach ($array as $key => $value) {
        $maxvid = 0;
        echo '<tr>';
        echo '<td>' . $value['vardas'] . '</td>';
        foreach ($value['pazymiai'] as $key2 => $value2) {
            echo '<td>';
            $sum = 0;
            foreach ($value2 as $pazymys) {
                echo ' ' . $pazymys . ' ';
                $sum += $pazymys;
            }
            echo '</td>';
            $vid = $sum / count($value2);
            echo '<td>' . round($vid, 2) . '</td>';
            $maxvid += $vid;
        }
        $maxvid = $maxvid / count($value['pazymiai']);
        echo '<td>' . round($maxvid, 2) . '</td>';
    }
    echo '</tr>';
}

?>
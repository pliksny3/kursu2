<?php

function poros(array $array)
{
    foreach ($array as $key => $value) {
        foreach ($array as $key2 => $value2) {
            if ($array[$key]['lytis'] != $array[$key2]['lytis'] && $key < $key2)
                echo $array[$key]['vardas'] . '+' . $array[$key2]['vardas'] . '<br>';
        }
    }
}

function grupes(array $array)
{
    foreach ($array as $key => $value) {
        foreach ($array as $key2 => $value2) {
            foreach ($array as $key3 => $value3) {
                if ($array[$key]['lytis'] == $array[$key2]['lytis'] && $array[$key]['lytis'] == $array[$key3]['lytis']) {
                    continue;
                } elseif ($key < $key2 && $key2 < $key3) {
                    echo $array[$key]['vardas'] . '+' . $array[$key2]['vardas'] . '+' . $array[$key3]['vardas'] . '<br>';
                }
            }
        }
    }
}

?>
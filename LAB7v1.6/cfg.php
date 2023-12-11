<?php

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $baza = 'moja_strona';
    $login = 'admin';
    $pass = 'admin';

    $mysqli = mysqli_connect($dbhost,$dbuser,$dbpass,$baza);
    if (!$mysqli) echo '<b> przerwane połączenie </b>';


?>
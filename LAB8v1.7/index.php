<?php 
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
?>

<!DOCTYPE html>
<html lang="pl">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="nav">
    <nav>
            <a href="./index.php?idp=" class="przycisk strona1">Strona Główna</a>
            <a href="./index.php?idp=bc" class="przycisk strona1">Burdż Chalifa</a>
            <a href="./index.php?idp=st" class="przycisk strona2">Shanghai Tower</a>
            <a href="./index.php?idp=ab" class="przycisk strona1">Abradż al-Bajt </a>
            <a href="./index.php?idp=pfc" class="przycisk strona2">Ping An Finance Center</a>
            <a href="./index.php?idp=lwt" class="przycisk strona1">Lotte World Tower</a>
    </nav>
</div>

<?php
	
    include('cfg.php');
    include('showpage.php');
    if($_GET['idp'] == '') 
    {echo PokazPodstrone(6);}
    if($_GET['idp'] == 'ab') 
    {echo PokazPodstrone(1);}
    if($_GET['idp'] == 'bc') 
    {echo PokazPodstrone(2);}
    if($_GET['idp'] == 'lwt') 
    {echo PokazPodstrone(3);}
    if($_GET['idp'] == 'pfc') 
    {echo PokazPodstrone(4);}
    if($_GET['idp'] == 'st') 
    {echo PokazPodstrone(5);}


    

    ?>




</body>
</html>
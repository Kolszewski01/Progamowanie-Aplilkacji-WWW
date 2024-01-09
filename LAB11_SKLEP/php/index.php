<?php 
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<div class="nav">
    <nav>
        <a href="./index.php?idp=glowna" class="przycisk strona1">Strona Główna</a>
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

$mysqli = CFG::getInstance();
$pages = [];  

$query = "SELECT id, page_title FROM page_list WHERE status = 1";  
$result = $mysqli->query($query);

if($result) {
    while($row = $result->fetch_assoc()) {
        $pages[$row['page_title']] = $row['id'];
    }
}
$defaultHomePageId = '6';
$idp = $_GET['idp'] ?? $defaultHomePageId;  ;  

if (array_key_exists($idp, $pages)) {
    echo PokazPodstrone($pages[$idp]);
} else {
    echo 'Strona nie istnieje.';
}
?>

</body>
</html>

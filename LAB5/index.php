<?php 
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
?>

<!DOCTYPE html>
<html lang="pl">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/timedata.js" type="text/javascript" defer></script>
    <script src="js/kolorujtlo.js" type="text/javascript" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

$strona = '';
if($_GET['idp']=='')
{
    $strona='./html/glowna.html';
}
if($_GET['idp']=='bc')
{
    $strona='./html/burdz.html';
}
if($_GET['idp']=='ab')
{
    $strona='./html/ab.html';
}
if($_GET['idp']=='lwt')
{
    $strona='./html/lwt.html';
}
if($_GET['idp']=='pfc')
{
    $strona='./html/pfc.html';
}
if($_GET['idp']=='st')
{
    $strona='./html/st.html';
}

if(file_exists($strona))
{
    include($strona);
}

?>


</body>
</html>
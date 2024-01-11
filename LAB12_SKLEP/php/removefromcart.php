<?php
session_start();
include 'cart.php';

if(isset($_GET['id'])) {
    $idProduktu = $_GET['id'];
    usunZKoszyka($idProduktu);
}

header('Location: koszyk.php'); 
?>

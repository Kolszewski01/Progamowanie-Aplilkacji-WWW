<?php
session_start();
include 'cart.php';

$idProduktu = $_GET['id'];
usunZKoszyka($idProduktu);
header('Location: index.php');

?>
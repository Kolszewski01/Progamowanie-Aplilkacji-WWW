<?php
session_start();
include 'cart.php';

$idProduktu = intval($_GET['id']);
$ilosc = intval($_GET['ilosc']);
require_once 'cfg.php';
$mysqli = CFG::getInstance();
$query = "SELECT tytul, cena_netto, podatek_vat FROM produkty WHERE id='$idProduktu' LIMIT 1";
$result = $mysqli->query($query);
if ($row = $result->fetch_assoc()) {
    dodajDoKoszyka($idProduktu, $row['tytul'], $ilosc, $row['cena_netto'], $row['podatek_vat']);
}
header('Location: index.php');
?>

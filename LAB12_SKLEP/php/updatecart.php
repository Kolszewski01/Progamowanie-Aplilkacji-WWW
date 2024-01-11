<?php
session_start();
include 'cart.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ilosc'])) {
    foreach ($_POST['ilosc'] as $idProduktu => $ilosc) {
        if (isset($_SESSION['koszyk'][$idProduktu])) {
            $_SESSION['koszyk'][$idProduktu]['ilosc'] = max(1, intval($ilosc));
        }
    }
}


header('Location: index.php');
?>

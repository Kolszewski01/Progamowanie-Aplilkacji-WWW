<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Prosty Sklep</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
    function toggleProdukty(id) {
        var produktyDiv = document.getElementById('produkty-' + id);
        if (produktyDiv.style.display === 'none') {
            produktyDiv.style.display = 'block';
        } else {
            produktyDiv.style.display = 'none';
        }
    }

    function pokazKoszyk() {
        var koszykDiv = document.getElementById('koszyk');
        var kategorieDiv = document.getElementById('kategorie');

        if (koszykDiv.style.display === 'none' || koszykDiv.style.display === '') {
            koszykDiv.style.display = 'block';
            kategorieDiv.style.display = 'none';
        } else {
            koszykDiv.style.display = 'none';
            kategorieDiv.style.display = 'block';
        }
    }

    function zmienIlosc(idProduktu, zmiana) {
    var iloscInput = document.getElementById('ilosc_' + idProduktu);
    var nowaIlosc = parseInt(iloscInput.value) + zmiana;
    if (nowaIlosc < 1) nowaIlosc = 1;
    iloscInput.value = nowaIlosc;
    updateTotal();
}

function updateTotal() {
    var form = document.getElementById('koszykForm');
    var total = 0;
    for (var i = 0; i < form.elements.length; i++) {
        var element = form.elements[i];
        if (element.name.startsWith('ilosc[')) {
            var cena = parseFloat(element.getAttribute('data-cena'));
            total += cena * parseInt(element.value);
        }
    }
    document.getElementById('total').textContent = total.toFixed(2) + ' zł';
}


function submitForm() {
    document.getElementById('koszykForm').submit();
}
    </script>
</head>
<body>
<div class="nav">
    <nav>
        <a href="index.php" class="przycisk">Strona Główna Sklepu</a>
        <a href="javascript:void(0)" onclick="pokazKoszyk()" class="przycisk">Koszyk</a>
    </nav>
</div>
<div class="kategorie">
<h2>Kategorie</h2>
<ul class="main-categories">
<?php
session_start();
include 'cart.php';
require_once 'cfg.php';
$mysqli = CFG::getInstance();
$query_main = "SELECT * FROM kategorie WHERE matka IS NULL OR matka = 0";
$result_main = $mysqli->query($query_main);

foreach ($result_main as $main_row) {
    echo "<li><div class='category' onclick='toggleProdukty(\"pod-{$main_row['id']}\")' style='cursor:pointer;'>" . $main_row['nazwa'] . "</div>";
    echo "<div id='produkty-pod-{$main_row['id']}' class='produkty' style='display:none;'>";
    $query_sub = "SELECT * FROM kategorie WHERE matka = " . $main_row['id'];
    $result_sub = $mysqli->query($query_sub);
    if ($result_sub->num_rows > 0) {
        echo '<ul class="sub-categories">';
        foreach ($result_sub as $sub_row) {
            echo "<li><div class='subcategory' onclick='toggleProdukty(\"{$sub_row['id']}\")' style='cursor:pointer;'>" . $sub_row['nazwa'] . "</div>";
            echo "<div id='produkty-{$sub_row['id']}' class='produkty' style='display:none;'>";
            $query_produkty = "SELECT * FROM produkty WHERE kategoria='{$sub_row['id']}' AND status_dostepnosci='dostepny'";
            $result_produkty = $mysqli->query($query_produkty);
            while ($produkt = $result_produkty->fetch_assoc()) {
                echo "<div class='produkt'>";
                echo "<img src='{$produkt['zdjecie']}' alt='{$produkt['tytul']}' style='width:100px;'>";
                echo "<div class='produkt-details'>";
                echo "<p><strong>{$produkt['tytul']}</strong></p>";
                echo "<p>{$produkt['opis']}</p>";
                echo "<span class='spec'>Cena: <strong>{$produkt['cena_netto']}</strong> zł</span>";
                echo "<span class='spec'>VAT: <strong>{$produkt['podatek_vat']}%</strong></span>";
                echo "<p>Dostępne: <strong>{$produkt['ilosc_dostepnych_sztuk']}</strong> sztuk</p>";
                echo "</div>";
                echo "<p><a href='addtocart.php?id={$produkt['id']}&ilosc=1'>Dodaj do koszyka</a></p>";
                echo "</div>";
                
            }
            echo "</div></li>";
        }
        echo '</ul>';
    }
    echo "</div></li>";
}
?>
</ul>
</div>
<div id="koszyk" class="koszyk" style="display:none;">
    <h2>Twój Koszyk</h2>
    <?php pokazKoszyk();
     ?>
</div>
</div>
</body>
</html>

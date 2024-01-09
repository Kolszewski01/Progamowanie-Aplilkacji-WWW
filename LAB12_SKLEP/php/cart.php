<?php
function dodajDoKoszyka($idProduktu, $nazwa, $ilosc, $cena, $vat) {
    $cenaBrutto = $cena + ($cena * $vat / 100);
    if (isset($_SESSION['koszyk'][$idProduktu])) {
        // Aktualizacja istniejącego wpisu produktu w koszyku.
        $_SESSION['koszyk'][$idProduktu]['ilosc'] += $ilosc;
        // Możesz tu również dodać logikę, która sprawdzi maksymalną dostępną ilość, jeśli jest taka potrzeba.
    } else {
        // Dodanie nowego produktu do koszyka.
        $_SESSION['koszyk'][$idProduktu] = array(
            'nazwa' => $nazwa, // Nazwa produktu.
            'ilosc' => $ilosc, // Ilość dodawanego produktu.
            'cena_brutto' => $cenaBrutto // Cena brutto jednostkowa.
        );
    }
}

function usunZKoszyka($idProduktu) {
    if (isset($_SESSION['koszyk'][$idProduktu])) {
        unset($_SESSION['koszyk'][$idProduktu]);
    }
}
function pokazKoszyk() {
    $total = 0;
    if (isset($_SESSION['koszyk']) && count($_SESSION['koszyk']) > 0) {
        echo '<form action="update_cart.php" method="post" id="koszykForm">';
        foreach ($_SESSION['koszyk'] as $idProduktu => $produkt) {
            $subtotal = $produkt['cena_brutto'] * $produkt['ilosc'];
            $total += $subtotal;
            echo "<div>{$produkt['nazwa']} - ";
            echo "<button type='button' onclick='zmienIlosc(\"$idProduktu\", -1)'>-</button>";
            echo "<input type='number' name='ilosc[$idProduktu]' value='{$produkt['ilosc']}' min='1' id='ilosc_$idProduktu' data-cena='{$produkt['cena_brutto']}' onchange='updateTotal()'>";
            echo "<button type='button' onclick='zmienIlosc(\"$idProduktu\", 1)'>+</button>";
            echo " Cena: $subtotal zł</div>";
        }
        echo "<div>Razem: <span id='total'>$total</span> zł</div>";
        echo "<button type='button' onclick='submitForm()'>Kup</button>";
        echo '</form>';
    } else {
        echo 'Koszyk jest pusty.';
    }
}




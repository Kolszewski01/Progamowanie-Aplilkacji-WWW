<?php
function dodajDoKoszyka($idProduktu, $nazwa, $ilosc, $cena, $vat) {
    $mysqli = CFG::getInstance();

    $stmt = $mysqli->prepare("SELECT ilosc_dostepnych_sztuk, status_dostepnosci FROM produkty WHERE id = ?");
    $stmt->bind_param("i", $idProduktu);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($produkt = $result->fetch_assoc()) {
        if ($produkt['status_dostepnosci'] != 'Dostepny' || $produkt['ilosc_dostepnych_sztuk'] < $ilosc) {
            echo "Produkt niedostępny lub nie ma wystarczającej ilości.";
            return;
        }
    }

    $cenaBrutto = $cena + ($cena * $vat / 100);
    if (isset($_SESSION['koszyk'][$idProduktu])) {
        $_SESSION['koszyk'][$idProduktu]['ilosc'] += $ilosc;
    } else {
        $_SESSION['koszyk'][$idProduktu] = array(
            'nazwa' => $nazwa,
            'ilosc' => $ilosc,
            'cena_brutto' => $cenaBrutto
        );
    }
}

function usunZKoszyka($idProduktu) {
    if (isset($_SESSION['koszyk'][$idProduktu])) {
        unset($_SESSION['koszyk'][$idProduktu]);
    }
}

function usun() {
    if (isset($_SESSION['koszyk'])) {
        unset($_SESSION['koszyk']);
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
            echo "<a href='removefromcart.php?id=$idProduktu'>Usuń</a>"; 
            echo " Cena: $subtotal zł</div>";
        }
        echo "<div>Razem: <span id='total'>$total</span> zł</div>";
        echo "<button type='button' onclick='usunWszystko()'>KUP</button>"; 

        echo '</form>';
    } else {
        echo 'Koszyk jest pusty.';
    }
}


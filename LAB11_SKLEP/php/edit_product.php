<?php
require_once 'cfg.php';
$mysqli = CFG::getInstance();

if (!isset($_GET['id'])) {
    exit('Brak ID produktu.');
}
$produkt_id = intval($_GET['id']);

$query = "SELECT * FROM produkty WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $produkt_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $produkt_data = $result->fetch_assoc();
} else {
    echo "Nie znaleziono produktu o ID: $produkt_id";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tytul = $_POST['tytul'] ?? '';
    $opis = $_POST['opis'] ?? '';
    $data_wygasniecia = $_POST['data_wygasniecia'] ?? null;
    $cena_netto = $_POST['cena_netto'] ?? 0;
    $podatek_vat = $_POST['podatek_vat'] ?? 0;
    $ilosc_dostepnych_sztuk = $_POST['ilosc_dostepnych_sztuk'] ?? 0;
    $status_dostepnosci = $_POST['status_dostepnosci'] ?? '';
    $kategoria = $_POST['kategoria'] ?? null;
    $gabaryt_produktu = $_POST['gabaryt_produktu'] ?? '';
    $zdjecie = $_POST['zdjecie'] ?? '';
    $update_query = "UPDATE produkty SET tytul = ?, opis = ?, data_wygasniecia = ?, cena_netto = ?, podatek_vat = ?, ilosc_dostepnych_sztuk = ?, status_dostepnosci = ?, kategoria = ?, gabaryt_produktu = ?, zdjecie = ? WHERE id = ?";
    $update_stmt = $mysqli->prepare($update_query);
    $update_stmt->bind_param("sssdidsisii", $tytul, $opis, $data_wygasniecia, $cena_netto, $podatek_vat, $ilosc_dostepnych_sztuk, $status_dostepnosci, $kategoria, $gabaryt_produktu, $zdjecie, $produkt_id);
    if ($update_stmt->execute()) {
        echo 'Produkt został zaktualizowany.';
        header("Location: admin.php");
        exit;
    } else {
        echo 'Błąd podczas aktualizacji produktu.';
    }
}
?>

<form method="POST">
    <label for="tytul">Tytuł produktu:</label><br>
    <input type="text" id="tytul" name="tytul" value="<?php echo htmlspecialchars($produkt_data['tytul']); ?>"><br>
    <label for="opis">Opis:</label><br>
    <textarea id="opis" name="opis"><?php echo htmlspecialchars($produkt_data['opis']); ?></textarea><br>
    <label for="data_wygasniecia">Data wygaśnięcia:</label><br>
    <input type="datetime-local" id="data_wygasniecia" name="data_wygasniecia" value="<?php echo htmlspecialchars($produkt_data['data_wygasniecia']); ?>"><br>
    <label for="cena_netto">Cena netto:</label><br>
    <input type="number" step="0.01" id="cena_netto" name="cena_netto" value="<?php echo htmlspecialchars($produkt_data['cena_netto']); ?>"><br>
    <label for="podatek_vat">Podatek VAT:</label><br>
    <input type="number" step="0.01" id="podatek_vat" name="podatek_vat" value="<?php echo htmlspecialchars($produkt_data['podatek_vat']); ?>"><br>
    <label for="ilosc_dostepnych_sztuk">Ilość dostępnych sztuk:</label><br>
    <input type="number" id="ilosc_dostepnych_sztuk" name="ilosc_dostepnych_sztuk" value="<?php echo htmlspecialchars($produkt_data['ilosc_dostepnych_sztuk']); ?>"><br>
    <label for="status_dostepnosci">Status dostępności:</label><br>
    <input type="text" id="status_dostepnosci" name="status_dostepnosci" value="<?php echo htmlspecialchars($produkt_data['status_dostepnosci']); ?>"><br>
    <label for="kategoria">Kategoria:</label><br>
    <input type="number" id="kategoria" name="kategoria" value="<?php echo htmlspecialchars($produkt_data['kategoria']); ?>"><br>
    <label for="gabaryt_produktu">Gabaryt produktu:</label><br>
    <input type="text" id="gabaryt_produktu" name="gabaryt_produktu" value="<?php echo htmlspecialchars($produkt_data['gabaryt_produktu']); ?>"><br>
    <label for="zdjecie">Zdjęcie (link):</label><br>
    <input type="text" id="zdjecie" name="zdjecie" value="<?php echo htmlspecialchars($produkt_data['zdjecie']); ?>"><br>
    <input type="submit" value="Zapisz zmiany">
</form>
<a href="admin.php"><button>POWRÓT</button></a>

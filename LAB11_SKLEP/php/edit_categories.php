<?php
require_once 'cfg.php';
$mysqli = CFG::getInstance();

if (!isset($_GET['id'])) {
    exit('Brak ID kategorii.');
}
$kategoria_id = intval($_GET['id']);

$query = "SELECT * FROM kategorie WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $kategoria_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $kategoria_data = $result->fetch_assoc();
} else {
    echo "Nie znaleziono kategorii o ID: $kategoria_id";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nazwa = $_POST['nazwa'];
    $matka = $_POST['matka'] ? intval($_POST['matka']) : null;

    $update_query = "UPDATE kategorie SET nazwa = ?, matka = ? WHERE id = ?";
    $update_stmt = $mysqli->prepare($update_query);
    $update_stmt->bind_param("sii", $nazwa, $matka, $kategoria_id);

    if ($update_stmt->execute()) {
        echo 'Kategoria została zaktualizowana.';
        header("Refresh: 0");
    } else {
        echo 'Błąd podczas aktualizacji kategorii.';
    }
}
?>

<form method="POST">
    <label for="nazwa">Nazwa kategorii:</label><br>
    <input type="text" id="nazwa" name="nazwa" value="<?php echo htmlspecialchars($kategoria_data['nazwa']); ?>"><br>

    <label for="matka">ID matki:</label><br>
    <input type="number" id="matka" name="matka" value="<?php echo htmlspecialchars($kategoria_data['matka']); ?>"><br><br>

    <input type="submit" value="Zapisz zmiany">
</form>
<a href="admin.php"><button>POWRÓT</button></a>

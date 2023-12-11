<?php
require_once 'cfg.php';

if (!isset($_GET['id'])) {
    exit('Brak ID strony.');
}
$page_id = intval($_GET['id']);

$query = "SELECT * FROM page_list WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $page_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $page_data = $result->fetch_assoc();
} else {
    echo "Nie znaleziono strony o ID: $page_id";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $page_title = $_POST['page_title'];
    $page_content = $_POST['page_content'];
    $status = isset($_POST['status']) ? 1 : 0;

    $update_query = "UPDATE page_list SET page_title = ?, page_content = ?, status = ? WHERE id = ?";
    $update_stmt = $mysqli->prepare($update_query);
    $update_stmt->bind_param("ssii", $page_title, $page_content, $status, $page_id);

    if ($update_stmt->execute()) {
        echo 'Strona została zaktualizowana.';
        header("REFRESH:0.1");
    } else {
        echo 'Błąd podczas aktualizacji strony.';
    }
}
?>

<form method="POST">
    <label for="page_title">Tytuł strony:</label><br>
    <input type="text" id="page_title" name="page_title" value="<?php echo htmlspecialchars($page_data['page_title']); ?>"><br>

    <label for="page_content">Treść strony:</label><br>
    <textarea id="page_content" name="page_content" rows="50" cols="100"><?php echo htmlspecialchars($page_data['page_content']); ?></textarea><br>

    <label for="status">Aktywny:</label>
    <input type="checkbox" id="status" name="status" <?php echo $page_data['status'] ? 'checked' : ''; ?>><br><br>

    <input type="submit" value="Zapisz zmiany">
</form>
<a href="admin.php"><button>POWRÓT</button></a>

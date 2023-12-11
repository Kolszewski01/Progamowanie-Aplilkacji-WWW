<?php
session_start();
require_once 'cfg.php';

function ListaStron($mysqli) {
    $query = "SELECT * FROM page_list";
    $result = $mysqli->query($query);

    while ($row = $result->fetch_assoc()) {
        echo "ID " . $row['id'] . " |  Tytuł: " . $row['page_title'] . " | ";
        echo "<button onclick='location.href=\"edit_page.php?id=" . $row['id'] . "\"'>Edytuj</button> ";
        echo "<button onclick='location.href=\"delete_page.php?id=" . $row['id'] . "\"'>Usuń</button><br/>";
    }
}

function FormularzLogowania() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        global $mysqli;
        $login = $mysqli->real_escape_string($_POST['login']);
        $haslo = $mysqli->real_escape_string($_POST['haslo']);

        $query = "SELECT * FROM uzytkownicy WHERE login = '$login' AND haslo = '$haslo'";
        $result = $mysqli->query($query);

        if ($result->num_rows > 0) {
            $_SESSION['logged_in'] = true;
            header('Location: admin.php');
            exit;
        } else {
            echo '<p>Błędny login lub hasło.</p>';
        }
    }

    echo '<form method="post">';
    echo '<input type="text" name="login" placeholder="Login" required>';
    echo '<input type="password" name="haslo" placeholder="Hasło" required>';
    echo '<input type="submit" value="Zaloguj">';
    echo '</form>';
}

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    FormularzLogowania();
    exit;
}

function DodajNowaPodstrone($mysqli) {
    $formularz = <<<EOD
    <br><br>
    <h1>Dodaj Nową Podstronę</h1>
    <form method="POST" action="">
        <label for="page_title">Tytuł strony:</label><br>
        <input type="text" id="page_title" name="page_title" value=""><br>
        <label for="page_content">Treść strony:</label><br>
        <textarea id="page_content" name="page_content" rows="50" cols="100"></textarea><br>
        <label for="status">Aktywny:</label>
        <input type="checkbox" id="status" name="status" value="1"><br><br>
        <input type="submit" value="Zapisz zmiany">
    </form>
    EOD;
    echo $formularz;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $page_title = isset($_POST['page_title']) ? $_POST['page_title'] : '';
        $page_content = isset($_POST['page_content']) ? $_POST['page_content'] : '';
        $stat = isset($_POST['status']) ? 1 : 0;

        $stmt = $mysqli->prepare("INSERT INTO page_list (page_title, page_content, status) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die("Błąd przygotowania zapytania: " . $mysqli->error);
        }

        $stmt->bind_param("ssi", $page_title, $page_content, $stat);

        if ($stmt->execute()) {
            echo "Nowy rekord został dodany";
            header("Location: admin.php");
            exit;
        } else {
            echo "Błąd przy dodawaniu rekordu: " . $stmt->error;
        }

        $stmt->close();
    }
}

ListaStron($mysqli);
DodajNowaPodstrone($mysqli);

if (isset($_GET['id'])) {
    $page_id = intval($_GET['id']);

    $query = "SELECT * FROM page_list WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $page_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        exit('Strona nie istnieje.');
    }
    $page_data = $result->fetch_assoc();
}

$mysqli->close();
?>

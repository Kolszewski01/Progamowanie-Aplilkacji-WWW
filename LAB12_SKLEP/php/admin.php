<?php
ob_start();
    require_once '../css/stylecms.php';


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '..\vendor\phpmailer\phpmailer\src\Exception.php';
    require '..\vendor\phpmailer\phpmailer\src\PHPMailer.php';
    require '..\vendor\phpmailer\phpmailer\src\SMTP.php';
    require_once 'cfg.php';
require_once 'category.php';
session_start();

function ListaStron() {
    $mysqli = CFG::getInstance();
    $query = "SELECT * FROM page_list";
    $result = $mysqli->query($query);

    echo '<table class="data-table">';
    echo '<tr><th>ID</th><th>Tytuł</th><th>Akcje</th></tr>';

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['page_title'] . "</td>";
        echo "<td>
                <a href='edit_page.php?id=" . $row['id'] . "' class='button-link'>Edytuj</a>
                <a href='delete_page.php?id=" . $row['id'] . "' class='button-delete'>Usuń</a>
              </td>";
        echo "</tr>";
    }

    echo '</table>';
}


function ListaKategorii() {
    $mysqli = CFG::getInstance();
    $query_main = "SELECT * FROM kategorie WHERE matka IS NULL OR matka = 0";
    $result_main = $mysqli->query($query_main);
    echo '<ul class="main-categories">';
    foreach ($result_main as $main_row) {
        echo "<li><div class='category'>" . $main_row['nazwa'] . "</div>";
        echo "<div class='actions'><a href='edit_categories.php?id=" . $main_row['id'] . "' class='button-link'>Edytuj</a><a href='delete_categories.php?id=" . $main_row['id'] . "' class='button-delete'>Usuń</a></div>";
        $query_sub = "SELECT * FROM kategorie WHERE matka = " . $main_row['id'];
        $result_sub = $mysqli->query($query_sub);
        if ($result_sub->num_rows > 0) {
            echo '<ul class="sub-categories">';
            foreach ($result_sub as $sub_row) {
                echo "<li><div class='subcategory'>" . $sub_row['nazwa'] . "</div>";
                echo "<div class='actions'><a href='edit_categories.php?id=" . $sub_row['id'] . "' class='button-link'>Edytuj</a><a href='delete_categories.php?id=" . $sub_row['id'] . "' class='button-delete'>Usuń</a></div></li>";
            }
            echo '</ul>';
        }
        echo "</li>";
    }
    echo '</ul>';
}


function ListaProduktow() {
    $mysqli = CFG::getInstance();
    $query = "SELECT * FROM produkty";
    $result = $mysqli->query($query);

    echo '<table class="data-table">';
    echo '<tr><th>ID</th><th>Tytuł</th><th>Opis</th><th>Data Utworzenia</th><th>Data Modyfikacji</th><th>Data Wygaśnięcia</th><th>Cena Netto</th><th>Podatek VAT</th><th>Ilość Sztuk</th><th>Status Dostępności</th><th>Kategoria</th><th>Gabaryt Produktu</th><th>Zdjęcie</th><th>Akcje</th></tr>';

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['tytul'] . "</td>";
        echo "<td>" . $row['opis'] . "</td>";
        echo "<td>" . $row['data_utworzenia'] . "</td>";
        echo "<td>" . $row['data_modyfikacji'] . "</td>";
        echo "<td>" . $row['data_wygasniecia'] . "</td>";
        echo "<td>" . $row['cena_netto'] . " PLN</td>";
        echo "<td>" . $row['podatek_vat'] . "%</td>";
        echo "<td>" . $row['ilosc_dostepnych_sztuk'] . "</td>";
        echo "<td>" . $row['status_dostepnosci'] . "</td>";
        echo "<td>" . $row['kategoria'] . "</td>";
        echo "<td>" . $row['gabaryt_produktu'] . "</td>";
        echo "<td><img src='" . $row['zdjecie'] . "' alt='Zdjęcie produktu' style='width:100px;'/></td>";
        echo "<td>
                <a href='edit_product.php?id=" . $row['id'] . "' class='button-link'>Edytuj</a>
                <a href='delete_product.php?id=" . $row['id'] . "' class='button-delete'>Usuń</a>
              </td>";
        echo "</tr>";
    }

    echo '</table>';
}



function FormularzLogowania() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['zaloguj']))
        {
            $mysqli = CFG::getInstance();
            $login = $mysqli->real_escape_string(strtolower($_POST['login']));
            $haslo = $mysqli->real_escape_string($_POST['haslo']);
        
            if(!$mysqli->connect_error)
            {
    
                $query = "SELECT * FROM uzytkownicy WHERE login = '$login' AND haslo = '$haslo' LIMIT 1";
                $result = $mysqli->query($query);
        
                if ($result->num_rows > 0) {
                    $_SESSION['logged_in'] = true;
                    header('Location: admin.php');
                    exit;
                } else {
                    echo '<p>Błędny login lub hasło.</p>';
                }
            }
            else
            {
                if($login == CFG::$login && $haslo == CFG::$pass)
                {
                    $_SESSION['logged_in'] = true;
                    header('Location: admin.php');
                    exit;
                }
            } 
        }
        else if(isset($_POST['przypomnij']))
        {
            przypomnij();
        }

    }

    echo '<form method="post">';
    echo '<input type="text" name="login" placeholder="Login" required>';
    echo '<input type="password" name="haslo" placeholder="Hasło" required>';
    echo '<input type="submit" name="zaloguj" value="Zaloguj">';
    echo '<input type="submit" name="przypomnij" value="Przypomnij hasło">';
    echo '</form>';
}

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    FormularzLogowania();
    exit;
}

function przypomnij()
{
    $mail = new PHPMailer();
            $final_message = "Login to: admin, hasło to: admin";
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com;';                    
            $mail->SMTPAuth   = true;                             
            $mail->Username   = 'popocompany473@gmail.com';                 
            $mail->Password   = 'ixgv obpk rpbl imik';                        
            $mail->SMTPSecure = 'tls';                              
            $mail->Port       = 587;  
            $mail->CharSet = "UTF-8";
            $mail->setFrom('popocompany473@gmail.com');           
            $mail->addAddress('lemkon24@gmail.com');
               
            $mail->IsHTML(true);
            $mail->SetFrom("popocompany473@gmail.com", "no-reply");
            $mail->Subject = "Przypomnienie hasła!";
            $mail->MsgHTML($final_message);
            if(!$mail->Send()) {
              echo "Error while sending Email.";
              var_dump($mail);
            } else {
              echo "Email sent successfully";
            }
            $mail->ClearAllRecipients();
}

function DodajNowaPodstrone() {
    $mysqli = CFG::getInstance();
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
        <input type="submit" name="export" value="Zapisz zmiany">
    </form>
    EOD;
    echo $formularz;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['export'])) {
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

function DodajNowaKategorie() {
    $mysqli = CFG::getInstance();
    $formularz = <<<EOD
    <br><br>
    <h1>Dodaj Nową Kategorie</h1>
    <form method="POST" action="">
        <label for="kategoria_nazwa">Nazwa kategorii:</label><br>
        <input type="text" id="nazwa" name="nazwa" value=""><br>
        <label for="matka">matka:</label><br>
        <input type="number" id="matka" name="matka" value=""><br>
        <input type="submit" name="premium" value="Zapisz zmiany">
    </form>
    EOD;
    echo $formularz;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["premium"])) {
        $nazwa = isset($_POST['nazwa']) ? $_POST['nazwa'] : '';
        $matka = isset($_POST['matka']) ? $_POST['matka'] : '';
        
        $stmt = $mysqli->prepare("INSERT INTO kategorie (nazwa, matka) VALUES (?, ?)");
        if ($stmt === false) {
            die("Błąd przygotowania zapytania: " . $mysqli->error);
        }

        $stmt->bind_param("si", $nazwa, $matka);

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

function DodajNowyProdukt() {
    $mysqli = CFG::getInstance();
    $formularz = <<<EOD
    <br><br>
    <h1>Dodaj Nowy Produkt</h1>
    <form method="POST" action="">
        <label for="tytul">Tytuł produktu:</label><br>
        <input type="text" id="tytul" name="tytul" value=""><br>
        <label for="opis">Opis:</label><br>
        <textarea id="opis" name="opis"></textarea><br>
        <label for="data_wygasniecia">Data wygaśnięcia:</label><br>
        <input type="datetime-local" id="data_wygasniecia" name="data_wygasniecia"><br>
        <label for="cena_netto">Cena netto:</label><br>
        <input type="number" step="0.01" id="cena_netto" name="cena_netto" value=""><br>
        <label for="podatek_vat">Podatek VAT:</label><br>
        <input type="number" step="0.01" id="podatek_vat" name="podatek_vat" value=""><br>
        <label for="ilosc_dostepnych_sztuk">Ilość dostępnych sztuk:</label><br>
        <input type="number" id="ilosc_dostepnych_sztuk" name="ilosc_dostepnych_sztuk" value=""><br>
        <label for="status_dostepnosci">Status dostępności:</label><br>
        <input type="text" id="status_dostepnosci" name="status_dostepnosci" value=""><br>
        <label for="kategoria">Kategoria:</label><br>
        <input type="number" id="kategoria" name="kategoria" value=""><br>
        <label for="gabaryt_produktu">Gabaryt produktu:</label><br>
        <input type="text" id="gabaryt_produktu" name="gabaryt_produktu" value=""><br>
        <label for="zdjecie">Zdjęcie (link):</label><br>
        <input type="text" id="zdjecie" name="zdjecie" value=""><br>
        <input type="submit" name="dodaj_produkt" value="Dodaj produkt">
    </form>
    EOD;
    echo $formularz;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["dodaj_produkt"])) {
        $tytul = $_POST['tytul'] ?? '';
        $opis = $_POST['opis'] ?? '';
        $data_wygasniecia = $_POST['data_wygasniecia'] ?? null;
        $cena_netto = $_POST['cena_netto'] ?? 0;
        $podatek_vat = $_POST['podatek_vat'] ?? 0;
        $ilosc_dostepnych_sztuk = $_POST['ilosc_dostepnych_sztuk'] ?? 0;
        $status_dostepnosci = $_POST['status_dostepnosci'] ?? '';
        $kategoria = $_POST['kategoria'] ?? 0;
        $gabaryt_produktu = $_POST['gabaryt_produktu'] ?? '';
        $zdjecie = $_POST['zdjecie'] ?? '';

        $stmt = $mysqli->prepare("INSERT INTO produkty (tytul, opis, data_wygasniecia, cena_netto, podatek_vat, ilosc_dostepnych_sztuk, status_dostepnosci, kategoria, gabaryt_produktu, zdjecie) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Błąd przygotowania zapytania: " . $mysqli->error);
        }

        $stmt->bind_param("sssdidsiss", $tytul, $opis, $data_wygasniecia, $cena_netto, $podatek_vat, $ilosc_dostepnych_sztuk, $status_dostepnosci, $kategoria, $gabaryt_produktu, $zdjecie);

        if ($stmt->execute()) {
            echo "Nowy produkt został dodany";
            header("Refresh: 1; URL=admin.php");
            exit;
        } else {
            echo "Błąd przy dodawaniu produktu: " . $stmt->error;
        }

        $stmt->close();
    }
}



$mysqli = CFG::getInstance();
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true)
{
 echo '<form method="post" action="'.$_SERVER['REQUEST_URI'].'">
        <input type="submit" name="logout" value="Wyloguj się">
       </form>';   
}

if(isset($_POST['logout']))
{
    unset($_SESSION['logged_in']);
    session_destroy();
}





echo '<div class="container">';

echo '<div class="section">';
echo '<h2>Lista Produktów</h2>';
ListaProduktow();
echo '</div>';

echo '<div class="section">';
DodajNowyProdukt();
echo '</div>';

echo '</div>'; 

echo '<div class="container">';

echo '<div class="section">';
echo '<h2>Lista Kategorii</h2>';
ListaKategorii();
echo '</div>';

echo '<div class="section">';

DodajNowaKategorie();
echo '</div>';

echo '</div>'; 


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
ob_end_flush();
?>

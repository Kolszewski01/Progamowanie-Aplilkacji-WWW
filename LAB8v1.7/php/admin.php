<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '..\vendor\phpmailer\phpmailer\src\Exception.php';
    require '..\vendor\phpmailer\phpmailer\src\PHPMailer.php';
    require '..\vendor\phpmailer\phpmailer\src\SMTP.php';
    require_once 'cfg.php';
session_start();

function ListaStron() {
    $mysqli = CFG::getInstance();
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

ListaStron();
DodajNowaPodstrone();



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
?>

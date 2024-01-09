<?php
include 'cfg.php';
session_start();
if(isset($_SESSION['logged_in']))
{
    $mysqli = CFG::getInstance();
    $id_to_delete = intval($_GET['id']);
    $stmt = $mysqli->prepare("DELETE FROM produkty WHERE id = ?");
    $stmt->bind_param("i", $id_to_delete);

    if ($stmt->execute()) {
        header('Location: admin.php');
    }

    $stmt->close();
    $mysqli->close();
}
?>

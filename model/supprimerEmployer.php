<?php
include 'connexion.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        $sql = "DELETE FROM employer WHERE id = ?";
        $req = $connexion->prepare($sql);

        if ($req->execute(array($id))) {
            $_SESSION['message']['text'] = "Employé supprimé avec succès";
            $_SESSION['message']['type'] = "success";
        } else {
            $_SESSION['message']['text'] = "Erreur lors de la suppression";
            $_SESSION['message']['type'] = "danger";
        }
    } catch (Exception $e) {
        $_SESSION['message']['text'] = "Erreur: " . $e->getMessage();
        $_SESSION['message']['type'] = "danger";
    }
} else {
    $_SESSION['message']['text'] = "ID employé non fourni";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/employer.php');
exit;
?>

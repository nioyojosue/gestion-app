<?php
include 'connexion.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (
    !empty($_POST['nom'])
    && !empty($_POST['prenom'])
    && !empty($_POST['email'])
    && !empty($_POST['password'])
) {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $telephone = !empty($_POST['telephone']) ? trim($_POST['telephone']) : '';
    $adresse = !empty($_POST['adresse']) ? trim($_POST['adresse']) : '';

    try {
        // Vérifier que l'email n'existe pas déjà
        $sql = "SELECT id FROM employer WHERE email = ?";
        $req = $connexion->prepare($sql);
        $req->execute(array($email));

        if ($req->rowCount() > 0) {
            $_SESSION['message']['text'] = "Cet email est déjà utilisé";
            $_SESSION['message']['type'] = "danger";
        } else {
            // Ajouter le nouvel employé
            $sql = "INSERT INTO employer (nom, prenom, email, password, telephone, adresse) VALUES (?, ?, ?, ?, ?, ?)";
            $req = $connexion->prepare($sql);

            if ($req->execute(array($nom, $prenom, $email, $password, $telephone, $adresse))) {
                $_SESSION['message']['text'] = "Employé ajouté avec succès";
                $_SESSION['message']['type'] = "success";
            } else {
                $_SESSION['message']['text'] = "Erreur lors de l'ajout de l'employé";
                $_SESSION['message']['type'] = "danger";
            }
        }
    } catch (Exception $e) {
        $_SESSION['message']['text'] = "Erreur: " . $e->getMessage();
        $_SESSION['message']['type'] = "danger";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire n'a pas été saisie";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/employer.php');
exit;
?>

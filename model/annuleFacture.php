<?php
include 'connexion.php';
include_once 'function.php';

if (session_status() == PHP_SESSION_NONE) session_start();

if (!empty($_GET['idFacture'])) {
    $id_facture = intval($_GET['idFacture']);

    try {
        $connexion->beginTransaction();

        // Get all ventes for this facture
        $sql = "SELECT id_article, quantite FROM vente WHERE id_facture = ?";
        $req = $connexion->prepare($sql);
        $req->execute(array($id_facture));
        $ventes = $req->fetchAll();

        if (empty($ventes)) {
            throw new Exception('Aucune vente trouvée pour cette facture');
        }

        // Restore stock for each article
        foreach ($ventes as $vente) {
            $sql = "UPDATE article SET quantite = quantite + ? WHERE id = ?";
            $req = $connexion->prepare($sql);
            $req->execute(array($vente['quantite'], $vente['id_article']));
        }

        // First, set id_facture to NULL for all ventes in this facture
        $sql = "UPDATE vente SET id_facture = NULL WHERE id_facture = ?";
        $req = $connexion->prepare($sql);
        $req->execute(array($id_facture));

        // Mark all ventes as cancelled (etat = 0)
        $sql = "UPDATE vente SET etat = ? WHERE id_facture IS NULL";
        $req = $connexion->prepare($sql);
        $req->execute(array(0));

        // Now we can delete the facture
        $sql = "DELETE FROM facture WHERE id = ?";
        $req = $connexion->prepare($sql);
        $req->execute(array($id_facture));

        $connexion->commit();
        $_SESSION['message']['text'] = "Facture annulée avec succès et stock restitué";
        $_SESSION['message']['type'] = "success";

    } catch (Exception $e) {
        if ($connexion->inTransaction()) {
            $connexion->rollBack();
        }
        $_SESSION['message']['text'] = "Erreur lors de l'annulation : " . $e->getMessage();
        $_SESSION['message']['type'] = "danger";
    }
}

header('Location: ../vue/vente.php');
?>

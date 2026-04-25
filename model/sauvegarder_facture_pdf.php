<?php
include 'connexion.php';
include_once 'function.php';

/**
 * Génère et enregistre une facture en PDF simple (texte)
 * @param int $id_facture ID de la facture
 * @return array ['success' => bool, 'message' => string, 'file_path' => string]
 */
function genererPDFFacture($id_facture)
{
    $facture = getFacture($id_facture);
    if (empty($facture)) {
        return ['success' => false, 'message' => 'Facture introuvable'];
    }

    $articlesFacture = getArticlesFacture($id_facture);

    // Dossier de sauvegarde
    $dossier_factures = __DIR__ . '/../factures/';
    if (!is_dir($dossier_factures)) {
        mkdir($dossier_factures, 0755, true);
    }

    // Créer un nom de fichier sécurisé
    $num_fact = preg_replace('/[^a-zA-Z0-9_-]/', '', str_replace(' ', '_', $facture['num_facture']));
    $nom_fichier = 'Facture_' . $num_fact . '_' . date('YmdHis') . '.txt';
    $chemin_fichier = $dossier_factures . $nom_fichier;

    // Générer le contenu 
    $contenu = genererContenuFacture($facture, $articlesFacture);

    // Enregistrer le fichier
    if (file_put_contents($chemin_fichier, $contenu) !== false) {
        return ['success' => true, 'message' => 'Facture enregistrée avec succès', 'file_path' => $chemin_fichier, 'file_name' => $nom_fichier];
    } else {
        return ['success' => false, 'message' => 'Erreur lors de la création du fichier'];
    }
}

/**
 * Génère le contenu de la facture en format texte lisible
 */
function genererContenuFacture($facture, $articles)
{
    $titre = "N-DESIGN STOCK - FACTURE";
    $date = date('d/m/Y H:i:s', strtotime($facture['date_facture']));
    $num_facture = $facture['num_facture'];
    $nom_client = $facture['nom'] . " " . $facture['prenom'];
    $tel_client = $facture['telephone'];
    $adresse_client = $facture['adresse'];
    $montant_total = $facture['montant_total'];
    
    // Récupérer le nom de l'employé/admin
    $nom_employe = 'N/A';
    if (!empty($facture['employer_nom']) && !empty($facture['employer_prenom'])) {
        $nom_employe = $facture['employer_nom'] . " " . $facture['employer_prenom'];
    } elseif (!empty($facture['email_user'])) {
        $nom_employe = $facture['email_user'];
    }
    
    $role_user = !empty($facture['role_user']) ? ucfirst($facture['role_user']) : 'Employé';

    $contenu = "========================================\n";
    $contenu .= $titre . "\n";
    $contenu .= "========================================\n\n";

    $contenu .= "Facture N°: " . $num_facture . "\n";
    $contenu .= "Date: " . $date . "\n";
    $contenu .= $role_user . ": " . $nom_employe . "\n\n";

    $contenu .= "CLIENT:\n";
    $contenu .= "Nom: " . $nom_client . "\n";
    $contenu .= "Téléphone: " . $tel_client . "\n";
    $contenu .= "Adresse: " . $adresse_client . "\n\n";

    $contenu .= "========================================\n";
    $contenu .= "DÉTAIL DES ARTICLES\n";
    $contenu .= "========================================\n\n";

    $contenu .= sprintf("%-40s %8s %15s %12s\n", "Article", "Quantité", "Prix unitaire", "Total");
    $contenu .= str_repeat("-", 80) . "\n";

    foreach ($articles as $a) {
        $nom_court = substr($a['nom_article'], 0, 40);
        $contenu .= sprintf("%-40s %8d %15s %12s\n",
            $nom_court,
            $a['quantite'],
            number_format($a['prix_unitaire'], 2, ',', ' '),
            number_format($a['prix'], 2, ',', ' ')
        );
    }

    $contenu .= str_repeat("-", 80) . "\n";
    $contenu .= sprintf("%-40s %8s %15s %12s\n",
        "MONTANT TOTAL",
        "",
        "",
        number_format($montant_total, 2, ',', ' ')
    );
    $contenu .= str_repeat("-", 80) . "\n\n";

    $contenu .= "Merci pour votre achat!\n";
    $contenu .= "========================================\n";

    return $contenu;
}

// Si appelé directement
if (!empty($_GET['id_facture'])) {
    header('Content-Type: application/json; charset=utf-8');
    $result = genererPDFFacture(intval($_GET['id_facture']));
    echo json_encode($result);
    exit;
}
?>

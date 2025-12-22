<?php
// Endpoint JSON pour suggestions de recherche (autocomplete)
header('Content-Type: application/json; charset=utf-8');
include 'connexion.php';
include_once 'function.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$scope = isset($_GET['scope']) ? $_GET['scope'] : 'all';

$suggestions = array();

if ($q !== '') {
    // clients
    if ($scope === 'client' || $scope === 'all') {
        $clients = searchClientByName($q);
        foreach ($clients as $c) {
            $label = $c['nom'] . ' ' . $c['prenom'];
            $suggestions[] = array(
                'type' => 'client',
                'label' => $label,
                'value' => $label,
                // redirige vers la page de vente en pré-sélectionnant le client
                'link' => '../vue/vente.php?select_client_id=' . $c['id'],
                'id' => $c['id']
            );
            if (count($suggestions) >= 10) break;
        }
    }

    // fournisseurs
    if (($scope === 'fournisseur' || $scope === 'all') && count($suggestions) < 10) {
        $fournisseurs = searchFournisseurByName($q);
        foreach ($fournisseurs as $f) {
            $label = $f['nom'] . ' ' . $f['prenom'];
            $suggestions[] = array(
                'type' => 'fournisseur',
                'label' => $label,
                'value' => $label,
                'link' => '../vue/recherche.php?q=' . urlencode($label) . '&scope=fournisseur',
                'id' => $f['id']
            );
            if (count($suggestions) >= 10) break;
        }
    }

    // articles (pour pouvoir pré-remplir le formulaire de vente)
    if (($scope === 'article' || $scope === 'all') && count($suggestions) < 10) {
        $articles = searchArticleByName($q);
        foreach ($articles as $a) {
            $label = $a['nom_article'] . ' — ' . $a['quantite'] . ' dispo';
            $suggestions[] = array(
                'type' => 'article',
                'label' => $label,
                'value' => $a['id'],
                'link' => '../vue/vente.php?select_article_id=' . $a['id'],
                'id' => $a['id']
            );
            if (count($suggestions) >= 10) break;
        }
    }

    // ventes (historique / reçu)
    if (($scope === 'vente' || $scope === 'all') && count($suggestions) < 10) {
        $ventes = searchVenteByKeyword($q);
        foreach ($ventes as $v) {
            $label = $v['nom_article'] . ' — ' . $v['nom'] . ' ' . $v['prenom'];
            $suggestions[] = array(
                'type' => 'vente',
                'label' => $label,
                'value' => $v['id'],
                'link' => '../vue/recuVente.php?id=' . $v['id'],
                'id' => $v['id']
            );
            if (count($suggestions) >= 10) break;
        }
    }
}

echo json_encode(array_values($suggestions));
exit;

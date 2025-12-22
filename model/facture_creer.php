<?php
header('Content-Type: application/json; charset=utf-8');
include_once 'function.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array('success' => false, 'error' => 'Methode invalide')); exit;
}

$id_client = isset($_POST['id_client']) ? intval($_POST['id_client']) : 0;

if ($id_client <= 0) {
    echo json_encode(array('success' => false, 'error' => 'Client invalide')); exit;
}

$res = creerFactureFromPanier($id_client);
if ($res['success']) {
    $url = '../vue/recuVente.php?id_facture=' . $res['id_facture'];
    echo json_encode(array('success' => true, 'id_facture' => $res['id_facture'], 'montant_total' => $res['montant_total'], 'url' => $url));
} else {
    echo json_encode($res);
}

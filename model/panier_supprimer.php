<?php
header('Content-Type: application/json; charset=utf-8');
include_once 'function.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array('success' => false, 'error' => 'Methode invalide')); exit;
}

$articleId = isset($_POST['id_article']) ? intval($_POST['id_article']) : 0;

if ($articleId <= 0) {
    echo json_encode(array('success' => false, 'error' => 'Paramètres invalides')); exit;
}

$res = panierSession_remove($articleId);
echo json_encode($res);

<?php
header('Content-Type: application/json; charset=utf-8');
include_once 'function.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array('success' => false, 'error' => 'Methode invalide')); exit;
}

$res = panierSession_clear();
echo json_encode($res);

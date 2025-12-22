<?php
header('Content-Type: application/json; charset=utf-8');
include_once 'function.php';

$data = panierSession_get();
echo json_encode(array('success' => true, 'data' => $data));

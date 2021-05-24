<?php

$tabela = $_GET['tabela'];

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename=dados.csv');
header('Content-Transfer-Encoding: binary');
header('Pragma: no-cache');

$pdo = new PDO('mysql:host=localhost;dbname=bdecommerce', 'root', 'liteci2000@#');
$stmt = $pdo->prepare('select * from ' . $tabela);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$out = fopen('php://output', 'w');

foreach ($results as $result) {
    fputcsv($out, $result);
}

fclose($out);

?>
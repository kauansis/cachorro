<?php
require 'banco.php';

if (!isset($_GET['quantidade'])) {
    echo json_encode(['erro' => 'Quantidade é obrigatória']);
    exit();
}

$quantidade = $_GET['quantidade'];

try {
    $sql = "INSERT INTO log (datahora, numeroregistros) VALUES (NOW(), :quantidade)";
    $qry = $con->prepare($sql);
    $qry->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
    $qry->execute();

    echo json_encode(['linhas_inseridas' => $qry->rowCount()]);
} catch (Exception $e) {
    echo json_encode(['erro' => $e->getMessage()]);
}
?>

<?php

require 'banco.php';

try {
    
    $sql = "SELECT idlog,datahora,numeroregistros FROM log ORDER BY idlog DESC";
    $qry = $con->prepare($sql);
    $qry->execute();

    
    $logs = $qry->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(["status" => "success", "logs" => $logs]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Erro ao listar logs: " . $e->getMessage()]);
}
?>

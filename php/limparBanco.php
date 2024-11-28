<?php

require 'banco.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        
        $tabela = 'dogs';

        
        $sql = "DELETE FROM $tabela";
        $qry = $con->prepare($sql);
        $qry->execute();

        
        $sqlAutoIncrement = "ALTER TABLE $tabela AUTO_INCREMENT = 1";
        $con->exec($sqlAutoIncrement);

        echo json_encode(["status" => "success", "message" => "Banco de dados limpo com sucesso!"]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Erro ao limpar o banco de dados: " . $e->getMessage()]);
    }
}
?>

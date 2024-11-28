<?php
require 'banco.php';

try {
    // Configuração da API
    $apiUrl = 'https://api.thedogapi.com/v1/breeds';
    $apiKey = 'live_RETgToG9uLkT9bTkCQEobb6YwWyc9MdZBCBS1syeMi5Z1tSFdqggn9BU3XULCSjA';

    // Requisição para a API
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $apiUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => ["x-api-key: $apiKey"]
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    if (!$response) {
        throw new Exception('Erro ao acessar a API');
    }

    // Decodificar os dados da API
    $breeds = json_decode($response, true);

    // Inserir dados no banco
    foreach ($breeds as $breed) {
        $sql = "INSERT INTO dogs (breed_id, name, lifespan, temperament, origin) 
                VALUES (:breed_id, :name, :lifespan, :temperament, :origin)
                ON DUPLICATE KEY UPDATE 
                    name = :name, 
                    lifespan = :lifespan, 
                    temperament = :temperament, 
                    origin = :origin";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(':breed_id', $breed['id']);
        $stmt->bindParam(':name', $breed['name']);
        $stmt->bindParam(':lifespan', $breed['life_span']);
        $stmt->bindParam(':temperament', $breed['temperament']);
        $stmt->bindParam(':origin', $breed['origin']);
        $stmt->execute();
    }

    echo json_encode(['status' => 'success', 'message' => 'Dados importados com sucesso']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>

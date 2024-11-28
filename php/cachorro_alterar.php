<?php
    require 'banco.php';

    if (!isset($_GET['id']) || !isset($_GET['name']) || !isset($_GET['lifespan']) || !isset($_GET['temperament']) || !isset($_GET['origin'])) {
        echo 'Erro, id, name, lifespan, temperament e origin são obrigatórios';
        exit();
    }

    $id = $_GET['id'];
    $name = $_GET['name'];
    $lifespan = $_GET['lifespan'];
    $temperament = $_GET['temperament'];
    $origin = $_GET['origin'];

    $sql = "update dogs set id = :id,
                name = :name, 
                lifespan = :lifespan, 
                temperament = :temperament, 
                origin = :origin 
            where id = :id";	
    $qry = $con->prepare($sql); 
    $qry->bindParam(':id', $id, PDO::PARAM_STR);
    $qry->bindParam(':name', $name, PDO::PARAM_STR);
    $qry->bindParam(':lifespan', $lifespan, PDO::PARAM_STR);
    $qry->bindParam(':temperament', $temperament, PDO::PARAM_STR);
    $qry->bindParam(':origin', $origin, PDO::PARAM_STR);
    $qry->execute();
    $nr = $qry->rowCount();
    echo $nr;
?>

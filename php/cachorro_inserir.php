<?php
    require 'banco.php';

    if ( !isset($_GET['name']) || !isset($_GET['lifespan']) || !isset($_GET['temperament']) || !isset($_GET['origin'])) {
        echo 'Erro, id, name, lifespan, temperament e origin são obrigatórios';
        exit();
    }

    $name = $_GET['name'];
    $lifespan = $_GET['lifespan'];
    $temperament = $_GET['temperament'];
    $origin = $_GET['origin'];

    $sql = "insert into dogs (name, lifespan, temperament, origin)
                        values (:name, :lifespan, :temperament, :origin)";	
    $qry = $con->prepare($sql); 
    $qry->bindParam(':name', $name, PDO::PARAM_STR);
    $qry->bindParam(':lifespan', $lifespan, PDO::PARAM_STR);
    $qry->bindParam(':temperament', $temperament, PDO::PARAM_STR);
    $qry->bindParam(':origin', $origin, PDO::PARAM_STR);
    $qry->execute();
    $nr = $qry->rowCount();
    echo $nr;
?>

<?php 
    require 'banco.php';

    if (!isset($_GET['id'])) {
        echo "Erro, id, name, temperament e origin são obrigatórios";
        exit();
    }

    $id = $_GET['id'];

    $sql = "delete from dogs
            where id = :id";
    $qry = $con->prepare($sql);
    $qry->bindParam(':id', $id, PDO::PARAM_STR);
    $qry->execute();
    $nr = $qry->rowCount();
    echo $nr;
?>


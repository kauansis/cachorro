<?php
    require 'banco.php';

    if (isset($_GET['name'])) {
        $name = $_GET['name'];

        $sql = "SELECT * FROM dogs WHERE name LIKE :name";
        $qry = $con->prepare($sql);
        $qry->bindValue(':name', '%' . $name . '%', PDO::PARAM_STR); // 'LIKE' para buscar similaridade
        $qry->execute();
        $registros = $qry->fetchAll(PDO::FETCH_OBJ);

        echo json_encode($registros);
    } else {
        echo json_encode([]);
    }
?>

<?php
    require 'banco.php';
    header('Content-Type: application/json');
    
    $sql = "select * from dogs order by name";	
    $qry = $con->prepare($sql); 
    $qry->execute();
    //$nr = $qry->rowCount();
    //echo $nr;
    $registros = $qry->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($registros);
?>

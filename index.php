<?php 
    include 'conexion.php';

    $pdo = new conexion();

    /* Comprobando si el método de solicitud es GET */
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if(isset($_GET['id'])){

            $sql = $pdo->prepare("SELECT * FROM web Where id = :id");
            $sql->bindValue(':id',$_GET['id']);
            $sql->execute();
            $sql ->setFetchMode(PDO::FETCH_ASSOC);
            header("HTTP/1.1 200 OK");
            echo json_encode($sql->fetchAll());
            exit;

        }else{
            $sql = $pdo->prepare("SELECT * FROM web");
            /* Executing the query. */
            $sql->execute();

            /* Setting the fetch mode to associative array. */
            $sql ->setFetchMode(PDO::FETCH_ASSOC);
    
    /* Envío de respuesta al cliente. */
            header("HTTP/1.1 200 OK");
            /*formato JSON. */
            echo json_encode($sql->fetchAll());
            exit;
        }
       
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $sql = "INSERT INTO web (nombre,telefono,email) VALUES (:nombre , :telefono , :email)";
            $stmt= $pdo->prepare($sql);
            $stmt->bindValue(':nombre', $_POST['nombre']);
            $stmt->bindValue(':telefono', $_POST['telefono']);
            $stmt->bindValue(':email', $_POST['email']);
            $stmt->execute();
            
            $idPost=$pdo->lastInsertId();
            if( $idPost){
                header("HTTP/1.1 200 OK");
                echo json_encode($idPost);
                exit;
            }   
        }
        if($_SERVER['REQUEST_METHOD'] == 'PUT'){
            $sql = "UPDATE web SET nombre = :nombre , telefono = :telefono , email = :email WHERE id = :id";
            $stmt= $pdo->prepare($sql);
            $stmt->bindValue(':nombre', $_GET['nombre']);
            $stmt->bindValue(':telefono',  $_GET['telefono']);
            $stmt->bindValue(':email',  $_GET['email']);
            $stmt->bindValue(':id',  $_GET['id']);
            $stmt->execute();
                header("HTTP/1.1 200 OK");
                exit;
             
        }


        if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
            $sql = "DELETE FROM web WHERE id = :id";
            $stmt= $pdo->prepare($sql);
            $stmt->bindValue(':id', $_GET['id']);
            $stmt->execute();
            header("HTTP/1.1 200 OK");
            exit;
        }
?>
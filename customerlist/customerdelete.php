<?php
include "../Includes/dbConn.php";

if(isset($_GET["id"])) {
    $id = $_GET["id"];

    try {
        $db = new PDO($dsn, $username, $password, $options);

        //system prepares what needs to be executed
        $sql = $db->prepare("Delete from customerlist WHERE CustomerID = :id");


        $sql->bindValue(":id",$id);

        //execute - returns all rows from table
        $sql->execute();
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo "Error: $error";
    }
}
    header("Location:customerlist.php");
?>
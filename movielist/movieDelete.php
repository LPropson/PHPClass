<?php
include "../Includes/dbConn.php";

if(isset($_GET["id"])){
    $id=$_GET["id"];
    $db = new PDO($dsn, $username, $password, $options);

    try {

        //system prepares what needs to be executed
        $sql = $db->prepare("delete from movielist WHERE movieID = :id");
        $sql->bindValue(":id",$id);

        //execute - returns all rows from table
        $sql->execute();

    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo "Error: $error";
    }
}
header("Location:movielist.php");
?>
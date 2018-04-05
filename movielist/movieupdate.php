// Testing

<?php
include "../Includes/dbConn.php";

if(isset($_POST["txtTitle"])) {
    if (isset($_POST["txtRating"])) {
        $title = $_POST[txtTitle];
        $rating = $_POST[txtRating];
        $id = $_POST["txtID"];

            try {
                $db = new PDO($dsn, $username, $password, $options);

                //system prepares what needs to be executed
                $sql = $db->prepare("update movielist set movieTitle = :Title, movieRating = :Rating where movieID = :id");

                $sql->bindValue(":id", $id);
                $sql->bindValue(":Title", $title);
                $sql->bindValue(":Rating", $rating);

                //execute - returns all rows from table
                $sql->execute();


            } catch (PDOException $e) {
                $error = $e->getMessage();
                echo "Error: $error";
            }
            header("Location:movielist.php");
    }

}

if(isset($_GET["id"])){
    $id=$_GET["id"];
    $db = new PDO($dsn, $username, $password, $options);

    try {

        //system prepares what needs to be executed
        $sql = $db->prepare("select * from movielist WHERE movieID = :id");
        $sql->bindValue(":id",$id);

        //execute - returns all rows from table
        $sql->execute();

        $row = $sql->fetch();
        $rating = $row["movieRating"];
        $title = $row["movieTitle"];

    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo "Error: $error";
    }
}
else{
    header("Location:movielist.php");
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MovieAdd</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyles.css"/>
</head>

<body>
<div class="page-wrap">
    <header class="site-header">
        <?php include "../Includes/header.php" ?>
        <script type="text/javascript">
            function DeleteMovie(title, id) {
                if(confirm("do you want to delete " + title)){
                    document.location.href = "movieDelete.php?id=" + id;
                }
            }
        </script>
    </header>

    <div class="flex-box">
        <nav class="main-nav">
            <?php include "../Includes/menu.php" ?>
        </nav>

        <section class="main-content">
            <h2>Update Movie</h2>
            <div class="content">
                <form method="post">
                    <table border="1" width="80%">
                        <tr height = "60">
                            <th colspan="2"><h3>Update Movie</h3></th>
                        </tr>
                        <tr height = "40">
                            <th>Movie Name</th>
                            <td align="center"><input id="txtTitle" name="txtTitle" type="text" size="50" value="<?=$title?>"></td>
                        </tr>
                        <tr height = "40">
                            <th>Movie Rating</th>
                            <td align="center"><input id="txtRating" name="txtRating" type="text" size="50" value="<?=$rating?>"></td>
                        </tr>
                        <tr height = "40">
                            <td colspan="2"  align="center">
                            <input type="submit" value="Update Movie"> | <input type="button" onclick="DeleteMovie('<?=$title?>','<?=$id?>')" value="Delete Movie">
                        </td>
                        </tr>
                    </table>
                    <input type="hidden" id="txtID" name="txtID" value="<?=$id?>">
                </form>
            </div>
        </section>

        <aside class="right-sidebar">Sidebar</aside>
    </div><!-- /Flex-box here -->
    <footer>
        <?php include "../Includes/footer.php" ?>
    </footer>

</div><!-- /page-wrap -->


</body>
</html>
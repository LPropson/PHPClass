<?php

if(isset($_POST["txtTitle"])) {
    if (isset($_POST["txtRating"])) {
        $title = $_POST[txtTitle];
        $rating = $_POST[txtRating];

        if(($title == "") || ($rating == "")){
            Echo "Cannot be blank!!";
            exit();
        }
        else {


            include "../Includes/dbConn.php";

            try {
                $db = new PDO($dsn, $username, $password, $options);

                //system prepares what needs to be executed
                $sql = $db->prepare("insert into movielist (movieTitle, movieRating) VALUE (:Title,:Rating)");

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
    </header>

    <div class="flex-box">
        <nav class="main-nav">
            <?php include "../Includes/menu.php" ?>
        </nav>

        <section class="main-content">
            <h2>Movie Add</h2>
            <div class="content">
                <form method="post">
                    <table border="1" width="80%">
                        <tr height = "60">
                            <th colspan="2"><h3>Add New Movie</h3></th>
                        </tr>
                        <tr height = "40">
                            <th>Movie Name</th>
                            <td align="center"><input id="txtTitle" name="txtTitle" type="text" size="50"></td>
                        </tr>
                        <tr height = "40">
                            <th>Movie Rating</th>
                            <td align="center"><input id="txtRating" name="txtRating" type="text" size="50"></td>
                        </tr>
                        <tr height = "40">
                            <td colspan="2"  align="center">
                            <input type="submit" value="Add New Movie">
                        </td>
                        </tr>
                    </table>
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
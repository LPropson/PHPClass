// Testing

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Movie List</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyles.css"/>
    <link rel="stylesheet" type="text/css" href="../css/tables.css"/>
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
            <h2>Movie List</h2>
            <div class="content">

                <table border="1" width="80%">
                    <thead>
                        <tr>
                            <th>Movie ID</th>
                            <th>Movie Title</th>
                            <th>Movie Rating</th>
                        </tr>
                    </thead>

                    <tbody>


                <?php

                include "../Includes/dbConn.php";

                try {
                    $db = new PDO($dsn, $username, $password, $options);

                    //system prepares what needs to be executed
                    $sql = $db->prepare("select * from movielist");

                    //execute - returns all rows from table
                    $sql->execute();

                    //fetch - get first record in table
                    $row = $sql->fetch();

                    while($row != null){
                        echo "<tr>";
                        echo "<td>" . $row["movieID"] . "</td>";
                        echo "<td><a href=movieupdate.php?id=". $row["movieID"] . ">" . $row["movieTitle"] . "</a></td>";
                        echo "<td>" . $row["movieRating"] . "</td>";
                        echo "</tr>";
                        $row = $sql->fetch();
                    }
                    //echo $row["movieTitle"];



                } catch(PDOException $e){
                    $error = $e ->getMessage();
                    echo "Error: $error";
                }
                ?>
                    </tbody>
                </table>
                <br />
                <br />

                <a href="movieadd.php">Add a New Movie</a>
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Customer List</title>
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
            <h2>Customer Listing</h2>
            <div class="content">
                <table border="1">
                    <thead>
                    <tr height="15">
                        <th>CustID</th>
                        <th>FirstName</th>
                        <th>LastName</th>
                        <th>StreetAddress</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zip</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Password</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php

                    include "../Includes/dbConn.php";

                    try {
                        $db = new PDO($dsn, $username, $password, $options);

                        //system prepares what needs to be executed
                        $sql = $db->prepare("select * from customerlist");

                        //execute - returns all rows from table
                        $sql->execute();

                        //fetch - get first record in table
                        $row = $sql->fetch();

                        while($row != null){
                            echo "<tr>";
                            echo "<td align='center'>" . $row["CustomerID"] . "</td>";
                            echo "<td align='center'><a href=customerupdate.php?id=". $row["CustomerID"] . ">" . $row["FirstName"] . "</a></td>";
                            echo "<td align='center'><a href=customerupdate.php?id=". $row["CustomerID"] . ">" . $row["LastName"] . "</a></td>";
                            echo "<td align='center'>" . $row["StrAddress"] . "</a></td>";
                            echo "<td align='center'>" . $row["City"] . "</td>";
                            echo "<td align='center'>" . $row["State"] . "</td>";
                            echo "<td align='center'>" . $row["Zip"] . "</td>";
                            echo "<td align='center'>" . $row["Phone"] . "</td>";
                            echo "<td align='center'>" . $row["Email"] . "</td>";
                            echo "<td align='center'>" . $row["CPassword"] . "</td>";
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

                <a href="customeradd.php">Add a New Customer</a>


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
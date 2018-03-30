<?php
session_start();


if(isset($_POST["txtEmail"])) {
    if (isset($_POST["txtPassword"])) {
        $email = $_POST["txtEmail"];
        $pwd = $_POST["txtPassword"];
        $errmsg = "";




        include "../Includes/dbConn.php";

        try {
            $db = new PDO($dsn, $username, $password, $options);

            //system prepares what needs to be executed
            $sql = $db->prepare("select memberID,memberPassword,MemberKey,RoleID from memberLogin where memberEmail = :Email");

            //Bind Value for parameter
            $sql->bindValue(":Email", $email);

            //execute - returns all rows from table
            $sql->execute();

            //fetch - get first record in table
            $row = $sql->fetch();

            if($row!=null){
                $hashPassword = md5($pwd . $row["MemberKey"]);

                if($hashPassword == $row["memberPassword"]){
                    $_SESSION["UID"] = $row["memberID"];
                    $_SESSION["Role"] = $row["RoleID"];
                    if($row["RoleID"]==1){
                        header("Location:admin.php");
                    }else{
                        header("Location:member.php");
                    }
                }else{
                    $errmsg = "Wrong Password";
                }
            }else{
                $errmsg = "Wrong Username";
            }

        } catch(PDOException $e){
            $error = $e ->getMessage();
            echo "Error: $error";
        }
    }
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
            <h2>User Login</h2>
            <div class="content">
                <form method="post">
                    <h3 id="error"><?=$errmsg?></h3>
                    <table border="1" width="80%">
                        <tr height = "60">
                            <th colspan="2"><h3>User Login</h3></th>
                        </tr>
                        <tr height = "40">
                            <th>Email</th>
                            <td align="center"><input id="txtEmail" name="txtEmail" type="text" size="50"></td>
                        </tr>
                        <tr height = "40">
                            <th>Password</th>
                            <td align="center"><input id="txtPassword" name="txtPassword" type="password" size="50"></td>
                        </tr>
                        <tr height = "40">
                            <td colspan="2"  align="center">
                            <input type="submit" value="Login">
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
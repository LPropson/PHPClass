<?php
session_start();
$errmsg = "";
$key = sprintf('%04X%04X%04X%04X%04X%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));

    if($_SESSION[Role]!=1){
        header("Location:index.php");
    }

    if(isset($_POST["submit"])){
        if(empty($_POST["txtFName"])){
            $errmsg = "Name is required!";
        }else{
            $FName = $_POST["txtFName"];
        }

        if(empty($_POST["txtEmail"])){
            $errmsg = "Email is required!";
        }else{
            $Email = $_POST["txtEmail"];
        }

        if(empty($_POST["txtPassword"])){
            $errmsg = "Password is required!";
        }else{
            $mPassword = $_POST["txtPassword"];
        }

        if($mPassword!=$_POST["txtPassword2"]){
            $errmsg = "Passwords do not match!!";
        }

        if(empty($_POST["txtRole"])){
            $errmsg = "Role is required!";
        }else{
            $Role = $_POST["txtRole"];
        }

        if($errmsg==""){
            //Do DB work!!!

            include "../Includes/dbConn.php";

            try {
                $db = new PDO($dsn, $username, $password, $options);

                //system prepares what needs to be executed
                $sql = $db->prepare("insert into memberLogin (memberName,memberEmail,memberPassword,RoleID,MemberKey) VALUE (:Name,:Email,:Password,:RID,:Key)");

                $sql->bindValue(":Name", $FName);
                $sql->bindValue(":Email", $Email);
                $sql->bindValue(":Password", md5($mPassword . $key));
                $sql->bindValue(":RID", $Role);
                $sql->bindValue(":Key", $key);

                //execute - returns all rows from table
                $sql->execute();
            } catch (PDOException $e) {
                $error = $e->getMessage();
                echo "Error: $error";
            }

            $FName = "";
            $Email = "";
            $mPassword = "";
            $Role="";
            $errmsg = "Member Added to Database!";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Template</title>
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
            <h1>Admin Page</h1>
            <h3 id="error"><?=$errmsg?></h3>
            <form method="post">
                <table border="1" width="80%">
                    <tr height = "60">
                        <th colspan="2"><h3>Add New Member</h3></th>
                    </tr>
                    <tr height = "40">
                        <th>Full Name</th>
                        <td align="center"><input id="txtFName" name="txtFName" value"<?=$FName?>" type="text" size="50" required></td>
                    </tr>
                    <tr height = "40">
                        <th>Email</th>
                        <td align="center"><input id="txtEmail" name="txtEmail" value"<?=$Email?>" type="text" size="50" required></td>
                    </tr>
                    <tr height = "40">
                        <th>Password</th>
                        <td align="center"><input id="txtPassword" name="txtPassword" type="password" size="50"></td>
                    </tr>
                    <tr height = "40">
                        <th>Retype Password</th>
                        <td align="center"><input id="txtPassword2" name="txtPassword2" type="password" size="50"></td>
                    </tr>
                    <tr height = "40">
                        <th>Role</th>
                        <td align="center">
                            <select id="txtRole" name="txtRole">

                                <?php
                                    include "../Includes/dbConn.php";

                                    try{
                                        $db = new PDO($dsn, $username, $password, $options);
                                        $sql = $db->prepare("select * from role");
                                        $sql->execute();

                                        $row = $sql->fetch();

                                        while($row != null){
                                            $id = $row['RoleID'];
                                            $name = $row['RoleValue'];
                                            echo '<option value="'.$id.'">'.$name.'</option>';
                                            $row = $sql->fetch();
                                        }

                                    }

                                    catch (PDOException $e) {
                                        $error = $e->getMessage();
                                        echo "Error: $error";
                                    }

                                ?>

                            </select>
                        </td>
                    </tr>

                    <tr height = "40">
                        <td colspan="2"  align="center">
                            <input type="submit" value="Add New Member" name="submit">
                        </td>
                    </tr>
                </table>
            </form>
        </section>

        <aside class="right-sidebar">Sidebar</aside>
    </div><!-- /Flex-box here -->
    <footer>
        <?php include "../Includes/footer.php" ?>
    </footer>

</div><!-- /page-wrap -->


</body>
</html>
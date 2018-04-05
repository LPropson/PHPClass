<?php

$errmsg = "";
$key = sprintf('%04X%04X%04X%04X%04X%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));

if(($_POST[txtPassword])!= ($_POST[txtPassword2])){
    $errmsg = "Passwords don't Match!";
}else{

    if((isset($_POST[txtFirstName])) && (isset($_POST[txtLastName])) && (isset($_POST[txtStreetAddress]))
        && (isset($_POST[txtCity])) && (isset($_POST[txtState])) && (isset($_POST[txtZip]))
        && (isset($_POST[txtPhone])) && (isset($_POST[txtEmail])) && (isset($_POST[txtPassword]))) {

        $fname = $_POST[txtFirstName];
        $lname = $_POST[txtLastName];
        $straddress = $_POST[txtStreetAddress];
        $city = $_POST[txtCity];
        $state = $_POST[txtState];
        $zip = $_POST[txtZip];
        $phone = $_POST[txtPhone];
        $email = $_POST[txtEmail];
        $cpassword = $_POST[txtPassword];

        include "../Includes/dbConn.php";

        //echo "everything worked for DB";

        //exit();

        try {
            $db = new PDO($dsn, $username, $password, $options);

            //system prepares what needs to be executed
            $sql = $db->prepare("insert into customerlist (Firstname, Lastname, StrAddress,
                                      City, State, Zip, Phone, Email, CPassword, CKey) 
                                      VALUE (:FName,:LName,:StrAddress,:City,:State,:Zip,:Phone,:Email,:Password,:cKey)");

            $sql->bindValue(":FName", $fname);
            $sql->bindValue(":LName", $lname);
            $sql->bindValue(":StrAddress", $straddress);
            $sql->bindValue(":City", $city);
            $sql->bindValue(":State", $state);
            $sql->bindValue(":Zip", $zip);
            $sql->bindValue(":Phone", $phone);
            $sql->bindValue(":Email", $email);
            $sql->bindValue(":Password", md5($cpassword . $key));
            $sql->bindValue(":cKey", $key);

            //execute - returns all rows from table
            $sql->execute();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "Error: $error";
        }

        header("Location:customerlist.php");
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Customer Add</title>
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
            <h3 id="error"><?=$errmsg?></h3>
            <h2>Customer Add</h2>
            <div class="content">
                <form method="post">
                    <table border="1" width="80%">
                        <tr height = "60">
                            <th colspan="2"><h3>Add New Customer</h3></th>
                        </tr>
                        <tr height = "40">
                            <th>FirstName</th>
                            <td align="center"><input id="txtFirstName" name="txtFirstName" type="text" size="50"></td>
                        </tr>
                        <tr height = "40">
                            <th>LastName</th>
                            <td align="center"><input id="txtLastName" name="txtLastName" type="text" size="50"></td>
                        </tr>
                        <tr height = "40">
                            <th>StreetAddress</th>
                            <td align="center"><input id="txtStreetAddress" name="txtStreetAddress" type="text" size="50"></td>
                        </tr>
                        <tr height = "40">
                            <th>City</th>
                            <td align="center"><input id="txtCity" name="txtCity" type="text" size="50"></td>
                        </tr>
                        <tr height = "40">
                            <th>State Abr</th>
                            <td align="center"><input id="txtState" name="txtState" type="text" size="50"></td>
                        </tr>
                        <tr height = "40">
                            <th>Zip</th>
                            <td align="center"><input id="txtZip" name="txtZip" type="text" size="50"></td>
                        </tr>
                        <tr height = "40">
                            <th>Phone</th>
                            <td align="center"><input id="txtPhone" name="txtPhone" type="text" size="50"></td>
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
                            <th>Confirm Password</th>
                            <td align="center"><input id="txtPassword2" name="txtPassword2" type="password" size="50"></td>
                        </tr>
                        <tr height = "40">
                            <td colspan="2"  align="center">
                                <input type="submit" value="Add New Customer">
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
<?php
    session_start();

    $sessiontype = "";

    if($_SESSION[Role]==1){
        $sessiontype = "Administrator";
        echo "<body style='background-color:pink'>";
    }elseif($_SESSION[Role]==2){
        $sessiontype = "Operator";
        echo "<body style='background-color:orange'>";
    }else{
        $sessiontype = "Member";
        echo "<body style='background-color:red'>";
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
            <h1>Member Page</h1>
            <h2>Role type</h2>
            <div class="content">
                <p>Role type: <?= $sessiontype ?>
                </p>
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
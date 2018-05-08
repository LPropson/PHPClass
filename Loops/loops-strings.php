<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Loops & Strings</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyles.css"/>
</head>

<body>
<div class="page-wrap">
    <header class="site-header">
        <?php include "../Includes/header.php" ?>
    </header>

    <div class="flex-box">
        <vav class="main-nav">
            <?php include "../Includes/menu.php" ?>
        </vav>

        <section class="main-content" style="text-align: center;">
            <h2>Loops & Strings</h2>
            <div class="content">
                <p>
                    <?php
                    $number = 100;

                    $result = "<h1>";
                    $result .= $number;
                    $result .= "</h1>";

                    echo $result;
                    echo "<h1>" . $number . "</h1>";

                    $number1 = 150;
                    $number2 = 50;
                    $number = $number1 + $number2;

                    echo $number;
                    echo "<br>";
                    echo '$number';

                    //Loops - while
                    $i = 1;
                    while ($i < 7) {
                        echo "<h$i>Hello World!</h$i>";
                        //$i = $i + 1;
                        //$i += 1;
                        $i++;
                    }

                    $i = 6;
                    while($i > 0){
                        echo "<h$i>Hello World!!</$i>";
                        //$i = $i - 1;
                        //$i -= 1;
                        $i--;
                    }

                    //Do Loop
                    $i = 6;
                    do{
                        echo "<h$i>Hello World!!!</$i>";
                        //$i = $i - 1;
                        //$i -= 1;
                        $i--;
                    }while($i > 0);

                    //For Loop
                    for($i = 1; $i < 7; $i++){
                        echo "<h$i>Hello World!!!!</$i>";
                    }

                    $full_name = "Doug Smith";

                    //D o u g S m i t h
                    //1 2 3 4 5 6 7 8 9

                    $position = strpos($full_name, " ");
                    echo $position;

                    echo "<br><br><hr><br><br>";
                    echo $full_name;
                    echo "<br>";

                    $full_name = strtoupper($full_name);
                    echo $full_name;

                    $full_name = strtolower($full_name);
                    echo "<br>";
                    echo $full_name;
                    echo "<br><br><hr><br><br>";

                    $nameParts = explode(' ', $full_name);
                    echo $nameParts[0];
                    echo "<br>";
                    echo $nameParts[1];

                    ?>


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
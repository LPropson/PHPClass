<?php
/*
* This is a Dice Roll
*/
// Testing

// Fill a list of rolls
$diceroll = array();
$diceroll[0] = 1;
$diceroll[1] = 2;
$diceroll[2] = 3;
$diceroll[3] = 4;
$diceroll[4] = 5;
$diceroll[5] = 6;

$mydiceroll = array();
$mydicerollimg = array();
$yourscore = 0;
$computerscore = 0;

$mydiceimgsrc = "";
$otherdiceimgsrc = "";

//For Loop
for($i = 0; $i < 3; $i++){
    $mydiceroll[i] = $diceroll[mt_rand(0, 5)];
    $mydicerollimg[i] = "../images/dice_" . strval($mydiceroll[i]) . ".png";
    $yourscore = $yourscore + $mydiceroll[i];

    $image = $mydicerollimg[i];

// Read image path, convert to base64 encoding
    $imageData = base64_encode(file_get_contents($image));

// Format the image SRC:  data:{mime};base64,{data};
    $src = 'data: '.mime_content_type($image).';base64,'.$imageData;

    $mydiceimgsrc = $mydiceimgsrc . '<img src="' . $src . '">';

}

$computerdiceroll = array();

$computerdicerollimg = array();

//For Loop
for($i = 0; $i < 3; $i++){
    $computerdiceroll[i] = $diceroll[mt_rand(0, 5)];
    $computerdicerollimg[i] = "../images/dice_" . strval($computerdiceroll[i]) . ".png";

    $computerscore = $computerscore + $computerdiceroll[i];

    $image2 = $computerdicerollimg[i];

// Read image path, convert to base64 encoding
    $imageData = base64_encode(file_get_contents($image2));

// Format the image SRC:  data:{mime};base64,{data};
    $src = 'data: '.mime_content_type($image2).';base64,'.$imageData;

    $otherdiceimgsrc = $otherdiceimgsrc . '<img src="' . $src . '">';
}

if($yourscore == $computerscore){
    $resultscore = "Tie!!!";
}
elseif($yourscore > $computerscore){
    $resultscore = "You Win!!!!";
}
else{
    $resultscore = "Computer Wins!!!!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dice Roll!!!</title>
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
            <h2>Dice Roll!!!</h2>
            <div class="content">
                <form method="get" action="mydiceroll.php">
                    <p>
                        <?php
                            echo "<h2>Your Score is: $yourscore</h2>";
                            echo $mydiceimgsrc;
                            echo "<h2>Computer scored: $computerscore</h2>";
                            echo $otherdiceimgsrc;
                            echo "<h2>Result: $resultscore</h2>";
                        ?>
                    </p>
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
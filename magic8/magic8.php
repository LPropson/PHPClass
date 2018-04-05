<?php
/*
* This is a Magic 8 Ball
*/
// Testing

//Starting a session
session_start();

//Did they ask a question
    if (isset($_POST["txtQuestion"])){
        $question = $_POST["txtQuestion"];
    }else{
        $question = "";
    }

    if(isset($_SESSION["PrevQuest"])){
        $PrevQuest = $_SESSION["PrevQuest"];
    }
    else{
        $PrevQuest = "";
    }



// Fill a list of responses
    $responses = array();
    $responses[0] = "Ask again later!";
    $responses[1] = "Yes";
    $responses[2] = "No";
    $responses[3] = "It appears to be so!";
    $responses[4] = "Reply is hazy, please try again!";
    $responses[5] = "Yes, Definitely!";
    $responses[6] = "What is it you really want to know?";
    $responses[7] = "Outlook is good!";
    $responses[8] = "My sources say No!";
    $responses[9] = "Signs point to Yes";
    $responses[10] = "Don't count on it!";
    $responses[11] = "Cannot predict now";
    $responses[12] = "As I see it, Yes";
    $responses[13] = "Better not tell you now!";
    $responses[14] = "Concentrate and ask again";

    if($question == ""){
        $answer = "Ask me a Question";
    }elseif(substr($question, -1)!= "?"){
        $answer = "Ask me with a Question Mark???????";
    }elseif($PrevQuest==$question){
        $answer = "Ask me a NEW Question!!!!!";
    }else{
        $iResponse = mt_rand(0, 14);
        $answer = $responses[$iResponse];

        $_SESSION["PrevQuest"] = $question;
    }
    /*echo "<br>";*/
    //echo $question;

    /*var_dump($names);

    echo "<br>";
    echo $names[0];
    echo "<br>";
    echo $names[1];
    echo "<br>";
    echo $names[2];*/
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
        <vav class="main-nav">
            <?php include "../Includes/menu.php" ?>
        </vav>

        <section class="main-content">
            <h2>Magic 8 Ball</h2>
            <div class="content">
                <br />
                <marquee><?=$answer?></marquee>
                <br />
                <p>Ask a Question: <br />
                <form method="post" action="magic8.php">
                    <input type="text" name="txtQuestion" id="txtQuestion" value="<?=$question?>"></p>
                    <input type="submit" value="Ask the 8 Ball!">
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
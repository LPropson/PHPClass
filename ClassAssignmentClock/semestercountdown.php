
<?php
/*
* This is a Countdown Timer
* Burning Man 8-25-2020
*/
$secPerMin = 60;
$secPerHour = 60 * $secPerMin;
$secPerDay = 24 * $secPerHour;
$secPerYear = 365 * $secPerDay;

//Current time
$now = time();

//Semeester time
$semestertime = mktime(21,20,0,5,20,2018);

//Number of seconds between now and then
$seconds = $semestertime - $now;

//Years
//$years = floor($seconds/$secPerYear);

//Days
$seconds = $seconds - ($years * $secPerYear);
$days = floor($seconds/$secPerDay);

//hours
$seconds = $seconds - ($days * $secPerDay);
$hours = floor($seconds/$secPerHour);

//minutes
$seconds = $seconds - ($hours * $secPerHour);
$minute = floor($seconds/$secPerMin);

//seconds remaining
$seconds = $seconds - ($minute * $secPerMin);

?>

<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <title>Semester Countdown Timer</title>
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
            <h2>Semester Countdown Timer</h2>
            <div class="content">
                <h3>Semester Time Remaining Countdown</h3>
                <p>Days: <?= $days ?> |
                    Hours: <?= $hours ?> | Minutes: <?= $minute ?> |
                    Seconds: <?= $seconds ?>
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
<?php
/*  This is a self-contained html page to test out ClockLib.  */

// Include the librairy
require_once('models/libclock.php');

// Create a clock instance, with parameters (optionnal)
$clock = new Clock(
    date("s"),
    date("m"),
    date("H")
);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h1>It's about  <?= $clock->GetHours() . ':' . $clock->GetMinutes() . ':' . $clock->GetSeconds() ?></h1>
    <p>To time stamp: <?= $clock->ToTimestamp() ?></p>
    <hr>
    <?php $clock->SetFromTimestamp('103000'); ?>
    <p>New ClockTime from timestamp: <?= $clock->GetHours() . ':' . $clock->GetMinutes() . ':' . $clock->GetSeconds() ?></p>
</body>

</html>

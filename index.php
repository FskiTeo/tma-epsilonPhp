<?php



$isConnected = (isset($_COOKIE['mail']) || isset($_SESSION['mail'])) ? true : false;

if ($isConnected) {
    include('./back/bcaAccessCodeSystem.php');

    $accessCode = getAccessCodeFromDB();
    $accessCodeArrayed = stringToArrayAccessCode($accessCode);

    if (isset($_POST['course'])) {
        setToOneNewJoinedCourse($_POST['course'], $accessCodeArrayed);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Epsilon</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b30f5d3ef8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/background.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div id="top">
    <?php include('./components/header.php'); ?>
</div>

<section>
    <div id="inside">
        <h1>EPSILON</h1>
        <p id="baseline">Plateforme de peer-learning de l'EPSI Lille</p>

        <?php
			if($isConnected) {
				displayCoursesList($accessCodeArrayed);
			}
        ?>

        <p id="badge">Badges :
            <i class="fa fa-circle"></i>Non suivi
            <i class="fa fa-graduation-cap"></i> Apprenti
            <i class="fa fa-code"></i> Développeur
            <i class="fa fa-hand-holding-medical"></i> Passeur
            <i class="fa fa-star"></i> Guide
        </p>
    </div>
</section>

<p id="copyright">Copyright 2024 © EPSI Lille</p>

<div id="background">
    <div id="stars"></div>
    <div id="stars2"></div>
    <div id="stars3"></div>
</div>
</body>
</html>
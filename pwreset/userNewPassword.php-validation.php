<?php

if(isset($_POST["valid"])){
    if(isset($_POST["mail"]) && isset($_POST["token"]) && isset($_POST["password"])){
        require_once("../config/env.php");

        $stm = $db->prepare("SELECT mail, password FROM user WHERE mail = ? and password = ?");
        $stm->execute(array($_POST["mail"], $_POST['token']));
        $name = $stm->fetch();

        $counttable = count((is_countable($name)?$name:[]));
        if($counttable >= 1){
            $newPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $stm = $db->prepare("UPDATE user SET password = ? WHERE mail = ? AND password = ?");
            $stm->execute(array($newPassword, $_POST["mail"], $_POST["token"]));
            $name = $stm->fetch();
            $return = '<span style="color:green">Votre mot de passse a correctement été changé</span>';
        } else {
            $return = '<span style="color:red">Données envoyées non valides</span>';
        }
    } else {
        $return = '<span style="color:red">Données manquantes ! </span>';
    }
} else {
    $return = '<span style="color:red">Formulaire non validé</span>';
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
    <link rel="stylesheet" href="../assets/css/background.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div id="top">
    <?php include("../components/header.php"); ?>
</div>

<section>
    <div id="inside">
        <h1>EPSILON</h1>
        <p id="baseline">Plateforme de peer-learning de l'EPSI Lille</p>
        <?php echo $return; ?>
    </div>
</section>
</body>
</html>

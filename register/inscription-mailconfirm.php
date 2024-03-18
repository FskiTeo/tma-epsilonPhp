<?php

    require_once('../config/env.php');
    $mail = $_GET["mail"];

    // verif si mail existe pas déjà
    $selectall = $db->query('SELECT * FROM user WHERE mail="'.$mail.'"');
    $result = $selectall->fetch();
    $counttable = count((is_countable($result)?$result:[]));

    // sinon, insertion en base
    if($counttable==0){
        $res = $db->prepare('INSERT INTO user (mail,password) VALUES(:mail,:password)');
        $pwd = $_GET["token"];
        $res->execute(array('mail' => $mail,'password' => $pwd));
        $return = "Inscription validée, vous pouvez maintenant vous connecter !";
    }
    else{
        $return = '<span style="color:red">Mail déjà inscrit</span>';
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
        <?php
        include('../components/header.php');
        ?>
    </div>

    <section>
        <div id="inside">
            <h1>EPSILON</h1>
            <p id="baseline">Plateforme de peer-learning de l\'EPSI Lille</p>
            <p><?php echo $return; ?></p>
        </div>
    </section>
    
</body>
</html>
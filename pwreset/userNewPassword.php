<?php

if(isset($_GET["mail"]) && isset($_GET["token"])){
    require_once("../config/env.php");
    $stm = $db->prepare("SELECT mail, password FROM user WHERE mail = ?");
    $stm->execute(array($_GET["mail"]));
    $name = $stm->fetch();

    $counttable = count((is_countable($name)?$name:[]));
    if($counttable > 0){
        if($name["password"] == $_GET["token"]){
            $return = '<form action="./userNewPassword.php-validation.php" method="post">
            <table>
                <tr style="display: none">
                    <td class="label">Email</td>
                    <td><input type="email" name="mail" value="'. $name["mail"] . '" readonly><br></td>
                </tr>
                <tr style="display: none">
                    <td class="label">Token</td>
                    <td><input type="text" name="token" value="'. $name["password"] . '" readonly><br></td>
                </tr>
                <tr>
                    <td class="label">New Password</td>
                    <td><input type="password" name="password" pattern=".{3,}$"><br></td>
                </tr>
                <tr>
                    <td class="label"></td>
                    <td><input type="submit" name="valid" value="Confirmer le nouveau mot de passe"></td>
                </tr>
            </table>
        </form>';
        } else {
            $return = '<span style="color:red">Token is not valid.</span>';
        }
    } else {
        $return = '<span style="color:red">No database record for this email address.</span>';
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

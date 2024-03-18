<?php

if(isset($_POST["valid"])){
	if(isset($_POST["bca-mail"]) && $_POST["bca-mail"]!=''){
		require_once('../config/env.php');
        $mail = $_POST["bca-mail"];
		$selectall = $db->query('SELECT * FROM user WHERE mail="'.$mail.'"');
        $result = $selectall->fetch();
        $counttable = count((is_countable($result)?$result:[]));
        if($counttable >= 1){
            // envoyer mail @ $mail avec $result['password'] en token

            $subject = 'Epsilon: renouvellement de mot de passe';
            $pwd = $result['password'];
            $url = parse_url($_SERVER["HTTP_REFERER"], PHP_URL_HOST);
            $message = '<html>
                            <body>
                                <p>Bonjour,</p>
                                <p>Une demande de changement de mot de passe à été faite sur le site Epsilon. Pour changer votre mot de passe, 
                                    <a href="https://'.$url.'/pwreset/userNewPassword.php?mail='.$mail.'&token='.$pwd.'">veuillez cliquer ici</a>.
                                </p>
                                <p>&Agrave; bient&ocirc;t !<br>
                                Epsilon".</p>
                            </body>
                        </html>';

            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=iso-8859-1';
            $headers[] = 'Reply-To: Thibault <tvinchent@gmail.com>';
            $headers[] = 'From: Thibault <tvinchent@gmail.com>';

            if(mail($mail, $subject, $message, implode("\r\n", $headers))){
                $return = '<span style="color:green">Nous vous avons envoyé un mail à cette adresse pour renouveller votre mot de passe</span>';
            }
            
            // if(password_verify($_POST["bca-pwd"],$result['password'])){
            //     $return = "Connexion réussie";
            //     // envoyer cookies ou session
            //     if(isset($_POST['bca-stayIn'])){
            //         $expire = 365*24*3600; // on définit la durée du cookie, 1 an
            //         setcookie("mail",$mail,time()+$expire);  // on l'envoi
            //     }
            //     else{
            //         session_start();
            //         $_SESSION['mail'] = $mail;
            //         echo 'ok'.$_SESSION['mail'];
            //     }
            // }
            // else{
            //     $return = '<span style="color:red">Mauvais mot de passe, <a href="index.php">réinitialisation du mot de passe</a>.</span>';
            // }
        }
        else{
            $return = '<span style="color:red">Pas de mail correspondant</span>';
        }
    }
	else{
		$return = '<span style="color:red">Veuillez préciser un mail</span>';
	}
}
else{
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
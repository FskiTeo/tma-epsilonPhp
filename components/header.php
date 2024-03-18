<?php

session_start();

if(isset($_COOKIE['mail']) || isset($_SESSION['mail'])){
    $id = isset($_COOKIE['mail']) ? $_COOKIE['mail'] : $_SESSION['mail'];
    echo'
                <ul id="connection" style="color:white" >
                    <li id="home">
                        <a href="/"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li id="signup">
                        <i class="fas fa-user"></i> ' . $id . '
                    </li>
                    <li>
                        <i class="fas fa-lock"></i> <a href="/pwreset/">Change password</a>
                    </li>
                    <li id="signout">
                        <a href="/logout/"><i class="fas fa-sign-out-alt"></i></a>
                    </li>
                </ul>
            ';
}
else{
    echo '<ul id="connection">
                    <li id="home">
                        <a href="/"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li id="signup">
                        <a href="../register/"><i class="fas fa-user-plus"></i> Inscription</a>
                    </li>
                    <li id="signin">
                        <a href="../login/"><i class="fas fa-sign-in-alt"></i> Connexion</a>
                    </li>
                </ul>
            ';
}
?>
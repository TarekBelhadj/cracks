<?php

session_start();

$limite = 3;     
$duree = 60; 

if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = [];
}

$_SESSION['attempts'] = array_filter(
    $_SESSION['attempts'],
    function ($t) use ($duree) {
        return $t > time() - $duree;
    }
);

if (count($_SESSION['attempts']) >= $limite) {
    die("Trop d'inscriptions ! , veuillez réessayer dans une minute :D");
}

$_SESSION['attempts'][] = time();

if(!empty($_REQUEST['valid'])) {
    Auth::getInstance()->subscribe($_REQUEST['login'], $_REQUEST['pwd']);
    echo '<p>Inscription réalisée avec succès !</p>';
}
?><form method="post">
    <div>
        <h2>Inscription</h2>
        <p>
            <label>
                Login
                <input type="text"
                       required="required"
                       name="login" />
            </label>
        </p>
        <p>
            <label>
                Login
                <input type="password"
                       required="required"
                       name="pwd" />
            </label>
        </p>
        <input type="submit" name="valid" value="Valider l'inscription" />
    </div>
</form>

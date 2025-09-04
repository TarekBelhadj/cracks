<?php
    if(!empty($_REQUEST['go'])) {
        if(Auth::getInstance()->tryLog($_REQUEST['login'], $_REQUEST['pwd'])) {
            header('Location:index.php?sid='.Auth::getInstance()->getSid());
            exit;
        } else {
            echo '<p>Erreur d\'identifiants !</p>';
        }
    }
?><form method="post">
    <div>
        <h2>Connexion</h2>
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
                Mot de passe
                <input type="password"
                       required="required"
                       name="pwd" />
            </label>
        </p>
        <input type="submit" name="go" value="Se connecter" />
    </div>
</form>
<p>
    Mot de passe oublié ?
    Envoyez un mail à
    <a href="mailto:<?php echo ADMIN_EMAIL; ?>"><?php echo ADMIN_EMAIL; ?></a>
    avec votre login
    pour recevoir un lien
    de reset de mot de passe !
</p>
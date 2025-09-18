<?php
require_once 'config.php';

function getCurrentUser() {
    global $db;
    $userId = $_SESSION['userid'];
    $q = 'SELECT * FROM users WHERE id = ?';
    $stmt = $db->prepare($q);
    $stmt->execute([$userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!Auth::getInstance()->isLogged()) {
    header('Location: /?inc=login');
    exit;
}

$currentUser = getCurrentUser();
if (!$currentUser || $currentUser['isadmin'] != 1) {
    echo 'Accès réservé aux administrateurs !';
    exit;
}

?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cracks are forming</title>
        <script type="text/javascript" src="script.js"></script>
    </head>
    <body>
        <h1>Création code reset</h1>
        <form method="post">
            <p>
                <input type="text" name="login" placeholder="login" />
                <input type="hidden" name="mdp" value="<?php echo $systemMdp; ?>" />
                <input type="submit" name="valid" value="Obtenir le lien" />
            </p>
        </form>
        <p>Envoyer ce code à l'utilisateur qui a oublié son mdp</p>
        <?php if(!empty($_REQUEST['valid'])) {
            $found = Auth::getInstance()->getCodeFromLogin($_REQUEST['login']);
            ?>
        <kbd><?php echo $_SERVER['HTTP_HOST'].'/?inc=rst&amp;id='.$found['id'].'&amp;code='.$found['pwd']; ?></kbd>
        <?php } ?>
    </body>
</html>

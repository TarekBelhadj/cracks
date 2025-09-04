<?php
    require_once 'config.php';
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cracks are forming</title>
        <script type="text/javascript" src="script.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <header>
            <menu>
                <li>
                    <a href="/">
                        Accueil
                    </a>
                </li>
                <li>
                    <a href="/?inc=search">
                        Cracks
                    </a>
                </li>
                <li>
                    <a href="/?inc=add">
                        Nouveau
                    </a>
                </li><?php if(!Auth::getInstance()->isLogged()) { ?>
                <li>
                    <a href="/?inc=login">
                        Connexion
                    </a>
                </li>
                <li>
                    <a href="/?inc=sub">
                        Inscription
                    </a>
                </li>
                <?php } else { ?>
                <li>
                    <a href="/?inc=logoff">
                        Déconnexion
                    </a>
                </li><?php } ?>
            </menu>
        </header>
        <main>
            <?php
                if(!empty($_REQUEST['inc'])) {
                    include './inc/'.$_REQUEST['inc'].'.php';
                } else {
                    include './inc/last.php';
                }
            ?>
        </main>
        <footer>
            
        </footer>
    </body>
</html>

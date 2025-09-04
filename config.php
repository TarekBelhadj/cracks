<?php
define('ADMIN_EMAIL', '<insert email>@etu-bourgogne.fr');

chdir(__DIR__);

require_once './tSingleton.php';
require_once './Auth.php';
require_once './Markdown.php';

$dbConfig = json_decode(trim(file_get_contents('./db.json')), true);

$db = new PDO($dbConfig['dsn'], null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);


function displayCrack($crack) {
    $voteable = !empty($_SESSION['userid']);
    echo '<div class="crack voteable" data-cid="'.$crack['id'].'">';
    if($voteable) {
        echo '<div class="votebar">'
                . '<span class="dovote" data-val="1">👍</span>'
                . '[<span class="votes">-</span>]'
                . '<span class="dovote" data-val="-1">👎</span>'
            . '</div>';
    }
    echo '<p>'.Markdown::_($crack['content']).'</p>';
    if(!empty($crack['login'])) {
        echo '<footer>Envoyé par '.$crack['login'].' le '.date('Y-m-d H:i', intval($crack['datesend'])).'</footer>';
    }
    echo '</div>';
    if($voteable) {
        echo '<script type="text/javascript">loadVoteBar('.$crack['id'].', '.$_SESSION['userid'].');</script>';
    }
}

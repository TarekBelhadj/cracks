<?php
    /**
     * peut chercher par contenu
     * content=
     * peut chercher par id
     * cid=
     * peut chercher par user
     * uid=
     * on stocke la dernière recherche en cookie
     */
    
    function searchByCid(int $cid) {
        global $db;
        $q = 'select c.*, u.login '
                . ' from cracks c '
                . ' left join users u on u.id=c.owner '
                . " where c.id=$cid";
        $found = null;
        $ls = $db->query($q, PDO::FETCH_ASSOC);
        if(!empty($ls)) {
            foreach($ls as $l) { $found = $l; }
        }
        if($found) {
            displayCrack($found);
        } else {
            echo '<p>Crack introuvable !</p>';
        }
    }
    
    function searchByUid($uid) {
        global $db;
        $q = 'select c.*, u.login '
                . ' from cracks c '
                . ' left join users u on u.id=c.owner '
                . " where c.owner=$uid";
        $found = [];
        $ls = $db->query($q, PDO::FETCH_ASSOC);
        if(!empty($ls)) {
            foreach($ls as $l) { $found[] = $l; }
        }
        if(count($found)) {
            foreach($found as $c) {
                displayCrack($c);
            }
        } else {
            echo '<p>Aucun crack pour cet utilisateur !</p>';
        }
    }
    
    function searchByContent($content) {
        global $db;
        $q = 'select c.*, u.login '
                . ' from cracks c '
                . ' left join users u on u.id=c.owner '
                . " where c.content like '$content'";
        $found = [];
        $ls = $db->query($q, PDO::FETCH_ASSOC);
        if(!empty($ls)) {
            foreach($ls as $l) { $found[] = $l; }
        }
        if(count($found)) {
            echo '<div class="flex">';
            foreach($found as $c) {
                displayCrack($c);
            }
            echo '</div>';
        } else {
            echo '<p>Aucun crack pour cette recherche !</p>';
        }
    }
    
    $cid = 0;
    $uid = 0;
    $content = '';
    
    // sauvegarde de la recherche en cookies
    if(!empty($_REQUEST['cid'])) {
        $cid = intval($_REQUEST['cid']);
        setcookie('cid', $cid);
        unset($_COOKIE['uid']);
        unset($_COOKIE['content']);
    } elseif(!empty($_COOKIE['cid']) && empty($_REQUEST['uid']) && empty($_REQUEST['content'])) {
        $cid = $_COOKIE['cid'];
    }
    
    if(!empty($_REQUEST['uid'])) {
        $uid = intval($_REQUEST['uid']);
        setcookie('uid', $uid);
        unset($_COOKIE['cid']);
        unset($_COOKIE['content']);
    } elseif(!empty($_COOKIE['uid']) && empty($_REQUEST['cid']) && empty($_REQUEST['content'])) {
        $uid = $_COOKIE['uid'];
    }
    
    if(!empty($_REQUEST['content'])) {
        $content = '%'.$_REQUEST['content'].'%';
        setcookie('content', $content);
        unset($_COOKIE['uid']);
        unset($_COOKIE['cid']);
    } elseif(!empty($_COOKIE['content']) && empty($_REQUEST['uid']) && empty($_REQUEST['cid'])) {
        $content = $_COOKIE['content'];
    }
    
    $usersList = [];
    $q = 'select id, login '
        . ' from users '
        . ' order by login';
    $ls = $db->query($q, PDO::FETCH_ASSOC);
    foreach($ls as $u) {
        $usersList[] = $u;
    }
    
?><form method="post">
    <div>
        <h2>Rechercher un crack</h2>
        <p>
            <label>
                Par ID :
                <input name="cid" type="number" min="0" step="1" value="<?php echo $cid; ?>" />
            </label>
        </p>
        <p>
            <label>
                Par utilisateur :
                <select name="uid">
                    <option value="">-</option>
                    <?php foreach($usersList as $usr) { ?>
                    <option value="<?php echo $usr['id']; ?>"<?php
                        if($usr['id'] == $uid) { echo ' selected="selected"'; } ?>>
                        <?php echo $usr['login']; ?>
                    </option>
                    <?php } ?>
                </select>
            </label>
        </p>
        <p>
            <label>
                Par contenu :
                <input name="content" type="search" value="<?php echo $content; ?>" />
            </label>
        </p>
        <input type="submit" value="Rechercher !" />
    </div>
</form>
<?php
    if(!empty($_REQUEST['cid'])) {
        searchByCid($cid);
        setcookie('uid', '');
        setcookie('content', '');
    } else if(!empty($_REQUEST['uid'])) {
        searchByUid($uid);
        setcookie('cid', '');
        setcookie('content', '');
    } else if(!empty($_REQUEST['content'])) {
        searchByContent($content);
        setcookie('uid', '');
        setcookie('cid', '');
    }

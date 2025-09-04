<form method="post">
    <div>
        <p>
            Nouveau mot de passe :
            <input type="password"
                   name="pwd1" />
        </p>
        <p>
            Nouveau mot de passe :
            <input type="password"
                   name="pwd2"
                   onpaste="return false;" />
        </p>
        <input type="hidden" name="inc" value="rst" />
        <input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>" />
        <input type="hidden" name="code" value="<?php echo $_REQUEST['code']; ?>" />
        <input type="submit" name="change" value="Valider le changement de mot de passe !" />
    </div>
</form>
<?php
if(!empty($_REQUEST['change']) && !empty($_REQUEST['id']) && !empty($_REQUEST['code'])) {
    if($_REQUEST['pwd1'] == $_REQUEST['pwd2']) {
        Auth::getInstance()->resetPwd($_REQUEST['id'], $_REQUEST['code'], $_REQUEST['pwd1']);
    }
}

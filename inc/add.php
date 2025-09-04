<?php
    if(!empty($_REQUEST['val'])) {
        $q = 'insert into cracks (content, owner, datesend) '
                . ' values("'.nl2br($_REQUEST['content']).'", "'.$_REQUEST['owner'].'", '.time().')';
        $db->query($q);
        // rediriger vers le nouveau crack
        header('Location:index.php?inc=search&cid='.$db->lastInsertId());
        exit;
    }
?><form method="post">
    <div>
        <h2>Ajouter un crack</h2>
        <p>
            <label for="content">
                Contenu
            </label>
            <textarea name="content"
                      id="content"
                      required="required"></textarea>
            <input type="hidden"
                   name="owner"
                   value="<?php echo $_SESSION['userid']; ?>" />
            <input type="submit" name="val" value="Ajouter ce crack" />
        </p>
    </div>
</form>
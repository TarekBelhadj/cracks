<?php
    Auth::getInstance()->logoff();
    header('Location:index.php?sid='.Auth::getInstance()->getSid());
    exit;

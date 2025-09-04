<?php

/**
 * Description of Auth
 *
 * @author 
 */
class Auth {
    use tSingleton;
    const COOKIENAME = 'authbypass';
    
    protected function __construct(){
        session_start();
        if(isset($_COOKIE[self::COOKIENAME])) {
            $this->log($_COOKIE[self::COOKIENAME]);
        }
    }
    
    public function subscribe($login, $pwd) {
        global $db;
        $q = 'insert into users values(null, "'.addslashes($login).'", "'.md5($pwd).'", 0)';
        $db->query($q);
    }
    
    public function tryLog($login, $pwd): bool {
        global $db;
        $q = 'select * from users where login="'.$login.'" and pwd="'.md5($pwd).'"';
        $found = null;
        $ls = $db->query($q, PDO::FETCH_ASSOC);
        if(!empty($ls)) {
            foreach($ls as $l) { $found = $l; }
        }
        if($found) {
            $this->log($found['id']);
            return true;
        } else {
            return false;
        }
    }
    
    public function log($id) {
        $_SESSION['userid'] = $id;
    }
    
    public function logoff() {
        $_SESSION['userid'] = null;
    }
    
    public function isLogged() {
        return !empty($_SESSION['userid']);
    }
    
    public function getSid() {
        return session_id();
    }
    
    public function getCodeFromLogin($login) {
        global $db;
        $q = 'select id, pwd from users where login="'.$login.'"';
        return $db->query($q)->fetch(PDO::FETCH_ASSOC);
    }
    
    public function resetPwd($id, $code, $newPwd) {
        global $db;
        $q = 'update users set pwd="'.md5($newPwd).'" where id="'.$id.'" and pwd="'.$code.'"';
        $db->query($q);
    }
}

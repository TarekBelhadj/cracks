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
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); // bcrypt/argon2
        $q = $db->prepare('INSERT INTO users (login, pwd, isadmin) VALUES (:login, :pwd, 0)');
        $q->execute([':login' => $login, ':pwd' => $hashedPwd]);
    }
    
    public function tryLog($login, $pwd): bool {
        global $db;
        $requete = $db->prepare('SELECT * FROM users WHERE login = :login LIMIT 1');
        $requete->execute([':login' => $login]);
        $found = $requete->fetch(PDO::FETCH_ASSOC);

        if ($found && password_verify($pwd, $found['pwd'])) {
            $this->log($found['id']);
            return true;
        }
        return false;
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
        $q = $db->prepare('SELECT id, pwd FROM users WHERE login = :login');
        $q->execute([':login' => $login]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }
    
    public function resetPwd($id, $code, $newPwd) {
    global $db;
    $q = $db->prepare('SELECT pwd FROM users WHERE id = :id');
    $q->execute([':id' => $id]);
    $user = $q->fetch(PDO::FETCH_ASSOC);

    if ($user && hash_equals($user['pwd'], $code)) {
        $hashedPwd = password_hash($newPwd, PASSWORD_DEFAULT);
        $update = $db->prepare('UPDATE users SET pwd = :pwd WHERE id = :id');
        $update->execute([':pwd' => $hashedPwd, ':id' => $id]);
    
    }
}

}

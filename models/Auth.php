<?php 

class Auth {
    private $session_token;
    private $password;
    private $id;

    public function __construct($id, $password, $session_token) {

        $this -> setSessionToken($session_token);
        $this -> setPassword($password);
        $this -> setId($id);

    }

    public function setSessionToken($session_token) {
        $this -> session_token = $session_token;
    }
    public function setPassword($password) {
        $this -> password = $password;
    }
    public function setId($id) {
        $this -> id = $id;
    }

    public function getSessionToken() {
        return $this -> session_token;
    }
    public function getPassword() {
        return $this -> password;
    }
    public function getId() {
        return $this -> id;
    }

}
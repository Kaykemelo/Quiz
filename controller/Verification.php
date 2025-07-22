<?php

class Verification {

    public function __construct()
    {
        session_start();
    }

    public function checkSession(){

        if (!isset($_SESSION['id_User'])) {
            return false;
        }
        return true;
    }
}
?>
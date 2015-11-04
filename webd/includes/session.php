<?php

class Session {
    # start session if is not already started
    # always needed for use session
    public function start_session(){
        if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
    }
    # check if session is started session
    # return number of session
    public function is_session_started(){
        return session_status();
    }

    # set user_id
    public function set_user_id($user_id){
        $_SESSION['login_user'] = $user_id;
    }
    # get user_id
    public function get_user_id(){
        if( isset( $_SESSION['login_user']) ){
            return $_SESSION['login_user'];
        }else{
            return 'logged off';
        }
    }
}
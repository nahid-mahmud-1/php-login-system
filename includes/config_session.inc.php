<?php

    ini_set("session.use_only_cookies", 1);
    ini_set("session.use_strict_mode", 1);

    session_set_cookie_params([
        'lifetime'  => 1800,
        'domain'    => 'localhost',
        'path'      => '/',
        'secure'    => true,
        'httponly'  => true,
    ]);

    // SESSION START
    session_start();

    if(isset($_SESSION["user_id"])){

        if(!isset($_SESSION["last_regeneration"])){
            regenerate_session_id_logged_in();
        }
        else{

            $interval = 60 * 30;

            if(time() - $_SESSION["last_regeneration"] >= $interval){
                regenerate_session_id_logged_in();
            }
        }


    }
    else{

         // CHECK SESSION ID REGENERATION
        if(!isset($_SESSION["last_regeneration"])){
            regenerate_session_id();
        }
        else{

            $interval = 60 * 30;

            if(time() - $_SESSION["last_regeneration"] >= $interval){
                regenerate_session_id();
            }

        }

    }

   
    // SESSION ID REGENERATION FOR LOGGEDIN USER
    function regenerate_session_id_logged_in(){
        session_regenerate_id(true);

        $user_id =  $_SESSION["user_id"];
        $newSessionID   = session_create_id();
        $sessionId      = $newSessionID . "_" . $user_id;
        session_id($sessionId);

        $_SESSION["last_regeneration"] = time();
    }

    // SESSION ID REGENERATION
    function regenerate_session_id(){
        session_regenerate_id(true);
        $_SESSION["last_regeneration"] = time();
    }
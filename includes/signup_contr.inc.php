<?php

    declare(strict_types = 1);

    // IF FORM INPUTS ARE EMPTY
    function is_input_empty(string $username, string $pwd, string $email){

        if(empty($username) || empty($pwd) || empty($email)){
            return true;
        }
        else{
            return false;
        }

    }

    // IF EMAIL IS INVALID
    function is_email_invalid(string $email){

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        else{
            return false;
        }

    }

    // IF USERNAME IS TAKEN
    function is_username_taken(object $pdo, string $username){

        if(get_username($pdo, $username)){
            return true;
        }
        else{
            return false;
        }

    }

    // IF EMAIL IS REGISTERED
    function is_email_used(object $pdo, string $email){
        
        if(get_email($pdo, $email)){
            return true;
        }
        else{
            return false;
        }

    }

    // CREATE USER
    function create_user(object $pdo, string $username, string $pwd, string $email){

        set_user($pdo, $username, $pwd, $email);

    }
    
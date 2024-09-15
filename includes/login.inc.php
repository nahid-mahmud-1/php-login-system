<?php

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        // STORING LOGIN FORM DATA
        $username   = $_POST["username"];
        $pwd        = $_POST["pwd"];


        try{

            // DATABASE CONNECTION
            require_once "dbh.inc.php";
            // MVC
            require_once "login_model.inc.php";
            require_once "login_contr.inc.php";

            // ERROR HANDLERS
            $errors = [];

            if(is_input_empty($username, $pwd)){
                $errors["empty_input"] = "Fill all the inputs!";
            }

            // STORING USER INFO
            $result = get_user($pdo, $username);

            if(is_username_wrong($result)){
               $errors["login_incorrect"] = "Incorrect Login Info!";
            }

            if(!is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"])){
                $errors["login_incorrect"] = "Incorrect Login Info!";
            }


            // SESSION START
            require_once "config_session.inc.php"; 

            if($errors){
                
                $_SESSION["login_errors"] = $errors;

                // REDIRECT TO INDEX.PHP
                header("Location: ../index.php");
                die();
            }

            // GENERATING SESSION ID
            $newSessionID   = session_create_id();
            $sessionId      = $newSessionID . "_" . $result["id"];
            session_id($sessionId);

            // STORING LOGGEDIN USER INFO IN SESSION
            $_SESSION["user_id"]        = $result["id"];
            $_SESSION["user_username"]  = htmlspecialchars($result["username"]);

            // ADDING TIME TO SESSION
            $_SESSION["last_regeneration"] = time();

            header("Location: ../index.php?login=success");
            
            $pdo = null;
            $stmt = null;

            die();


        }catch(PDOException $e){
            die("Query Failed: " . $e->getMessage());
        }

    }
    else{
        header("Location: ../index.php");
        die();
    }
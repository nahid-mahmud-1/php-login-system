<?php

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        // STORING FORM DATA
        $username   = $_POST["username"];
        $pwd        = $_POST["pwd"];
        $email      = $_POST["email"];

        try{

            // DATABASE CONNECTION
            require_once "dbh.inc.php";
            // MVC Files
            require_once "signup_model.inc.php";
            require_once "signup_contr.inc.php";

            // ERROR HANDLERS
            $errors = [];

            if(is_input_empty($username, $pwd, $email)){
                $errors["empty_input"] = "Fill all the inputs!";
            }
            if(is_email_invalid($email)){
                $errors["invalid_email"] = "Email is not valid!";
            }
            if(is_username_taken($pdo, $username)){
                $errors["username_taken"] = "Username already taken!";
            }
            if( is_email_used($pdo, $email)){
                $errors["email_used"] = "Email already registered";
            }

            // SESSION START
            require_once "config_session.inc.php";

            if($errors){
                $_SESSION["signup_errors"] = $errors;

                $singupData = [
                    "username" => $username,
                    "email" => $email
                ];

                $_SESSION["signup_data"] = $singupData;

                header("Location: ../index.php");
                die();
            }

            // CREATE USER IF NO ERRORS
            create_user($pdo, $username, $pwd, $email);

            $pdo = null;
            $stmt = null;

            header("Location: ../index.php?signup=success");

            die();
            

        }catch(PDOException $e){
            die("Query Failed: " . $e->getMessage());
        }

    }
    else{
        header("Location: ../index.php");
        die();
    }
<?php

    declare(strict_types = 1);


    function signup_inputs(){


        if(isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["signup_errors"]["username_taken"])){

            echo '<input type="text" name="username" value="'. $_SESSION["signup_data"]["username"] .'" placeholder="Username">';

        }
        else{
            echo '<input type="text" name="username" placeholder="Username">';

            unset($_SESSION["signup_data"]["username"]);
        }

        echo '<input type="password" name="pwd" placeholder="Password">';

        if(isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["signup_errors"]["email_used"])){

            echo '<input type="email" name="email" value="'.$_SESSION["signup_data"]["email"].'" placeholder="Email">';
            
        }
        else{
            echo '<input type="email" name="email" placeholder="Email">';
            
            unset($_SESSION["signup_data"]["email"]);
        }

    }


    // CHECK SIGNUP ERRORS
    function check_signup_errors(){

        if(isset($_SESSION["signup_errors"])){
            
            $errors = $_SESSION["signup_errors"];

            foreach($errors as $error){
                echo "<p class='form-error'> $error</p>";
            }

            unset($_SESSION["signup_errors"]);

        }
        else if(isset($_GET["signup"]) && $_GET["signup"] === "success"){
            
            echo '<div class="form-success">User Created Successfully</div>';

            die();
        }

    }
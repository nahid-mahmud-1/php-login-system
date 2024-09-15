<?php

    declare(strict_types = 1);

    function output_username(){

        if(isset($_SESSION["user_id"])){
            echo '<div class="admin"> Hi <span>'. $_SESSION["user_username"] . ',</span> You are admin now!.</div>';
        }

    }

    // CHECKING LOGIN ERRORS
    function check_login_errors(){

        if(isset($_SESSION["login_errors"])){

            $login_errors = $_SESSION["login_errors"];

            foreach($login_errors as $login_error){
                echo '<p class="form-error">'.$login_error.'</p>';
            }

            unset($_SESSION["login_errors"]);

        }
        else if(isset($_GET["login"]) && $_GET["login"] === "success"){

            echo '<div class="form-success">Login Success</div>';

        }

    }
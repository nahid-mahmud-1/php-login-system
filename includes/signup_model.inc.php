<?php

    declare(strict_types = 1);

    // GET USERNAME FROM THE USER TABLE
    function get_username(object $pdo, string $username){

        // SQL Query
        $query = "SELECT username FROM users WHERE username = :username;";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;

    }

    // GET EMAIL FROM THE USER TABLE
    function get_email(object $pdo, string $email){

        // SQL query
        $query = "SELECT email FROM users WHERE email = :email";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":email", $email);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;

    }

    // SET USER INTO THE USER TABLE
    function set_user(object $pdo, string $username, string $pwd, string $email){

        require_once "dbh.inc.php";

        // SQL query to insert data
        $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email);";
        
        $stmt = $pdo->prepare($query);

        // Password Hasing
        $options = [
            "cost" => 12
        ];

        $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $hashedPwd);
        $stmt->bindParam(":email", $email);

        $stmt->execute();
    }
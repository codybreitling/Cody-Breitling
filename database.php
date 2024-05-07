<?php
    $dsn = 'mysql:host=localhost;dbname=my_membership_application1';
    $username = 'root';
    $password = 'B@seball24';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>
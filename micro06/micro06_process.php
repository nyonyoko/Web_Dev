<?php
    // accept the incoming data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // check if the username field is empty
    if(empty($username)) {
        header("Location: micro06.php?status=username_missing");
        exit();
    }

    // check if the password field is empty
    if(empty($password)) {
        header("Location: micro06.php?status=password_missing");
        exit();
    }

    // check if the username and password are correct
    if($username != 'pikachu' || $password != 'pokemon') {
        header("Location: micro06.php?status=incorrect");
        exit();
    } else {
        header("Location: micro06.php?status=logged_in");
        exit();
    }
?>

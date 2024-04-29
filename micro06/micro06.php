<?php
    if(isset($_GET['status'])){
        if($_GET['status'] == 'username_missing'){
            echo "<p style='color:red;'>Error: username is missing!</p>";
        } else if ($_GET['status'] == 'password_missing'){
            echo "<p style='color:red;'>Error: password is missing!</p>";
        } else if ($_GET['status'] == 'incorrect'){
            echo "<p style='color:red;'>Error: username or password is incorrect!</p>";
        } else if ($_GET['status'] == 'logged_in'){
            echo "<p style='color:green;'>You are logged in!</p>";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <h1>Micro06</h1>
        <form action="micro06_process.php" method="POST">
            <div>Username: <input type="text" name="username"></div>
            <div>Password: <input type="text" name="password"></div>
            <input type="submit">
        </form>
    </body>
</html>
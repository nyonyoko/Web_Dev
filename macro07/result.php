<!doctype html>
<html>
    <head>
        <title>Your Quiz Result</title>
        <style>
            h1 {
                margin: 5px 0;
                padding: 5px;
                font-family: Arial, sans-serif;
            }
            .container {
                width: 400px;
                margin: 0 auto;
                padding: 20px;
                border: 2px solid black;
                text-align: center;
            }
            .container img {
                max-width: 90%;
                height: auto;
                padding: 20px;
            }
        </style>
    </head>
    <body>
        <h1>Which Marvel Character am I?</h1>
        <div class="container">
            <?php
            // Check if the character cookie is set
            if (isset($_COOKIE['character']) && !empty($_COOKIE['character'])) {
                $character = $_COOKIE['character'];
                // Display the character image and name
                echo "<h2>You are " . ucwords(str_replace('_', ' ', $character)) . "!</h2>";
                echo "<img src=\"images/$character.jpg\" alt=\"$character\">";
            } else {
                // If the character cookie is not set, 
                // return to the original quiz page
                header("Location: index.php");
            }
            ?>
            <form action="tryagain.php" method="post">
                <button type="submit">Try Again?</button>
            </form>
        </div>
    </body>
</html>

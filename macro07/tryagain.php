<?php
    // Delete the character cookie
    setcookie('character', '');
    // Return to the original quiz page
    header("Location: index.php");
?>
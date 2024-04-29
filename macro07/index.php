<?php
    // Check if the character cookie is set
    if (isset($_COOKIE['character']) && !empty($_COOKIE['character'])) {
        // If the character cookie is set, show the last result
        header("Location: result.php");
        exit;
    }
?>
<!doctype html>
<html>
    <head>
        <title>Server-side Quizzing System</title>
        <style>
            h1 {
                margin: 5px 0;
                padding: 5px;
                font-family: Arial, sans-serif;
            }
            div {
                padding: 5px;
                font-weight: bold;
                font-family: Arial, sans-serif;
            }
            hr {
                margin: 20px 0;
            }
        </style>
    </head>
    <body>
        <h1>Which Marvel Character am I?</h1>
        <?php
            // Check if there's an error in the URL and its value is 'missing_field'
            if (isset($_GET['error']) && $_GET['error'] == 'missing_fields') {
                // Display an error message
                echo '<p style="color: red;">Please answer all questions before submitting.</p>';
            }
        ?>
        <hr>
        <form action="process.php" method="POST">
            <div>
                Which one describes your personality the best?
                <div>
                    <select name="personality">
                        <option value="unknown">Select a personality</option>
                        <option value="calm">Calm</option>
                        <option value="energetic">Energetic</option>
                        <option value="serious">Serious</option>
                        <option value="funny">Funny</option>
                        <option value="others">Others</option>
                    </select>
                </div>
            </div>
            
            <div>
                What is the best way of dealing with MCU villains?
                <div>
                    <select name="villain">
                        <option value="unknown">Select a strategy</option>
                        <option value="kill">Kill them</option>
                        <option value="imprison">Imprison them</option>
                        <option value="nothing">Do nothing</option>
                    </select>
                </div>
            </div>

            <div>
                Do you think superheroes should work with the government and follow the rules?  
                <div>
                    <select name="government">
                        <option value="unknown">Select an opinion</option>                        
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                        <option value="depends">It depends</option>
                    </select>
                </div>
            </div>

            <div>
                Which group of heroes do you like more?
                <div>
                    <select name="group">
                        <option value="unknown">Select a group</option>                        
                        <option value="avengers">Avengers</option>
                        <option value="guardians">Guardians of the Galaxy</option>
                    </select>
                </div>
            </div>

            <div>
                Which would you most like to have?
                <div>
                    <select name="power">
                        <option value="unknown">Select an superpower</option>
                        <option value="intelligence">Intelligence / technology</option>
                        <option value="physical">Physical power</option>
                        <option value="magic">Magic power / special abilities</option>
                    </select>
                </div>
            </div>
            <div>
                <input type="submit">
            </div>
        </form>
        <hr>
        <div>
            <a href="aggregate_results.php">See Aggregate Results</a>
        </div>
    </body>
</html>


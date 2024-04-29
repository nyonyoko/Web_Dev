<?php
    // Initialize variables
    $submission_num = 0;
    
    $character_colors = [
        'ironman' => '#FF0000',
        'captain_america' => '#0000FF',
        'thor' => '#00FF00',
        'black_widow' => '#FFA07A',
        'hulk' => '#00FFFF',
        'spiderman' => '#FF00FF',
        'doctor_strange' => '#FFFF00',
        'wanda' => '#FFA500',
        'black_panther' => '#800080',
        'starlord' => '#008000',
        'rocket' => '#808080',
        'groot' => '#008080'
    ];

    $characters_percentages = [
        'ironman' => 0,
        'captain_america' => 0,
        'thor' => 0,
        'black_widow' => 0,
        'hulk' => 0,
        'spiderman' => 0,
        'doctor_strange' => 0,
        'wanda' => 0,
        'black_panther' => 0,
        'starlord' => 0,
        'rocket' => 0,
        'groot' => 0
    ];

    // Read data from the results.txt file
    $filename = getcwd() . '/data/results.txt';

    if (file_exists($filename)) {
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        // Count the number of submissions
        $submission_num = count($lines);
        // Console log variables for debugging
        echo '<script>';
        echo 'console.log("Submission Number: ' . $submission_num . '");';
        echo '</script>';
        // Count occurrences of each character
        $character_counts = array_count_values($lines);
        // Calculate percentages
        foreach ($characters_percentages as $character => $percentage) {
            $characters_percentages[$character] = ($character_counts[$character] ?? 0) / $submission_num * 100;
            // Round to two decimal places
            $characters_percentages[$character] = round($characters_percentages[$character], 2);
            echo '<script>';
            echo 'console.log("' . $character . ': ' . $characters_percentages[$character]. '%");';
            echo '</script>';
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Aggregate Quiz Results</title>
    <style>
        h1 {
            margin: 5px 0;
            padding: 5px;
            font-family: Arial, sans-serif;
        }
        .submission {
            font-family: Arial, sans-serif;
            padding: 5px;
        }
        .container {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            width: 80%;
            height: 40px;
            margin-top: 15px;
        }
        .container p {
            flex: 0 0 20%;
            text-align: right;
            font-size: 14px;
            font-family: Arial, sans-serif;
        }
        .container div {
            height: 40px;
            margin-left: 10px;
            border: 2px solid black;
        }
        a {
            display: block;
            margin-top: 40px;
            font-family: Arial, sans-serif;;
            text-align: center;
        }
        <?php 
            foreach ($characters_percentages as $character => $percentage) {
                echo '.' . $character . ' {';
                echo 'background-color: ' . $character_colors[$character] . ';';
                // If the percentage is 0, set the width to 1% to prevent empty divs
                $width = max($percentage, 1);
                echo 'width: ' . $width . '%;';
                echo '}';
            }
        ?>

        
    </style>
</head>
<body>
    <h1>Marvel Quiz Results</h1>
    <?php
        // Display aggregate results
        echo "<p class='submission'>In total there have been $submission_num quiz submissions.</p>";
        foreach ($characters_percentages as $character => $percentage) {
            echo "<div class='container'>";
            echo "<p>". ucwords(str_replace('_', ' ', $character)) . ": $percentage%</p>";
            echo "<div class='$character'></div>";
            echo "</div>";
        }
    ?>
    <a href="index.php">Back to Quiz</a>
</body>
</html>

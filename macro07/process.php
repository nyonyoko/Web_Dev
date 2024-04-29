<?php

    // Extract variables from POST
    $personality = $_POST['personality'];
    $villain = $_POST['villain'];
    $government = $_POST['government'];
    $group = $_POST['group'];
    $power = $_POST['power'];

    // Validate the data (make sure all the questions are answered)
    if ($personality == 'unknown' || $villain == 'unknown' || $government == 'unknown' || $group == 'unknown' || $power == 'unknown') {
        // If any variable is 'unknown', 
        // display an error message and redirect back to the form
        header("Location: index.php?error=missing_fields");
        exit;
    }

    // Initialize scores for each character
    $characters_scores = [
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

    // Diagnose the character
    switch ($personality) {
        case 'calm':
            $characters_scores['groot'] += 1;
            break;
        case 'energetic':
            $characters_scores['spiderman'] += 1;
            break;
        case 'serious':
            $characters_scores['black_panther'] += 1;
            break;
        case 'funny':
            $characters_scores['starlord'] += 1;
            break;
    }

    switch ($villain) {
        case 'kill':
            $characters_scores['ironman'] += 1;
            $characters_scores['thor'] += 1;
            $characters_scores['black_widow'] += 1;
            $characters_scores['starlord'] += 1;
            $characters_scores['rocket'] += 1;
            break;
        case 'imprison':
            $characters_scores['doctor_strange'] += 1;
            $characters_scores['spiderman'] += 1;
            $characters_scores['wanda'] += 1;
            break;
        case 'nothing':
            $characters_scores['groot'] += 1;
            break;
    }

    switch ($government) {
        case 'yes':
            $characters_scores['ironman'] += 1;
            break;
        case 'no':
            $characters_scores['captain_america'] += 1;
            $characters_scores['wanda'] += 0.5;
            break;
    }

    switch ($group) {
        case 'avengers':
            $characters_scores['ironman'] += 1;
            $characters_scores['thor'] += 1;
            $characters_scores['black_widow'] += 1;
            $characters_scores['captain_america'] += 1;
            $characters_scores['hulk'] += 1;
            $characters_scores['spiderman'] += 1;
            $characters_scores['doctor_strange'] += 1;
            $characters_scores['wanda'] += 1;
            $characters_scores['black_panther'] += 1;
            break;
        case 'guardians':
            $characters_scores['starlord'] += 1;
            $characters_scores['rocket'] += 1;
            $characters_scores['groot'] += 1;
            break;
    }

    switch ($power) {
        case 'intelligence':
            $characters_scores['ironman'] += 1;
            $characters_scores['black_panther'] += 1;
            $characters_scores['starlord'] += 1;
            $characters_scores['rocket'] += 1;
            break;
        case 'physical':
            $characters_scores['black_widow'] += 1;
            $characters_scores['captain_america'] += 1;
            $characters_scores['hulk'] += 1;
            break;
        case 'magic':
            $characters_scores['wanda'] += 1;
            $characters_scores['doctor_strange'] += 1;
            $characters_scores['thor'] += 1;
            $characters_scores['groot'] += 1;
            break;
    }

    // Find the character(s) with the highest score
    $max_score = max($characters_scores);
    $characters_with_max_score = array_keys($characters_scores, $max_score);

    // If there's only one character with the highest score, choose it
    if (count($characters_with_max_score) == 1) {
        $character = $characters_with_max_score[0];
    } else {
        // If there are multiple characters with the same highest score, 
        // shuffle and choose one randomly
        shuffle($characters_with_max_score);
        $character = $characters_with_max_score[0];
    }

    // Store the data in a file
    $filename = getcwd() . '/data/results.txt';
    $data = $character . "\n";
    file_put_contents($filename, $data, FILE_APPEND);

    // Drop a cookie on their computer keeping track of the character
    setcookie('character', $character);

    // Send them to their result page
    header("Location: result.php");
?>
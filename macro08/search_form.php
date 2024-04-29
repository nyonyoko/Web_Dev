<!doctype html>
<html>
  <head>
    <title>Movies Database</title>
    <style>
      .buttons {
        display: flex;
        justify-content: space-between;
        width: 300px;
        margin-bottom: 20px;
      }
      .buttons button {
        border: 1px solid black;
        margin-right: 10px;
      }
      .buttons button:last-child {
        margin-right: 0;
      }
      .active {
        background-color: gray;
      }
    </style>
  </head>

  <body>
    <h1>My Movie Database</h1>
    <div class="buttons">
      <button onclick="window.location.href='index.php'" <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') {echo 'class="active"';} ?>>View All</button>
      <button onclick="window.location.href='add_form.php'" <?php if (basename($_SERVER['PHP_SELF']) == 'add_form.php') {echo 'class="active"';} ?>>Add Movie</button>
      <button onclick="window.location.href='search_form.php'" <?php if (basename($_SERVER['PHP_SELF']) == 'search_form.php') {echo 'class="active"';} ?>>Search Movies</button>
    </div>
    
    <form method="POST" action="search_form.php">
      <p>Title:
      <input type="text" name="title"></p>
      <p>Year:
      <input type="number" name="year"></p>
      <p>Genre:
      <input type="text" name="genre"></p>
      <input type="submit" value="Search">
    </form>


    <ul>
        <?php
            // Check if form was submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Get form data
                $title = $_POST['title'];
                $year = $_POST['year'];
                $genre = $_POST['genre'];

                // Connect to database
                include('config.php');
                $db = new SQLite3($path.'/movies.db');

                // Prepare search query
                $sql = "SELECT id, title, year, genre FROM items WHERE title LIKE :title AND year LIKE :year AND genre LIKE :genre";
                $statement = $db->prepare($sql);

                // Bind parameters
                $statement->bindValue(':title', "%$title%");
                $statement->bindValue(':year', "%$year%");
                $statement->bindValue(':genre', "%$genre%");

                // Execute query and get results
                $result = $statement->execute();
                
                // Initialize counter and results array
                $counter = 0;
                $results = [];

                // Display results
                while ($row = $result->fetchArray()) {
                    $counter++;
                    $id = $row[0];
                    $title = stripslashes($row[1]);
                    $year = stripslashes($row[2]);
                    $genre = stripslashes($row[3]);
                    $results[] = "<li>$title | $year | $genre</li>";
                }

                // Print number of results found or "Nothing found"
                if ($counter > 1) {
                    print "<h3>$counter movies found.</h3>";
                } elseif ($counter == 1) {
                    print "<h3>$counter movie found.</h3>";
                } else {
                    print "<h3>No movies found.</h3>";
                }

                // Print results
                print "<h3>Title | Year | Genre | Options</h3>";
                foreach ($results as $result) {
                    print $result;
                }

                // Close database
                $db->close();
                unset($db);
            }
        ?>
   </ul>


  </body>
</html>

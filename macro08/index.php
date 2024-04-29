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
    
    <?php
      if (isset($_GET['status'])) {
        if ($_GET['status'] == 'deleted') {
          print "<p>Movie was deleted successfully!</p>";
        }
        if ($_GET['status'] == 'missinginfo') {
          print "<p>Missing info, try again!</p>";
        }
      }
     ?>



    <h3>Title | Year | Genre | Options</h3>
    <ul>
    <?php

      // at this point in the page we should display all previously
      // created movie items

      // identify the full path to where our database is stored
      include('config.php');

      // connect to our database, making sure to use the full
      // file path when specifying the database file location
      $db = new SQLite3($path.'/movies.db');

      // prepare a query to obtain the data from the database
      $sql = 'SELECT id, title, year, genre FROM items';

      // prepare a SQL statement object
      $statement = $db->prepare($sql);

      // run the query
      $result = $statement->execute();

      // iterate over the results
      while ($row = $result->fetchArray()) {
        // extract the relevant info from the query into some variables
        $id = $row[0];
        $title = stripslashes($row[1]);
        $year = stripslashes($row[2]);
        $genre = stripslashes($row[3]);

        // build a link that lets the user delete an item
        $link_delete = "<a href=\"delete.php?id=$id\">Delete</a>";

        // generate output
        print "<li>$title | $year | $genre | $link_delete</li>";
      }

      // close the database
      // this allows Apache to use it again quickly, rather than waiting for
      // the database's natural timeout to occur
      $db->close();
      unset($db);
     ?>
   </ul>


  </body>
</html>

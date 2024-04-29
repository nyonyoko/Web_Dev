<?php

  // get incoming data
  $title = $_POST['title'];
  $year = $_POST['year'];
  $genre = $_POST['genre'];

  // make sure we have our data -- if not, fail out here
  if (strlen($title) == 0 || strlen($year) == 0 || strlen($genre) == 0) {
    header("Location: index.php?status=missinginfo");
    exit();
  }

  // identify the full file path of where our
  // databases are stored on the server
  include('config.php');

  // connect to our database, making sure to use the full
  // file path when specifying the database file location
  $db = new SQLite3($path.'/movies.db');

  // prepare a SQL query to store our record (just a string)
  $sql = "INSERT INTO items (title, year, genre) VALUES (:title, :year, :genre)";
  $statement = $db->prepare($sql);
  $statement->bindValue(':title', $title);
  $statement->bindValue(':year', $year);
  $statement->bindValue(':genre', $genre);

  // run our query
  $result = $statement->execute();


  // close the database
  // this allows Apache to use it again quickly, rather than waiting for
  // the database's natural timeout to occur
  $db->close();
  unset($db);

  // send the browser back to the form with a confirmation message
  header('Location: add_form.php?status=added');
  exit();
 ?>

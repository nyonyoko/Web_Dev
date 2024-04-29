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
        if ($_GET['status'] == 'added') {
          print "<p>Movie was added successfully!</p>";
        }
        if ($_GET['status'] == 'missinginfo') {
          print "<p>Missing info, try again!</p>";
        }
      }
     ?>

    <form method="POST" action="save.php">
      <p>Title:
      <input type="text" name="title"></p>
      <p>Year:
      <input type="number" name="year"></p>
      <p>Genre:
      <input type="text" name="genre"></p>
      <input type="submit" value="Save">
    </form>

  </body>
</html>

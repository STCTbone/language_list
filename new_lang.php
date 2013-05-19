<?php
  $name = $_POST['name'];

  if (!$name) {
    echo "<h1>Please enter a name and try again!</h1><br>
          <a href=\"index.php\">Home</a>";
    exit;
  }

  @ $db = new mysqli('localhost', 'lang', 'lang123', 'languages');

  if(mysqli_connect_errno()) {
      echo "<p><strong>Error</strong>: Could not connect to database. Please try again later.</p>
      <a href=\"index.php\">Home</a>";
      exit;
  }

  if (!get_magic_quotes_gpc()) {
    $name = $db->real_escape_string($name);
  }

  $query = "insert into languages (name) values ('".$name."')";
  $result = $db->query($query);

  if ($result) {
    header("Location: http://localhost/languages_list/index.php");
    exit;
  } else {
    echo "<h2>An error has occurred. The item was not added.</h2>
          <p><a href=\"index.php\">Home</a></p>";
  }
?>
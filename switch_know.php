<?php

  $id = $_GET['id'];

  @ $db = new mysqli('localhost', 'lang', 'lang123', 'languages');

    if(mysqli_connect_errno()) {
      echo "<p><strong>Error</strong>: Could not connect to database. Please try again later.</p>";
      exit;
    }

    $select_query = "select * from languages where id = ".$id;

    $result = $db->query($select_query)->fetch_assoc();

    if ($result['known'] == 0) {
      $update_query_known = 1;
    } else {
      $update_query_known = 0;
    }

    $update_query = "update languages set known =".$update_query_known." where id = ".$id;

    $result = $db->query($update_query);

    if ($result) {
      header("Location: http://localhost/languages_list/index.php");
      exit;
    } else {
      echo "<h2>An error has occurred. The item was not updated.</h2>
          <p><a href=\"index.php\">Home</a></p>";
    }


 ?>
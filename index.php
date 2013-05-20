<html>
<head>
  <title>My Web Languages</title>
  <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
  <h1>My Programming Languages</h1>
  <div class="lang_table float">
    <table>
      <tr>
        <th>Languages I Know</th>
        <th>Languages I Want to Know</th>
      </tr>
        <?php
          @ $db = new mysqli('localhost', 'lang', 'lang123', 'languages');

          if(mysqli_connect_errno()) {
            echo "<p><strong>Error</strong>: Could not connect to database. Please try again later.</p>";
            exit;
          }

          $query_known = "select * from languages where known = 1";
          $query_unknown = "select * from languages where known = 0";

          $result_known = $db->query($query_known);
          $result_unknown = $db->query($query_unknown);

          $num_rows = max($result_known->num_rows, $result_unknown->num_rows);

          for ($i=0; $i < $num_rows; $i++) { 
            $row_known = $result_known->fetch_assoc();
            $row_unknown = $result_unknown->fetch_assoc();
            echo "<tr><td>".$row_known['name'];
            if ($row_known) {
              echo " <a href=\"switch_know.php?id=".$row_known['id']."\">>></a>";
            }

            echo "</td><td>".$row_unknown['name'];
            if ($row_unknown) {
              echo " <a href=\"switch_know.php?id=".$row_unknown['id']."\"><<</a>";
            }
            echo "</td></tr>";
          }
        ?>
    </table>
  </div>
  <div class="lang_form float">
    <form name="new_lang" method="post" action="new_lang.php">
      <input type="text" name="name" value=""><br>
      <input type="submit" value="Submit New Language">
    </form>
  </div>
</body>
</html>
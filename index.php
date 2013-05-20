<?php require 'header.php';?>
  <div class="lang_table container-fluid">
    <div class="row-fluid">
      <div class="span6 offset3">
        <div class="hero-unit">
          <h1>My Programming Languages</h1>
        </div>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span4 offset2">
        <table class="table table-bordered">
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
                echo " <a href=\"switch_know.php?id=".$row_known['id']."\"><i class=\"icon-chevron-right\"></i></a>";
              }

              echo "</td><td>".$row_unknown['name'];
              if ($row_unknown) {
                echo " <a href=\"switch_know.php?id=".$row_unknown['id']."\"><i class=\"icon-chevron-left\"></i></a>";
              }
              echo "</td></tr>";
            }
          ?>
        </table>
      </div>
      <div class="lang_form span4 offset1">
        <form name="new_lang" method="post" action="new_lang.php">
          <input type="text" name="name" value=""><br>
          <input type="submit" value="Submit New Language">
        </form>
      </div>
    </div>
  </div>
<?php require 'footer.php';?>

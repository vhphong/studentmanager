<?php
  require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Open folder</title>
  </head>
  <body>
    <h4>openfolder.php</h4>
    <a href="view.php">Back to View Students Data</a>
    <?php
      // echo "openfolder.php is here";
      // if the "View in folder" button was pressed
      if (isset($_GET['openFolderID']))
      {
        $studentFolder = $_GET['openFolderID'];
        // Opening a directory
        // if (isset($_GET['openFolderID'])) {
        $path = "C:\\xampp\htdocs\PHP_Practice\studentmanager" . "\\" . $studentFolder;
        if (!is_dir($path)) {
          echo '<script>alert("Folder of student is not found.")</script>';
        }
        else {
          // $path = "C:\\xampp\htdocs\PHP_Practice\studentmanager" . "\\" . $studentFolder;
          exec("EXPLORER /E, $path");
        }
          // exec("EXPLORER /E, $path");
        // }
      }
    ?>
  </body>
</html>

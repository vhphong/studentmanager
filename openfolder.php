<?php
  require_once("connection.php");

  // retrieve Student ID whose information to be edited
  $stdID = $_GET['openFolderID'];
  $queryOpenFolder = "SELECT * FROM studentinfo WHERE sid = '".$stdID."' ";
  $resultOpenFolder = mysqli_query($dbconnection, $queryOpenFolder);

  while ($row=mysqli_fetch_assoc($resultOpenFolder)) {
    $stdID = $row['sid'];
    $stdFName = $row['firstname'];
    $stdLName = $row['lastname'];
    $stdSSN = $row['ssn'];
    $stdDOB = $row['dob'];
    $stdGender = $row['gender'];
    $stdRace = $row['race'];
    $stdAvatar = $row['photo'];
  }
 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Student's folder</title>
  </head>
  <body>
    <h4>openfolder.php</h4>
    <a href="view.php">Back to View Students Data</a>
    <?php
      // if the "View in folder" button was pressed
      if (isset($_GET['openFolderID']))
      {
        // Opening a directory
        // absolute path
        // $path = "C:/xampp/htdocs/PHP_Projects/studentmanager/" . $studentFolder;
        // relative path
        $studentFolder = $stdLName . '_' . $stdFName;

        if (!is_dir($studentFolder)) {
          echo '<script>alert("Folder of student is not found.")</script>';
        }
        else {
          exec("EXPLORER /E, $studentFolder");
        }
      }
    ?>
  </body>
</html>

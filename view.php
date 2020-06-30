<?php
  require_once("connection.php");
  $queryView = "SELECT sid, firstname, lastname, dob, gender, race, photo
                FROM studentinfo";
  $resultView = mysqli_query($dbconnection, $queryView);
  // echo "view.php is here.";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Student Manager Records</title>
  </head>
  <body>
    <h3>Student Manager Records</h3>
    <table>
      <tr>
        <td>Student ID</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Date of birth</td>
        <td>Gender</td>
        <td>Race</td>
        <td>Avatar</td>
      </tr>

      <?php
        while ($row=mysqli_fetch_assoc($resultView)) {
          $stdID = $row['sid'];
          $stdFName = $row['firstname'];
          $stdLName = $row['lastname'];
          $stdDOB = $row['dob'];
          $stdGender = $row['gender'];
          $stdRace = $row['race'];
          $stdAvatar = $row['photo'];
          ?>
          <tr>
            <td><?php echo $stdID ?></td>
            <td><?php echo $stdFName ?></td>
            <td><?php echo $stdLName ?></td>
            <td><?php echo $stdDOB ?></td>
            <td><?php echo $stdGender ?></td>
            <td><?php echo $stdRace ?></td>
            <td><?php echo $stdAvatar ?></td>
          </tr>
          <?php
          }
          ?>
    </table>
  </body>
</html>

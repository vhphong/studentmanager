<?php
  require_once("connection.php");
  $queryView = "SELECT sid, firstname, lastname, ssn, dob, gender, race, photo, submission
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
    <center>
      <h3>Student Manager Records</h3>
      <h4>view.php</h4>
    </center>
    <hr width=100%>
    <a href="index.php">Back to Data Entry Form</a>
    <br><br>0
    <table>
      <tr>
        <td>Student ID</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>SSN</td>
        <td>Date of birth</td>
        <td>Gender</td>
        <td>Race</td>
        <td>Avatar</td>
        <td>Submissions</td>
      </tr>

      <?php
        while ($row=mysqli_fetch_assoc($resultView)) {
          $stdID = $row['sid'];
          $stdFName = $row['firstname'];
          $stdLName = $row['lastname'];
          $stdSSN = $row['ssn'];
          $stdDOB = $row['dob'];
          $stdGender = $row['gender'];
          $stdRace = $row['race'];
          $stdAvatar = $row['photo'];
          $stdSubmissions = $row['submission'];
      ?>
        <tr>
          <td><?php echo $stdID ?></td>
          <td><?php echo $stdFName ?></td>
          <td><?php echo $stdLName ?></td>
          <td><?php echo $stdSSN ?></td>
          <td><?php echo $stdDOB ?></td>
          <td><?php echo $stdGender ?></td>
          <td><?php echo $stdRace ?></td>
          <td><?php echo $stdAvatar ?></td>
          <td><?php echo $stdSubmissions ?></td>
          <td><a href="edit.php?editID=<?php echo $stdID ?>">Edit</a></td>
          <td><a href="delete.php?deleteID=<?php echo $stdID ?>">Delete</a></td>
        </tr>
        <?php
      } // end of while
        ?>
    </table>
  </body>
</html>

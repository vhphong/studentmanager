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
    <style>
      #students table, th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #4CAF50;
        color: purple;
        border: 1px solid Black;
        border-collapse: collapse;
      }
      table, th, td {
        border: 1px solid Black;
        border-collapse: collapse;
      }
      tr {
        text-align: center;
      }
    </style>
    <meta charset="utf-8">
    <title>Student Manager Records</title>
  </head>
  <body>
    <center>
      <h3>Student Manager Records</h3>
      <h4>view.php</h4>
    </center>
    <hr width=100%>
    <a href="index.php">Back to Main Data Entry Form index.php</a>
    <br>
    <a href="indexoriginal.php">Back to Main Data Entry Form indexoriginal.php</a>
    <br><br>
    <table id="students">
      <tr>
        <th>Student ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>SSN</th>
        <th>Date of birth</th>
        <th>Gender</th>
        <th>Race</th>
        <th>Avatar</th>
        <th>Submissions</th>
        <th></th>
        <th></th>
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

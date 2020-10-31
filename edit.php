<?php
  // echo "edit.php is here.";
  require_once("connection.php");

  // retrieve Student ID whose information to be edited
  $stdID = $_GET['editID'];
  $queryEdit = "SELECT * FROM studentinfo WHERE sid = '".$stdID."' ";
  $resultEdit = mysqli_query($dbconnection, $queryEdit);

  while ($row=mysqli_fetch_assoc($resultEdit)) {
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
    <title>Edit Student 's Information</title>
  </head>
  <body>
    <center>
      <h3>Edit Student 's Information</h3>
      <h3>edit.php</h3>
      <hr width=100%>
    </center>
    <a href="index.php">Back to Main Data Entry Form</a>
    <br>
    <a href="view.php">Back to View Students Data</a>
    <br><br>
    <form class="" action="update.php?ID=<?php echo $stdID ?>" method="post">
      <table>
        <tr>
          <td>Student ID: </td>
          <!-- student ID is unchangeable -->
          <td><input type="text" name="stdid" value="<?php echo $stdID ?>" disabled="disabled"></td>
        </tr>
        <tr>
          <td>First Name: </td>
          <td><input type="text" name="fname" value="<?php echo $stdFName ?>"></td>
        </tr>
        <tr>
          <td>Last Name: </td>
          <td><input type="text" name="lname" value="<?php echo $stdLName ?>"></td>
        </tr>
        <tr>
          <td>SSN: </td>
          <td><input type="text" name="ss" value="<?php echo $stdSSN ?>"></td>
        </tr>
        <tr>
          <td>Date of Birth: </td>
          <td><input type="text" name="birthday" value="<?php echo $stdDOB ?>"></td>
        </tr>
          <td>Gender: </td>
          <td>
            <select class="" name="stdgender">
              <option value="<?php echo $stdGender ?>"><?php echo $stdGender ?></option>
              <option value="">-- Make a selection --</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Other">Other</option>
            </select>
          </td>
        <tr>
          <td>Race: </td>
          <td>
            <select class="" name="stdrace">
              <option value="<?php echo $stdRace ?>"><?php echo $stdRace ?></option>
              <option value="">-- Make a selection --</option>
              <option value="Hispanic or Latino">Hispanic or Latino</option>
              <option value="American Indian or Alaska Native (not Hispanic or Latino)">American Indian or Alaska Native (not Hispanic or Latino)</option>
              <option value="Asian (not Hispanic or Latino)">Asian (not Hispanic or Latino)</option>
              <option value="Black or African American (not Hispanic or Latino)">Black or African American (not Hispanic or Latino)</option>
              <option value="Native Hawaiian or Other Pacific Islander (not Hispanic or Latino)">Native Hawaiian or Other Pacific Islander (not Hispanic or Latino)</option>
              <option value="Two or More Races (not Hispanic or Latino)">Two or More Races (not Hispanic or Latino)</option>
              <option value="White (not Hispanic or Latino)">White (not Hispanic or Latino)</option>
              <option value="Opt Out">Opt Out</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Avatar: </td>
          <td><input type="file" name="avatar" value="<?php echo $stdAvatar ?>"></td>
        </tr>
        <tr>
          <td>Submissions: </td>
          <td><input type="file" name="stdsubmission" value="<?php echo $stdSubmissions ?>"></td>
        </tr>
      </table>
      <br>
      <tr>
        <td>
          <!-- <button type="button" name="update">UPDATE</button> -->
          <button name="update">UPDATE</button>
        </td>
      </tr>
    </form>
  </body>
</html>

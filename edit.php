<?php
  // echo "edit.php is here";
  require_once("connection.php");

  // retrieve Student ID has the information to be edited
  $stdID = $_GET['editID'];
  $queryEdit = "SELECT * FROM studentinfo WHERE sid = '".$stdID."' ";
  $resultEdit = mysqli_query($dbconnection, $queryEdit);

  while ($row=mysqli_fetch_assoc($resultEdit)) {
    $stdID = $row['sid'];
    $stdFName = $row['firstname'];
    $stdLName = $row['lastname'];
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
    <title>Edit Student Record</title>
  </head>
  <body>
    <h3>Edit Student Record</h3>
    <a href="index.php">Back to Entry Formmmm</a>
    <form class="" action="update.php?ID=<?php echo $stdID ?>" method="post">
      <table>
        <tr>
          <td>First Name: </td>
          <td><input type="text" name="fname" value=""></td>
        </tr>
        <tr>
          <td>Last Name: </td>
          <td><input type="text" name="lname" value=""></td>
        </tr>
        <tr>
          <td>SSN: </td>
          <td><input type="text" name="ss" value=""></td>
        </tr>
        <tr>
          <td>Date of Birth: </td>
          <td><input type="text" name="birthday" value=""></td>
        </tr>
        <tr>
          <td>Gender: </td>
          <td><input type="radio" name="stdgender" value="m">Male
              <input type="radio" name="stdgender" value="f">Female
              <input type="radio" name="stdgender" value="o">Other</td>
        </tr>
        <tr>
          <td>Race: </td>
          <td>
            <select class="" name="stdrace">
              <option value=""></option>
              <option value="hispanic">Hispanic or Latino</option>
              <option value="asian">Asian (not Hispanic or Latino)</option>
              <option value="native">American Indian or Alaska Native</option>
              <option value="african">Black or African American</option>
              <option value="white">White</option>
              <option value="other">Other</option>
            </select>
          </td>
          <tr>
            <td>Avatar: </td>
            <td><input type="file" name="avatar" value=""></td>
          </tr>
        </tr>
        <tr>
          <td><button type="button" name="update">UPDATE</button></td>
        </tr>

      </table>


    </form>

  </body>
</html>

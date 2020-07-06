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
    <title>Edit Student Record</title>
  </head>
  <body>
    <h3>Edit Student Record</h3>
    <a href="index.php">Back to Data Entry Form</a>
    <br><br>
    <form class="" action="update.php?ID=<?php echo $stdID ?>" method="post">
      <table>
        <tr>
          <td>Student ID: </td>
          <td><input type="text" name="stdid" disabled="disabled"></td>
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
        <!-- <tr> -->
          <!-- <td>Gender: </td> -->
          <!-- <td><input type="radio" name="stdgender" value="m">Male
              <input type="radio" name="stdgender" value="f">Female
              <input type="radio" name="stdgender" value="o">Other
          </td> -->

        <!-- </tr> -->
          <td>Gender: </td>
          <td>
            <select class="" name="stdgender">
              <option value="<?php echo $stdGender ?>"><?php echo $stdGender ?></option>
              <option value="m">Male</option>
              <option value="f">Female</option>
              <option value="o">Other</option>
            </select>
          </td>
        <tr>
          <td>Race: </td>
          <td>
            <select class="" name="stdrace">
              <option value=""><?php echo $stdRace ?></option>
              <option value="native">Decline to self-indentify</option>
              <option value="hispanic">Hispanic or Latino</option>
              <option value="asian">Asian (Not Hispanic or Latino)</option>
              <option value="african">Black or African American (Not Hispanic or Latino)</option>
              <option value="white">White (Not Hispanic or Latino)</option>
              <option value="other">Other</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Avatar: </td>
          <td><input type="file" name="avatar" value="<?php echo $stdAvatar ?>"></td>
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

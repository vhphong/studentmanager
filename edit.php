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

  $fNameErr = $lNameErr = $dobErr = $genderErr = $raceErr = "";
  $stdID = $stdFName = $stdLName = $stdSSN = $stdDOB = $stdGender = $stdRace = $stdAvatar = $stdSubmissions = "";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit Student 's Information</title>
    <style>
      .error {color: #FF0000;}
    </style>
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
    <p><span class="error">* required field</span></p>
    <form action="" method="post" enctype="multipart/form-data">
      <fieldset>
        <legend>Personal Information</legend>
        <table>
          <tr>
            <td>SID</td>
            <!-- <td><input type="text" name="stdid" readonly="readonly"</td> -->
            <td><input type="text" name="stdid" disabled="disabled"</td>
            <!-- <td><input type="text" name="stdid"</td> -->
          </tr>
          <tr>
            <td>First Name</td>
            <td><input type="text" name="fname" value="<?php echo $stdFName ?>">
                <span class="error">* <?php echo $fNameErr;?></span></td>
            </tr>
            <tr>
              <td>Last Name</td>
              <td><input type="text" name="lname" value="<?php echo $stdLName ?>">
                  <span class="error">* <?php echo $lNameErr;?></span></td>
              </tr>
              <tr>
                <td>SSN (Optional)</td>
                <td><input type="text" name="ss" value="<?php echo $stdSSN ?>" placeholder="xxx-xx-xxxx" pattern="\d{3}-?\d{2}-?\d{4}"></td>
              </tr>
              <tr>
                <td>Date of birth</td>
                <td><input type="date" name="birthday" value="<?php echo $stdDOB ?>"><span class="error">* <?php echo $dobErr;?></span></td>
              </tr>
              <tr>
                <td>Gender</td>
                <td><input type="radio" name="stdgender" <?php if (isset($stdGender) && $stdGender=="Female") echo "checked";?> value="Female">Female
                    <input type="radio" name="stdgender" <?php if (isset($stdGender) && $stdGender=="Male") echo "checked";?> value="Male">Male
                    <input type="radio" name="stdgender" <?php if (isset($stdGender) && $stdGender=="Other") echo "checked";?> value="Other">Other
                    <span class="error">* <?php echo $genderErr;?></span>
                </tr>
                <tr>
                  <td>Race</td>
                  <!-- <td><input type="text" name="race"</td> -->
                  <td>
                    <select class="" name="stdrace">
                      <option value="">-- Make a selection --</option>
                      <option <?php echo ($stdRace === "Hispanic or Latino")? "selected" : ""; ?> >Hispanic or Latino</option>
                      <option <?php echo ($stdRace === "American Indian or Alaska Native (not Hispanic or Latino)")? "selected" : ""; ?> >American Indian or Alaska Native (not Hispanic or Latino)</option>
                      <option <?php echo ($stdRace === "Asian (not Hispanic or Latino)")? "selected" : ""; ?> >Asian (not Hispanic or Latino)</option>
                      <option <?php echo ($stdRace === "Black or African American (not Hispanic or Latino)")? "selected" : ""; ?> >Black or African American (not Hispanic or Latino)</option>
                      <option <?php echo ($stdRace === "Native Hawaiian or Other Pacific Islander (not Hispanic or Latino)")? "selected" : ""; ?> >Native Hawaiian or Other Pacific Islander (not Hispanic or Latino)</option>
                      <option <?php echo ($stdRace === "Two or More Races (not Hispanic or Latino)")? "selected" : ""; ?> >Two or More Races (not Hispanic or Latino)</option>
                      <option <?php echo ($stdRace === "White (not Hispanic or Latino)")? "selected" : ""; ?> >White (not Hispanic or Latino)</option>
                      <option <?php echo ($stdRace === "Opt Out")? "selected" : ""; ?> >Opt Out</option>
                    </select><span class="error">* <?php echo $raceErr;?></span>
                  </td>
                </tr>
                <tr>
                  <td>Avatar</td>
                  <td><input type="file" name="stdavatar" value="<?php echo $stdAvatar ?>"</td>
                </tr>
                <tr>
                  <td>Submissions</td>
                  <td><input type="file" name="stdsubmission" value="<?php echo $stdSubmissions ?>" multiple></td>
                </tr>
                <tr>
                  <!-- <button type="" name="savedata">SAVE DATA</button> -->
                    <td><input type="submit" name="savedata" value="SAVE DATA"></td>
                    <td><input type="submit" name="display" value="VIEW RECORDS"></td>
                    <td><input type="submit" name="clear" value="CLEAR FORM"></td>
                </tr>
              </table>
      </fieldset>
    </form>
  </body>
</html>

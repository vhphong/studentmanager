<!DOCTYPE HTML>
<html>
<head>
<style>
  .error {color: #FF0000;}
</style>
</head>
<body>

<?php
  // connect to the database
  $dbconnection = mysqli_connect("localhost", "root", "", "dbstudentmanager");

  // define variables and set to empty values
  $dataErr = $fNameErr = $lNameErr = $dobErr = $genderErr = $raceErr = "";
  $stdID = $stdFName = $stdLName = $stdSSN = $stdDOB = $stdGender = $stdRace = $stdAvatar = $stdSubmissions = "";

  // if "INSERT" button was pressed
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // if any field is empty
    if (empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['birthday']) || empty($_POST['stdgender']) || empty($_POST['stdrace'])){
      // validate First Name
      if (empty($_POST["fname"])) {
        $fNameErr = "First Name is required";
      }
      else {
        $stdFName = ($_POST["fname"]);
        // check if name only contains letters and whitespace
        // if (!preg_match("/^[a-zA-Z-' ]*$/", $stdFName)) {
        //   $fNameErr = "Only letters and white space allowed";
        // }
      }

      // validate Last Name
      if (empty($_POST["lname"])) {
        $lNameErr = "Last Name is required";
      }
      else {
        $stdLName = ($_POST["lname"]);
        // check if name only contains letters and whitespace
        // if (!preg_match("/^[a-zA-Z-' ]*$/", $stdLName)) {
        //   $lNameErr = "Only letters and white space allowed";
        // }
      }

      // validate DOB
      if (empty($_POST["birthday"])) {
        $dobErr = "DOB is required";
      }
      else {
        $stdDOB = ($_POST["birthday"]);
        // check if name only contains letters and whitespace
        // if (!preg_match("/^[a-zA-Z-' ]*$/", $stdDOB)) {
        //   $dobErr = "Only letters and white space allowed";
        // }
      }

      // validate Gender
      if (empty($_POST["stdgender"])) {
        $genderErr = "Gender is required";
      }
      else {
        $stdGender = ($_POST["stdgender"]);
        // check if name only contains letters and whitespace
        // if (!preg_match("/^[a-zA-Z-' ]*$/", $stdGender)) {
        //   $genderErr = "Only letters and white space allowed";
        // }
      }

      // validate Race
      if (empty($_POST["stdrace"])) {
        $raceErr = "Race is required";
      }
      else {
        $stdRace = ($_POST["stdrace"]);
        // check if name only contains letters and whitespace
        // if (!preg_match("/^[a-zA-Z-' ]*$/", $stdRace)) {
        //   $raceErr = "Only letters and white space allowed";
        // }
      }
    }
    else {    // no all fields are filled
      $stdID = $_POST['stdid'];
      $stdFName = $_POST['fname'];
      $stdLName = $_POST['lname'];
      $stdSSN = $_POST['ss'];
      $stdDOB = $_POST['birthday'];
      $stdGender = $_POST['stdgender'];
      $stdRace = $_POST['stdrace'];
      $stdAvatar = $_POST['stdavatar'];
      $stdSubmissions = $_POST['stdsubmission'];








    }
  } // end if save pressed


  // function test_input($data) {
  //   $data = trim($data);
  //   $data = stripslashes($data);
  //   $data = htmlspecialchars($data);
  //   return $data;
  // }
  // ?>

  <h2>PHP Form Validation Example</h2>
  <p><span class="error">* required field</span></p>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Student ID:
      <input type="text" name="stdid" value="<?php echo $stdID;?>">
      <br><br>
    First Name:
      <input type="text" name="fname" value="<?php echo $stdFName;?>">
      <span class="error">* <?php echo $fNameErr;?></span>
      <br><br>
    Last Name:
      <input type="text" name="lname" value="<?php echo $stdLName;?>">
      <span class="error">* <?php echo $lNameErr;?></span>
      <br><br>
    SSN (Optional):
      <input type="text" name="ss" value="<?php echo $stdSSN;?>" placeholder="xxx-xx-xxxx" pattern="\d{3}-?\d{2}-?\d{4}">
      <br><br>
    DOB:
      <input type="date" name="birthday" value="<?php echo $stdDOB;?>">
      <span class="error">* <?php echo $dobErr;?></span>
      <br><br>
    Gender:
      <input type="radio" name="stdgender" <?php if (isset($stdGender) && $stdGender=="female") echo "checked";?> value="female">Female
      <input type="radio" name="stdgender" <?php if (isset($stdGender) && $stdGender=="male") echo "checked";?> value="male">Male
      <input type="radio" name="stdgender" <?php if (isset($stdGender) && $stdGender=="other") echo "checked";?> value="other">Other
      <span class="error">* <?php echo $genderErr;?></span>
      <br><br>
    Race:
      <select class="" name="stdrace">
        <option value="">-- Make a selection --</option>
        <option value="Hispanic or Latino">Hispanic or Latino</option>
        <option value="American Indian or Alaska Native (not Hispanic or Latino)">American Indian or Alaska Native (not Hispanic or Latino)</option>
        <option value="Asian (not Hispanic or Latino)">Asian (not Hispanic or Latino)</option>
        <option value="Black or African American (not Hispanic or Latino)">Black or African American (not Hispanic or Latino)</option>
        <option value="Native Hawaiian or Other Pacific Islander (not Hispanic or Latino)">Native Hawaiian or Other Pacific Islander (not Hispanic or Latino)</option>
        <option value="Two or More Races (not Hispanic or Latino)">Two or More Races (not Hispanic or Latino)</option>
        <option value="White (not Hispanic or Latino)">White (not Hispanic or Latino)</option>
        <option value="Opt Out">Opt Out</option>
      </select><span class="error">* <?php echo $dataErr;?></span>
        <br><br>
    Avatar:
      <input type="file" name="stdavatar" value="<?php echo $stdAvatar;?>">
      <br><br>
    Submissions:
      <input type="file" name="stdsubmission" value="<?php echo $stdSubmissions;?>" multiple>
      <br><br>


  <input type="submit" name="submit" value="SUBMIT">
  <input type="submit" name="display" value="VIEW RECORDS">
</form>
</body>
</html>

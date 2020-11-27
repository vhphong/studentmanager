<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Student Manager</title>
    <style>
      .error {color: #FF0000;}
    </style>
  </head>
  <body>
    <?php
      // connect to the database
      $dbconnection = mysqli_connect("localhost", "root", "", "dbstudentmanager");

      $fNameErr = $lNameErr = $dobErr = $genderErr = $raceErr = "";
      $stdID = $stdFName = $stdLName = $stdSSN = $stdDOB = $stdGender = $stdRace = $stdAvatar = $stdSubmissions = "";

      function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      // if "INSERT" button was pressed
      if (isset($_POST['savedata'])) {
        // if a required field is empty
        if (empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['birthday']) || empty($_POST['stdgender']) || empty($_POST['stdrace'])) {
          // validate First Name
          if (empty($_POST['fname'])) {
            $fNameErr = "First Name is required.";
          } else {
            $stdFName = test_input($_POST['fname']);
          }

          // validate Last Name
          if (empty($_POST['lname'])) {
            $lNameErr = "Last Name is required.";
          } else {
            $stdLName = test_input($_POST['lname']);
          }

          // validate SSN
          if (empty($_POST['ss'])) {
            $stdSSN = "000-00-0000";
          } else {
            $stdSSN = $_POST['ss'];
          }

          // validate DOB
          if (empty($_POST['birthday'])) {
            $dobErr = "DOB is required.";
          } else {
            $stdDOB = $_POST['birthday'];
          }

          // validate Gender
          if (empty($_POST['stdgender'])) {
            $genderErr = "Gender is required.";
          } else {
            $stdGender = $_POST['stdgender'];
          }

          // validate Race
          if (empty($_POST['stdrace'])) {
            $raceErr = "Race is required.";
          } else {
            $stdRace = $_POST['stdrace'];
          }

        }   // end: if any required field is empty
        else {    // if all required fields are filled
          // if (isset($_POST['stdid'])) {
          //   $stdID = $_POST['stdid'];
          // }

          // if (isset($_POST['ss'])) {
          //   $stdSSN = $_POST['ss'];
          // }

          $stdFName = test_input($_POST['fname']);
          $stdLName = test_input($_POST['lname']);
          $stdSSN = $_POST['ss'];
          $stdDOB = $_POST['birthday'];
          $stdGender = $_POST['stdgender'];
          $stdRace = $_POST['stdrace'];
          if (isset($_POST['stdavatar'])) {
            $stdAvatar = $_POST['stdavatar'];
          } else {
            $stdAvatar = "";
          }

          if (isset($_POST['stdsubmission'])) {
            $stdSubmissions = $_POST['stdsubmission'];
          }
          // $stdAvatar = $_POST['stdavatar'];
          // $stdSubmissions = $_POST['stdsubmission'];


          // path to the folder of each student, patterned: LastName_FirstName
          $studentFolder = $stdLName . '_' . $stdFName;

          ////////////////////////////////////////////////////////////
          // validate avatar
          $errors = [];    // Store errors here
          $avatarOk = $submissionOk = false;    // ~ N/A, invalid

          ////////////////////////////////////////////////////////////
          // validate submission
          // $submissionErr = [];    // Store errors here


          // name of the name of the actual file to be uploaded
          $avatarName = $_FILES['stdavatar']['name'];
          // the physical avatar file on a temporary uploads directory on the server
          $avatarTemp = $_FILES['stdavatar']['tmp_name'];
          // get avatar file base name
          $avatarBaseName = substr($avatarName, 0, strripos($avatarName, '.'));
          // file type of avatar
          $avatarFileType = $_FILES['stdavatar']['type'];
          // extension of the uploaded file
          $avatarExtension = strtolower(pathinfo($avatarName, PATHINFO_EXTENSION));
          // size of the uploaded avatar file
          $avatarSize = $_FILES['stdavatar']['size'];
          // allowed avatar file types
          $avatarExtensionsAllowed = ['jpeg','jpg','png','bmp',''];

          // new avatar file name, patterned: Last_First.jpg/png/bmp
          $newAvatarFileName = $stdLName . '_' . $stdFName . '.' . $avatarExtension;
          $avatarPath = $studentFolder . "/" . $newAvatarFileName;

          // validate avatar's extension
          if (!in_array($avatarExtension, $avatarExtensionsAllowed)) {
            echo '<script>alert("Wrong avatar file type.")</script>';
            $errors = "Wrong avatar file type.";
            $avatarOk = false;
          }

          // check if no avatar is uploaded. That 's fine
          if ($avatarExtension == '') {
            $newAvatarFileName = '';
            $avatarOk = true;
          }

          // else {
          //   $avatarOk = true;
          // }

          // validate avatar's size
          if ($_FILES['stdavatar']['size'] > 5242880) {
            echo '<script>alert("Avatar should 5MB or less.")</script>';
            $errors = "File exceeds maximum size (5MB)";
            $avatarOk = false;
          } else {
            $avatarOk = true;
          }

          $submissionExtensionsBanned = ['exe','msi','bat', 'com'];

          // name of the name of the submission file to be uploaded
          $submissionName = $_FILES['stdsubmission']['name'];
          // the physical submission file on a temporary uploads folder on the server
          $submissionTemp = $_FILES['stdsubmission']['tmp_name'];
          // file type of avatar
          $submissionFileType = $_FILES['stdsubmission']['type'];
          // extension of the uploaded submission file
          $submissionExtension = strtolower(pathinfo($submissionName, PATHINFO_EXTENSION));
          // disallowed submission file types
          // $disallowed_submission_file_types = ['exe','msi','bat'];
          // rename file into Last_First.jpg/png/bmp pattern
          $submissionPath = $studentFolder . "/" . $submissionName;

          ////////////////////////////////////////////////////////////
          // uploads submission
          // $submissionOk = true;
          // if no file was chosen for avatar
          // if (!empty($_FILES['stdsubmission']['name'])) {
          //   // if there is no submission
          // }
          // else {         // if there is submission

          if (in_array($submissionExtension, $submissionExtensionsBanned)) {
            echo '<script>alert("Wrong submission(s) file type.")</script>';
            $errors = "Wrong submission(s) file type.";
            $submissionOk = false;
          } else {
            $errors = "";
            $submissionOk = true;
          }

          if (!empty($errors)) {
            echo '<script>alert("Errors may occur. Save data failed.")</script>';
          }
          if (empty($errors)) {
            $queryInsert = "INSERT INTO studentinfo(sid, firstname, lastname, ssn, dob, gender, race, photo, submission)
                            VALUES ('', '$stdFName', '$stdLName', '$stdSSN', '$stdDOB', '$stdGender', '$stdRace', '$newAvatarFileName', '$submissionName')";
            echo '<script>alert("Save data succeed.")</script>';

            if (mysqli_query($dbconnection, $queryInsert)) {
              header("location:view.php");
            } else {
              echo '<script>alert("Save data failed.")</script>';
            }

            // make a folder for the student to store avatar and submissions
            // create directory if not exists
            if (!is_dir($studentFolder)){
              mkdir($studentFolder, 0777, true);    // 0777: full permission
            } else {
              $studentFolder = $stdLName . '_' . $stdFName . '1' ;
              mkdir($studentFolder, 0777, true);    // 0777: full permission
            }

            // move the avatar to avatarPath
            if (move_uploaded_file($avatarTemp, $avatarPath)) {
              header("location:view.php");
            } else {
              echo '<script>alert("Upload avatar failed.")</script>';
            }

            // move the submission to submissionPath
            if (move_uploaded_file($submissionTemp, $submissionPath)) {
              header("location:view.php");
            } else {
              echo '<script>alert("Upload submissions failed.")</script>';
            }
          } // end: if ($avatarOk===true && $submissionOk===true) / if (empty($errors))
          else {
            foreach ($errors as $err) {
              echo $err . " These are the errors" . "\n";
            }
          }

        }   // end: if all required fields are filled
      }  // end: if (isset($_POST['savedata']))

      // if "VIEW RECORDS" button was pressed
      if (isset($_POST['display'])) {
        header("location:view.php");
      }

      // if "CLEAR FORM" button was pressed
      if (isset($_POST['clear'])) {
        header("location:index.php");
      }
    ?>


    <h2>Student Information Manager</h2>
    <h3>Main Data Entry Form</h3>
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

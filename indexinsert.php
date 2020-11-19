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

      // if "INSERT" button was pressed
      if (isset($_POST['savedata'])) {
        // check for null values
        // if (empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['birthday']) || empty($_POST['stdgender']) || empty($_POST['stdrace'])) {
        //   echo '<script>alert("First Name, Last Name, DOB, Gender and Race required.")</script>';
        //   header("location:index.php");
        // }

        // validate First Name
        if (empty($_POST['fname'])) {
          $fNameErr = "First Name is required";
        }
        else {
          $stdFName = $_POST['fname'];
        }

        if (empty($_POST['lname'])) {
          $lNameErr = "Last Name is required";
        }
        else {
          $stdLName = $_POST['lname'];
        }

        if (empty($_POST['birthday'])) {
          $dobErr = "Date of birth is required";
        }
        else {
          $stdDOB = $_POST['birthday'];
        }

        if (empty($_POST['stdgender'])) {
          $genderErr = "Gender is required";
        }

        if (empty($_POST['stdrace'])) {
          $raceErr = "Race is required";
        }
        else {
          $stdID = $_POST['stdid'];
          // $stdFName = $_POST['fname'];
          // $stdLName = $_POST['lname'];
          $stdSSN = $_POST['ss'];
          // $stdDOB = $_POST['birthday'];
          $stdGender = $_POST['stdgender'];
          $stdRace = $_POST['stdrace'];
          $stdAvatar = $_POST['stdavatar'];
          $stdSubmissions = $_POST['stdsubmission'];

          ////////////////////////////////////////////////////////////
          // uploads an avatar
          // name of the uploaded avatar file
          $avatarName = $_FILES['stdavatar']['name'];
          // the physical avatar file on a temporary uploads directory on the server
          $avatarTemp = $_FILES['stdavatar']['tmp_name'];
          // get avatar file base name
          $avatarBaseName = substr($avatarName, 0, strripos($avatarName, '.'));
          // extension of the uploaded file
          $avatarExtension = pathinfo($avatarName, PATHINFO_EXTENSION);
          // size of the uploaded avatar file
          $avatarSize = $_FILES['stdavatar']['size'];
          // allowed avatar file types
          $allowed_avatar_file_types = ['jpg','png','bmp','raw'];
          // new avatar file name, patterned: Last_First.jpg/png/bmp
          $newAvatarFileName = $stdLName . '_' . $stdFName . '.' . $avatarExtension;

          ////////////////////////////////////////////////////////////
          // uploads a submission
    	    // name of the uploaded submission file
    	    $submissionName = $_FILES['stdsubmission']['name'];
    	    // the physical submission file on a temporary uploads directory on the server
          $submissionTemp = $_FILES['stdsubmission']['tmp_name'];
          // extension of the uploaded submission file
          $submissionExtension = pathinfo($submissionName, PATHINFO_EXTENSION);
    	    // disallowed submission file types
      	  $disallowed_submission_file_types = ['exe','msi','bat'];


          // check for the validation of the file types
          if (!in_array($avatarExtension, $allowed_avatar_file_types) || ($avatarSize > 5000000) || in_array($submissionExtension, $disallowed_submission_file_types)) {
            echo '<script>alert("Wrong avatar/submission(s) file type/size.")</script>';
          }
          else {
            $queryInsert = "INSERT INTO studentinfo(sid, firstname, lastname, ssn, dob, gender, race, photo, submission)
                            VALUES ('', '$stdFName', '$stdLName', '$stdSSN', '$stdDOB', '$stdGender', '$stdRace', '$newAvatarFileName', '$submissionName')";

            // path to the directory of each student. Folder name pattern: LastName_FirstName
            $studentFolder = $stdLName . '_' . $stdFName;

            // rename file into Last_First.jpg/png/bmp pattern
            $avatarPath     = $studentFolder . "/" . $newAvatarFileName;
            $submissionPath = $studentFolder . "/" . $submissionName;

            // make a full permission folder for the student to store avatar and submissions
            // create directory if not exists
            if (!is_dir($studentFolder)){
              mkdir($studentFolder, 0777, true);
            }

            if (mysqli_query($dbconnection, $queryInsert)) {
              header("location:view.php");
            }
            else {
              echo '<script>alert("Save data failed.")</script>';
            }

            // move the avatar to avatarPath
            if (move_uploaded_file($avatarTemp, $avatarPath)) {
              header("location:view.php");
            }
            else {
              header("location:failed.php");
            }

            // move the submission to submissionPath
            if (move_uploaded_file($submissionTemp, $submissionPath)) {
              header("location:view.php");
            }
            else {
              header("location:failed.php");
            }
          }
        }
      }  // end of if (isset($_POST['savedata']))

      // if "VIEW RECORDS" button was pressed
      if (isset($_POST['display'])) {
        header("location:view.php");
      }  // end of elseif (isset($_POST['display']))



    ?>









    <h2>Student Information Manager</h2>
    <h3>Main Data Entry Form</h3>
    <p><span class="error">* required field</span></p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
      <table>
        <tr>
          <td>SID</td>
          <!-- <td><input type="text" name="stdid" readonly="readonly"</td> -->
          <td><input type="text" name="stdid" disabled="disabled"</td>
          <!-- <td><input type="text" name="stdid"</td> -->
        </tr>
        <tr>
          <td>First Name</td>
          <td><input type="text" name="fname" value="<?php echo $stdFName; ?>">
          <span class="error">* <?php echo $fNameErr;?></span></td>
        </tr>
        <tr>
          <td>Last Name</td>
          <td><input type="text" name="lname" value="<?php echo $stdLName; ?>">
          <span class="error">* <?php echo $lNameErr;?></span></td>
        </tr>
        <tr>
          <td>SSN (Optional)</td>
          <td><input type="text" name="ss" placeholder="xxx-xx-xxxx" pattern="\d{3}-?\d{2}-?\d{4}"></td>
        </tr>
        <tr>
          <td>Date of birth</td>
          <td><input type="date" name="birthday" value="<?php echo $stdDOB; ?>"><span class="error">* <?php echo $dobErr;?></span></td>
        </tr>
        <tr>
          <td>Gender</td>
          <td><input type="radio" name="stdgender" value="Male" value="<?php echo $stdGender ?>">Male
              <input type="radio" name="stdgender" value="Female" value="<?php echo $stdGender ?>">Female
              <input type="radio" name="stdgender" value="Other" value="<?php echo $stdGender ?>">Other<span class="error">* <?php echo $genderErr;?></span></td>
        </tr>
        <tr>
          <td>Race</td>
          <!-- <td><input type="text" name="race"</td> -->
          <td>
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
            </select><span class="error">* <?php echo $raceErr;?></span>
          </td>
        </tr>
        <tr>
          <td>Avatar</td>
          <td><input type="file" name="stdavatar"</td>
        </tr>
        <tr>
          <td>Submissions</td>
          <td><input type="file" name="stdsubmission" multiple></td>
        </tr>
        <tr>
          <!-- <button type="" name="savedata">SAVE DATA</button> -->
          <td><input type="submit" name="savedata" value="SAVE DATA"></td>
          <td><input type="submit" name="display" value="VIEW RECORDS"></td>
        </tr>
      </table>
    </form>
  </body>
</html>

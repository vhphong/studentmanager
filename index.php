<?php
  // connect to the database
  // $dbconnection = mysqli_connect("localhost", "root", "", "dbstudentmanager");
  require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Student Manager</title>
    <style media="screen">
      .error {color: #FF0000;}
    </style>
  </head>
  <body>
    <?php
      $fNameError = $lNameError = $dobError = $genderError = $raceError = "";

      if (isset($_POST['savedata'])) {      // if "INSERT" button was pressed
        // check for null values
        // if (empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['birthday']) || empty($_POST['stdgender']) || empty($_POST['stdrace'])) {
        //   echo '<script>alert("Please fill in First Name, Last Name, DOB, Gender and Race.")</script>';
        //   // header("location:index.php");
        // }

        if (empty($_POST['fname'])) {
          $fNameError = "First name is required.";
        }
        else {
          // $stdFName = test_input($_POST['fname']);
          $stdFName = $_POST['fname'];
        }

        if (empty($_POST['lname'])) {
          $lNameError = "Last name is required.";
        }
        else {
          // $stdLName = test_input($_POST['lname']);
          $stdLName = $_POST['lname'];
        }

        if (empty($_POST['birthday'])) {
          $DOBError = "Date of birth is required.";
        }
        else {
          // $stdDOB = test_input($_POST['birthday']);
          $stdDOB = $_POST['birthday'];
        }

        if (empty($_POST['stdgender'])) {
          $genderError = "Gender is required.";
        }
        else {
          // $stdGender = test_input($_POST['stdgender']);
          $stdGender = $_POST['stdgender'];
        }

        if (empty($_POST['stdrace'])) {
          $raceError = "Race is required.";
        }
        else {
          // $stdRace = test_input($_POST['stdrace']);
          $stdRace = $_POST['stdrace'];
        }

        if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['birthday']) && !empty($_POST['stdgender']) && !empty($_POST['stdrace'])) {
          $stdID = $_POST['stdid'];
          // $stdFName = $_POST['fname'];
          // $stdLName = $_POST['lname'];
          $stdSSN = $_POST['ss'];
          // $stdDOB = $_POST['birthday'];
          // $stdGender = $_POST['stdgender'];
          // $stdRace = $_POST['stdrace'];
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

          // destination of the file on the server folder: avatars
          // $avatarFolder  = 'avatars/' . $avatarName;
          // destination of the file on the server folder: submissions
          // $submissionFolder  = 'submissions/' . $submissionName;

          // path to the directory of each student. Folder name pattern: LastName_FirstName
          $studentFolder = $stdLName . '_' . $stdFName;
          // making a full permission directory for each student that stores a student 's avatar and submissions
          // create directory if not exists
          // if (!file_exists($studentFolder)) {
          //   mkdir($studentFolder, 0777, true);
          // }
          if (!is_dir($studentFolder)){
            mkdir($studentFolder, 0777, true);
          }

          // rename file into Last_First.jpg/png/bmp pattern
          $avatarPath     = $studentFolder . "/" . $newAvatarFileName;
          $submissionPath = $studentFolder . "/" . $submissionName;

          // check for the validation of the file types
          if (!in_array($avatarExtension, $allowed_avatar_file_types) || ($avatarSize > 5000000) || in_array($submissionExtension, $disallowed_submission_file_types)) {
            // echo "You file extension must be .jpg, .png or .bmp";
            // header("location:failed.php");
            echo '<script>alert("Please fill in First Name, Last Name, DOB, Gender and Race.")</script>';
          }
          else {
            $queryInsert = "INSERT INTO studentinfo(sid, firstname, lastname, ssn, dob, gender, race, photo, submission)
                            VALUES ('', '$stdFName', '$stdLName', '$stdSSN', '$stdDOB', '$stdGender', '$stdRace', '$newAvatarFileName', '$submissionName')";

            if (mysqli_query($dbconnection, $queryInsert)) {
              header("location:view.php");
            }
            else {
              // header("location:failed.php");
              echo "Insertion data failed.";
            }

            // move the avatar to avatarPath
            if (move_uploaded_file($avatarTemp, $avatarPath)) {
              header("location:view.php");
            }
            else {
              // header("location:failed.php");
              echo "Uploading avatar failed.";
            }

            // move the submission to submissionPath
            if (move_uploaded_file($submissionTemp, $submissionPath)) {
              header("location:view.php");
            }
            else {
              // header("location:failed.php");
              echo "Uploading submission(s) failed.";
            }
          }
        }


      }

      if (isset($_POST['display'])) {   // if "VIEW RECORDS" button was pressed
        header("location:view.php");
      }





    ?>

    <h2>Student Information Manager</h2>
    <h3>Main Data Entry Form</h3>

    <p><span class="error">* required field</span></p>
    <form method="post" enctype="multipart/form-data">
      <table>
        <tr>
          <td>SID</td>
          <!-- <td><input type="text" name="stdid" readonly="readonly"</td> -->
          <td><input type="text" name="stdid" disabled="disabled"</td>
          <!-- <td><input type="text" name="stdid"</td> -->
        </tr>
        <tr>
          <td>First Name</td>
          <td><input type="text" name="fname"</td>
              <span class="error">* <?php echo $fNameError;?></span>
        </tr>
        <tr>
          <td>Last Name</td>
          <td><input type="text" name="lname"</td>
              <span class="error">* <?php echo $lNameError;?></span>
        </tr>
        <tr>
          <td>SSN (Optional)</td>
          <td><input type="text" name="ss" placeholder="xxx-xx-xxxx" pattern="\d{3}-?\d{2}-?\d{4}"></td>
        </tr>
        <tr>
          <td>Date of birth</td>
          <td><input type="date" name="birthday"</td>
              <span class="error">* <?php echo $dobError;?></span>
        </tr>
        <tr>
          <td>Gender</td>
          <td><input type="radio" name="stdgender" value="Male">Male
              <input type="radio" name="stdgender" value="Female">Female
              <input type="radio" name="stdgender" value="Other">Other
              <span class="error">* <?php echo $lNameError;?></span>
          </td>
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
            </select>
            <span class="error">* <?php echo $raceError;?></span>
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
          <td><input type="submit" name="savedata" value="SAVE DATA"></td>
          <td><input type="submit" name="display" value="VIEW RECORDS"></td>
        </tr>
      </table>
    </form>
  </body>
</html>

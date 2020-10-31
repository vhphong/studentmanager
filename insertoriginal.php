<?php
  // connect to the database
  $dbconnection = mysqli_connect("localhost", "root", "", "dbstudentmanager");

  // if "INSERT" button was pressed
  if (isset($_POST['savedata']))
  {
    // check for null values
    if (empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['birthday']) || empty($_POST['stdgender']) || empty($_POST['stdrace'])) {
      // header("location:failed.php");
      echo '<script>alert("Please fill in First Name, Last Name, DOB, Gender and Race.")</script>';
      header("location:index.php");
    }
    else {
      $stdID = $_POST['stdid'];
      $stdFName = $_POST['fname'];
      $stdLName = $_POST['lname'];
      $stdSSN = $_POST['ss'];
      $stdDOB = $_POST['birthday'];
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
        header("location:failed.php");
      }
      else {
        $queryInsert = "INSERT INTO studentinfo(sid, firstname, lastname, ssn, dob, gender, race, photo, submission)
                        VALUES ('', '$stdFName', '$stdLName', '$stdSSN', '$stdDOB', '$stdGender', '$stdRace', '$newAvatarFileName', '$submissionName')";

        if (mysqli_query($dbconnection, $queryInsert)) {
          header("location:view.php");
        }
        else {
          header("location:failed.php");
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
  } // end of if (isset($_POST['savedata']))

  // if "VIEW RECORDS" button was pressed
  elseif (isset($_POST['display'])) {
    header("location:view.php");
  }  // end of elseif (isset($_POST['display']))

  // if no button was pressed
  else {
    header("location:index.php");
  }
?>

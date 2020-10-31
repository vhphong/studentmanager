<?php
  require_once("connection.php");
  if (!$dbconnection){
    die("Connection to database failed");
  }

  // if the UPDATE button was pressed
  if (isset($_POST['update']))
  {
    // echo "update.php is here.";
    $stdID = $_GET['ID'];   // get 'ID' from edit.php
    // assign input text values: fname, lname, ss, ... to variables
    $stdFName = $_POST['fname'];
    $stdLName=$_POST['lname'];
    $stdSSN = $_POST['ss'];
    $stdDOB = $_POST['birthday'];
    $stdGender = $_POST['stdgender'];
    $stdRace = $_POST['stdrace'];
    $stdAvatar = $_POST['avatar'];
    $stdSubmissions = $_POST['stdsubmission'];

    $queryUpdate = "UPDATE studentinfo
                    SET firstname = '".$stdFName."'
                        , lastname = '".$stdLName."'
                        , ssn = '".$stdSSN."'
                        , dob = '".$stdDOB."'
                        , gender = '".$stdGender."'
                        , race = '".$stdRace."'
                        -- , photo = '".$stdAvatar."'
                        , submission = '".$stdSubmissions."'
                    WHERE sid = '".$stdID."' ";

    // test queryUpdate
    // $queryUpdate = "SELECT * FROM studentinfo";

    $resultUpdate = mysqli_query($dbconnection, $queryUpdate);

    if ($resultUpdate)
    {
      // echo "Updated successfully";
      header("location:view.php");
    }
    else {
      echo "Update failed. Please check queryUpdate";
    }
  }
  // if UPDATE button was not pressed
  else {
    header("location:view.php");
  }

?>

  }

?>
lder = $stdLName . '_' . $stdFName;

    if (!is_dir($studentFolder)){
      mkdir($studentFolder, 0777, true);
    }

    // rename file into Last_First.jpg/png/bmp pattern
    $avatarPath     = $studentFolder . "/" . $newAvatarFileName;
    $submissionPath = $studentFolder . "/" . $submissionName;

    if (!in_array($avatarExtension, $allowed_avatar_file_types) || ($avatarSize > 5000000)) {
      // echo "You file extension must be .jpg, .png or .bmp";
      header("location:failed.php");
    }
    else {
      $queryUpdate = "UPDATE studentinfo
                      SET firstname = '".$stdFName."'
                        , lastname = '".$stdLName."'
                        , ssn = '".$stdSSN."'
                        , dob = '".$stdDOB."'
                        , gender = '".$stdGender."'
                        , race = '".$stdRace."'
                        , photo = '".$newAvatarFileName."'
                        , submission = '".$stdSubmissions."'
                      WHERE sid = '".$stdID."' ";
    }

    // test queryUpdate
    // $queryUpdate = "SELECT * FROM studentinfo";

    // $resultUpdate = mysqli_query($dbconnection, $queryUpdate);

    if (mysqli_query($dbconnection, $queryUpdate))
    {
      // echo "Updated successfully";
      header("location:view.php");
    }
    else {
      // echo "Update failed. Please check queryUpdate";
      header("location:view.php");
    }

    if (move_uploaded_file($avatarTemp, $avatarPath)) {
      header("location:view.php");
    }
    else {
      header("location:failed.php");
    }


  }
  // if UPDATE button was not pressed
  else {
    header("location:view.php");
  }

?>

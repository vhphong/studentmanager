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
                    WHERE sid = '".$stdID."' ";
                        // , photo = '".$stdAvatar."'
                        // , submission = '".$stdSubmissions."'

    $didUpdate = mysqli_query($dbconnection, $queryUpdate);

    if ($didUpdate)
    {
      // echo "Updated successfully";
      header("location:view.php");
    }
    else {
      echo "Update failed. Please check queryUpdate";
    }
  }

  // if "VIEW RECORDS" button was pressed
  if (isset($_POST['display'])) {
    header("location:view.php");
  }

?>

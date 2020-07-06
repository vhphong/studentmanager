<?php
  require_once("connection.php");

  // if the Update button was pressed
  if (isset($_POST['update']))
  {
    // echo "update.php is here.";
    $stdID = $_GET['sid'];
    $stdFName = $_POST['fname'];
    $stdLName=$_POST['lname'];
    $stdSSN = $_POST['ss'];
    $stdDOB = $_POST['birthday'];
    $stdGender = $_POST['stdgender'];
    $stdRace = $_POST['stdrace'];
    $stdAvatar = $_POST['avatar'];
    // $stdSubmissions = $_POST['stdsubmission'];

    $queryUpdate = "UPDATE studentinfo
                    SET firstname = '".$stdFName."', lastname = '".$stdLName."', ssn = '".$stdSSN."', dob = '".$stdDOB."', gender = '".$stdGender."', race = '".$stdRace."', photo= '".$stdAvatar."'
                    WHERE stdid = '".$stdID."' ";

    $resultUpdate = mysqli_query($dbconnection, $queryUpdate);

    if ($resultUpdate)
    {
      echo "Updated successfully";
    }
    else {
      echo "Please check queryUpdate";
    }
  }
  else {
    header("location:view.php");
  }

?>

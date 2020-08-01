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
                    SET firstname = '".$stdFName."', lastname = '".$stdLName."', ssn = '".$stdSSN."', dob = '".$stdDOB."', gender = '".$stdGender."', race = '".$stdRace."', photo = '".$stdAvatar."', submission = '".$stdSubmissions."'
                    WHERE sid = '".$stdID."' ";

    // test queryUpdate
    // $queryUpdate = "SELECT * FROM studentinfo";

    $resultUpdate = mysqli_query($dbconnection, $queryUpdate);

    if ($resultUpdate)
    {
      // echo "Updated successfully";
      // <a href="index.php">Back to Data Entry Form</a>
      header("location:view.php");
    }
    else {
      echo "Please check queryUpdate";
    }
  }
  else {
    header("location:view.php");
  }

?>

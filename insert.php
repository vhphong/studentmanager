<?php
  $dbconnection = mysqli_connect("localhost", "root", "", "dbstudentmanager");

  // if Insert button was pressed
  if (isset($_POST['insert']))
  {
    // check for null values
    if (empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['birthday']) || empty($_POST['stdgender']) || empty($_POST['stdrace'])) {
      // die("Please fill in First Name, Last Name, DOB, Gender and Race");
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
      $stdAvatar = $_POST['avatar'];
      $stdSubmissions = $_POST['stdsubmission'];

      $query = "INSERT INTO studentinfo(sid, firstname, lastname, ssn, dob, gender, race, photo, submission)
                VALUES ('', '$stdFName', '$stdLName', '$stdSSN', '$stdDOB', '$stdGender', '$stdRace', '$stdAvatar', '$stdSubmissions')";

      $result = mysqli_query($dbconnection, $query);

      if ($result) {
        header("location:view.php");
      }
      else {
        echo "Please check the query";
      }
    }
  }
  else {
    // header("location:index.php");
    die("Please fill in all blanks");
  }
?>

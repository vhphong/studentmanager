<?php
  require_once("connection.php");

  // retrieve Student ID whose information to be edited
  $stdID = $_GET['emailID'];
  $querySendEmail = "SELECT * FROM studentinfo WHERE sid = '".$stdID."' ";
  $resultSendEmail = mysqli_query($dbconnection, $querySendEmail);

  while ($row=mysqli_fetch_assoc($resultSendEmail)) {
    $stdID = $row['sid'];
    $stdFName = $row['firstname'];
    $stdLName = $row['lastname'];
    $stdSSN = $row['ssn'];
    $stdDOB = $row['dob'];
    $stdGender = $row['gender'];
    $stdRace = $row['race'];
    $stdAvatar = $row['photo'];
  }
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Send Email</title>
  </head>
  <body>
    <h4>sendemail.php</h4>
    <h2>Student's Profile</h2>
    <a href="index.php">Back to Main Data Entry Form</a>
    <br>
    <a href="view.php">Back to View Students Data</a>
    <br><br>

    <?php



    ?>
    <textarea name="comment" rows="5" cols="40"></textarea>
    <br><br>
    <button type="button" name="button">Send Email</button>

  </body>
</html>













<!-- raw -->
<!-- <?php
    $to      = "abc@example.com";
    $subject = "Subject of the email";
    $message = "Content of the email";
    $header  = "From:myemail@exmaple.com \r\n";
    $header .= "Cc:other@exmaple.com \r\n";

    $success = mail ($to,$subject,$message,$header);

    if($success == true) {
      echo "Email sent successfully...";
    }
    else {
      echo "Email was not sent...";
    }
?> -->

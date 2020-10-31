<?php
  // retrieve student ID whose profile to be viewed
  require_once("connection.php");
  $stdID = $_GET['viewProfileID'];
  $queryViewProfile = "SELECT * FROM studentinfo WHERE sid = '".$stdID."' ";
  $resultViewProfile = mysqli_query($dbconnection, $queryViewProfile);



  while ($row=mysqli_fetch_assoc($resultViewProfile)) {
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
    <title>Student Profile</title>
  </head>
  <body>
    <?php
      $dirname = "c://avatars//";
      $images = glob($dirname."*.jpg");
      foreach($images as $image) {
        echo '<img src="'.$image.'" /><br />';
      }
    ?>

    <h3>Individual Profile</h3>
    <h4>profile.php</h4>
    <a href="index.php">Back to Main Data Entry Form</a>
    <br>
    <a href="view.php">Back to View Student Data</a>
    <br><br>

      <div class="card">
        <div class="container">
          <h4><b>Full Name</b></h4>
          <h5>SSN: </h5>
          <h5>Date of birth: </h5>
          <h5>Gender: </h5>
          <h5>Race: </h5>
          <h5>Submissions: </h5>
      </div>
      </div>

  </body>
</html>
        <h5>SSN: </h5>
          <h5>Date of birth: </h5>
          <h5>Gender: </h5>
          <h5>Race: </h5>
          <h5>Submissions: </h5>
      </div>
      </div>
    <!-- ?> -->
    <!-- <form class="" action="index.html" method="post">
    </form> -->
  </body>
</html>

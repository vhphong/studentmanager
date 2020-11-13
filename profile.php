<!-- reference: https://www.codexworld.com/upload-multiple-images-store-in-database-php-mysql/ -->

<?php
  require_once("connection.php");

  // retrieve Student ID whose information to be edited
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
     <title>Student's profile</title>
   </head>
   <body>
     <h4>profile.php</h4>
     <h2>Student's Profile</h2>
     <a href="index.php">Back to Main Data Entry Form</a>
     <br>
     <a href="view.php">Back to View Students Data</a>
     <br><br>

     <?php
       if (isset($_GET['viewProfileID'])) {
         // $studentFolder = $_GET['viewProfileID'];
         $studentFolder = $stdLName . '_' . $stdFName;

         // Include the database configuration file
         // Get images from the database
         $query = $dbconnection->query("SELECT photo FROM studentinfo ORDER BY sid DESC");

         // if($query->num_rows > 0){
           // while($row = $query->fetch_assoc()) {
             // $imageURL = $studentFolder . '/' . $row["photo"];
             // if (!$imageURL) {
               // echo "no image";
             // }
             // else {
               ?><img src="<?php echo $studentFolder.'/'.$studentFolder.".jpg" ?>" alt= "student's avatar" style="width:25%" /><?php
             // }

             // echo "<img src=$imageURL ";
           // }
         }
         else {
           ?><p>No image(s) found...</p><?php
         }
       // }
     ?>
     <br>
     <h3><b>First Name: <?php echo $stdFName ; ?></b></h3>
     <h3><b>Last Name: <?php echo $stdLName ; ?></b></h3>
     <h4>SSN: <?php echo $stdSSN; ?></h4>
     <h4>Date of birth (yyyy-mm-dd): <?php echo $stdDOB; ?></h4>
     <h4>Gender: <?php echo $stdGender; ?></h4>
     <h4>Race: <?php echo $stdRace; ?></h4>
     <h4>Submissions:
       <?php
         // Open student's directory, and read its contents
         // absolute path
         // $studentFolder = "C:/xampp/htdocs/PHP_Projects/studentmanager/" . $stdLName . '_' . $stdFName;
         // relative path
         $studentFolder = "./" . $stdLName . '_' . $stdFName;
         if (!is_dir($studentFolder)) {
           echo "Folder " . $stdLName . '_' . $stdFName . " is not found.";
         }
         else {
           if ($handle = opendir($studentFolder)) {
             while (false !== ($entry = readdir($handle))) {
               if ($entry != "." && $entry != "..") {
                 // echo "$entry" . "<br>";
                 if (!$entry) {
                   echo "not a file";
                 }
                 else {
                   $newpath = $studentFolder . '/' . $entry;
                   echo "<a href = $newpath> $entry </a>" . "<br>";
                 }
               }
             }
             closedir($handle);
           }
         }
       ?>
     </h4>
   </body>
 </html>

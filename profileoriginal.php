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
     <a href="index.php">Back to Main Data Entry Form index.php</a>
     <br>
     <br>

     <?php
       if (isset($_GET['viewProfileID'])) {
         // $studentFolder = $_GET['viewProfileID'];
         $studentFolder = $stdLName . '_' . $stdFName;

         // Include the database configuration file
         // Get images from the database
         $query = $dbconnection->query("SELECT photo FROM studentinfo ORDER BY sid DESC");

         if($query->num_rows > 0){
           while($row = $query->fetch_assoc()) {
             $imageURL = $studentFolder . '/' . $row["photo"];
             ?>
             <img src="<?php echo $imageURL; ?>" alt= "student's avatar" style="width:25%" />
           <?php }
         }
         else {
           ?>
           <p>No image(s) found...</p>
           <?php
         }
       }
     ?>
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
         // $path = "C:/xampp/htdocs/PHP_Projects/studentmanager/" . $stdLName . '_' . $stdFName;
         // relative path
         $path = "./" . $stdLName . '_' . $stdFName;

         if (!is_dir($path)) {
           echo '<script>alert("Folder of student is not found.")</script>';
         }
         else {
           $dir = scandir($path);

           foreach($dir as $token){
             if(($token != ".") && ($token != "..")){
               if(is_dir($path.'/'.$token)){
                 $folders[] = $token; // search for folders
               }
               else{
                 $files[] = $token;   // search for files
               }
             }
           }

           // display folders
           foreach($folders as $folder){
             $newpath = $path.'/'.$folder;
             echo "<a href = fileHandler.php?cale=$newpath> [ $folder ] </a>" . "<br>";
           }

           // display files
           foreach($files as $file){
             $newpath = $path.'/'.$file;
             echo "<a href = fileHandler.php?file=$file> $file </a>" . "<br>";
           }
         }
       ?>
     </h4>
   </body>
 </html>

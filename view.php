<?php
  require_once("connection.php");
  $queryView = "SELECT sid, firstname, lastname, ssn, dob, gender, race, photo, submission
                FROM studentinfo";
  $resultView = mysqli_query($dbconnection, $queryView);
  echo "view.php is here.";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <style>
      #students table, th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #4CAF50;
        color: purple;
        border: 1px solid Black;
        border-collapse: collapse;
      }
      table, th, td {
        border: 1px solid Black;
        border-collapse: collapse;
      }
      tr {
        text-align: center;
      }
    </style>
    <meta charset="utf-8">
    <title>Student Manager Records</title>
  </head>
  <body>
    <center>
      <h3>Student Manager Records</h3>
      <h4>view.php</h4>
    </center>
    <hr width=100%>
    <a href="index.php">Back to Main Data Entry Form index.php</a>
    <br>
    <br><br>
    <table id="students">
      <tr>
        <th>Student ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>SSN</th>
        <th>Date of birth <br>(yyyy-mm-dd)</th>
        <th>Gender</th>
        <th>Race</th>
        <th>Avatar</th>
        <th>Submissions</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>

      <?php
        while ($row=mysqli_fetch_assoc($resultView)) {
            $stdID = $row['sid'];
            $stdFName = $row['firstname'];
            $stdLName = $row['lastname'];
            $stdSSN = $row['ssn'];
            $stdDOB = $row['dob'];
            $stdGender = $row['gender'];
            $stdRace = $row['race'];
            $stdAvatar = $row['photo'];
            $stdSubmissions = $row['submission'];
          ?>
          <tr>
            <td><?php echo $stdID ?></td>
            <td><?php echo $stdFName ?></td>
            <td><?php echo $stdLName ?></td>
            <td><?php echo $stdSSN ?></td>
            <td><?php echo $stdDOB ?></td>
            <td><?php echo $stdGender ?></td>
            <td><?php echo $stdRace ?></td>
            <td><?php echo $stdAvatar ?></td>
            <td><?php
                   // Open 'avatar' directory, and read its contents
                   $dir = "C:\\xampp\\htdocs\\PHP_Practice\\studentmanager\\" . $stdLName . '_' . $stdFName;
                   if (is_dir($dir)){
                     if ($dh = opendir($dir)){
                       while (($file = readdir($dh)) !== false){
                         echo $file . "<br>";
                       }
                       // close the directory
                       closedir($dh);
                     }
                   }
                ?>
            </td>
            <td><a href="edit.php?editID=<?php echo $stdID ?>">Edit</a></td>
            <!-- <td><a href="delete.php?deleteID=<?php echo $stdID ?>">Delete</a></td> -->
            <!-- use double quotes for js inside php! -->
            <td><a onClick="javascript: return confirm('Please confirm deletion')" href="delete.php?deleteID=<?php echo $stdID ?>">Delete</a></td>

            <td><a href="submitmore.php?submitID=<?php echo $stdID ?>">Submit more</a></td>
            <td><a href="openfolder.php?openFolderID=<?php echo $stdLName . '_' . $stdFName ?>">View in folder</a></td>
            <!-- open a new browser tab to view the student profile -->
            <td><a href="profile.php?viewProfileID=<?php echo $stdID ?>" target="_blank">View profile</a></td>
          </tr>
          <?php
        } // end of while
        ?>
    </table>
  </body>
</html>

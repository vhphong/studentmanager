<?php
  // echo "delete.php is here";
  require_once("connection.php");

  // if the Delete button was pressed
  if (isset($_GET['deleteID']))
  {
    $studentID = $_GET['deleteID'];
    $queryDelete = "DELETE FROM studentinfo WHERE sid = '".$studentID."' ";
    $resultDelete = mysqli_query($dbconnection, $queryDelete);

    if ($resultDelete)
    {
      header("location:view.php");
    }
    else
    {
      echo "Delete failed. Please check the queryDelete";
    }
  }
  else
  {
    header("location:view.php");
  }
?>

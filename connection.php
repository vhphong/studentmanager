<?php
  $dbconnection = mysqli_connect("localhost", "root", "", "dbstudentmanager");
  if (!$dbconnection){
    die("Connection to database failed");
  }
?>

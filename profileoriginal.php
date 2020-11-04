<!-- reference: https://www.codexworld.com/upload-multiple-images-store-in-database-php-mysql/ -->

<?php
  require_once("connection.php");
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <?php
       // Include the database configuration file
       // Get images from the database
       $query = $dbconnection->query("SELECT photo FROM studentinfo ORDER BY sid DESC");

       if($query->num_rows > 0){
         while($row = $query->fetch_assoc()){
           $imageURL = 'Vo1_Phong1/'.$row["photo"];
           ?>
           <img src="<?php echo $imageURL; ?>" alt="Vo1_Phong1" style="width:25%" />
         <?php }
       }
       else {
         ?>
         <p>No image(s) found...</p>
         <?php
       }
     ?>
   </body>
 </html>

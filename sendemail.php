<!-- raw -->


<?php
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
?>

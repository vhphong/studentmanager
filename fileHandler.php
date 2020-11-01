<!-- https://stackoverflow.com/questions/22592823/link-to-file-on-local-hard-drive -->

<?php
    $file = $_GET['file'];
    header('content-type:application/'.end(explode('.',$file)));
    Header("Content-Disposition: attachment; filename=" . $file); //to set download filename
    exit(file_get_contents($file));
?>

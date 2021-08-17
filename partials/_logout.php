<?php  

    // echo 'Your logout is in processing';
    session_start();
    session_destroy();
    header("Location:http://wediscuss.lovestoblog.com/");
    exit();
?>
<?php
    session_start();
    session_destroy();
    header("Location: Info Lorong dan Rak.php");
    exit;
?>
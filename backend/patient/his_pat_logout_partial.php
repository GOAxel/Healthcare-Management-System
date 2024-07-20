<?php
    session_start();
    unset($_SESSION['doc_id']);
    unset($_SESSION['pat_phone']);
    session_destroy();

    header("Location: his_pat_logout.php");
    exit;
?>
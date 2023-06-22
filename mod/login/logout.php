<?php
include "../../cnf/app.php";
session_start();
session_unset();
session_destroy();
echo "<script>location.href='".$GLOBALS['app_url']."';</script>";
?>
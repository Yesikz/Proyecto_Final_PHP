<?php
session_start();
session_destroy();
header("Location: backend/index.php");
exit();
?>

<?php
session_start();
unset($_SESSION['codeSecret']) ;
session_destroy();
header('Location: index.php');

?>
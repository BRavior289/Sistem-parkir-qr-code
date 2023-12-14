<?php 
session_start();
// Untuk menghapus session
$_SESSION = [];
session_unset();
session_destroy();

// menghapus cookies
setcookie('id', '', time()-3600);
setcookie('key', '', time()-3600);

header('Location: login.php');
exit;
?>
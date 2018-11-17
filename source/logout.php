<?php
include('fonction.php');
include('headerhtml.php');

session_destroy();

echo "You are disconnected<br>";
?>

<a href="register.php">register</a>
<a href="login.php">login</a>

<?php
include('footerhtml.php');
?>
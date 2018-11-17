<?php

include('fonction.php');
include('headerhtml.php');

if (isset($_POST['Username']) && isset($_POST['Password'])) {
	$Username = (String) $_POST['Username'];
	$Password = (String) $_POST['Password'];

	$Username = htmlspecialchars($Username, ENT_COMPAT,'ISO-8859-1', true);

	$_SESSION['Username'] = $Username;


	$CheckUser = CheckUsername();
	$CheckUser->bindParam(':username', $Username);
	$CheckUser->execute();

	while ($Data = $CheckUser->fetch()) {
		$Number = (int) $Data["COUNT(*)"];
	}

	if ($Number == 1) {

		$CheckPass = CheckPassword();
		$CheckPass->bindParam(':username', $Username);
		$CheckPass->execute();

		while ($Data = $CheckPass->fetch()) {
		$Pass = (String) $Data['password'];
		}

		if (hash_equals($Pass, (String) crypt($Password,$Pass))) {
			include('navbar.php');
			echo "Hello : ".$Username." you are connected";
		}
		else {
			echo "Error in your password retry : ";
			echo "<a href='login.php'>Login</a>";
		}
	}
	else {
		echo "Error in your username retry : ";
		echo "<a href='login.php'>Login</a>";
	}
}
else {

	?>
	<form action="login.php" method="post">
		<label>Username* : </label>
		<input type="text" 
		name="Username" 
		placeholder="Your Username" 
		maxlength="50" 
		minlength="1" 
		required>
		<br>
		<label>Password* : </label>
		<input type="Password" 
		name="Password" 
		placeholder="Your Password" 
		maxlength="50" 
		minlength="1" 
		required>
		<br>
		<input type="submit" value="Validation">
	</form>
	<?php
}

include('footerhtml.php');
?>
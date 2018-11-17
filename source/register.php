<?php

include('fonction.php');
include('headerhtml.php');

if (
	isset($_POST['Username']) && 
	isset($_POST['Password']) && 
	isset($_POST['PasswordConfimation'])
) {
	$Username = (String) $_POST['Username'];
	$Password = (String) $_POST['Password'];
	$PassConf = (String) $_POST['PasswordConfimation'];

	$Username = htmlspecialchars($Username, ENT_COMPAT,'ISO-8859-1', true);
	$Password = htmlspecialchars($Password, ENT_COMPAT,'ISO-8859-1', true);
	$PassConf = htmlspecialchars($PassConf, ENT_COMPAT,'ISO-8859-1', true);

	if (strlen($Username) > 0) {
		if (strlen($Password) > 0) {
			if (strlen($PassConf) > 0) {
				if (strlen($Username) < 50) {
					if (strlen($Password) < 50) {
						if (strlen($PassConf) < 50) {
							if ($PassConf === $Password) {
								try {
									$bdd = connection();
									if ($bdd == TRUE) {
										$CheckUser = CheckUsername();
										$CheckUser->bindParam(':username', $Username);
										$CheckUser->execute();

										while ($Data = $CheckUser->fetch()) {
											$Number = (int) $Data["COUNT(*)"];
										}

										if ($Number == 0) {

											$Hashing = (String) crypt($Password);

											$Hashing = htmlspecialchars($Hashing, ENT_COMPAT,'ISO-8859-1', true);

											$AddData = AddUser();
											$AddData->bindParam(':username', $Username);
											$AddData->bindParam(':password', $Hashing);
											$AddData->execute();
											echo "Your account was successfully created.";
											echo "<a href='login.php'>Login</a>";
										}
										else {
											echo "The username \"".$Username."\" is already taken";
											echo "<a href='register.php'>Try again</a>";
										}
									}
								} catch (Exception $e) {
									echo "Error ! : ".$bdd."<br>".$e->getMessage();
									echo "<a href='register.php'>Try again</a>";
									die();
								}
							}
							else {
								echo "Your password does not match the password verification. 
								Please try again.";
								echo "<a href='register.php'>Try again</a>";
							}
						}
						else {
							echo "Your password cannot have more than 50 characters. 
							Please try again.";
							echo "<a href='register.php'>Try again</a>";
						}
					}
					else {
						echo "Your password cannot have more than 50 characters. 
						Please try again.";
						echo "<a href='register.php'>Try again</a>";
					}
				}
				else {
					echo "Your username cannot have more than 50 characters. 
					Please try again.";
					echo "<a href='register.php'>Try again</a>";
				}
			}
			else {
				echo "Your password does not match the password verification. 
				Please try again.";
				echo "<a href='register.php'>Try again</a>";
			}
		}
		else {
			echo "You cannot leave the password blank. 
			Please try again.";
			echo "<a href='register.php'>Try again</a>";
		}
	}
	else {
		echo "You cannot leave the username blank. 
		Please try again.";
		echo "<a href='register.php'>Try again</a>";
	}
}
else {
	?>
	<form action="register.php" method="post">
		<label>Username : </label>
		<input type="text" 
		name="Username" 
		placeholder="Your Username" 
		maxlength="50" 
		minlength="1" 
		required>
		<br>
		<label>Password : </label>
		<input type="Password" 
		name="Password" 
		placeholder="Your Password" 
		maxlength="50" minlength="1" 
		required>
		<br>
		<label>Confirmation of Password : </label>
		<input type="Password" 
		name="PasswordConfimation" 
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
<?php
include('fonction.php');
include('headerhtml.php');
include('navbar.php');

$Username = (String) $_POST['usernamegest'];
$Comment = (String) $_POST['commentarticle'];
$IdArticle = $_POST['idarticle'];

$Username = htmlspecialchars($Username, ENT_COMPAT,'ISO-8859-1', true);
$Comment = htmlspecialchars($Comment, ENT_COMPAT,'ISO-8859-1', true);

if (strlen($Username) > 0) {
	if (strlen($Comment) > 0) {
		if (strlen($Username) < 50) {
			if (strlen($Comment) < 255) {

				$AddComments = AddComment();
				$AddComments->bindParam(':username', $Username);
				$AddComments->bindParam(':content', $Comment);
				$AddComments->bindParam(':article', $IdArticle);
				$AddComments->execute();

				echo "Your comment has been created.";
			}
			else {
				echo"Your content cannot have more than 255 characters. 
				Please try again.";
			}
		}
		else {
			echo"Your username cannot have more than 50 characters. 
			Please try again.";
		}
	}
	else {
		echo"You cannot leave the content blank. 
		Please try again.";
	}
}
else {
	echo"You cannot leave the username blank. 
	Please try again.";
}

include('footerhtml.php');
?>
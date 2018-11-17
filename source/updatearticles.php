<?php
include('fonction.php');
include('headerhtml.php');
include('navbar.php');

$Title = (String) $_POST['title'];
$Content = (String) $_POST['content'];
$IdArticle = (String) $_POST['article'];

$Title = htmlspecialchars($Title, ENT_COMPAT,'ISO-8859-1', true);
$Content = htmlspecialchars($Content, ENT_COMPAT,'ISO-8859-1', true);

if (strlen($Title) > 0) {
	if (strlen($Title) < 255) {
		if (strlen($Content) > 0) {
			if (strlen($Content) < 65535) {

				$UpdadeArticles = UpdadeArticle();
				$UpdadeArticles->bindParam(':title', $Title);
				$UpdadeArticles->bindParam(':content', $Content);
				$UpdadeArticles->bindParam(':IdArticles', $IdArticle);
				$UpdadeArticles->execute();

				echo "is good";
			}
			else {
				echo "Content has too many characteres";
			}
		}
		else {
			echo "Content cannot be left blank.";
		}
	}
	else {
		echo "Title too long";
	}
}else {
	echo "Title too short";
}

include('footerhtml.php');
?>
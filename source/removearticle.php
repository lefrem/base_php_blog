<?php
include('fonction.php');
include('headerhtml.php');
include('navbar.php');

$IdArticle = (int) $_POST['article'];

$RemoveImages = RemoveImage();
$RemoveImages->bindParam(':IdArticles', $IdArticle);
$RemoveImages->execute();

while($Data = $RemoveImages->fetch()) {
	$Image = (String) $Data['image'];
}

unlink($Image);

$RemoveArticles = RemoveArticle();
$RemoveArticles->bindParam(':IdArticles', $IdArticle);
$RemoveArticles->execute();

echo "Your article has been remove.";

include('footerhtml.php');
?>
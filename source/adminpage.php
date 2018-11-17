<?php
include('fonction.php');
include('headerhtml.php');
include('navbar.php');

$x = (int)0;
$y = (int)0;
$IdArticle = array();
$TitleArticle = array();
$AuthordArticle = array();

$AllArticles = AllArticle();
$AllArticles->execute();

$SearchUser = ResearchUser ();

while ($Data = $AllArticles->fetch()) {
	$IdArticle[$x] = (String) $Data['id'];
	$TitleArticle[$x] = (String) $Data['title'];
	$IdAuthorArticle[$x] = (String) $Data['author'];

	$SearchUser->bindParam(':IdUser', $IdAuthorArticle[$x]);
	$SearchUser->execute();

	while ($Datas = $SearchUser->fetch()) {
		$AuthorArticle[$y] = (String) $Datas['username'];

		echo "<form action='updatearticle.php' method='post' target='_blank'>";

		echo $TitleArticle[$x]." by : ".$AuthorArticle[$y];
		echo "<input type='hidden' name='article' value='$IdArticle[$x]'>";
		echo "<input type='submit' value='updade'>";

		echo "</form>";

		echo "<form action='removearticle.php' method='post'>";

		echo "<input type='hidden' name='article' value='$IdArticle[$x]'>";
		echo "<input type='submit' value='remove'><br>";

		echo "</form>";
		
		$y++;
	}
	$x++;
}

include('footerhtml.php');
?>
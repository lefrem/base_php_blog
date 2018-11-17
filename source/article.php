<?php
include('fonction.php');
include('headerhtml.php');
include('navbar.php');

$IdArticle = (int) $_POST['article'];

$GetArticles = GetArticle();
$GetArticles->bindParam(':IdArticles', $IdArticle);
$GetArticles->execute();

while ($Data = $GetArticles->fetch()) {
	$Title = (String) $Data['title'];
	$Content = (String) $Data['content'];
	$Image = (String) $Data['image'];
	$IdAuthor = (int) $Data['author'];
}

$SearchUser = ResearchUser ();
$SearchUser->bindParam(':IdUser', $IdAuthor);
$SearchUser->execute();

while ($Data = $SearchUser->fetch()) {
	$Author = (String) $Data['username'];
}

$AllComments = AllComment();
$AllComments->bindParam(':IdArticles', $IdArticle);
$AllComments->execute();

$x = (int) 0;
$UsernameGest = array();
$CommentArticle = array();

while ($Data = $AllComments->fetch()) {
	$UsernameGest[$x] = (String) $Data['username'];
	$CommentArticle[$x] = (String) $Data['content'];

	$x++;
}

$Position = (int) $IdArticle % 2;

if ($Position == 0) {
	echo $Title."<img src='./$Image'>".$Content.$Author;
}
else {
	echo $Title.$Content."<img src='./$Image'>".$Author;
}
?>

<form method="post" action="newcomment.php">
	<label>Your username :</label>
	<textarea name="usernamegest" 
	rows="1" 
	cols="20" 
	required></textarea>
	<label>Comment :</label>
	<textarea name="commentarticle"
	rows="1" 
	cols="40" 
	required></textarea>
	<input type="hidden" name="idarticle" value="<?php echo $IdArticle ?>">
	<input type="submit" name="send">
</form>

<?php
for ($i=(int)0; $i < $x; $i++) { 
	echo $UsernameGest[$i]." : ".$CommentArticle[$i];
}

include('footerhtml.php');
?>
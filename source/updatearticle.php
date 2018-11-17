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
}
?>
<form action="updatearticles.php" method="POST" enctype="multipart/form-data">
	<label>Article title : </label>
	<textarea name="title" rows="1" cols="20" required><?php echo $Title; ?></textarea>
	<label>Article content :</label>
	<textarea name="content" rows="10" cols="40" required><?php echo $Content; ?></textarea>
	<input type="hidden" name="article" value="<?php echo $IdArticle; ?>">
	<input type="submit" value="save">
</form>
<?php
include('footerhtml.php');
?>
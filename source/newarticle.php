<?php
include('fonction.php');
include('headerhtml.php');
include('navbar.php');

if (
	isset($_FILES['file']) && 
	isset($_POST['title']) && 
	isset($_POST['content'])
) {
	$id = uniqid();
	$target_dir = "image/";
	$new_name = explode(".",$_FILES["file"]["name"]);
	$new_name = array_reverse($new_name);
	$ext = $new_name[0];

	$Title = (String) $_POST['title'];
	$Content = (String) $_POST['content'];

	$Title = htmlspecialchars($Title, ENT_COMPAT,'ISO-8859-1', true);
	$Content = htmlspecialchars($Content, ENT_COMPAT,'ISO-8859-1', true);

	if (
		$_FILES['file']['type'] == "image/jpeg" || 
		$_FILES['file']['type'] == "image/jpg" || 
		$_FILES['file']['type'] == "image/png"
	) {
		if ($_FILES['file']['size'] < 2097152) {
			if (strlen($Title) > 0) {
				if (strlen($Title) < 255) {
					if (strlen($Content) > 0) {
						if (strlen($Content) < 65535) {
							$IdUser = CheckIdUser();
							$IdUser->bindParam(':username', $User);
							$IdUser->execute();

							while ($Data = $IdUser->fetch()) {
								$UserId = (int) $Data['id'];
							}

							$_FILES["file"]["name"] = $id.".".$ext;
							move_uploaded_file($_FILES['file']['tmp_name'], 
							"image/".$_FILES['file']['name']);

							$Link = (String) "image/".$_FILES['file']['name'];

							$Link = htmlspecialchars($Link, ENT_COMPAT,'ISO-8859-1', true);

							$SaveArticles =SaveArticle();
							$SaveArticles->bindParam(':title', $Title);
							$SaveArticles->bindParam(':content', $Content);
							$SaveArticles->bindParam(':image', $Link);
							$SaveArticles->bindParam(':author', $UserId);
							$SaveArticles->execute();

							echo "Your article is saved";

							echo "<a href='listarticle.php'>View article list</a>";
							echo "<a href='newarticle.php'>Create a new article</a>";

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
			}
			else {
				echo "Title too short";
			}
		}
		else {
			echo "Error size is bigger than 2Mb";
		}
	}
	else {
		echo "Error extention is not a JPEG or PNG or JPG";
	}

}
else {
	?>
	<form action="newarticle.php" method="POST" enctype="multipart/form-data">
		<label>Article title : </label>
		<textarea name="title" rows="1" cols="20" required></textarea>
		<label>Article content :</label>
		<textarea name="content" rows="10" cols="40" required></textarea>
		<label>Your image <label>
		<input type="file" name="file" required>
		<input type="submit" name="save">
	</form>
	<?php
}
include('footerhtml.php');
?>
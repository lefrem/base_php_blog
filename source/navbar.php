<?php
session_start();

$User = (String) $_SESSION['Username'];
?>

<ul>
	<li>
		<a href="newarticle.php">New Article</a>
	</li>
	<li>
		<a href="listarticle.php">Articles List</a>
	</li>
	<li>
		<a href="adminpage.php">Admin Section</a>
	</li>
	<li>
		<p><?php echo $User; ?></p>
		<ul>
			<li>
				<a href="logout.php">Logout</a>
			</li>
		</ul>
	</li>
</ul>
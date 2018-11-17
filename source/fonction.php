<?php

declare(strict_types=1);

function Connection()
{
	$Server = (String) "db";
	$DataBase = (String) "blog";
	$SQLUser = (String) "user";
	$SQLPassword = (String) "password123";

	$bdd = new PDO('mysql:host='.$Server.';
		dbname='.$DataBase.';
		charset=utf8', 
		"$SQLUser", 
		"$SQLPassword"
	);

    return $bdd;
}

function AddUser ()
{
	$bdd = connection();
	$AddData = $bdd->prepare("
		INSERT INTO `user` (id,username,password) 
		VALUE (NULL,:username, :password)
	");

	return $AddData;
}

function CheckUsername ()
{
	$bdd = connection();
	$CheckUser = $bdd->prepare("
		SELECT COUNT(*) 
		FROM `user` 
		WHERE `username` = (:username)
	");

	return $CheckUser;
}

function CheckPassword ()
{
	$bdd = connection();
	$CheckPass = $bdd->prepare("
		SELECT `password` 
		FROM `user` 
		WHERE `username` = (:username)
	");

	return $CheckPass;
}

function SaveArticle ()
{
	$bdd = connection();
	$SaveArticles = $bdd->prepare("
		INSERT INTO `article` (id,title,content,image,author) 
		VALUE (NULL,:title, :content, :image, :author)
	");

	return $SaveArticles;
}

function CheckIdUser ()
{
	$bdd = connection();
	$IdUser = $bdd->prepare("
		SELECT `id` 
		FROM `user` 
		WHERE `username` = (:username)
	");

	return $IdUser;
}

function AllArticle ()
{
	$bdd = connection();
	$AllArticles = $bdd->prepare("
		SELECT * 
		FROM `article`
	");

	return $AllArticles;
}

function ResearchUser () 
{
	$bdd = connection();
	$SearchUser = $bdd->prepare("
		SELECT `username`
		FROM `user`
		WHERE `id` = (:IdUser)
	");

	return $SearchUser;
}

function GetArticle () 
{
	$bdd = connection();
	$GetArticles = $bdd->prepare("
		SELECT * 
		FROM `article`
		WHERE `id` = (:IdArticles)
	");

	return $GetArticles;
}

function AllComment ()
{
	$bdd = connection();
	$AllComments = $bdd->prepare("
		SELECT *
		FROM `commentaire`
		WHERE `article` = (:IdArticles)
	");

	return $AllComments;
}

function AddComment ()
{
	$bdd = connection();
	$AddComments = $bdd->prepare("
		INSERT INTO `commentaire` (id,username,content,article) 
		VALUE (NULL,:username, :content, :article)
	");

	return $AddComments;
}

function RemoveArticle ()
{
	$bdd = connection();
	$RemoveArticles = $bdd->prepare("
	DELETE FROM `article`
	WHERE `id` = (:IdArticles)
	");

	return $RemoveArticles;
}

function RemoveImage ()
{
	$bdd = connection();
	$RemoveImages = $bdd->prepare("
	SELECT `image`
	FROM `article`
	WHERE `id` = (:IdArticles)
	");

	return $RemoveImages;
}

function UpdadeArticle ()
{
	$bdd = connection();
	$UpdadeArticles = $bdd->prepare("
	UPDATE `article`
	SET `title` = (:title), content = (:content)
	WHERE `id` = (:IdArticles)
	");

	return $UpdadeArticles;
}

?>
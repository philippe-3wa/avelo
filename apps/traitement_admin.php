<?php
if (!isset($_SESSION['admin']))
{
	header('Location: index.php');
	exit;
}
else
{

	if (isset($_POST['action']))
	{
		$action = $_POST['action'];

		if ($action == "categorie_add")
		{
			$manager = new CategorieManager($link);
			try
			{
				$categorie = $manager->create($_POST);
				header('Location: index.php?page=admin');
				exit;
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}
	}
}
?>
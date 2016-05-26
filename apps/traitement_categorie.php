<?php
if (isset($_POST['action']))
{
	if ($_POST['action'] == 'update')
	{
		if (isset($_SESSION['admin']))
		{
			$manager = new CategorieManager($link);
			try
			{
				$categorie = $manager->findById($_POST['id']);
				$categorie->setNom($_POST['nom']);
				$categorie->setDescription($_POST['description']);
				$manager->update($article);
				header('Location: index.php');
				exit;
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}
	}
	else if ($_POST['action'] == 'create')
	{
		if (isset($_SESSION['admin']))
		{
			$manager = new CategorieManager($link);
			try
			{
				$rubrique = $manager->create($_POST);
				header('Location: index.php');
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
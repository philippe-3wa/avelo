<?php
if (isset($_POST['action']))
{
	if ($_POST['action'] == 'update')
	{
		if (isset($_SESSION['id'], $_POST['id_avis']))
		{
			$manager = new AvisManager($link);// $link => $this->link
			try
			{
				$avis = $manager->findById($_POST['id_avis']);
				$avis->setNote($_POST['note']);
				$avis->setContenu($_POST['contenu']);
				$manager->update($avis);
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
		if (isset($_SESSION['id']))
		{
			$manager = new AvisManager($link);
			try
			{
				$avis = $manager->create($_POST);
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
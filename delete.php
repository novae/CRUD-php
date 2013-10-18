<?php
	require 'database.php';
	$id = 0;
	if(!empty($_GET['id'])){
		$id = $_REQUEST['id'];
	}
	if(!empty($_POST)){
		//kept track post values
		$id = $_POST['id'];
		//delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM customers WHERE id=?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		Database::disconnect();
		header("Location: index.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="CSS/bootstrap.min.css">
		<script type="text/javascript" src="JS/bootstrap.min.js"></script>
	</head>
	<body>
		<section class="container">
			<article class="span10 offset1">
				<header class="row">
					<h3>Borrar Cliente</h3>
				</header>
				<form class="form-horizontal" action="delete.php" method="post">
					<input type="hidden" name="id" value="<?php echo $id;?>">
					<p class="alert alert-error">Seguro que deseas borrar este registro?</p>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger">Si</button>
						<a class="btn" href="index.php">NO</a>
					</div>
				</form>
			</article>
		</section>
	</body>
</html>
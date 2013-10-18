<?php
	require 'database.php';
	$id = null;
	if(!empty($_GET['id'])){
		$id = $_REQUEST['id'];
	}
	if(null ==$id){
		header("location:index.php");
	}
	if(!empty($_POST)){
		//KEEP TRACK VALIDATION ERRORS
		$nameError = null;
		$emailError = null;
		$mobileError = null;
		//KEEP TRACK POST VALUES
		$name = $_POST['name'];
		$email =$_POST['email'];
		$mobile = $_POST['mobile'];
		//VALIDATE INPUT
		$valid = true;
		if(empty($name)){
			$nameError = "Ingresa un Nombre";
			$valid = false;
		}
		if(empty($email)){
			$emailError = "Ingresa un Email";
			$valid = false;
		}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$emailError ="Ingresa una direccion correcta de Email";
			$valid = false;
		}
		if(empty($mobile)){
			$mobileError = "Ingresa un numero de Celular";
			$valid = false;
		}
		//update data
		if($valid){
			$pdo = Database::Connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE customers set name=?,email=?,mobile=? WHERE id=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$email,$mobile,$id));
			Database::disconnect();
			header("Location: index.php");
		}else{
			$pdo = Database::Connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM customers WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->ecxecute(array($id));
			$data = $q->fetch(PDO::FETCH_ASSOC);
			$name = $data['name'];
			$email = $data['email'];
			$mobile = $data['mobile'];
			Database::disconnect();
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta chartset="utf-8">
		<link href="CSS/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript" src="JS/bootstrap.min.js"></script>
	</head>
	<body>
		<article class="container">
			<section class="span10 offset1">
				<header class="row">
					<h3>Actualizar informacion de Cliente</h3>
				</header>
				<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
					
					<div class="control-group <?php echo !empty($nameError)?'error':'';?>">
						<label class="control-label">Nombre</label>
						<div class="controls">
							<input name="name" type="text" placeholder="Nombre" value="<?php echo !empty($name)?$name:'';?>">
							<?php if(!empty($nameError)):?>
								<span class="help-line"><?php echo $nameError;?></span>
							<?php endif;?>
						</div>
					</div>

					<div class="control-group <?php echo !empty($emailError)?'error':'';?>">
						<label class="control-label">Direccion Email</label>
						<div class="controls">
							<input name="email" type="text" placeholder="Email" value="<?php echo !empty($email)?$email:'';?>">
							<?php if(!empty($emailError)):?>
								<span class="help-line"><?php echo $emailError;?></span>
							<?php endif;?>
						</div>
					</div>

					<div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
						<label class="control-label">Celular</label>
						<div class="controls">
							<input name="mobile" type="text" placeholder="Celular" value="<?php echo !empty($mobile)?$mobile:'';?>">
							<?php if(!empty($mobileError)):?>
								<span class="help-line"><?php echo $mobileError;?></span>
							<?php endif;?>
						</div>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-success">Actualizar</button>

						<a class="btn" href="index.php">Regresar</a>
					</div>

				</form>
			</section>
		</article>
	</body>
</html>
<?php
		require 'database.php';
		if(!empty($_POST)){
			//keep track validation errors
			$nameError = null;
			$emailError = null;
			$mobileError = null;

			//keep track post values

			$name = $_POST['name'];
			$email = $_POST['email'];
			$mobile = $_POST['mobile'];

			//validate input
			$valid = true;
			if(empty($name)){
				$nameError = 'Ingresa un Nombre';
				$valid = false;
			}
			if(empty($email)){
				$emailError = 'Ingresa una Direccion de Email';
				$valid = false;
			} else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$emailError = 'Please enter a valid Email Address';
				$valid = false;
			}
			if(empty($mobile)){
				$mobileError = 'Ingresa un Numero de Celular';
				$valid = false;
			}
			//Insert Data
			if($valid){
				$pdo = Database::connect();
				$pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO customers (name,email,mobile) values (?,?,?)";
				$q = $pdo->prepare($sql);
				$q -> execute(array($name,$email,$mobile));
				Database::disconnect();
				header("Location:index.php");
			}
		}
	?>
<!DOCTYPER html>
<html lang ="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="CSS/bootstrap.min.css">
		<script type="text/javascript" src="JS/bootstrap.min.js" ></script>
	</head>
	
	<body>
		<section class="container">
			
			<article class="span10 offset1">
				<header class="row">
					<H3>Nuevo Cliente</H3>
				</header>
				<section>
					
					<form class="form-horizontal" action="create.php" method="post">	
						<legend> Los campos con un * son obligatorios</legend>
						
						<div class="control-group <?php echo !empty($nameError)?'error':'';?>">
							<label class="control-label" for="Name">Name</label>
							<div class="controls">
								<input name="name" type="text" placeholder="Nombre" value="<?php echo !empty($name)?$name:'';?>">
								<?php if(!empty($nameError)):?>
									<span class ="help-inline"><?php echo $nameError;?></span>
								<?php endif; ?>	
							</div>
						</div>

						<div class="control-group <?php echo !empty($emailError)?'error':'';?>">
							<label class="control-label">Direccion de Email</label>
							<div class="controls">
								<input name="email" type="text" placeholder="Direccion de Email" value="<?php echo !empty($email)?$email:'';?>">
								<?php if(!empty($emailError)): ?>
									<span class="help-inline"><?php echo $emailError; ?></span>
								<?php endif;?>	
							</div>
						</div>

						<div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
							<label class="control-label">Celular</label>
							<div class="controls">
								<input name="mobile" type="text" placeholder="Celular" value="<?php echo !empty($mobile)?$mobile:'';?>">
								<?php if(!empty($mobileError)): ?>
									<span class="help-inline"><?php echo $mobileError; ?></span>
								<?php endif;?>
							</div>
						</div>

						<div class="form-actions">
							<button type="submit" class="btn btn-success">Registrar</button>
							<a class="btn" href="index.php">Regresar</a>
						</div>

					</form>
				</section>
			</article>

 		</section>
	</body>
</html>
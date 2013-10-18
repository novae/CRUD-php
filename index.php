<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link   href="CSS/bootstrap.min.css" rel="stylesheet">
	<script src="JS/bootstrap.min.js"></script>
</head>

<body>
	<section class="container">
		<header class="row">
			<h3>PHP CRUD</h3>
		</header>
		
		<article class="row">
			<p>
				<a href="create.php" class="btn btn-success">Create</a>
			</p>
			<table class="table table-striped table-bordered row">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Direccion de Correo Electronico</th>
						<th>Celular</th>
						<th>Accion</th>
					</tr>
				</thead>
				<tbody>
					<?PHP
						include 'database.php';
						$pdo = database::connect();
						$sql = 'SELECT * FROM customers ORDER BY id DESC';
						foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
							echo '<td>'.$row['name'].'</td>';
							echo '<td>'.$row['email'].'</td>';
							echo '<td>'.$row['mobile'].'</td>';
							echo '<td width=250>';
							echo '<a class="btn" href="read.php?id='.$row['id'].'">Leer</a>';
							echo ' ';
							echo '<a class="btn btn-success" href="update.php? id='.$row['id'].'">Actualizar</a>';
							echo ' ';
							echo '<a class="btn btn-danger" href="delete.php? id='.$row['id'].'">Borrar</a>';
							echo '</td>';
							echo '</tr>';
						}
						Database::disconnect();
					?>
				</tbody>
			</table>
		</article>
	</section>
</body>



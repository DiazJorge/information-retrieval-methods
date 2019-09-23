<!DOCTYPE html>
<htlm lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0,maximum-scale=1.0, minimum-scale=1.0">
		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/estilof2.css">
		<title>Formulario</title>
	</head>

	<body>
		<div class="contenedor-formulario">
			<form action="seleccionar2.php" class="formulario" name="formulario_registro" method="post">
				<div>
					<div class="input-group">
						<h2>Documentos en los que aparece el término</h2>
							<?php
								for($i=1; $i<60; $i++){
									$x=rand(1, 4);
									echo "<input type='text' id='T$i' name='T$i' value='$x'>";
									echo "<label for='T$i'>T$i</label>";
								}
							?>	
						<input type="text" id="Ndoc" name="Ndoc" value=10>
						<label for="Ndoc">Número de documentos</label>						
					</div>				
					<input type="submit" id="btn-submit" value="Enviar">
				</div>
			</form>
		</div>
	</body>
</html>




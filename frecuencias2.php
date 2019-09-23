<!DOCTYPE html>
<htlm lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/estilof2.css">
			<title>Formulario</title>
			
	</head>
	<body>
		<div class="contenedor-formulario">
			<form action="probabilistico2.php" class="formulario" name="formulario_registro" method="post">
				<div>
					<div class="input-group">
						<h2>Introduce la relevancia</h2>
							<?php
								for($i=1; $i<60; $i++){
									echo "<input type='text' id='T$i' name='T$i' value=0>";
									echo "<label for='T$i'>T$i</label>";
								}
							?>
						
						<input type="text" id="Ndoc" name="n_docs" value=0>
						<label for="Ndoc">Número de documentos</label>
												
					</div>				
					<input type="submit" id="btn-submit" value="Enviar">
				</div>
			</form>
		</div>
	</body>
</html>




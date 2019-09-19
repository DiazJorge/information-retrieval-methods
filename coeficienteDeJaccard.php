<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Coeficiente de Jaccard</title>
		<meta charset="utf-8"/>	
	</head>
	<body bgcolor="#CEECF5"></body>

	<body>
	    <?php
	    	include 'funciones.php';
		
	        $j = 0;
	        $array;
			
	        for( $i = 1; $i<=10;$i++ )
	        {
	            $nombreArchivo = "doc".$i.".txt";
	            $archivo = fopen( $nombreArchivo, "r");
	            
	            if( $archivo == false )
	            {
	                echo("Error al abrir el archivo.");
	                exit();
	            }

	            fgets($archivo);
	            while(!feof($archivo))
	            {
	                $coches = rtrim(fgets($archivo));
	                if( $j > 0 )
	                {
	                    if(in_array($coches, $array) != TRUE && strlen($coches) > 0)
	                    {
	                        $array[$j] = $coches;
	                        $j++;
	                    }
	                }else $array[$j++] = $coches;
	            }
	        }
			
	        sort($array);
	        inicializaMatriz($j);
			salida_1($array, $j);
	        salida_2($array, $j);
			transpuesta($j);
			normalizarMatriz($j);
			$consulta=$_POST["consulta"];
			echo"<br>";
		
			$dim = count($array);

			$vectorC=array_fill(0, $dim, 0);
		
			for ($i = 0, $k = 0; $i < count($array) && $k < count ($consulta); $i++)
			{
				$p1 = trim($array[$i]);
				$p2 = $consulta[$k];
				if (strcmp( $p1, $p2 ) == 0 )
				{
					$vectorC[$i] = 1; 
					$k++; 
				}
				else $vectorC[$i] = 0;
			}

			coeficienteJaccard($vectorC);
			imprimeC($consulta);
			imprimeV($vectorC);
			imprimeR($resultados);
	    ?>
	</body>
</html>

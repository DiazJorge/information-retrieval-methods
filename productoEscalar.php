<html>
<head>
	<title>Producto Escalar</title>
	<meta charset="utf-8"/>	
</head>
<body bgcolor="#CEECF5"></body>

<body>
    <?php
	error_reporting(E_ALL ^ E_WARNING);
	
    $matriz;
	$trans;
	$resultados;
	
	function inicializaMatriz( $t )
	{
		global $matriz;
		for ( $i = 0; $i < $t; $i++ )
			for ( $j = 0; $j < 10; $j++ )
				$matriz[$i][$j] = 0;
	}
	function imprimeMatriz( $t )
	{
		global $matriz;
		for ( $i = 0; $i < $t; $i++ )
		{
			for ( $j = 0; $j < 10; $j++ )
				echo $matriz[$i][$j];
			echo "<br>";
		}
	}

	function transpuesta( $t)
	{
		global $matriz, $trans;
		for ( $i = 0; $i < 10; $i++ )
			for ( $j = 0; $j < $t; $j++ )
				$trans[$i][$j] = $matriz[$j][$i]; 
	}
	
	function normalizarMatriz( $t )
	{
		global $trans;
		for ( $i = 0; $i < 10; $i++ )
		{
			$max = $trans[$i][0]; 
			$min = $trans[$i][0];
			for ($j = 1; $j < $t; $j++ )
				if ($trans[$i][$j] < $min ) $min = $trans[$i][$j];
				else if ($trans[$i][$j] > $max ) $max = $trans[$i][$j];
			$amp = $max-$min;
			
			for ($j = 0; $j < $t; $j++ )
				$trans[$i][$j] = ($trans[$i][$j] - $min)/$amp;
		}
	}
	
	///mostramos la lista de términos y los documentos en los que aparece.
    function salida_1( $array, $j )
    {
        print( "<table border='1' align='center' bgcolor='#E6E6E6'>" );
		print( "<TR>" );
		print("<TD Colspan='3' align=center>MATRIZ DE T&Eacute;RMINOS</TD>");
		print("</TR>");
            print( "<TR>" );
                print( "<TH width='100'>Identificador</TH>" );
                print( "<TH width='100'>Termino</TH>" );
                print( "<TH width='100'>documento_Id</TH>" );
            print( "</TR>" );
        print( "</table>" );
            
        for( $i = 1; $i <= $j; $i++ )
        {
            print( "<table border='1' align='center' bgcolor='#E6E6E6'>" );
                print( "<TR>" );
                    print( "<TD width='100' align=center >T$i</TD>" );
                    print( "<TD width='100' align=center >{$array[$i-1]}</TD>" );
                    $id_doc = documento_Id( $array[$i-1]);
                    print( "<TD width='100' align=center>$id_doc</TD>" );
                print( "</TR>" );
            print( "</table>" );
        }
    }
	
	function documento_Id( $id )
    {
        $cadena="";
        for( $i = 1; $i<=10;$i++ )
        {
			$ban=1;
            $nombreArchivo = "doc".$i.".txt";
            $archivo = fopen( $nombreArchivo, "r");
            
            if( $archivo == false )
            {
                echo( "Error: No se pudo abrir el archivo" );
                exit();
            }
            while( !feof($archivo) && $ban )
            {
                $cmpC = rtrim(fgets( $archivo ) );
                if( strcmp( $id,$cmpC ) == 0 )
                {
					$ban=0;
                    if( strlen($cadena > 0 ) )
                        $cadena=$cadena.",".$i; 
                    else $cadena = $i;
                }
            }
        }
        return $cadena;
    }
	
	//se imprime la matriz termino-documento para ubicar la frecuencia con que aparece cada termino en cada documento
    function salida_2( $array, $j )
    {
        global $matriz;
		
        print("<br>");
		print("<br>");
        print( "<table border= '1' align='center' bgcolor='#E6E6E6'>" );
		print("<TR>");
			print("<TD Colspan='11' align=center>MATRIZ T&Eacute;RMINO-DOCUMENTO NO BOOLEANA</TD>");
		print("</TR>");
            print( "<TR>" );
                print( "<TH width='70'>Terminos</TH>" );
                print( "<TH width='50'>d1</TH>" );
                print( "<TH width='50'>d2</TH>" );
                print( "<TH width='50'>d3</TH>" );
                print( "<TH width='50'>d4</TH>" );
                print( "<TH width='50'>d5</TH>" );
                print( "<TH width='50'>d6</TH>" );
                print( "<TH width='50'>d7</TH>" );
                print( "<TH width='50'>d8</TH>" );
                print( "<TH width='50'>d9</TH>" );
                print( "<TH width='50'>d10</TH>" );
            print( "</TR>" );
        print( "</table>" );   
        
        for( $i = 1; $i <= $j; $i++ )
        {
            $val_pos;
            $indice = 0;
            print( "<table border='1' align='center' bgcolor='#E6E6E6'>" );
            print( "<TR>" );
                print( "<TD width='70' align=center >T$i</TD>" );
				
                $val_pos = esta_en( "doc1.txt", $array[$i-1] );
                $matriz[$i-1][$indice] += $val_pos;
				$aux = $matriz[$i-1][$indice++];
				print( "<TD width='50' align=center >$aux</TD>" );
                $val_pos = esta_en( "doc2.txt", $array[$i-1] );
                $matriz[$i-1][$indice] += $val_pos;
				$aux = $matriz[$i-1][$indice++];
				print( "<TD width='50' align=center >$aux</TD>" );
                $val_pos = esta_en( "doc3.txt", $array[$i-1] );
                $matriz[$i-1][$indice] += $val_pos;
				$aux = $matriz[$i-1][$indice++];
				print( "<TD width='50' align=center >$aux</TD>" );
                $val_pos = esta_en( "doc4.txt", $array[$i-1] );
                $matriz[$i-1][$indice] += $val_pos;
				$aux = $matriz[$i-1][$indice++];
				print( "<TD width='50' align=center >$aux</TD>" );
				$val_pos = esta_en( "doc5.txt", $array[$i-1] );
                $matriz[$i-1][$indice] += $val_pos;
				$aux = $matriz[$i-1][$indice++];
				print( "<TD width='50' align=center >$aux</TD>" );
				$val_pos = esta_en( "doc6.txt", $array[$i-1] );
                $matriz[$i-1][$indice] += $val_pos;
				$aux = $matriz[$i-1][$indice++];
				print( "<TD width='50' align=center >$aux</TD>" );
			    $val_pos = esta_en( "doc7.txt", $array[$i-1] );
                $matriz[$i-1][$indice] += $val_pos;
				$aux = $matriz[$i-1][$indice++];
				print( "<TD width='50' align=center >$aux</TD>" );
                $val_pos = esta_en( "doc8.txt", $array[$i-1] );
                $matriz[$i-1][$indice] += $val_pos;
				$aux = $matriz[$i-1][$indice++];
				print( "<TD width='50' align=center >$aux</TD>" );
                $val_pos = esta_en( "doc9.txt", $array[$i-1] );
                $matriz[$i-1][$indice] += $val_pos;
				$aux = $matriz[$i-1][$indice++];
				print( "<TD width='50' align=center >$aux</TD>" );
                $val_pos = esta_en( "doc10.txt", $array[$i-1] );
                $matriz[$i-1][$indice] += $val_pos;
				$aux = $matriz[$i-1][$indice++];
				print( "<TD width='50' align=center >$aux</TD>" );
            
			print( "</TR>" );
			print( "</table>" );
        }
		print("<br>");
    }
    
    function esta_en( $nombre_doc, $termino )
    {
		$tot=0;
        $archivo = fopen( $nombre_doc, "r" );
        if( $archivo == false )
        {
            echo( "Error al abrir el archivo." );
            exit();
        }
        fgets( $archivo );
        while( !feof($archivo) )
        {
            $coches = rtrim(fgets( $archivo ));
            // Esta en el documento actual y cuantas veces
            if( strcmp( $coches, $termino ) == 0 )
                $tot+=1;
        }
        return $tot;
    }
	
	function cmp($a, $b) 
	{
		return ($a >= $b) ? -1 : 1;
	}

		///impresion del vector de similitudes entre la consulta y cada documento
	function imprimeR( $p )
	{
		$array = array('1' => $p[0],'2' =>$p[1], '3'=>$p[2], '4'=>$p[3], '5' =>$p[4], '6' => $p[5], '7' =>$p[6], '8' => $p[7], '9'=> $p[8], '10'=>$p[9] );
		uasort($array, 'cmp');
		print("<br>");
		print("<br>");
		print( "<table border= '1' align='center' bgcolor='#E6E6E6'>" );	
		print("<TR>");
			print("<TD Colspan='2' align=center>SIMILITUD DE LA CONSULTA CON CADA DOCUMENTO</TD>");
		print("</TR>");
		print("<TR>");
			print("<TH width='70'>Documento</TH>");
			print( "<TH width='50'>Similitud</TH>" );
		print("</TR>");
		
		for ( $i=1; $i <= 10; $i++)
		{
			$v = key ($array);next($array);
            print( "<TR>" );
				print( "<TD width='70' align=center >d$v</TD>" );
				$ax= $array[$v];
				print( "<TD width='50' align=center >$ax</TD>" );
		}
		
		print( "</TR>" );
		print( "</table>" );
	}
	// imprimimos los terminos de la consulta
	function imprimeC( $imp )
	{
		print("<br>");
		print("<br>");
		print( "<table border= '1' align='center' bgcolor='#E6E6E6'>" );	
		print("<TR>");
			print("<TD Colspan='2' align=center>TERMINOS DE CONSULTA</TD>");
		print("</TR>");
		for ( $i=1; $i <= count($imp); $i++)
		{
            print( "<TR>" );
				print( "<TD width='100' align=center >Termino_$i</TD>" );
				$ax= $imp[$i-1];
				print( "<TD width='100' align=center >$ax</TD>" );
		}
		print( "</TR>" );
		print( "</table>" );
	}
	//impresion del vector de terminos de consulta completo
	function imprimeV( $imp )
	{
		print("<br>");
		print("<br>");
		print( "<table border= '1' align='center' bgcolor='#E6E6E6'>" );	
		print("<TR>");
			print("<TD Colspan='2' align=center>VECTOR DE CONSULTA</TD>");
		print("</TR>");
		print("<TR>");
			print("<TH width='100'>N_Termino</TH>");
			print( "<TH width='100'>Seleccion</TH>" );
		print("</TR>");
		for ( $i=1; $i <= count($imp); $i++)
		{
            print( "<TR>" );
				print( "<TD width='100' align=center >Termino_$i</TD>" );
				$ax= $imp[$i-1];
				print( "<TD width='100' align=center >$ax</TD>" );
		}
		print( "</TR>" );
		print( "</table>" );
	}
	
	function productoEscalar( $consulta )
	{
		global $trans;
		global $resultados;
		$total = 0;
		for ( $i = 0; $i < count($trans); $i++ )
		{
			$total = 0;
			for ( $j = 0; $j < count($trans[0] ) ; $j++ )
				$total+=$trans[$i][$j] * $consulta[$j];
			$resultados[$i] = $total;
		}
	}


        $j = 0;
        $array;
		
        for( $i = 1; $i<=10;$i++ )
        {
            $nombreArchivo = "doc".$i.".txt";
            $archivo = fopen( $nombreArchivo, "r");
            
            if( $archivo == false )
            {
                echo( "Error al abrir el archivo." );
                exit();
            }
            fgets( $archivo );
            while( !feof($archivo) )
            {
                $coches = rtrim(fgets( $archivo ));
                if( $j > 0 )
                {
                    if( in_array( $coches, $array ) != TRUE && strlen($coches) > 0 )
                    {
                        $array[$j] = $coches;
                        $j++;
                    }
                }else $array[$j++] = $coches;
            }
        }
		
        sort( $array );
        inicializaMatriz( $j );
		salida_1($array, $j );
        salida_2( $array, $j );
		transpuesta($j);
		normalizarMatriz($j);
		$consulta=$_POST["consulta"];
		echo"<br>";
	
	
	
	$dim = count($array);

	$vectorC=array_fill(0, $dim, 0);
	
	for ( $i = 0, $k = 0; $i < count($array) && $k < count ($consulta); $i++ )
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

		productoEscalar( $vectorC );
		imprimeC($consulta);
		imprimeV($vectorC);
		imprimeR( $resultados );
		
    ?>
</body>
</html>

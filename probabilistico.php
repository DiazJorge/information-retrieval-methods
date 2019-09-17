<html>
<head>
	<title>Metodo Probabilistico</title>
	<meta charset="utf-8"/>	
</head>
<body bgcolor="#CEECF5"></body>

<body>
<?php
    // Globales
    $palabras;                                                                  // Guardar todas las palabars
    $frecuencias;                                                               // Guarda las ocurrencias de cada palabra
    $auxiliar;
    $consulta;
    $similitud;

    function leer_palabras()
    {
        global $palabras, $auxiliar;
        $archivo = fopen( "palabras.txt", "r" );

        if( $archivo == false )
        {
            echo( "Error al abrir el archivo." );
            exit();
        }

        while( !feof( $archivo ) )
        {
            $coches = fgets( $archivo );
            $coches = rtrim( $coches );
            if( strlen( $coches ) > 0 )
            {
                $palabras[ $coches ] = 0;
                $auxiliar[] = $coches;
            }
        }
    }

    function leer_consulta()
    {
        global $consulta;
        for( $i = 0; $i < 59; ++$i )                                            // Son 59 entradas, entonces ir de 0-59
        {
            // Aqui se debe verificar que campos son los que estan activados
            $T = "T".( $i + 1 );
            $consulta[] = $_POST[ $T ];
           
        }
    }

    function init_frecuencias()
    {
        global $palabras, $similitud;

        for( $i = 0; $i < 10; ++$i )
        {
            $similitud[] = 0.0;
            $nombre_doc = "d".( $i + 1 ).".txt";
            $archivo = fopen( $nombre_doc, "r" );

            if( $archivo == false )
            {
                echo( "Error al abrir el archivo." );
                exit();
            }
            fgets( $archivo );

            while( !feof( $archivo ) )
            {
                $coches = fgets( $archivo );
                $coches = rtrim( $coches );                                     // Retira el el salto de nueva linea de la cadena
                if( strlen( $coches ) > 0 )
                    $palabras[ $coches ]++;
            }
        }
    }

    function esta_en( $nombre_doc, $termino )
    {
        $archivo = fopen( $nombre_doc, "r" );
        $termino;
        if( $archivo == false )
        {
            echo( "Error al abrir un archivo." );
            exit();
        }
        fgets( $archivo );

        while( !feof($archivo) )
        {
            $coches = fgets( $archivo );
            $coches = rtrim($coches);                                           // Retira el el salto de nueva linea de la cadena

            if( strcmp( $coches, $termino ) == 0 )
                return 1;
        }
        return 0;
    }

    function calcular_peso( $ni, $N )
    {
        $res = $ni / $N;
        $resultado = log10( 0.5 / ( 1 - 0.5 ) ) + log10( ( 1 - $res ) / $res );

        return $resultado;
    }

    function imprimir_tabla()
    {
        global $palabras, $auxiliar, $similitud, $consulta;
		print("<br>");
		print("<br>");
        // Se imprime primero la cabecera de la tabla
        print( "<table border= '1' align='center' bgcolor='#E6E6E6'>" );
            print( "<TR>" );
                print( "<TD Colspan='13' width='80' align=center>MATRIZ DE TERMINOS, PESOS Y FRECUENCIAS</TD>" );                     // Colspan: unifica de forma orizontal las celdas de la tabla
            print( "</TR>" );
            print( "<TR>" );
                print( "<TH width='80'>Terminos</TH>" );
                print( "<TH width='80'>D1</TH>" );
                print( "<TH width='80'>D2</TH>" );
                print( "<TH width='80'>D3</TH>" );
                print( "<TH width='80'>D4</TH>" );
                print( "<TH width='80'>D5</TH>" );
                print( "<TH width='80'>D6</TH>" );
                print( "<TH width='80'>D7</TH>" );
                print( "<TH width='80'>D8</TH>" );
                print( "<TH width='80'>D9</TH>" );
                print( "<TH width='80'>D10</TH>" );
                print( "<TH width='125'>Peso</TH>" );
                print( "<TH width='80'>Frecuencia</TH>" );
            print( "</TR>" );
        print( "</table>" );

        for( $i = 1; $i <= 59; ++$i )
        {
            $coches=$auxiliar[ $i - 1 ];
            $peso = calcular_peso( $palabras[ $coches ], 10 );

            print( "<table border= '1' align='center' bgcolor='#E6E6E6'>" );
            print( "<TR>" );
                print( "<TD width='80' align=center >T$i</TD>" );
                $cero_uno = esta_en( "d1.txt", $auxiliar[ $i-1 ] );
                $similitud[ 0 ] = $similitud[ 0 ] + ( $cero_uno * $peso ) * $consulta[ $i - 1 ];
                print( "<TD width='80' align=center >$cero_uno</TD>" );
                $cero_uno = esta_en( "d2.txt", $auxiliar[ $i-1 ] );
                $similitud[ 1 ] = $similitud[ 1 ] + ( $cero_uno * $peso ) * $consulta[ $i - 1 ];
                print( "<TD width='80' align=center >$cero_uno</TD>" );
                $cero_uno = esta_en( "d3.txt", $auxiliar[ $i-1 ] );
                $similitud[ 2 ] =  $similitud[ 2 ] + ( $cero_uno * $peso ) * $consulta[ $i - 1 ];
                print( "<TD width='80' align=center >$cero_uno</TD>" );
                $cero_uno = esta_en( "d4.txt", $auxiliar[ $i-1 ] );
                $similitud[ 3 ] =  $similitud[ 3 ] + ($cero_uno * $peso ) * $consulta[ $i - 1 ];
                print( "<TD width='80' align=center >$cero_uno</TD>" );
                $cero_uno = esta_en( "d5.txt", $auxiliar[ $i-1 ] );
                $similitud[ 4 ] =  $similitud[ 4 ] + ($cero_uno * $peso ) * $consulta[ $i - 1 ];
                print( "<TD width='80' align=center >$cero_uno</TD>" );
                $cero_uno = esta_en( "d6.txt", $auxiliar[ $i-1 ] );
                $similitud[ 5 ] = $similitud[ 5 ] +( $cero_uno * $peso ) * $consulta[ $i - 1 ];
                print( "<TD width='80' align=center >$cero_uno</TD>" );
                $cero_uno = esta_en( "d7.txt", $auxiliar[ $i-1 ] );
                $similitud[ 6 ] = $similitud[ 6 ] + ($cero_uno * $peso ) * $consulta[ $i - 1 ];
                print( "<TD width='80' align=center >$cero_uno</TD>" );
                $cero_uno = esta_en( "d8.txt", $auxiliar[ $i-1 ] );
                $similitud[ 7 ] = $similitud[ 7 ] +( $cero_uno * $peso ) * $consulta[ $i - 1 ];
                print( "<TD width='80' align=center >$cero_uno</TD>" );
                $cero_uno = esta_en( "d9.txt", $auxiliar[ $i-1 ] );
                $similitud[ 8 ] = $similitud[ 8 ] + ($cero_uno * $peso ) * $consulta[ $i - 1 ];
                print( "<TD width='80' align=center >$cero_uno</TD>" );
                $cero_uno = esta_en( "d10.txt", $auxiliar[ $i-1 ] );
                $similitud[ 9 ] =  $similitud[ 9 ] +( $cero_uno * $peso ) * $consulta[ $i - 1 ];
                print( "<TD width='80' align=center >$cero_uno</TD>" );

                print( "<TD width='125' align=center >$peso</TD>" );
                print( "<TD width='80' align=center >{$palabras[ $coches ]}</TD>" );
            print( "</TR>" );
            print( "</table>" );
        }
    }
/*
    function imprimir_similitud()
    {
        global $similitud;
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
		for ( $i=1; $i <= 10; $i++ )
		{
            print( "<TR>" );
				print( "<TD width='70' align=center >d$i</TD>" );
				$ax= $similitud[$i-1];
				print( "<TD width='50' align=center >$ax</TD>" );
		}
		print( "</TR>" );
		print( "</table>" );
    }
*/
function cmp($a, $b) 
	{
		if ($a == $b)
			return 0;
		return ($a >= $b) ? -1 : 1;
	}

		///impresion del vector de similitudes entre la consulta y cada documento
	function imprimir_similitud( )
	{
		global $similitud;
		$array = array('1' => $similitud[0],'2' =>$similitud[1], '3'=>$similitud[2], '4'=>$similitud[3], '5' =>$similitud[4], '6' => $similitud[5], 
						'7' =>$similitud[6], '8' => $similitud[7], '9'=> $similitud[8], '10'=>$similitud[9] );
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

    leer_palabras();
    leer_consulta();
    init_frecuencias();
    imprimir_tabla();
    print( "<br><br>" );
    imprimir_similitud();
	
	
	//pendejadas de no sr que madres
	for ( $i = 0; $i < 5; $i++)
	{
		$frec = "T".$i;
          print ("<input type='text' value='Evaluar$i' name='$frec'/><br>");
	}
	
?>

<HTML>
    <BODY>
        <FORM action="frecuencias2.php" method="post" enctype="multipart/form-data" >
            <input type="submit" value="Evaluar" name="frec2" />
        </FORM>
    </BODY>
</HTML>

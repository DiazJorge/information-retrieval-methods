<?php
    // Globales
    $frec_default = array( 2,3,3,4,4,2,4,2,4,2,2,4,3,3,2,3,3,5,2,2,3,2,3,2,2,1,3,1,2,4,2,4,2,2,5,5,2,2,2,4,1,4,2,3,2,3,3,2,3,4,2,3,2,3,3,5,3,4,2,10 );

    $palabras;          // Guardar todas las palabras
    $frecuencias;       // Guarda las ocurrencias de cada palabra
    $auxiliar;
    $consulta;
    $similitud;
    $numdoc = $_POST["n_docs"];

    function leer_palabras()
    {
        global $palabras, $auxiliar;
        $archivo = fopen("palabras.txt", "r");

        if($archivo == false)
        {
            echo("Error al abrir el archivo.");
            exit();
        }

        while(!feof( $archivo ))
        {
            $coches = fgets($archivo);
            $coches = rtrim($coches);
            if(strlen( $coches ) > 0)
            {
                $palabras[$coches] = 0;
                $auxiliar[] = $coches;
            }
        }

        fclose($archivo);
    }

    function leer_consulta()
    {
        global $consulta;
        $archivo = fopen("consulta.txt", "r");
        $cadena_consulta = fgets($archivo);

        for($i = 0; $i < 59; $i++)       // Son 59 entradas, entonces ir de 0-59
            $consulta[] = $cadena_consulta[$i];

        fclose($archivo);
    }

    function init_frecuencias()
    {
        global $frec_default, $frecuencias, $similitud;

        for($i = 0; $i < 59; $i++)
        {
            $T = "T".($i + 1);  // Si hubo algun cambio entonces se modifica las nuevas frecuencias
            $frecuencias[] = $frec_default[$i];
            if($_POST[$T] != 0)
                $frec_default[$i] = $_POST[$T];
        }
        for($i = 0; $i < 10; $i++)
        	$similitud[] = 0.0;
    }

    function esta_en( $nombre_doc, $termino )
    {
        $archivo = fopen($nombre_doc, "r");
        $termino;
        if($archivo == false)
        {
            echo("Error al abrir un archivo.");
            exit();
        }
        fgets($archivo);

        while(!feof($archivo))
        {
            $coches = fgets($archivo);
            $coches = rtrim($coches);  // Retira el el salto de nueva linea de la cadena

            if(strcmp($coches, $termino) == 0)
                return 1;
        }
        return 0;
    }

    function calcular_peso( $ni, $xi, $X, $N )
    {
    	print("X=".$X);
		$i1 = ($xi / $X) + 0.5 ;
		$i2 =  ( $ni - $xi + 0.5 )/(  $N - $X + 1 );
		
        $log1 = log10( $i1 /  (1 - $i1  ));
        $log2 = log10( (1 - $i2)/$i2);
       
        $resultado = $log1 + $log2;

        return $resultado;
    }

    function imprimir_tabla()
    {
        global $palabras, $auxiliar, $similitud, $consulta, $frecuencias, $frec_default, $numdoc;
        // Se imprime primero la cabecera de la tabla
        print( "<table border= '1'>" );
            print( "<TR>" );
                print( "<TD Colspan='13' width='80'
                align=center>Modelo Probabilistico</TD>" ); // Colspan: unifica de forma orizontal las celdas de la tabla
            print( "</TR>" );
            print( "<TR>" );
                print( "<TH width='80'>-</TH>" );
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

        for( $i = 0; $i < 59; $i++ )
        {
            $peso = calcular_peso( $frecuencias[ $i ], $frec_default[ $i ], $numdoc, 10 );
			//print( "Pesp".$peso );
            print( "<table border= '1'>" );
            print( "<TR>" );
                print( "<TD width='80' align=center >T$i</TD>" );
                $cero_uno = esta_en( "d1.txt", $auxiliar[ $i ] );
                $similitud[ 0 ] = $similitud[ 0 ] + ( $cero_uno * $peso ) * $consulta[ $i ];
                print( "<TD width='80' align=center >$cero_uno</TD>" );
                $cero_uno = esta_en( "d2.txt", $auxiliar[ $i ] );
                $similitud[ 1 ] = $similitud[ 1 ] + ( $cero_uno * $peso ) * $consulta[ $i ];
                print( "<TD width='80' align=center >$cero_uno</TD>" );
                $cero_uno = esta_en( "d3.txt", $auxiliar[ $i ] );
                $similitud[ 2 ] =  $similitud[ 2 ] + ( $cero_uno * $peso ) * $consulta[ $i ];
                print( "<TD width='80' align=center >$cero_uno</TD>" );
                $cero_uno = esta_en( "d4.txt", $auxiliar[ $i ] );
                $similitud[ 3 ] =  $similitud[ 3 ] + ($cero_uno * $peso ) * $consulta[ $i ];
                print( "<TD width='80' align=center >$cero_uno</TD>" );
                $cero_uno = esta_en( "d5.txt", $auxiliar[ $i ] );
                $similitud[ 4 ] =  $similitud[ 4 ] + ($cero_uno * $peso ) * $consulta[ $i ];
                print( "<TD width='80' align=center >$cero_uno</TD>" );
                $cero_uno = esta_en( "d6.txt", $auxiliar[ $i ] );
                $similitud[ 5 ] = $similitud[ 5 ] +( $cero_uno * $peso ) * $consulta[ $i ];
                print( "<TD width='80' align=center >$cero_uno</TD>" );
                $cero_uno = esta_en( "d7.txt", $auxiliar[ $i ] );
                $similitud[ 6 ] = $similitud[ 6 ] + ($cero_uno * $peso ) * $consulta[ $i ];
                print( "<TD width='80' align=center >$cero_uno</TD>" );
                $cero_uno = esta_en( "d8.txt", $auxiliar[ $i ] );
                $similitud[ 7 ] = $similitud[ 7 ] +( $cero_uno * $peso ) * $consulta[ $i ];
                print( "<TD width='80' align=center >$cero_uno</TD>" );
                $cero_uno = esta_en( "d9.txt", $auxiliar[ $i ] );
                $similitud[ 8 ] = $similitud[ 8 ] + ($cero_uno * $peso ) * $consulta[ $i ];
                print( "<TD width='80' align=center >$cero_uno</TD>" );
                $cero_uno = esta_en( "d10.txt", $auxiliar[ $i ] );
                $similitud[ 9 ] =  $similitud[ 9 ] +( $cero_uno * $peso ) * $consulta[ $i ];
                print( "<TD width='80' align=center >$cero_uno</TD>" );

                print( "<TD width='125' align=center >$peso</TD>" );
                print( "<TD width='80' align=center >{$frec_default[ $i ]}</TD>" );
            print( "</TR>" );
            print( "</table>" );
        }
    }

    function imprimir_similitud()
    {
        global $similitud;
        for( $i = 0; $i < 10; $i++ )
        {
            print( "Similitud( D".( $i + 1 ).", Q ) = ".$similitud[ $i ]."<br>" );
        }
    }

    leer_palabras();
    leer_consulta();
    init_frecuencias();
    imprimir_tabla();
    print( "<br><br>" );
    imprimir_similitud();
?>

<html>
<body bgcolor="#CEECF5"></body>

<body>
    <?php
    $matriz;

    class Pila
    {
      private $vector_pila;

      public function __construct()
      {
        $this->vector_pila = array();
      }
      public function vacia()
      {
        if( empty( $this->vector_pila ) )
            return true;
        return false;
      }

      public function push( $dato )
      {
          $this->vector_pila[] = $dato;
      }

      public function pop()
      {
        $res = array_pop( $this->vector_pila );
        return $res;
      }

      public function tope()
      {
        $res = $this->vector_pila[ count( $this->vector_pila ) - 1 ];
        return $res;
      }
  }

  function prioridad( $op )
  {
    switch( $op )
    {
        case '&':
          return 1;
        case '|':
            return 1;
        case ')':
            return -1;
        default:
            return 0;
    }
  }

  function convertir( $entrada )
  {
      $pila = new Pila();
      $posf="";

      for( $i = 0; $i < strlen( $entrada ); $i++ )
      {
          switch( $entrada[ $i ] )
          {
              case '(':
                  $pila->push( '(' );
                  break;
            case ')':
                while( $pila->vacia() != true && $pila->tope() != '(' )
                {
                    $posf = $posf.$pila->tope()." ";
                    $pila->pop();
                }
                $pila->pop();
            break;
            case '&':
            case '|':
                while( $pila->vacia() != true && prioridad( $entrada[ $i ] ) <= prioridad( $pila->tope() ) )
                {
                    $posf = $posf.$pila->tope()." ";
                    $pila->pop();
                }
                $pila->push( $entrada[ $i ] );
            break;
            default:
                while( is_numeric( $entrada[ $i ] ) == true || $entrada[ $i ] == "." )
                {
                    $posf = $posf.$entrada[ $i++ ];
                    if( $i == strlen( $entrada ) )
                        break;
                }
                $posf = $posf." ";
                $i--;
        }
		echo $posf."<br>";
    }
    while ($pila->vacia() != true)
    {
        $posf = $posf.$pila->tope()." ";
        $pila->pop();
    }
    return $posf;
 }

 function evaluar( $p )
 {
    global $matriz;

    $pila = new Pila();
    $op1;
    $op2;

    for( $i = 0; $i < strlen( $p ) ; $i = $i + 2 )
    {
        switch ( $p[$i] )
        {
            case '&':
                $op2 = $pila->pop();
                $op1 = $pila->pop();

                $res=( (int)$op1 & (int)$op2 );
                $pila->push($res);
            break;
            case '|':
                $op2 = $pila->pop();
                $op1 = $pila->pop();

                $res=( (int)$op1 | (int)$op2);
                $pila->push($res);

                $pila->push( $res );
            break;
            default:
                $aux = "";
                while ( $p[ $i ] != ' ' )
                {
                    $aux = $aux.$p[ $i++ ];
                    if( $i == strlen($p) )
                        break;
                }
                $aux2 = "";
                for( $it = 0; $it < 10; $it++ )
                    $aux2 = $aux2.$matriz[ (int)$aux - 1 ][ $it ];
                $pr = bindec( $aux2 );
                $pila->push( $pr );
                $i--;
        }
    }
    return $pila->tope();
 }

  function id_document( $id )
  {
      $cadena="";

      for( $i = 1; $i <= 10; $i++ )
      {
          $nombreArchivo = "d".$i.".txt";
            //print( $nombreArchivo );
          $archivo = fopen( $nombreArchivo, "r");

          if( $archivo == false )
          {
              echo( "Error al abrir el archivo" );
              exit();
          }
          while( !feof($archivo) )
          {
              $cmpC = fgets( $archivo,25 );
              if( strcmp( $id,$cmpC ) == 0 )
              {
                  if( strlen($cadena > 0 ) )
                      $cadena=$cadena.",".$i;
                  else
                      $cadena = $i;
              }
          }
      }
      return $cadena;
  }

  function matriz_Uno( $array, $j )
  {
      print( "<table border='1' align='center' bgcolor='#E6E6E6'>" );
          print( "<TR>" );
              print( "<TD Colspan='3' align=center>MATRIZ DE T&Eacute;RMINOS</TD>" );
          print( "</TR>" );

          print( "<TR>" );
              print( "<TH width='100'>Identificador</TH>" );
              print( "<TH width='100'>Termino</TH>" );
              print( "<TH width='100'>Id_documento</TH>" );
          print( "</TR>" );
      print( "</table>" );

      for( $i = 1; $i <= $j; $i++ )
      {
          print( "<table border='1' align='center' bgcolor='#E6E6E6'>" );
              print( "<TR>" );
                  print( "<TD width='100' align=center >T$i</TD>" );
                  print( "<TD width='100' align=center >{$array[$i-1]}</TD>" );
                  $id_doc = id_Document( $array[$i-1]);
                  print( "<TD width='100' align=center>$id_doc</TD>" );
              print( "</TR>" );
          print( "</table>" );
      }
  }

  function esta_en( $nombre_doc, $termino )
  {
      $archivo = fopen( $nombre_doc, "r" );

      if( $archivo == false )
      {
          echo( "Error al abrir el archivo." );
          exit();
      }

      fgets( $archivo, 255 );
      while( !feof($archivo) )
      {
          $coches = fgets( $archivo,25 );
          // Esta en el documento actual
          if( strcmp( $coches, $termino ) == 0 )
              return 1;
      }
      return 0;
  }

  function matriz_Dos( $array, $j )
  {
      print( "<table border='1' align='center' bgcolor='#E6E6E6'>" );
          print( "<TR>" );
              print( "<TD Colspan='11' align=center>TABLA_DOS</TD>" );
          print( "</TR>" );
          print( "<TR>" );
              print( "<TH width='70'>Terminos</TH>" );
              print( "<TH width='50'>Doc1</TH>" );
              print( "<TH width='50'>Doc2</TH>" );
              print( "<TH width='50'>Doc3</TH>" );
              print( "<TH width='50'>Doc4</TH>" );
              print( "<TH width='50'>Doc5</TH>" );
              print( "<TH width='50'>Doc6</TH>" );
              print( "<TH width='50'>Doc7</TH>" );
              print( "<TH width='50'>Doc8</TH>" );
              print( "<TH width='50'>Doc9</TH>" );
              print( "<TH width='50'>Doc10</TH>" );
          print( "</TR>" );
      print( "</table>" );

      for( $i = 1; $i <= $j; $i++ )
      {
          global $matriz;
          $cero_uno;
          $indice = 0;
          print( "<table border='1' align='center' bgcolor='#E6E6E6'>" );
          print( "<TR>" );
              print( "<TD width='70' align=center >T$i</TD>" );
              $cero_uno = esta_en( "d1.txt", $array[$i-1] );
              $matriz[$i-1][$indice++]= $cero_uno;
              print( "<TD width='50' align=center >$cero_uno</TD>" );
              $cero_uno = esta_en( "d2.txt", $array[$i-1] );
              $matriz[$i-1][$indice++]= $cero_uno;
              print( "<TD width='50' align=center >$cero_uno</TD>" );
              $cero_uno = esta_en( "d3.txt", $array[$i-1] );
              $matriz[$i-1][$indice++]= $cero_uno;
              print( "<TD width='50' align=center >$cero_uno</TD>" );
              $cero_uno = esta_en( "d4.txt", $array[$i-1] );
              $matriz[$i-1][$indice++]= $cero_uno;
              print( "<TD width='50' align=center >$cero_uno</TD>" );
              $cero_uno = esta_en( "d5.txt", $array[$i-1] );
              $matriz[$i-1][$indice++]= $cero_uno;
              print( "<TD width='50' align=center >$cero_uno</TD>" );
              $cero_uno = esta_en( "d6.txt", $array[$i-1] );
              $matriz[$i-1][$indice++]= $cero_uno;
              print( "<TD width='50' align=center >$cero_uno</TD>" );
              $cero_uno = esta_en( "d7.txt", $array[$i-1] );
              $matriz[$i-1][$indice++]= $cero_uno;
              print( "<TD width='50' align=center >$cero_uno</TD>" );
              $cero_uno = esta_en( "d8.txt", $array[$i-1] );
              $matriz[$i-1][$indice++]= $cero_uno;
              print( "<TD width='50' align=center >$cero_uno</TD>" );
              $cero_uno = esta_en( "d9.txt", $array[$i-1] );
              $matriz[$i-1][$indice++]= $cero_uno;
              print( "<TD width='50' align=center >$cero_uno</TD>" );
              $cero_uno = esta_en( "d10.txt", $array[$i-1] );
              $matriz[$i-1][$indice++]= $cero_uno;
              print( "<TD width='50' align=center >$cero_uno</TD>" );
          print( "</TR>" );
      print( "</table>" );
      }
  }

  error_reporting(E_ALL ^ E_WARNING);

      $j = 0;
      $array;
      for( $i = 1; $i <= 10; $i++ )
      {
          $nombreArchivo = "d".$i.".txt";
          //print( $nombreArchivo );
          $archivo = fopen( $nombreArchivo, "r" );

          if( $archivo == false )
          {
              echo( "Error al abrir el archivo." );
              exit();
          }

          fgets( $archivo, 255 );
          while( !feof( $archivo ) )
          {
              $coches = fgets( $archivo,25 );
              if( $j > 0 )
              {
                  if( in_array( $coches, $array ) != TRUE && strlen( $coches ) > 0 )
                  {
                      $array[ $j ] = $coches;
                      $j++;
                  }
              }else
                  $array[ $j++ ] = $coches;
          }
      }

      sort( $array );
      $entrada = $_POST[ "entrada" ];
   		$entrada = str_replace("T", "", $entrada);

      matriz_Uno( $array, $j );
      print( "<br><br>" );
      matriz_Dos( $array, $j );
	  echo "<br>"."<br>";
	  echo "Consulta_Entrada(infija):		".$entrada."<br>";
	  echo "Consulta_Postfija:		"."<br>";
      $cad_procesar = convertir( $entrada );
	  echo $cad_procesar."<br>";
      $resultado = evaluar( $cad_procesar );
      $res_fin = decbin( $resultado );

      for( $i = 10-strlen( $res_fin ); $i > 0; $i-- )
        $res_fin = "0".$res_fin;

      print( "<h3>RESULTADO: </h2>".$res_fin."<br>" );
  ?>
</body>
</html>

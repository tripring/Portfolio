<?php
class DB{
  function __construct(){
    require( "secret.php" );
  }

  function bindPar( $stmt , $key , $value ){
    //$arg_key に入る値は，必ず PHPの変数であること
    // ダメな例：$params = array( "p1" => "1" );
    // 良い例： $num = 1; $params = array( "p1" => $num );
    if( strcmp( gettype( $value ) , "string" ) === 0 ){
      $stmt -> bindParam( "".$key , $value , PDO::PARAM_STR );
    }else if( strcmp( gettype( $value ) , "integer" ) === 0 ){
      $stmt -> bindParam( "".$key , $value , PDO::PARAM_INT );
    }else if( strcmp( gettype( $value ) , "boolean" ) === 0 ){
      $stmt -> bindParam( "".$key , $value , PDO::PARAM_BOOL );
    }else{
      $stmt -> bindParam( "".$key , $value , PDO::PARAM_STR );
    }
  }

  function sql_execute( $str_sql, $sql_bind ){
    $pdo = new pdo(DBTYPE.':charset='.CHARCODE.';dbname='.DBNAME.';host='.HOST.'',''.USER.'',''.PASS.'');
    $stmt = $pdo -> prepare( $str_sql );
    foreach( $sql_bind as $key => $value ){
      $this -> bindPar( $stmt, $key, $value );
    }
    $res = $stmt -> execute();
    return $stmt -> fetchAll();
  }
}
?>

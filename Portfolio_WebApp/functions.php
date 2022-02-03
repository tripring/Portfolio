<?php
require( "db.php" );
$db = new DB();
/*
更新日：2022/01/25
使い方：引数が指すデータを全て htmlspecialchars関数 に通す
引数：文字列・添字配列・連想配列などなんでも
戻り値：引数のデータを htmlspecialchars関数 から返ったデータ
*/
function h( $arg ){
  if( is_array( $arg ) ) return h2( $arg );
  return htmlspecialchars( $arg, ENT_QUOTES, "UTF-8" );
}

function h2( $arg ){
  $_res = array();
  foreach( $arg as $key => $value ){
    $key = h( $key );
    if( is_array( $value ) ){
      $_res[ $key ] = h2( $value );
    }else{
      $_res[ $key ] = h( $value );
    }
  }
  return $_res;
}

/*
更新日：2022/01/25
使い方：入力された jsonデータ を 返す
引数：無し
戻り値： jsonデータを格納した連想配列
*/
function get_json(){
  return h2( json_decode( file_get_contents("php://input"), true ) );
}

/*
更新日：2022/01/25
使い方：httpレスポンスを返す
引数：連想配列，フラグ（１：成功，-1：失敗），メッセージ，httpレスポンスコード
戻り値： 無し
メモ： json の key と value は 全て String型 にすること！
*/
function send_json( $array, $flag, $message, $response_code ){
  $array["flag"] = "".$flag;
  $array["msg"] = $message;
  http_response_code( $response_code ) ;
  echo json_encode( $array, JSON_UNESCAPED_UNICODE );
  exit();
}

/*
更新日：2022/01/25
使い方：引数の値がメアド形式かどうか判定する
引数：String型の変数
戻り値： bool
注意：filter_var関数は $str の値がメアドではない場合は false が返るが，
     メアドの場合は，trueではなくメアドが返ってくる為，以下のようなコードになっている
*/
function is_email( $str ){
  if( filter_var( $str, FILTER_VALIDATE_EMAIL ) ) return true;
  return false;
}

/*
更新日：2022/01/25
使い方：連想配列に対して，指定された配列に含まれる文字列をキーとした値が存在するかどうか
引数：連想配列，String型の添字配列
戻り値： bool
*/
function isset_array( $array, $str_array ){
  for( $i = 0; $i < count( $str_array ); $i++ ){
    if( !array_key_exists( $str_array[ $i ], $array ) ) return false;
  }
  return true;
}

/*
更新日：2022/01/25
使い方：メールを送る
引数：メアド，タイトル，内容
戻り値： 無し
*/
function send_mail( $email, $subject, $message ){
  $header = "From : Info";
  $email = "";
  mb_language( "Japanese" );
  mb_internal_encoding( "UTF-8" );
  mb_send_mail( $email, $subject, $message, $header );
}


?>

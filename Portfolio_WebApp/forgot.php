<?php

/* 共通 */
require( "functions.php" );
$data = get_json();
$res_json = array();

//メアドが入力されていない，または入力されたメアドがメアド形式ではない場合，
if( !isset_array( $data, ["email"] ) || !is_email( $data["email"] ) ){
  send_json( $res_json, -1, "メールアドレスの形式が正しくありません", 400 );
}

//入力されたメアドが登録されているかどうか
$str_sql = "select id from `".ACCOUNT."` where email = :email and flag = 1";
$sql_bind = array(
  ':email' => $data["email"]
);
$db_data = $db -> sql_execute( $str_sql, $sql_bind );

if( !isset( $db_data[0]["id"] ) ){
  send_json( $res_json, -1, "入力されたメールアドレスのアカウントが見つかりませんでした", 400 );
}

$message = "
以下のURLからパスワードを再設定してください．
";
send_mail( $data["email"], "たびちず　パスワード再設定について", $message );
send_json( $res_json, 1, "正常終了", 200 );
?>

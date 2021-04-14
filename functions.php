<?php

function connect_to_db()
{

  $dbn = 'mysql:dbname=graduation_production;charset=utf8;port=3306;host=localhost';
  $user = 'root';
  $pwd = '';

  try {
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
  }
}


// function connect_to_db()
// {

//   $dbn = 'mysql:dbname=2ea21218e812791e2b0a1c9f33e9d898;charset=utf8;port=3306;host=mysql-2.mc.lolipop.lan';
//   $user = '2ea21218e812791e2b0a1c9f33e9d898';
//   $pwd = 'ROOTroot0627';

//   try {
//     return new PDO($dbn, $user, $pwd);
//   } catch (PDOException $e) {
//     echo json_encode(["db error" => "{$e->getMessage()}"]);
//     exit();
//   }
// }






// function connect_to_db()
// {

//   $dbn = 'mysql:dbname=86f5966d11215db41d6d33f7107303b7;charset=utf8;port=3306;host=mysql-2.mc.lolipop.lan';
//   $user = '86f5966d11215db41d6d33f7107303b7';
//   $pwd = 'ROOTroot0627';

//   try {
//     return new PDO($dbn, $user, $pwd);
//   } catch (PDOException $e) {
//     echo json_encode(["db error" => "{$e->getMessage()}"]);
//     exit();
//   }
// }




// ログイン状態のチェック関数
function check_session_id()
{
  if (
    !isset($_SESSION["session_id"]) ||
    $_SESSION["session_id"] != session_id()
  ) {
    header("Location:index.php");
  } else {
    session_regenerate_id(true);
    $_SESSION["session_id"] = session_id();
  }
}
<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include("functions.php");
check_session_id();



// 送信データ受け取り
$id = $_GET["id"];
$clients_id = $_SESSION["id"];


// var_dump($color_check);
// var_dump($job_category);
// exit;


// $clients_id = $_SESSION["id"];
$color_check = implode('  ',$_POST["color_check"]);
$project_title = $_POST["project_title"];
// $job_category = $_POST["job_category"];
$job_category = implode('  ',$_POST["job_category"]);
$project_overview = $_POST["project_overview"];
$project_detail = $_POST["project_detail"];
$production_period = $_POST["production_period"];
$remote_availability = $_POST["remote_availability"];



// $color_check = $_POST["color_check"];
// $project_title = $_POST["project_title"];
// $job_category = $_POST["job_category"];
// $project_overview = $_POST["project_overview"];
// $project_detail = $_POST["project_detail"];
// $production_period = $_POST["production_period"];
// $remote_availability = $_POST["remote_availability"];

// var_dump($_POST);
// exit;


// $img = "https://res.cloudinary.com/dlqadjcsc/image/upload/l_text:Sawarabi%20Gothic_30_bold:,co_rgb:333,w_500,c_fit/v1616471824/UbpRDEkE_uqbs0d.png";
// $img = "https://res.cloudinary.com/dlqadjcsc/image/upload/v1616468990/sample.jpg";
$v1 = 'https://res.cloudinary.com/dlqadjcsc/image/upload/l_text:Sawarabi%20Gothic_35_black:';
$img_in1 = $project_title;
$img_in2 = $job_category;
$v3 = ',co_rgb:fff,w_750,c_fit/v1617152888/banar1_zf56ul.png';
$img = $v1.$img_in1."%0A%0A"."デザイナー募集"."%0A".$img_in2.$v3;



// DB接続
$pdo = connect_to_db();

// UPDATE文を作成&実行
$sql = "UPDATE ogp_table2 SET clients_id=:clients_id, img=:img, color_check=:color_check, project_title=:project_title, job_category=:job_category, project_overview=:project_overview, project_detail=:project_detail ,production_period=:production_period, remote_availability=:remote_availability WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':clients_id', $clients_id, PDO::PARAM_INT);
$stmt->bindValue(':img', $img, PDO::PARAM_STR);
$stmt->bindValue(':color_check', $color_check, PDO::PARAM_STR);
$stmt->bindValue(':project_title', $project_title, PDO::PARAM_STR);
$stmt->bindValue(':job_category', $job_category, PDO::PARAM_STR);
$stmt->bindValue(':project_overview', $project_overview, PDO::PARAM_STR);
$stmt->bindValue(':project_detail', $project_detail, PDO::PARAM_STR);
$stmt->bindValue(':production_period', $production_period, PDO::PARAM_STR);
$stmt->bindValue(':remote_availability', $remote_availability, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は一覧ページファイルに移動し，一覧ページの処理を実行する
  header("Location:ogp-send.php?id=$id");

}


?>







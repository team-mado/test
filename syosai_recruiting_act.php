<?php
error_reporting(E_ALL & ~E_NOTICE);
// include('functions.php');


// var_dump($_POST);
// exit;



// if (
//     !isset($_POST['ogp_id']) || $_POST['ogp_id'] == '' ||
//     !isset($_POST['designer_name']) || $_POST['designer_name'] == '' ||
//     !isset($_POST['designer_email']) || $_POST['designer_email'] == '' ||
//     !isset($_POST['portfolio']) || $_POST['portfolio'] == ''  ||
//     !isset($_POST['remote_availability']) || $_POST['remote_availability'] 
// ) {
//     // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
//     echo json_encode(["error_msg" => "no input"]);
//     exit();
// };

// 受け取ったデータを変数に入れる

$ogp_id = $_POST['ogp_id'];
$designer_name = $_POST['designer_name'];
$designer_email = $_POST['designer_email'];
$portfolio = $_POST['portfolio'];
$remote_availability = $_POST['remote_availability'];


// var_dump($_POST['ogp_id']);
// var_dump($_POST['designer_name']);
// var_dump($_POST['designer_email']);
// var_dump($_POST['portfolio']);
// var_dump($_POST['remote_availability']);
// var_dump($ogp_id);
// var_dump($designer_name);
// var_dump($designer_email);
// var_dump($portfolio);
// var_dump($remote_availability);
// exit;


include('functions.php');
$pdo = connect_to_db();



$sql = 'INSERT INTO designer_table(id, ogp_id, designer_name, designer_email, portfolio, remote_availability) VALUES(NULL, :ogp_id, :designer_name, :designer_email, :portfolio, :remote_availability)';
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':ogp_id', $ogp_id, PDO::PARAM_INT);
$stmt->bindValue(':designer_name', $designer_name, PDO::PARAM_STR);
$stmt->bindValue(':designer_email', $designer_email, PDO::PARAM_STR);
$stmt->bindValue(':portfolio', $portfolio, PDO::PARAM_STR);
$stmt->bindValue(':remote_availability', $remote_availability, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    header("Location:hanasi.php");
    exit();
}

?>
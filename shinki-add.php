<?php

error_reporting(E_ALL & ~E_NOTICE);
include('functions.php');
$pdo = connect_to_db();

if (
    !isset($_POST['company_name']) || $_POST['company_name'] == '' ||
    !isset($_POST['staff']) || $_POST['staff'] == '' ||
    !isset($_POST['email']) || $_POST['email'] == '' ||
    !isset($_POST['password']) || $_POST['password'] == ''
) {
    // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["error_msg" => "no input"]);
    exit();
};

// 受け取ったデータを変数に入れる

$company_name = $_POST['company_name'];
$staff = $_POST['staff'];
$email = $_POST['email'];
$password = $_POST['password'];
$location = $_POST['location'];
$businesscontent = $_POST['businesscontent'];
$field = $_POST['field'];
$capital = $_POST['capital'];
$number_of_employees = $_POST['number_of_employees'];




$sql = 'INSERT INTO clients_table(id, company_name, staff, email, password, location, businesscontent, field, capital, number_of_employees) VALUES(NULL, :campany_name, :staff, :email, :password, :location, :businesscontent, :field, :capital, :number_of_employees)';
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':campany_name', $company_name, PDO::PARAM_STR);
$stmt->bindValue(':staff', $staff, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':location', $location, PDO::PARAM_STR);
$stmt->bindValue(':businesscontent', $businesscontent, PDO::PARAM_STR);
$stmt->bindValue(':field', $field, PDO::PARAM_STR);
$stmt->bindValue(':capital', $capital, PDO::PARAM_INT);
$stmt->bindValue(':number_of_employees', $number_of_employees, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    header("Location:thanks.php");
    exit();
}

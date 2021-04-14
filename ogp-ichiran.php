<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include('functions.php');
check_session_id();

// var_dump($_SESSION);
// exit;

$clients_id= $_SESSION["id"];
$name = $_SESSION["staff"];

// var_dump($clients_id);
// var_dump($name);
// exit;
// echo (gettype($clients_id));
// exit;

// 全件データ表示
// ---------
$pdo = connect_to_db();
$sql = "SELECT * FROM ogp_table2 where clients_id =:clients_id";
// $sql1 = "SELECT * ,COUNT(clients_id=$clients_id) AS project_counts FROM ogp_table2 where clients_id =$clients_id";

// var_dump($sql);
// exit;

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':clients_id', $clients_id, PDO::PARAM_INT);
$status = $stmt->execute();

// var_dump($sql1);
// var_dump($status);
// var_dump($status1);
// exit;

// データ登録処理後
if ($status == false) {
  $error = $stmt->errorInfo();

    echo json_encode(["error_msg" => "{$error[2]}"]);
} else {
  $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);  
  
}




?>






<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DESIGN UP! SDGs</title>

    <!-- リセットCSS -->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />

    <!-- Googleフォント -->

    <!-- Fon Awesome読込み -->
    <link
      href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
      rel="stylesheet"
    />
    <!-- オリジナルcomponent.CSS -->
    <link rel="stylesheet" href="css/component.css" />
    <link rel="stylesheet" href="css/ogp-ichiran.css" />
  </head>
  <body>
    <header>
    <div class="header">
      <div><img class="home-logo" src="img/home-logo.png" alt="" ></div>
      <div><a href="php_act/logout.php"><img class="logout-bt" src="img/logout-bt.png" alt=""></a></div>
    </div>
    </header>
    <main>
<p><span><?= $name ?></span> 様ありがとうございます。<br>
現在進行中のプロジェクトは<span class="project-kensu"><?= $project_counts ?>0</span> 件です。</p>
<br>

<?php foreach ($posts as $post) : ?>

  <?php
$img = $post["img"];
$id = $post["id"];
?>

      <div class="ogp-ichiran-img">
      <a href="ogp-update.php?id=<?= $id ?>"><img class="ogp-img" src="<?= $img ?>" alt=""></a>
      </div>

<?php endforeach; ?>

<br>
<div class="button-box">
<a href="ogp-new.php">新規作成</a>
<a href="php_act/logout.php">ログアウト</a>
<br>
      </div>
      <br>
<br>
      </input>
        </form>
    </main>
  </body>
</html>

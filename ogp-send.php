<?
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include('functions.php');
check_session_id();

// var_dump($_POST);
// exit;

$clients_id = $_SESSION["id"];

// var_dump($_GET);
// exit;


if(!isset($_GET["id"])){
  // var_dump("hoge");
  // exit;

// 入れたばかりのデータを持ってくる
$pdo = connect_to_db();
// $sql = "SELECT * FROM ogp_table where id ";
$sql = "SELECT * FROM ogp_table2 WHERE id = (SELECT MAX(id) FROM ogp_table2); ";
$stmt = $pdo->prepare($sql);
// $stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $posts = $stmt->fetch(PDO::FETCH_ASSOC);
  $id = $posts["id"];
  $clients_id = $posts["clients_id"];
  $img = $posts["img"];
  $color_check = $posts["color_check"];
  $project_title = $posts["project_title"];
  $job_category = $posts["job_category"];
  $project_overview = $posts["project_overview"];
  $project_detail = $posts["project_detail"];
  $production_period = $posts["production_period"];
  $remote_availability = $posts["remote_availability"];

}

}






// すでにOGPを作成しているときはデータが入っている状態
if(isset($_GET["id"])){
  // var_dump("test");
  // exit;
  $id = $_GET["id"];

  $pdo = connect_to_db();
  $sql = "SELECT * FROM ogp_table2 where id = :id";
  // var_dump($sql);
  // exit;
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $status = $stmt->execute();
  
  
  if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
  } else {
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $post["id"];
    $clients_id= $post["clients_id"];
    $img = $post["img"];
    $color_check = $post["color_check"];
    $project_title = $post["project_title"];
    $job_category = $post["job_category"];
    $project_overview = $post["project_overview "];
    $project_detail = $post["project_detail"];
    $production_period = $post["production_period"];
    $remote_availability = $post["remote_availability"];
  
    // var_dump($img);
    // exit;
    }
  }







?>





<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
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
    <link rel="stylesheet" href="css/ogp-send.css" />
  </head>
  <body>
    <header>
      <div class="header">
        <div><a href="ogp-ichiran.php"><img class="home-logo" src="img/home-logo.png" alt="" /></a></div>
      </div>
    </header>
    <main>
      <br>
      <div class="ogp-box">
<img class="ogp-img" src="<?= $img ?>" alt="">
      </div>
<!-- <hr color="#C4C4C4" width="100%" size="1"> -->
<br>
<p>プロジェクトを作成しました！<br>
  作ったプロジェクトはtwitterで広めましょう！</p>
  <br>
<div class="button-box">
<a href="ogp-update.php?id=<? echo($id) ?>"><img src="img/bt-hensyu.png" alt=""></a>
<a href="https://twitter.com/share?url=https://lively-miyakonojo-7603.lolipop.io//ogp-syosai.php?id=<? echo($id) ?>&text=デザイナー募集中"><img src="img/bt-tweet.png" alt=""></a><input type="submit" value="" /></input>
<br>
          <div class="center">
<a href="ogp-ichiran.php"><img src="img/bt-ichiranhe.png" alt=""></a><input type="submit" value="" /></input>
      </div>
      </div>
      <br>
<br>
      </input>
        </form>
    </main>
  </body>
</html>

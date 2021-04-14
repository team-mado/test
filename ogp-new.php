<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include('functions.php');
check_session_id();

$clients_id = $_SESSION["id"];
// // var_dump($_GET["id"]);
// // exit;


// 初期画面
if (!isset($_GET["id"])) {
  // $img = "https://res.cloudinary.com/dlqadjcsc/image/upload/l_text:Sawarabi%20Gothic_25_bold:下記のフォームを全て入力いただくと%0Aこちらの枠内にバナーが生成されます,co_rgb:333,w_500,c_fit/v1616471824/UbpRDEkE_uqbs0d.png";
  $img = "https://res.cloudinary.com/dlqadjcsc/image/upload/l_text:Sawarabi%20Gothic_35_bold:下記のフォームを全て入力いただくと%0Aこちらの枠内にバナーが生成されます,co_rgb:fff,w_750,c_fit/v1617152888/banar1_zf56ul.png";
}



// OGP編集時にID取得
if (isset($_GET["id"])) {
  $id = $_GET["id"];
}

// // すでにOGPを作成しているときはデータが入っている状態
if (isset($_GET["id"])) {

  $pdo = connect_to_db();
  $sql = "SELECT * FROM ogp_table2 where id = :id";
  // // var_dump($sql);
  // // exit;
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
    $clients_id = $post["clients_id"];
    $img = $post["img"];
    $color_check = $post["color_check"];
    $project_title = $post["project_title"];
    $job_category = $post["job_category"];
    $project_overview = $post["project_overview "];
    $project_detail = $post["project_detail"];
    $production_period = $post["production_period"];
    $remote_availability = $post["remote_availability"];
  }
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
  <link href="https://unpkg.com/ress/dist/ress.min.css" rel="stylesheet" />

  <!-- Googleフォント -->

  <!-- Fon Awesome読込み -->
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet" />
  <!-- オリジナルcomponent.CSS -->
  <link rel="stylesheet" href="css/component.css" />
  <link rel="stylesheet" href="css/ogp-new.css" />
</head>

<body>
  <header>
    <div class="header">
      <div><a href="ogp-ichiran.php"><img class="home-logo" src="img/home-logo.png" alt=""></a></div>
      <div><a href="php_act/logout.php"><img class="logout-bt" src="img/logout-bt.png" alt=""></a></div>
    </div>
  </header>
  <main>
    <div class="gray-box">
      <img class="ogp-img" src="<? echo($img) ?>" alt="">
      <!-- <p>
        下記のフォームを全て入力いただくと<br />
        こちらの枠内に自動でバナーが生成されます
      </p> -->
    </div>
    <p>SDGｓ17の目標の中から、該当する項目を選んでください ※複数選択可</p>
    <br>
    <div class="checkbox-center">
      <div>
        <form action="php_act/ogp_act.php" method="post">
          <ul>
            <li><img src="img/1.png" alt="">
              <div><input type="checkbox" name="color_check[]" value="1" checked="checked"> 貧困をなくそう</div>
            </li>
            <li><img src="img/2.png" alt="">
              <div><input type="checkbox" name="color_check[]" value="2"> 飢餓をゼロに</div>
            </li>
            <li><img src="img/3.png" alt="">
              <div><input type="checkbox" name="color_check[]" value="3"> 全ての人に健康と福祉を</div>
            </li>
            <li><img src="img/4.png" alt="">
              <div><input type="checkbox" name="color_check[]" value="4"> 質の高い教育をみんなに</div>
            </li>
            <li><img src="img/5.png" alt="">
              <div><input type="checkbox" name="color_check[]" value="5"> ジェンダー平等を実現しよう</div>
            </li>
            <li><img src="img/6.png" alt="">
              <div><input type="checkbox" name="color_check[]" value="6"> 安全な水とトイレを世界中に</div>
            </li>
            <li><img src="img/7.png" alt="">
              <div><input type="checkbox" name="color_check[]" value="7"> エネルギーをみんなにそしてクリーンに</div>
            </li>
            <li><img src="img/8.png" alt="">
              <div><input type="checkbox" name="color_check[]" value="8"> 働きがいも経済成長も</div>
            </li>
            <li><img src="img/9.png" alt="">
              <div><input type="checkbox" name="color_check[]" value="9"> 産業と技術革新の基盤をつくろう</div>
            </li>

            <li><img src="img/10.png" alt="">
              <div><input type="checkbox" name="color_check[]" value="10"> 人や国の不平等をなくそう</div>
            </li>
            <li><img src="img/11.png" alt="">
              <div><input type="checkbox" name="color_check[]" value="11"> 住み続けられる街づくりを</div>
            </li>
            <li><img src="img/12.png" alt="">
              <div><input type="checkbox" name="color_check[]" value="12"> つくる責任つかう責任</div>
            </li>
            <li><img src="img/13.png" alt="">
              <div><input type="checkbox" name="color_check[]" value="13"> 機構変動に具体的な対策を</div>
            </li>
            <li><img src="img/14.png" alt="">
              <div><input type="checkbox" name="color_check[]" value="14"> 海の豊かさを守ろう</div>
            </li>
            <li><img src="img/15.png" alt="">
              <div><input type="checkbox" name="color_check[]" value="15"> 陸の豊かさも守ろう</div>
            </li>
            <li><img src="img/16.png" alt="">
              <div><input type="checkbox" name="color_check[]" value="16"> 平和と公正を全ての人に</div>
            </li>
            <li><img src="img/17.png" alt="">
              <div><input type="checkbox" name="color_check[]" value="17"> パートナーシップで目標を達成しよう</div>
            </li>
            <!-- <li><img src="img/18.png" alt=""><div><input type="checkbox" name="riyu" value="1" checked="checked"> 貧困をなくそう</div></li> -->
          </ul>
          <!-- </form> -->
      </div>
    </div>
    <br>
    <div class="form-box">
      <!-- <form action="php_act/ogp_act.php" method="post" class="row"> -->
        <label for="GET-name">プロジェクトタイトル（最大20文字）</label><br>
        <input class="form-style" id="GET-name" maxlentgth="20" type="text" name="project_title" placeholder="例）海洋ゴミを洋服に変える。FASHION × SEA プロジェクト" >

        <label for="GET-name">職種（最大3つ）</label><br>
        <input type="checkbox" name="job_category[]" value="グラフィック" checked> グラフィック 　
        <input type="checkbox" name="job_category[]" value="WEB" checked> WEB 　
        <input type="checkbox" name="job_category[]" value="UI"> UI 　
        <input type="checkbox" name="job_category[]" value="UX" checked> UX 　<br>
        <input type="checkbox" name="job_category[]" value="DX"> DX 　
        <input type="checkbox" name="job_category[]" value="DTP"> DTP 　
        <input type="checkbox" name="job_category[]" value="プロダクト"> プロダクト 　<br>
        <input type="checkbox" name="job_category[]" value="パッケージ"> パッケージ 　
        <input type="checkbox" name="job_category[]" value="ファッション"> ファッション 　
        <input type="checkbox" name="job_category[]" value="映像"> 映像 　<br>
        <br>


        <label for="GET-name">プロジェクトの概要（最大40文字）</label><br>
        <textarea class="form-style-textbox40" id="GET-name" type="text" wrap="soft" maxlength="40" name="project_overview" placeholder="例）海のゴミから布を作り、洋服へ。魔法のようなプロジェクトを創り出すデザイン集団、求ム！"></textarea>


        <label for="GET-name">プロジェクトの詳細（最大230文字※改行不可）</label><br>
        <textarea class="form-style-textbox230" id="GET-name" type="text" wrap="soft" maxlength="230" name="project_detail" placeholder="例）海洋ゴミを洋服に変える、魔法のようなプロジェクト。アプリのUIデザイン、パンフ作成、商品用パッケージや、洋服のデザインを行うデザイナーを募集しています。今、話題のSDGｓの取り組みを一緒に広げましょう。"></textarea>

        <label for="GET-name">制作期限</label><br>
        <input class="form-style" id="GET-name" type="text" name="production_period" placeholder="例）5月中旬まで" />

        <label for="GET-name">
          <input class="form" id="GET-name" type="radio" name="remote_availability" value="リモート可" checked /> リモート可　
          <input class="form" id="GET-name" type="radio" name="remote_availability" value="リモート不可" /> 不可</label><br>
        <br>

        <div class="center">
          <button class="simple_square_btn1">
            <!-- <a href="ogp_act.php"> -->
            <input type="submit" value="" />送信する</input>
            <!-- </a> -->
          </button>
        </div>
        <br>
        <br>
        </input>

      </form>
  </main>
</body>

</html>
<?php
    var_dump($_GET['tweet_id']);//前の画面から送られてきたIDが何か判別できる
// 前の画面から贈られてきたIDを使ってSQL文作成
    require('dbconnect.php');
    $sql='SELECT * FROM `tweets` INNER JOIN `members` ON `tweets`.`member_id`=`members`.`member_id` WHERE `tweet_id`=?';
    $data=array($_GET['tweet_id']);
// SQL実行
    $stmt=$dbh->prepare($sql);
    $stmt->execute($data);
// データ取得
    while($record=$stmt->fetch(PDO::FETCH_ASSOC)){
      // $recordにfalseが代入されたとき処理が終了します
    // 　　（データの一番最後まで取得してしまい、次に取得するデータが存在しないとき）
      // $tweets[]..配列の最後に新しいデータを追加する
      $tweets[]=array(
        "tweet"=>$record['tweet'],
        "nick_name"=>$record['nick_name'],
        "picture_path"=>$record['picture_path'],
        "created"=>$record['created'],
        "tweet_id"=>$record['tweet_id']
        );
    }
// 取得してきたデータを表示に使用（ここはHTMLタグの方に記述）

    if (isset($_POST['tweet'])) {
      //update文作成
      $sql='UPDATE `tweets` SET `tweet`=? WHERE `tweet_id`=?';
      $data=array($_POST['tweet'],$_GET['tweet_id']);
    

    //SQL実行
    $stmt=$dbh->prepare($sql);
    $stmt->execute($data);

    //topページに戻る
    header("Location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SeedSNS</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/form.css" rel="stylesheet">
    <link href="assets/css/timeline.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">

  </head>
  <body>
  <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header page-scroll">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.html"><span class="strong-title"><i class="fa fa-twitter-square"></i> Seed SNS</span></a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.html">ログアウト</a></li>
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4 content-margin-top">

      <form method="post" action="" class="form-horizontal" role="form">
      <?php foreach ($tweets as $tweet_each) { ?>
        <div class="msg">
          <img src="member_picture/<?php echo $tweet_each['picture_path'] ?>" width="100" height="100">
          <p>投稿者 : <span class="name"> <?php echo $tweet_each['nick_name'] ?> </span></p>
          <p>
            つぶやき : <br>
            <textarea name="tweet" class="form-control"><?php echo $tweet_each["tweet"]; ?>
            </textarea>
          </p>
          <p class="day">
            <?php echo $tweet_each["created"]; ?>
          </p>
          <input type="submit" value="更新" class="btn btn-warning btn-xs">
        </div>
        <?php } ?>
        </form>
        <a href="index.php">&laquo;&nbsp;一覧へ戻る</a>
      </div>
    </div>
  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery-3.1.1.js"></script>
    <script src="assets/js/jquery-migrate-1.4.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>

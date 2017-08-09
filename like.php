<?php

    session_start();
    require('dbconnect.php'); 

    // 前提；$_GET['tweet_id']でlikeしたいtweet_idが取得できる

  //ログインチェック
    if (isset($_SESSION['login_member_id'])){

    //Insert文
      // 演習：ログインしている人が指定したtweet_idのつぶやきをlikeした情報を保存するINSERT文を作成しましょう
    $sql = 'INSERT INTO `likes` SET `member_id`='.$_SESSION['login_member_id'] .', `tweet_id`='.$_GET['tweet_id'];
    // sprintfを使った場合
    // $sql = sprintf('INSERT INTO `likes` SET `member_id`=%d, `tweet_id`=%d',$_SESSION['login_member_id']);  %dは数字の時につかう
    var_dump($sql);
    // ↑数字が代入されるときはサニタイズされてしまうので$data=array()は使わない方が良い。文字の時は大丈夫


    //SQLを実行
    $stmt=$dbh->prepare($sql);
    $stmt->execute();

    }
  //トップページに戻る
    header('Location: index.php');
    exit();

?>
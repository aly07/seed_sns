<?php
    session_start();
    require('dbconnect.php');

  //ログインチェック
    if (isset($_SESSION['login_member_id'])){

    //指定されたtweet_idが、ログインユーザー本人のものかチェック(宿題：指定されたtweet_id,ログインユーザーidでデータ取得)
    $sql = 'SELECT * FROM `tweets` Where `member_id`=? and `tweet_id`=?';


    //SQLを実行
    $data=array($_SESSION['login_member_id'],$_GET['tweet_id']);
    $stmt=$dbh->prepare($sql);
    $stmt->execute($data);

    $record=$stmt->fetch(PDO::FETCH_ASSOC);
    // 本人のものかどうか判別するif文を作成（宿題）
    if($record !=false){

      //本人のものであれば、削除処理（論理削除）
    $sql='UPDATE `tweets` SET `delete_flag`=1 WHERE `tweet_id`=?';
    $data=array($_GET['tweet_id']);
    $stmt=$dbh->prepare($sql);
    $stmt->execute($data);
  }
}
  //トップページに戻る
    header('Location: index.php');
?>
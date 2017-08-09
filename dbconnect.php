<?php
  // DB接続
    $dsn = 'mysql:dbname=seed_sns;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    // 例外処理が使えるようになりエラーメッセージを確認できるようにする
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $dbh->query('SET NAMES utf8');
?>
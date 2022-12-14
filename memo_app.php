<?php

// DBと接続する関数。接続情報は$link
function dbConnect()
{
  $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');

  if (!$link) {
    echo 'Error:データベースに接続できませんでした' . PHP_EOL;
    echo 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
    exit;
  }
  echo 'データベースに接続できました' . PHP_EOL;
  return $link;
}

// メモをDBに登録する関数。うまくいっている
function addMemo($link)
{
  echo 'メモを登録してください' . PHP_EOL . PHP_EOL;
  echo 'タイトル:';
  $title = trim(fgets(STDIN));

  echo '日付：';
  $date = trim(fgets(STDIN));

  echo '内容:';
  $memo = trim(fgets(STDIN));

  $sql = <<<EOT
  INSERT INTO memo_app (
    title,
    date,
    memo
  ) VALUES (
    "{$title}",
    $date,
    "{$memo}"
  )
  EOT;

    $results = mysqli_query($link, $sql);
    if ($results) {
      echo 'データを追加しました' . PHP_EOL;
    } else {
      echo 'Error: データの追加に失敗しました' . PHP_EOL;
      echo 'Debugging error;' . mysqli_error($link) . PHP_EOL;
    }


  echo 'メモを登録しました' . PHP_EOL . PHP_EOL;

}

// メモをDBから情報を引っ張ってきて、表示する関数。
function listMemo($link)
{
  echo 'メモを表示します' . PHP_EOL . PHP_EOL;

  $sql = 'SELECT title, date, memo FROM memo_app';
  $results = mysqli_query($link, $sql);

  while ($memoDate = mysqli_fetch_assoc($results)) {
    echo 'タイトル:' . $memoDate['title'] . PHP_EOL;
    echo '日付:' . $memoDate['date'] . PHP_EOL;
    echo '内容:' . $memoDate['memo'] . PHP_EOL;
  }

  mysqli_free_result($results);
}

$link = dbConnect();

// メモのメニュー。上記で定義した関数をメニューごとに実行している
while(true) {
  echo 'メモ帳アプリへようこそ！' . PHP_EOL . PHP_EOL;
  echo '1.メモを登録' . PHP_EOL;
  echo '2.メモを表示' . PHP_EOL;
  echo '9.メモ帳アプリを終了' . PHP_EOL;
  echo '番号を選択してください(1, 2, 9):';
  $num = trim(fgets(STDIN));

  if ($num === '1') {
    addMemo($link);
  } elseif ($num === '2'){
    listMemo($link);
  } elseif ($num === '9'){
    mysqli_close($link);
    echo 'データベースとの接続を切断しました' . PHP_EOL;
    break;
  }
}

<?php

function addMemo()
{
  echo 'メモを登録してください' . PHP_EOL . PHP_EOL;
  echo 'タイトル:';
  $title = trim(fgets(STDIN));

  echo '日付：';
  $date = trim(fgets(STDIN));

  echo '内容:';
  $memo = trim(fgets(STDIN));

  echo 'メモを登録しました' . PHP_EOL . PHP_EOL;

  return [
    'title' => $title,
    'date' => $date,
    'memo' => $memo,
  ];

}

$memoDate = [];

function listMemo($memoDate)
{
  echo 'メモを表示します' . PHP_EOL . PHP_EOL;

  foreach($memoDate as $memoReview) {
    echo 'タイトル:' . $memoReview['title'] . PHP_EOL;
    echo '日付:' . $memoReview['date'] . PHP_EOL;
    echo '内容:' . $memoReview['memo'] . PHP_EOL . PHP_EOL;
  }
}


while(true) {
  echo 'メモ帳アプリへようこそ！' . PHP_EOL . PHP_EOL;
  echo '1.メモを登録' . PHP_EOL;
  echo '2.メモを表示' . PHP_EOL;
  echo '9.メモ帳アプリを終了' . PHP_EOL;
  echo '番号を選択してください(1, 2, 9):';
  $num = trim(fgets(STDIN));

  if ($num === '1') {
    $memoDate[] = addMemo();
  } elseif ($num === '2'){
    listMemo($memoDate);
  } elseif ($num === '9'){
    break;
  }
}

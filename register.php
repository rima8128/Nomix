<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title> 新規登録 </title>
</head>
<body>
<?php
// ハッシュ化に使用する定数
$salt="jsdklmn";
// パスワードを保存するファイル
$pfile='../../data/session/p.txt';
$status = "none";
if (!empty($_POST["username"]) && !empty($_POST["password"])) {
// パスワードはハッシュ化
$pw = md5($_POST["password"]);
if (!file_exists($pfile)) {
touch($pfile);
}
$lines = file($pfile);
foreach ($lines as $L) {
$L = chop($L);
$p = explode(",", $L);
if ($p[0] == $_POST["username"]) {
$status = "failed";
break;
}
}
if ($status != "failed") {
$fp=fopen($pfile, 'a');
fputs($fp, $_POST["username"] . "," . $pw . "\r\n");
$status = "ok";
}
}
?>
<?php if ($status == "ok"): ?>
<p> 登録完了 </p>
<?php elseif ($status == "failed"): ?>
<p> すでに存在するユーザ名です </p>    
<?php endif; ?>
<A HREF="register.html"> ユーザ登録 </A>
<A HREF="index.html"> ログイン </A>
</body>
</html>
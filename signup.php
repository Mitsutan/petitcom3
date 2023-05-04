<?php
// セッション
session_start();
if (isset($_SESSION['login_id'])) {
    header("Location: ./index.php");
}

// データベースマネージャの読込
require_once "./php/DBManager.php";
$db = new DBManager();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>プチコン３号作品倉庫</title>
</head>

<body>
    <?php require './php/nav.php'; ?>
    <div class="container-fluid">
        <div class="row p-1">
            <div class="col-12">
                <div class="section">
                    <h1>新規ユーザ登録</h1>
                    <h2>登録することのメリット</h2>
                    <ul>
                        <li>記事の投稿・編集・削除ができるようになる</li>
                        <li>記事をユーザ名・NNIDで絞り込めるのでほかの人が探しやすい</li>
                        <li>投稿された記事にリアクションが送れる</li>
                    </ul>
                    <h2>どうしても匿名がいいな...</h2>
                    <p>
                        こちらで用意した「名無しさん」というアカウントがありますのでそちらにログインして投稿してください。
                        <!-- ただし悪意を持った第三者にこのアカウントで投稿した記事が荒らされる可能性があることにご留意ください。 -->
                        <!-- （基本的にバックアップを取っていないので復元することができません。） -->
                        またこのアカウントでは投稿記事の編集・削除およびリアクションが送れません。
                    </p>
                    <p>
                        メールアドレス：(空欄)<br />
                        パスワード：hoge
                    </p>
                    <h2>フォーム</h2>
                    <form id="form" action="./php/signup.php" method="post">
                        <div>
                            <p class="required">メールアドレス</p>
                            <input type="email" name="mail" required>
                        </div>
                        <div>
                            <p class="required">パスワード</p>
                            <input type="password" name="pass" required>
                        </div>
                        <div>
                            <p class="required">ユーザ名</p>
                            <input type="text" name="name" required>
                        </div>
                        <div>
                            <p class="required">NNID</p>
                            <input type="text" name="nnid" required>
                        </div>
                        <div>
                            <label><input type="checkbox" name="agree" id="agree" onclick="document.getElementById('submit').disabled = !document.getElementById(this.id).checked"><a href="./readme.php">READ ME</a>を読み、内容を理解しました</label>
                        </div>
                        <div>
                            <input type="submit" value="登録" id="submit" disabled>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
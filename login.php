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

    <title>プチコン３号作品倉庫 - ログイン</title>
</head>

<body>
    <?php require './php/nav.php'; ?>
    <div class="container-fluid">
        <div class="row p-1">
            <div class="col-12">
                <div class="section">
                    <h1>ログイン</h1>
                    <a href="signup.php">新規ユーザ登録はこちら</a>
                    <form id="form" action="./php/login.php" method="post">
                        <div>
                            <p>メールアドレス</p>
                            <input type="email" name="mail">
                        </div>
                        <div>
                            <p>パスワード</p>
                            <input type="password" name="pass">
                        </div>
                        <div>
                            <input type="submit" value="ログイン">
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

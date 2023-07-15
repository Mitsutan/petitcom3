<?php
// セッション
session_start();
if ($_SESSION['login_auth'] == 1) {
    header("Location: ./index.php");
}

// データベースマネージャの読込
require_once "./php/DBManager.php";
$db = new DBManager();

$result = $db->getUser($_SESSION['login_id']);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="./img/favicon.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.4/dist/trix.css">
    <link rel="stylesheet" href="css/trix_overwrite.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.4/dist/trix.umd.min.js"></script>

    <title>プチコン３号作品倉庫 - プロフィール</title>
</head>

<body>
    <?php require './php/nav.php'; ?>
    <div class="container-fluid">
        <div class="row p-1">
            <div class="col-12">
                <div class="section">
                    <h1>プロフィール</h1>
                    <form class="form" action="./php/mypage.php" method="post">
                        <div>
                            <p class="required">メールアドレス</p>
                            <input type="email" name="mail" value="<?php echo $result['user_mail'] ?>" required>
                        </div>
                        <div>
                            <p class="required">ユーザ名</p>
                            <input type="text" name="name" value="<?php echo $result['user_name'] ?>" required>
                        </div>
                        <div>
                            <p class="required">NNID</p>
                            <input type="text" name="nnid" value="<?php echo $result['user_nnid'] ?>" required>
                        </div>
                        <div>
                            <p>概要</p>
                            <input id="desc" type="hidden" name="description" value="<?php echo htmlspecialchars($result['user_description'], ENT_QUOTES) ?>">
                            <trix-editor input="desc" class="trix-content" placeholder="自己紹介などを書いてみましょう"></trix-editor>
                        </div>
                        <div>
                            <input type="submit" value="変更">
                        </div>
                    </form>
                    <h1>パスワードを変更する</h1>
                    <form class="form" action="./php/logindata.php" method="post">
                        <div>
                            <p class="required">現在のパスワード</p>
                            <input type="password" name="pass" required>
                        </div>
                        <div>
                            <p class="required">新しいパスワード</p>
                            <input type="password" name="newpass" required>
                        </div>
                        <div>
                            <p class="required">新しいパスワード（確認）</p>
                            <input type="password" name="newpass2" required>
                        </div>
                        <div>
                            <input type="submit" value="変更">
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

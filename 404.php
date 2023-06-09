<?php
// セッション
session_start();

// データベースマネージャの読込
require_once "./php/DBManager.php";
$db = new DBManager();
$db->OutPutlog();
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

    <title>プチコン３号作品倉庫 - 404 Not found</title>
</head>

<body>
    <?php require './php/nav.php'; ?>
    <?php
    if (isset($_SESSION['login_id'])) {
        $notice = $db->getNotice($_SESSION['login_id']);
        if (!empty($notice)) {
            require_once './php/notice.php';
        }
    }
    ?>
    <div class="container-fluid">
        <div class="row p-1">
            <div class="col-sm-12 col-md-8">
                <div class="section">
                    <h1>404 Not found</h1>
                    <h2>ページが見つかりませんでした</h2>
                    <p>
                        :(
                    </p>
                </div>
            </div>
            <?php require './php/prjlist.php'; ?>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>

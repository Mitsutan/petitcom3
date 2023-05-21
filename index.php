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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>プチコン３号作品倉庫</title>
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
                    <h1>トップページ</h1>
                    <h2>ようこそプチコン３号作品倉庫へ！</h2>
                    <p>
                        プチコン４と違って３号は公開作品を一覧で見られない！<br />
                        これじゃ隠れた名作を探すことも困難だ！<br />
                        ということで、プチコン３号で作成されたプロジェクトを簡単な概要とともに投稿できるサイトです。
                        e-ショップが死んでも３号はまだ現役！
                    </p>
                    <ul>
                        <li><a href="http://smilebasic.com/">プチコン３号公式サイト</a></li>
                        <li><a href="http://petitverse.hosiken.jp/community/petitcom/">プチコンシリーズユーザの交流場所、「Petitverse」</a></li>
                    </ul>
                    <p>
                        現在<span class="fs-2 fw-bold"><?php echo $db->getCntProject() ?></span>作品！
                    </p>
                    <h2>投稿しよう</h2>
                    <p>
                        このサイトは３号で公開されているプロジェクトを集めて一覧から検索できるようにすることが目的です。<br />
                        各プロジェクトのページには評価ボタンがついており、「いいね！」や「すごい！」と賞賛を送ることができます。<br />
                        投稿や評価にはユーザ登録が必要です。登録の前にREAD MEを必ず読んでください。
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
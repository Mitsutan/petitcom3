<?php
// セッション
session_start();

// データベースマネージャの読込
require_once "./php/DBManager.php";
$db = new DBManager();

$db->OutPutlog();

try {
    $result = $db->getProject($_GET['id']);
    if (!$result) {
        http_response_code(404);
        include("./404.php");
        exit;
    }
    $user = $db->getUser($result['user_id']);

    $rep = $db->getPrjReps($_GET['id']);
} catch (Throwable $th) {
    // echo "[".$th->getCode()."]".$th->getMessage();
    echo "エラーが発生しました。";
    exit;
}



$edit = false;
if (isset($_SESSION['login_id']) && $_SESSION['login_auth'] != 1) {
    $reped = $db->getUserPrjRep($_GET['id'], $_SESSION['login_id']);
    $userid = $_SESSION['login_id'];
    if (($_SESSION['login_id'] == $result['user_id'] && $_SESSION['login_auth'] != 0) || $_SESSION['login_auth'] == 10) $edit = true;
} else {
    $reped = [
        "good" => "disabled",
        "download" => "disabled",
        "nice" => "disabled",
        "great" => "disabled",
        "effort" => "disabled"
    ];
    $userid = null;
}

$rtn = $db->cntView($_GET['id']);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="./img/favicon.ico">

    <!-- OGP -->
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo $result['project_name'] ?>" />
    <meta property="og:description" content="<?php echo strip_tags($result['project_description']) ?>" />
    <meta property="og:url" content="<?php echo (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" />
    <meta property="og:site_name" content="プチコン３号作品倉庫" />
    <meta property="og:image" content="<?php
                                        if (file_exists("./img/projectimg/" . (int)$result['project_id'] . "/img0.png")) {
                                            echo (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/img/projectimg/' . (int)$result['project_id'] . '/img0.png';
                                        } else {
                                            echo (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/img/noimg.png';
                                        }
                                        ?>" />
    <!-- Twitterカードの設定 -->
    <meta name="twitter:card" content="summary_large_image" />
    <!-- <meta name="twitter:site" content="(9)Twitterアカウント名" /> -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.4/dist/trix.css">
    <link rel="stylesheet" href="css/trix_overwrite.css">

    <title>プチコン３号作品倉庫 - <?= $result['project_name'] ?></title>
</head>

<body>
    <?php require './php/nav.php'; ?>
    <div class="container-fluid">
        <div class="row p-1">
            <div class="col-sm-12 col-md-8">
                <div class="section">
                    <h1><?php echo $result['project_name'] ?></h1>
                    <p>
                        投稿者：<?php echo "<a href='./userpage?id=" . $result['user_id'] . "'>" . $user['user_name'] . "</a>・" . $result['project_datetime'] . "・" . $rtn . "閲覧" ?>
                    </p>
                    <div class="d-flex">
                        <div class="me-1">
                            <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-text="<?= $result['project_name'] ?>|プチコン３号作品倉庫" data-hashtags="プチコン３号 #petitcom #プチコン３号作品倉庫" data-show-count="false">Tweet</a>
                            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                        <div>
                            <a href="https://misskeyshare.link/share.html?text=<?= $result['project_name'] ?>|" class="d-flex" onclick="window.open(this.href+encodeURI(decodeURI(document.title))+'&url='+encodeURI(decodeURI(location.href)), '', 'width=500,height=400'); return false;"><img src="./img/notebutton.webp" width="80" height="20"></a>
                        </div>
                    </div>
                    <?php
                    if ($edit) {
                        echo '<form action="./edit.php" method="post">';
                        echo "<input type='hidden' name='projectid' value='" . $result['project_id'] . "'>";
                        // echo '<input class="m-1" type="submit" value="編集/削除">';
                        echo '<button type="submit" class="m-1">編集/削除</button>';
                        echo "</form>";
                    }
                    ?>
                    <div class="m-1" id="tagfield">
                        <?php
                        $data = $db->getTagsByProject($_GET['id']);
                        foreach ($data as $key) {
                            echo '<a class="taglink" href="./search?searchtype=3&search=' . $key['tag_name'] . '">' . htmlentities($key['tag_name'], ENT_QUOTES) . '</a>';
                        }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6" id="imgfield">
                            <?php
                            for ($i = 0; $i < 4; $i++) {
                                if (file_exists("./img/projectimg/" . (int)$_GET['id'] . "/img" . $i . ".png")) {
                                    echo '<img id="img" class="mb-1" width="100%" src="./img/projectimg/' . (int)$_GET['id'] . '/img' . $i . '.png" alt="pic">';
                                    break;
                                }
                            }
                            ?>
                            <div id="imglist">
                                <?php
                                for ($i = 0; $i < 4; $i++) {
                                    if (file_exists("./img/projectimg/" . (int)$_GET['id'] . "/img" . $i . ".png")) {
                                        echo '<img width="20%" src="./img/projectimg/' . (int)$_GET['id'] . '/img' . $i . '.png" alt="pic' . $i . '" onclick="document.getElementById(`img`).src = `./img/projectimg/' . (int)$_GET['id'] . '/img' . $i . '.png`">';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <h2>公開キー</h2>
                    <pre class="text-uppercase bg-white border border-4 border-secondary rounded fs-6 d-inline-block text-center"><span class="bg-secondary text-white p-2 d-block" id="pk-title"></span><span class="d-block m-3" id="public_key"><?= $result['project_pk'] ?></span></pre>
                    <h2>概要</h2>
                    <div class="trix-content"><?php echo $result['project_description'] ?></div>
                    <div id="repfield">
                        <button id="good" type="button" class="btn btn-outline-primary my-1" onclick="sendhttpreq('good',`<?php echo $_GET['id'] ?>`,'<?php echo $userid ?>')" <?php echo $reped['good'] ?>><i class="fa-regular fa-thumbs-up"></i>いいね！<span id="goodnum" class="ms-1"><?php echo $rep['good'] ?></span></button>
                        <button id="downloaded" type="button" class="btn btn-outline-success my-1" onclick="sendhttpreq('downloaded',`<?php echo $_GET['id'] ?>`,'<?php echo $userid ?>')" <?php echo $reped['download'] ?>><i class="fa-solid fa-file-arrow-down"></i>ダウンロードした！<span id="downloadednum" class="ms-1"><?php echo $rep['download'] ?></span></button>
                        <button id="nice" type="button" class="btn btn-outline-danger my-1" onclick="sendhttpreq('nice',`<?php echo $_GET['id'] ?>`,'<?php echo $userid ?>')" <?php echo $reped['nice'] ?>><i class="fa-regular fa-heart"></i>ステキ！<span id="nicenum" class="ms-1"><?php echo $rep['nice'] ?></span></button>
                        <button id="great" type="button" class="btn btn-outline-warning my-1" onclick="sendhttpreq('great',`<?php echo $_GET['id'] ?>`,'<?php echo $userid ?>')" <?php echo $reped['great'] ?>><i class="fa-regular fa-face-surprise"></i>すごい！<span id="greatnum" class="ms-1"><?php echo $rep['great'] ?></span></button>
                        <button id="effort" type="button" class="btn btn-outline-secondary my-1" onclick="sendhttpreq('effort',`<?php echo $_GET['id'] ?>`,'<?php echo $userid ?>')" <?php echo $reped['effort'] ?>><i class="fa-regular fa-face-smile-wink"></i>がんばって！<span id="effortnum" class="ms-1"><?php echo $rep['effort'] ?></span></button>
                    </div>
                </div>
            </div>
            <?php require './php/prjlist.php'; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./script/script.js"></script>
</body>

</html>

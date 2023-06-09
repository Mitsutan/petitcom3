<?php
// セッション
session_start();

// データベースマネージャの読込
require_once "./php/DBManager.php";
$db = new DBManager();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $data = $db->getProject($_POST['projectid']);
    if ($data['user_id'] != $_SESSION['login_id'] && $_SESSION['login_auth'] != 10) header("Location: ./index.php");
}
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

    <title>プチコン３号作品倉庫 - 「<?php echo $data['project_name'] ?>」の編集</title>
</head>

<body>
    <?php require './php/nav.php'; ?>
    <div class="container-fluid">
        <div class="row p-1">
            <div class="col-12">
                <div class="section">
                    <h1>「
                        <?php echo $data['project_name'] ?>」の編集
                    </h1>
                    <form id="form" action="./php/edit.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $data['project_id']; ?>">
                        <div>
                            <p class="">画像</p>
                            削除する画像にチェックを入れてください。
                            <div id="imglist">
                                <?php
                                    for ($i = 0; $i < 4; $i++) {
                                        if (file_exists("./img/projectimg/".(int)$data['project_id']."/img".$i.".png")) {
                                            echo '<label><input class="me-2" type="checkbox" name="imgs[]" value="'.$i.'"><img width="50%" src="./img/projectimg/'.(int)$data['project_id'].'/img'.$i.'.png" alt="pic'.$i.'" onclick="document.getElementById(`img`).src = `./img/projectimg/'.(int)$data['project_id'].'/img'.$i.'.png`"></label>';
                                        }
                                    }
                                ?>
                            </div>
                            <input type="file" name="projectimg[]" accept="image/png, image/jpeg" multiple>
                            現在送付されている画像と合わせて4枚まで送付することができます。(.png.jpg)
                        </div>
                        <div>
                            <p class="required">作品名</p>
                            <input type="text" name="projectname" value="<?php echo $data['project_name'] ?>" autocomplete="off" required>
                        </div>
                        <div>
                            <p class="required">公開キー</p>
                            <input type="text" name="projectpk" placeholder="A12BC3D"
                                value="<?php echo $data['project_pk'] ?>" autocomplete="off" required>
                        </div>
                        <div>
                            <p>概要</p>
                            <input id="desc" type="hidden" name="projectdesc" value="<?php echo htmlspecialchars($data['project_description'], ENT_QUOTES) ?>">
                            <trix-editor input="desc" class="trix-content"></trix-editor>
                        </div>
                        <div>
                            <p>タグ</p>
                            <div>
                                削除するタグにチェックを入れてください。
                            <?php
                            $tagdata = $db->getTagsByProject($data['project_id']);
                            foreach ($tagdata as $key) {
                                echo '<label class="mb-1" style="display: block;"><input type="checkbox" name="tags[]" value="'.htmlentities($key['tag_name'],ENT_QUOTES).'"><a class="taglink">'.htmlentities($key['tag_name'],ENT_QUOTES).'</a></label>';
                            }
                            ?>
                            </div>
                            追加するタグを入力してください。<br />
                            <input type="text" name="projecttags" autocomplete="off">
                            <div>
                                「 」(半角スペース)区切りで複数入力可<br />
                                表記ゆれを減らすために<a href="./tags.php" target="_blank">タグ一覧</a>をご確認ください。
                            </div>
                        </div>
                        <div>
                            <input type="submit" value="編集確定">
                        </div>
                    </form>
                    <div id="dangerzone">
                        <form action="./php/delete.php" method="post">
                            <p>
                                この作品を削除します<br />
                                一度削除すると復元はできません。確認画面は出ません。
                            </p>
                            <input type="hidden" name="id" value="<?php echo $data['project_id']; ?>">
                            <input class="btn btn-outline-danger" type="submit" value="削除">
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>

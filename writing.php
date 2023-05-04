<?php
// セッション
session_start();
if (!isset($_SESSION['login_id'])) {
    header("Location: ./index.php");
}

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

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.4/dist/trix.css">
    <link rel="stylesheet" href="css/trix_overwrite.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.4/dist/trix.umd.min.js"></script>

    <title>プチコン３号作品倉庫</title>
</head>

<body>
    <?php require './php/nav.php'; ?>
    <div class="container-fluid">
        <div class="row p-1">
            <div class="col-12">
                <div class="section">
                    <h1>新規記事投稿</h1>
                    <form id="form" action="./php/writing.php" method="post" enctype="multipart/form-data">
                        <div>
                            <p class="">画像</p>
                            <input type="file" name="projectimg[]" accept="image/png, image/jpeg" multiple>
                            4枚まで送付することができます。(.png.jpg)
                        </div>
                        <div>
                            <p class="required">作品名</p>
                            <input type="text" name="projectname" required>
                        </div>
                        <div>
                            <p class="required">公開キー</p>
                            <input type="text" name="projectpk" placeholder="A12BC3D" required>
                        </div>
                        <div>
                            <p>概要</p>
                            <!-- <textarea name="projectdesc" id="" cols="35" rows="10"
                                placeholder="<h3>操作方法</h3>"></textarea> -->
                            <input id="desc" type="hidden" name="projectdesc">
                            <trix-editor input="desc" class="trix-content"></trix-editor>
                            <!-- <div>
                                次のhtmlタグが使用できます：
                                a(リンク)
                                p(段落)
                                br(改行)
                                i(斜体)
                                b(太字)
                                u(下線)
                                ul(箇条書きリスト、liと併用)
                                ol(番号付きリスト、liと併用)
                                li(リスト項目)
                                h3(見出し)<br />
                                style属性は使用できません。（無視されます）
                            </div> -->
                        </div>
                        <div>
                            <p>タグ</p>
                            <input type="text" name="projecttags">
                            <div>
                                「 」(半角スペース)区切りで複数入力可<br />
                                表記ゆれを減らすためにタグ一覧のページをご確認ください。
                            </div>
                        </div>
                        <div>
                            <input type="submit" value="投稿">
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
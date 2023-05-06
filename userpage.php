<?php
// セッション
session_start();

// データベースマネージャの読込
require_once "./php/DBManager.php";
$db = new DBManager();

$db->OutPutlog();

$result = $db->getUser($_GET['id']);
$prjlist = $db->getProjectsByUserid($_GET['id']);
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

    <title>プチコン３号作品倉庫</title>
</head>

<body>
    <?php require './php/nav.php'; ?>
    <div class="container-fluid">
        <div class="row p-1">
            <div class="col-8">
                <div class="section">
                    <h1><?php echo $result['user_name'] ?>のページ</h1>
                    <h2>概要</h2>
                    <div class="trix-content">
                        <?php echo htmlspecialchars_decode($result['user_description'], ENT_QUOTES) ?>
                    </div>
                    <h2>投稿記事</h2>
                    <div class="row row-cols-1 row-cols-md-3 g-1">
                        <?php
                            foreach ($prjlist as $key) {
                                echo "<div class='col'>";
                                echo "<a class='cardtext' href='./project.php?id=".$key["project_id"]."'>";
                                echo '<div class="card">';
                                if (file_exists("./img/projectimg/".(int)$key['project_id']."/img0.png")) {
                                    echo '<img src="./img/projectimg/'.(int)$key['project_id'].'/img0.png" class="card-img-top" alt="image">';
                                } else {
                                echo '<img src="./img/noimg.png" class="card-img-top" alt="No IMG">';
                                }
                                echo '<div class="card-body">';
                                echo '<h5 class="card-title">'.$key['project_name'].'</h5>';
                                echo "<p class='card-text cardlinelimit'>".strip_tags($key['project_description'])."</p>";
                                echo '</div>';
                                echo '</div>';
                                echo "</a>";
                                echo '</div>';
                            }
                        ?>
                    </div>
                    
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
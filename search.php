<?php
// セッション
session_start();

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

    <title>プチコン３号作品倉庫 - 作品検索</title>
</head>

<body>
    <?php require './php/nav.php'; ?>
    <div class="container-fluid">
        <div class="row p-1">
            <div class="col-12">
                <div class="section">
                    <h1>作品検索</h1>
                    <form id="form" action="" method="get">
                        <div>
                            <label class="me-1"><input type="radio" name="searchtype" value="0" checked>記事名</label>
                            <label class="me-1"><input type="radio" name="searchtype" value="1">投稿者名</label>
                            <label class="me-1"><input type="radio" name="searchtype" value="2">投稿者NNID</label>
                            <label class="me-1"><input type="radio" name="searchtype" value="3">タグ</label>
                        </div>
                        <div>
                            <input type="search" name="search" placeholder="キーワード">
                            <input type="submit" value="検索">
                        </div>
                    </form>
                    <ul>
                        <?php
                            if (isset($_GET['searchtype'])) {
                                switch ($_GET['searchtype']) {
                                    case 0:
                                        $res = $db->getProjectsByName($_GET['search']);
                                        foreach ($res as $key) {
                                            echo '<li><a href="./project?id='.$key['project_id'].'">'.$key['project_name'].'</a>'.'('.$key['project_datetime'].')</li>';
                                        }
                                        break;
                                    case 1:
                                        $res = $db->getUsersByName($_GET['search']);
                                        foreach ($res as $key) {
                                            $data = $db->getProjectsByUserid($key['user_id']);
                                            foreach ($data as $key) {
                                                echo '<li><a href="./project?id='.$key['project_id'].'">'.$key['project_name'].'</a>'.'('.$key['project_datetime'].')</li>';
                                            }
                                        }
                                        break;
                                    case 2:
                                        $res = $db->getUsersByNnid($_GET['search']);
                                        foreach ($res as $key) {
                                            $data = $db->getProjectsByUserid($key['user_id']);
                                            foreach ($data as $key) {
                                                echo '<li><a href="./project?id='.$key['project_id'].'">'.$key['project_name'].'</a>'.'('.$key['project_datetime'].')</li>';
                                            }
                                        }
                                        break;
                                    case 3:
                                        $res = $db->getProjectsByTag($_GET['search']);
                                        foreach ($res as $key) {
                                            $data = $db->getProject($key['project_id']);
                                            echo '<li><a href="./project?id='.$key['project_id'].'">'.$data['project_name'].'</a>'.'('.$data['project_datetime'].')</li>';
                                        }
                                        break;
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>

<?php
    // セッション
    session_start();
        
    // データベースマネージャの読込
    require_once "./DBManager.php";
    $db = new DBManager();
    $db->OutPutlog();

    $filesize = 0;
    foreach ($_FILES['projectimg']['size'] as $key => $value) {
        $filesize += $value;
    }
    if ($filesize > 200000) {
        echo "ファイルサイズが大きすぎます：".($filesize - 200000)."kb over";
        exit;
    }
    if (count($_FILES['projectimg']['size']) > 4) {
        echo "画像は4枚までです";
        exit;
    }

    // タグ分割---
    $str = mb_convert_kana($_POST['projecttags'], 's', 'UTF-8');
    $delimiter = " ";
    $token = strtok($str, $delimiter);
    $arr = array();

    while ($token !== false) {
        array_push($arr, $token);
        $token = strtok($delimiter);
    }

    // print_r($arr);S
    print_r($_FILES['projectimg']['tmp_name']);
    // ---
    try {
        $db->submitProject($_SESSION['login_id'], $db->regexHtml($_POST['projectname']), $db->regexHtml($_POST['projectpk']), $_POST['projectdesc'], $arr);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    
?>
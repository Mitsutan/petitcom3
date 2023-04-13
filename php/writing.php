<?php
    // セッション
    session_start();
        
    // データベースマネージャの読込
    require_once "./DBManager.php";
    $db = new DBManager();

    // if (is_uploaded_file($_FILES['projectimg']['tmp_name'])) {
    //     $file='../img/projectimg/'.basename($_FILES['projectimg']['name']);
    // }

    $desc = $db->regexHtml($_POST['projectdesc']);
    echo $desc;

    // タグ分割---
    $str = $_POST['projecttags'];
    $delimiter = " ";
    $token = strtok($str, $delimiter);
    $arr = array();

    while ($token !== false) {
        array_push($arr, $token);
        $token = strtok($delimiter);
    }

    // print_r($arr);S
    // ---
    try {
        $db->submitProject($_SESSION['login_id'], $_POST['projectname'], $_POST['projectpk'], $desc, $arr);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    
?>
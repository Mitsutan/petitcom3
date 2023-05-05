<?php
    // セッション
    session_start();

    // データベースマネージャの読込
    require_once "./DBManager.php";
    $db = new DBManager();
    $db->OutPutlog();

    $request = json_decode(file_get_contents("php://input"), true);

    $rep = $db->getPrjReps($request['prjid']);
    $reped = $db->getUserPrjRep($request['prjid'], $request['loginid']);

    switch ($request['htmlid']) {
        case 'good':
            $reped['good'] = "disabled";
            $addrep = 16;
            break;
        case 'downloaded':
            $reped['download'] = "disabled";
            $addrep = 8;
            break;
        case 'nice':
            $reped['nice'] = "disabled";
            $addrep = 4;
            break;
        case 'great':
            $reped['great'] = "disabled";
            $addrep = 2;
            break;
        case 'effort':
            $reped['effort'] = "disabled";
            $addrep = 1;
            break;
        default:
            break;
    }

    $db->submitUserPrjRep($request['prjid'], $request['loginid'], $addrep);

    $json = json_encode($reped, JSON_UNESCAPED_UNICODE);
    header("Content-Type: application/json; charset=UTF-8");
    echo $json;
    exit;
?>
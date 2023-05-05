<?php
    // セッション
    session_start();

    // データベースマネージャの読込
    require_once "./DBManager.php";
    $db = new DBManager();
    $db->OutPutlog();
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        try {
            $db->submitUser($_POST['mail'], $_POST['name'], $_POST['pass'], $_POST['nnid']);
        } catch(LogicException $e) {
            echo $e->getMessage();
            exit;
        } catch(PDOException $e) {
            echo '['.$e->getCode().']';               
            if($e->getCode() == '23000') {
                echo 'このメールアドレスは既に登録されています。<br />';
            }
            if($e->getCode() == '2002') {
                echo '情報の登録に失敗しました。<br />しばらく時間をおいて再度お試しください。';
            }
            exit;
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }

            // 新規登録完了
            echo '登録中...';
            $_SESSION['login_id'] = $result['user_id'];
            echo "<script>location.replace('../welcome.php');</script>";
            exit;
    }
?>

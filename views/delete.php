<?php
/**
 * Created by PhpStorm.
 * User: kana
 * Date: 2017/02/12
 * Time: 23:37
 */

require_once '../class/ConnectionDB.php';

$dbConnect = new ConnectionDB();

$articleId = null;
if (isset($_GET['id'])) {
    $articleId = $_GET['id'];
}

if (isset($_POST['delete_yes'])) {
    $articleId = key($_POST['delete_yes']);
    $article = $dbConnect->findByArticleId($articleId);

    if ($article['id']) {
        $dbConnect->delete($article['id']);
    }
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" type="text/css" href="../css/common.css">
</head>

<body>
    <p>本当に削除しますか？</p>
    <form action="delete.php" method="POST" enctype="multipart/form-data">
    <div>
        <input type="button" name="delete_no" value="いいえ" class="cansel" onclick="location.href='index.php'">
        <input type="submit" name="delete_yes[<?php if($articleId) echo $articleId; ?>]" value="はい" class="delete">
    </div>
    </form>
</body>
</html>
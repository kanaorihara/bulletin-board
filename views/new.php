<?php
/**
 * Created by PhpStorm.
 * User: kana
 * Date: 2017/02/10
 * Time: 10:50
 */

require_once '../class/ConnectionDB.php';

$dbConnect = new ConnectionDB();

$title =  $author = $comment = null;
if(isset($_POST['create'])) {
    $dbConnect->insert($_POST['title'], $_POST['author'], $_POST['comment']);
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
    <h1>新規作成</h1>
    <form action="new.php" method="POST" enctype="multipart/form-data">
        <div>
            <label>タイトル</label>
            <input type="text" name="title" value="<?php if($title) echo $title; ?>">
        </div>
        <div>
            <label>投稿者</label>
            <input type="text" name="author" value="<?php if($author) echo $author; ?>">
        </div>
        <div>
            <label>コメント</label>
            <textarea name="comment" rows="5"><?php if($comment) echo $comment ?></textarea>
        </div>
        <div>
            <input type="button" name="return" value="キャンセル" class="cansel" onclick="location.href='index.php'">
            <input type="submit" name="create" value="作成" class="new">
        </div>
    </form>
</body>
</html>
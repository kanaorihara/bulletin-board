<?php
/**
 * Created by PhpStorm.
 * User: kana
 * Date: 2017/02/10
 * Time: 12:43
 */

require_once '../class/ConnectionDB.php';

$dbConnect = new ConnectionDB();

$article = [];
$articleId = $title = $author = $comment = null;
if (isset($_GET['id'])) {
    $articleId = $_GET['id'];
    $article = $dbConnect->findByArticleId($articleId);
}

if (isset($_POST['edit'])) {
    $dbConnect->update($_POST['title'], $_POST['author'], $_POST['comment'], $_POST['id']);
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
    <h1>編集</h1>
    <form action="edit.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $articleId; ?>">
        <div>
            <label>タイトル</label>
            <input type="text" name="title" value="<?php if($article['title']) echo $article['title']; ?>">
        </div>
        <div>
            <label>投稿者</label>
            <input type="text" name="author" value="<?php if($article['author']) echo $article['author']; ?>">
        </div>
        <div>
            <label>コメント</label>
            <textarea name="comment" rows="5"><?php if($article['comment']) echo $article['comment']; ?></textarea>
        </div>
        <div>
            <input type="button" name="return" value="キャンセル" class="cansel" onclick="location.href='index.php'">
            <input type="submit" name="edit" value="編集" class="edit">
        </div>
    </form>
</body>
</html>
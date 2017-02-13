<?php
/**
 * Created by PhpStorm.
 * User: kana
 * Date: 2017/02/10
 * Time: 12:43
 */

require_once '../classes/ConnectionDB.php';

$dbh = ConnectionDB::getConnection();

date_default_timezone_set('Asia/Tokyo');
$date = date('Y-m-d H:i:s');

$stmt = $query = null;

$article = [];
$articleId = $title = $author = $comment = null;
if (isset($_GET['id'])) {
    $articleId = $_GET['id'];
    $query = 'select * from articles where id = ?';
    $stmt = mysqli_prepare($dbh, $query);
    mysqli_stmt_bind_param($stmt, 'd', $articleId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $title, $author, $comment, $delete_flag, $created_at, $updated_at);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($dbh);
}

if (isset($_POST['edit'])) {
    $query = "update articles set title = ?, author = ?, comment = ?, updated_at = ? where id = ?";
    $stmt = mysqli_prepare($dbh, $query);
    mysqli_stmt_bind_param($stmt, 'ssssd', $_POST['title'], $_POST['author'], $_POST['comment'], $date, $_POST['id']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($dbh);

    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/common.css">
</head>

<body>
    <h1>編集</h1>
    <form action="edit.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $articleId; ?>">
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
            <textarea name="comment" rows="5"><?php if($comment) echo $comment; ?></textarea>
        </div>
        <div>
            <input type="button" name="return" value="キャンセル" class="cansel" onclick="location.href='index.php'">
            <input type="submit" name="edit" value="編集" class="edit">
        </div>
    </form>
</body>

</html>
<?php
/**
 * Created by PhpStorm.
 * User: kana
 * Date: 2017/02/12
 * Time: 23:37
 */

require_once '../class/ConnectionDB.php';

$dbh = ConnectionDB::getConnection();

$articleId = null;
if (isset($_GET['id'])) {
    $articleId = $_GET['id'];
}

if (isset($_POST['delete_yes'])) {
    $articleId = key($_POST['delete_yes']);
    $query = 'select * from articles where id = ?';

    $stmt = mysqli_prepare($dbh, $query);
    mysqli_stmt_bind_param($stmt, 'd', $articleId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $title, $author, $comment, $delete_flag, $created_at, $updated_at);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    if ($id) {
        $query = 'update articles set delete_flag = 1 where id = ?';
        $stmt = mysqli_prepare($dbh, $query);
        mysqli_stmt_bind_param($stmt, 'd', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($dbh);
    }
    mysqli_close($dbh);

    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="../css/common.css">
</html>

<body>
    <p>本当に削除しますか？</p>
    <form action="delete.php" method="POST" enctype="multipart/form-data">
    <div>
        <input type="button" name="delete_no" value="いいえ" class="cansel" onclick="location.href='index.php'">
        <input type="submit" name="delete_yes[<?php if($articleId) echo $articleId; ?>]" value="はい" class="delete">
    </div>
    </form>
</body>
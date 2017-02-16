<?php
/**
 * Created by PhpStorm.
 * User: kana
 * Date: 2017/02/10
 * Time: 0:07
 */

require_once '../class/ConnectionDB.php';

$dbConnect = new ConnectionDB();
$articles = $dbConnect->getAll();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" type="text/css" href="../css/common.css">
</head>
<body>
    <h1>掲示版</h1>
    <input type="button" name="new" value="新規作成" class="new" onclick="location.href='./new.php'">
    <?php if (count($articles) < 1) { ?>
    <p>記事がありません。新規作成ボタンから作成してください。</p>
    <?php } else { ?>
    <table>
        <thead>
            <tr>
                <th>日付</th>
                <th>タイトル</th>
                <th>投稿者</th>
                <th>コメント</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article) { ?>
            <tr>
                <td><?php echo $article['created_at'] ?></td>
                <td><?php echo $article['title'] ?></td>
                <td><?php echo $article['author'] ?></td>
                <td><?php echo $article['comment'] ?></td>
                <td>
                    <input type="button" name="edit" value="編集" class="edit" onclick="location.href='./edit.php?id=<?php echo $article['id']?>'">
                    <input type="button" name="delete" value="削除" class="delete" onclick="location.href='./delete.php?id=<?php echo $article['id']?>'">
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } ?>
</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: kana
 * Date: 2017/02/10
 * Time: 0:07
 */

require_once '../classes/ConnectionDB.php';

$dbh = ConnectionDB::getConnection();
$query = 'select * from articles where delete_flag is null order by created_at DESC';

$articles = mysqli_query($dbh, $query);
$articlesCount = mysqli_num_rows($articles);
?>

<!DOCTYPE html>
<head>
</head>
<body>
    <h1>掲示版</h1>
    <input type="button" name="new" value="新規作成" onclick="location.href='new.php'">
    <?php if (empty($articlesCount)) { ?>
    <p>記事がありません。新規作成ボタンから作成してください。</p>
    <?php } else { ?>
    <table>
        <thread>
            <tr>
                <th>日付</th>
                <th>タイトル</th>
                <th>投稿者</th>
                <th>コメント</th>
                <th></th>
            </tr>
        </thread>
        <tbody>
            <?php foreach ($articles as $article) { ?>
            <tr>
                <td><?php echo $article['created_at'] ?></td>
                <td><?php echo $article['title'] ?></td>
                <td><?php echo $article['author'] ?></td>
                <td><?php echo $article['comment'] ?></td>
                <td>
                    <input type="submit" name="edit" value="編集" onclick="location.href='edit.php?id=<?php echo $article['id']?>'">
                    <input type="submit" name="delete" value="削除" onclick="location.href='delete.php?id=<?php echo $article['id']?>'">
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } ?>
</body>

<?php
/**
 * Created by PhpStorm.
 * User: kana
 * Date: 2017/02/10
 * Time: 10:27
 */

class ConnectionDB
{
    public static function getConnection()
    {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=test_board', 'root', '');
        } catch (PDOException $e) {
            print 'error: ' . $e->getMessage() . '<br/>';
            die();
        }
        return $pdo;
    }

    public function getDatetime()
    {
        date_default_timezone_set('Asia/Tokyo');
        $datetime = date('Y-m-d H:i:s');
        return $datetime;
    }

    public function getAll()
    {
        $pdo = $this->getConnection();
        $query = $pdo->prepare('select * from articles where delete_flag is null order by created_at DESC');
        $query->execute();
        return $query->fetchAll();
    }

    public function insert($title, $author, $comment)
    {
        $pdo = $this->getConnection();
        $datetime = $this->getDatetime();
        $query = $pdo->prepare('insert into articles(title,author,comment,created_at) values(?,?,?,?)');
        $query->execute(array($title, $author, $comment, $datetime));
    }

    public function findByArticleId($id)
    {
        $pdo = $this->getConnection();
        $query = $pdo->prepare('select * from articles where id = ?');
        $query->execute(array($id));
        return $query->fetch();
    }

    public function update($title, $author, $comment, $id)
    {
        $pdo = $this->getConnection();
        $datetime = $this->getDatetime();
        $query = $pdo->prepare('update articles set title = ?, author = ?, comment = ?, updated_at = ? where id = ?');
        $query->execute(array($title, $author, $comment, $datetime, $id));
    }

    public function delete($id)
    {
        $pdo = $this->getConnection();
        $datetime = $this->getDatetime();
        $query = $pdo->prepare('update articles set delete_flag = 1, updated_at = ? where id = ?');
        $query->execute(array($datetime, $id));
    }
}
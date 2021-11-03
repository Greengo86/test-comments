<?php
namespace App\Models;

use App\components\DB;

class Comment
{
    //Загружаем записи, где parent_id = номер топика из _GET()
    public static function getParentCommentsByArray(array $ids): array
    {
        $dbConn = DB::getDbConn();
        $in = str_repeat('?,', count($ids) - 1) . '?';

        $parents = $dbConn->prepare(static::getSql('left_join_in', $in));
        $parents->execute($ids);
        return $parents->fetchAll(\PDO::FETCH_ASSOC);
    }

    //А тут загрузим те, записи, что упомянулись в getParentCommentsByArray
    public static function getCommentsRecursive(array $ids): array
    {
        $dbConn = DB::getDbConn();
        $in = str_repeat('?,', count($ids) - 1) . '?';

        $parents = $dbConn->prepare(static::getSql('simple_in', $in));
        $parents->execute($ids);
        return $parents->fetchAll(\PDO::FETCH_ASSOC);
    }

    //Загружаем, первым делом, запись запрашиваемого топика
    public static function getCommentsByMainTopicId(int $id): array
    {
        $dbConn = DB::getDbConn();
        $comm = $dbConn->prepare('SELECT * FROM test_comments WHERE topic_id=:topic_id');
        $comm->bindParam(':topic_id', $id);
        $comm->execute();
        return $comm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function insertComment(int $parent_id, string $body): bool
    {
        $dbConn = DB::getDbConn();
        $insert = $dbConn->prepare(
            'INSERT INTO test_comments (parent_id, body) VALUES (?, ?)'
        );
        return $insert->execute([$parent_id, $body]);
    }

    public static function getSql(string $type, string $in): string
    {
        $sql = '';
        switch ($type){
            case 'simple_in':
                $sql = "SELECT * FROM test_comments WHERE parent_id IN ($in)";
                break;
            case 'left_join_in':
                $sql = "SELECT * FROM test_comments c LEFT JOIN comments c1 ON c.topic_id = c1.parent_id WHERE c.topic_id IN ($in)";
                break;
        }
        return $sql;
    }
}
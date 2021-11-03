<?php
namespace App\Controllers;

use App\helpers\RenderHelper;
use App\Models\Comment;

class CommentController
{
    public function actionComment(): void
    {
        //Запрос по урлу на страницу комментариев - http://localhost/comments.php?topic_id=3
        if (!isset($_GET['topic_id']) || empty($_GET['topic_id'])) {
            throw new \Exception('Required parameter not passed');
        }
        $this->viewComments($_GET['topic_id']);
    }

    public function actionRefresh(): void
    {
        //Сюда попадаем при обновлении страницы
        if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
            throw new \Exception('Bad request');
        }
        //Попытаемся узнать с какой страницы и с каким topic_id обновили и запросим по нему данные
        $route = explode("?", $_SERVER['HTTP_REFERER'])[1];
        $topicId = explode("=", $route)[1];
        if (!$topicId) {
            throw new \Exception('No topic_id for refresh');
        }
        $this->viewComments($topicId);
    }

    private function viewComments(int $topicId): void
    {
        $comments = Comment::getCommentsByMainTopicId($topicId);
        $parentComments = Comment::getParentCommentsByArray([$topicId]);
        $comments = array_merge($comments, $parentComments);
        while (True) {
            $commentsIds = array_map(function ($item) {
                return $item['topic_id'];
            }, $parentComments);
            $parentComments = Comment::getCommentsRecursive($commentsIds);
            if (empty($parentComments)) {
                break;
            }
            $comments = array_merge($comments, $parentComments);
        }

        $nestedTree = RenderHelper::buildNestedTree($comments);
        $html = RenderHelper::obHtmlTemplateComments($nestedTree);
        echo RenderHelper::decorateHtml($html);
    }

    public function actionPostComment():void
    {
        if (!isset($_POST['text']) || !isset($_POST['topic_id']) || empty($_POST['topic_id']) || empty($_POST['text'])) {
            throw new \Exception('Bad request');
        }
        $body = $_POST['text'];
        $parentId = $_POST['topic_id'];
        if (!Comment::insertComment($parentId, $body)) {
            throw new \Exception('Not inserted new comment');
        }
        echo json_encode(true);
    }
}
<?php
namespace App\helpers;

class RenderHelper
{
    public static function obHtmlTemplateComments(array $comments): string
    {
        $html = '';
        ob_start();
        foreach ($comments as $comment){
            include 'comm_temp.php';
        }
        $html .= ob_get_clean();

        return $html;
    }

    public static function buildNestedTree(array $comments): array
    {
        //раступаем этот клубок!
        function buildTree(array $elements, $parentId = 0) {
            $tree = [];
            foreach ($elements as $key => $element) {
                if ($element['parent_id'] == $parentId) {
                    $children = buildTree($elements, $element['topic_id']);
                    if ($children) {
                        $element['childs'] = $children;
                    }
                    $tree[$element['topic_id']] = $element;
                    unset($elements[$key]);
                }
            }
            return $tree;
        }
        return buildTree($comments);
    }

    public static function decorateHtml(string &$html): string
    {
        ob_start();
        include "modify.php";
        $html .= ob_get_clean();
        return $html;
    }
}
<?php
namespace App;
use App\Controllers\CommentController;

require_once __DIR__ . '/vendor/autoload.php';

$controller = new CommentController();
//По умолчанию будет работать экшен - actionComment
$action = 'actionComment';
if (isset($_POST) && !empty($_POST['action'])) {
    $action = 'action' . $_POST['action'];
}

$controller->$action();



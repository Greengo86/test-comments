<?php use App\helpers\RenderHelper;?>

<link rel="stylesheet" href="style.css">
<div class="comments_wrap">
    <ul>
        <li>
            <div class="comment">
                <div class="author">
                    topic #<?php echo $comment['topic_id'];?>
                    <span class="date"><?php echo $comment['created_at'];?></span>
                </div>

                <div class="comment_text"><?php echo $comment['body'];?></div>
                <input type="button" name="<?php echo $comment['topic_id'];?>" id="showForm" value="ответить" class="comment_reply""/>
            </div>
            <form id="form-<?php echo $comment['topic_id'];?>" name="comment" method="post">
                <p>
                    <label>Введите Комментарий:</label>
                    <br />
                    <textarea id="text_comment-<?php echo $comment['topic_id'];?>" cols="30" rows="5"></textarea>
                </p>
                <p>
                    <input type="submit" value="Отправить" onClick = "postComment(<?php echo $comment['topic_id'];?>)" />
                </p>
            </form>
            <?php if(!empty($comment['childs'])):?>
                <ul>
                    <?php echo RenderHelper::obHtmlTemplateComments($comment['childs']);?>
                </ul>
            <?php endif;?>
        </li>
    </ul>
</div>
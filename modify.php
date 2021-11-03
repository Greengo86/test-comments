<div id="commentAdd"></div>
<input type="button" name="submit" id="submit" value="Обновить комменты" onClick = "refresh()" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type='text/javascript'>
    $('form').hide();//все формы скрываем по умолчанию
    $('.comment_reply').click(function(e){
        //узнаем какую форму тоглить по имени топика из this!
        var form_id = '#form-' + this.name;
        $(form_id).toggle('slow');//а дальше тоглим по кнопке
    });
    function postComment(topic){
        //Примем параметром айдишник топика
        var text = '#text_comment-' + topic;
        //узнаем по какому айдишнику хранится текст, что указали в комментарии
        var body = $(text).val();
        $.ajax({
            type: "POST",
            url: "comments.php",
            datatype:"json",
            data: {'action': 'PostComment', 'topic_id': topic, 'text': body}
        }).done(function(result)
        {
            console.log(result);
            $("#commentAdd").html('Комментарий добавлен');
        });
    }
    function refresh(){
        //Обновим комменты и кинем запрос на дефолтный урл! Но при добавлении комментария сразу он должен отобразиться!
        $.ajax({
            type: "POST",
            url: "comments.php",
            datatype:"json",
            data: {'action': 'Refresh'}
        }).done(function(result)
        {
            $('.comments_wrap').remove();
            $('#submit').remove();
            $(document.body).append(result);
        });
    }
</script>
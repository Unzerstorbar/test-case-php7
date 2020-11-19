<?php

require __DIR__ . '/../vendor/autoload.php';

use Topic\Presentation\Controller\TopicController;
use Topic\Presentation\Presenter\CommentPresenter;

$topic = TopicController::create()->getById($_GET['topicId']);

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Hello, world!</title>
    <style>
        .media-body .author {
            display: inline-block;
            font-size: 1rem;
            color: #000;
            font-weight: 700;
        }
        .media-body .metadata {
            display: inline-block;
            margin-left: .5rem;
            color: #777;
            font-size: .8125rem;
        }

        .comment-reply a {
            color: #777;
        }
        .comment-reply a:hover, .comment-reply a:focus {
            color: #000;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <main role="main" class="container">
        <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-primary rounded shadow-sm">
            <div class="lh-100">
                <h5 class="mb-0 text-white lh-100">Топик №<?= $topic->getId() ?></h5>
            </div>
        </div>
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">Комментарии</h6>
            <div class="comments">
                <?php CommentPresenter::presentCollection($topic->getComments()); ?>
            </div>
        </div>
        <form action="" method="post">
            <span>Комментарий</span><br>
            <textarea id="comment" style="width: 100%"></textarea><br>
            <button id="add_comment">Отправить</button>
        </form>
    </main>
</body>

<script type="text/javascript">
    $(function () {
        $("#send").click(function () {
            var topic    = $("#topic").val();
            var body     = $("#body").val();
            var parentId = $("#parentId").val();
            $.ajax({
                type: "POST",
                url: "sendMessage.php",
                data: {"topicId": topic, "body": body, "parentId": parentId},
                cache: false,
                success: function (response) {
                    $("#commentBlock").append(response);
                }
            });
            return false;
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</html>
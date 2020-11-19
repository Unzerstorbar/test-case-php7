<?php

use Topic\Infrastructure\Repository\CommentRepository;
use Topic\Presentation\Presenter\CommentPresenter;

require __DIR__ . '/../vendor/autoload.php';

if (!empty($_POST['body']) && !empty($_POST['topicId'])) {
    $commentRepository = CommentRepository::create();
    $commentId = CommentRepository::create()->addComment($_POST['body'], $_POST['topicId'], $_POST['parentId'] ?: null);

    return CommentPresenter::present(
        $commentRepository->getById($commentId)
    );
}

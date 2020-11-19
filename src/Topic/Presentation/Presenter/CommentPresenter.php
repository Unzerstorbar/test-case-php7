<?php

namespace Topic\Presentation\Presenter;

use Topic\Domain\Entity\Comment;

class CommentPresenter extends EntityPresenter
{
    /**
     * @param Comment|object $entity
     */
    protected static function toHtml(object $entity)
    { ?>
        <div class="media">
            <div class="media-left" style="width: 50px; height: 50px"></div>
            <div class="media-body">
                <div class="media-heading">
                    <div class="author">Гость</div>
                    <div class="metadata">
                        <span class="date"><?= $entity->getCreatedAt()->format('j F Y в H:i') ?></span>
                    </div>
                </div>
                <div class="media-text text-justify">
                    <?= $entity->getBody() ?>
                </div>
                <div class="footer-comment">
                    <span class="comment-reply">
                        <a href="#" class="reply">Ответить</a>
                    </span>
                </div>
                <?php if (!empty($entity->getChildComments())) {
                    static::presentCollection($entity->getChildComments());
                } ?>
            </div>
        </div>
    <?php }
}

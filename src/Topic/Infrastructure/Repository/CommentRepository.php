<?php

namespace Topic\Infrastructure\Repository;

use DateTimeImmutable;
use General\Infrastructure\Repository\Repository;
use Topic\Domain\Entity\Comment;
use Topic\Domain\Entity\Topic;

class CommentRepository extends Repository
{
    /**
     * @param Topic $topic
     * @return Comment[]
     */
    public function getByTopic(Topic $topic): array
    {
        $sql = "
            SELECT id,
                   parent_id,
                   body,
                   created_at as `createdAt`
            FROM comments
            WHERE topic_id = {$topic->getId()}
              AND parent_id IS NULL";

        $result = $this->getRows($sql);

        $comments = array();
        foreach ($result as $comment) {
            $comments[] = $this->createCommentOfArray($comment);
        }

        return $comments;
    }

    /**
     * @param int $commentId
     * @return Comment[]
     */
    private function getByCommentId(int $commentId): array
    {
        $sql = "
            SELECT id,
                   parent_id,
                   body,
                   created_at as `createdAt`
            FROM comments
            WHERE parent_id = {$commentId}";

        $result = $this->getRows($sql);

        $comments = array();
        foreach ($result as $comment) {
            $comments[] = $this->createCommentOfArray($comment);
        }

        return $comments;
    }

    public function addComment(string $body, int $topicId, int $parentId = null): int
    {
        $sql = "
            INSERT INTO comments
             SET topic_id = {$topicId},
                parent_id = {$parentId},
                body = '{$body}'";

        $this->query($sql);

        return (int)$this->lastInsertId();
    }

    public function getById(int $id)
    {
        $sql = "
            SELECT id,
                   parent_id,
                   body,
                   created_at as `createdAt`
            FROM comments
            WHERE id = {$id}";

        return $this->createCommentOfArray(
            $this->getRow($sql)
        );
    }

    private function createCommentOfArray(array $comment): Comment
    {
        $id = (int)$comment['id'];

        return Comment::create(
            $id,
            $comment['body'],
            new DateTimeImmutable($comment['createdAt']),
            $this->getByCommentId($id)
        );
    }
}

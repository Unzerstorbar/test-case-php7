<?php

namespace Topic\Domain\Entity;

class Topic
{
    private int $id;

    private array $comments;

    /**
     * @param int $id
     * @param Comment[] $comments
     * @return static
     */
    public static function create(int $id, array $comments = array()): self
    {
        return new self($id, $comments);
    }

    private function __construct(int $id, array $comments)
    {
        $this->id       = $id;
        $this->comments = $comments;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Comment[]
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * @param Comment[] $comments
     */
    public function setComments(array $comments): void
    {
        foreach ($comments as $comment) {
            if ($comment instanceof Comment) {
                $this->addComment($comment);
            }
        }
    }

    public function addComment(Comment $comment): void
    {
        $this->comments[] = $comment;
    }
}

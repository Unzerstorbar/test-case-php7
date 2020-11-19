<?php

namespace Topic\Domain\Entity;

class Topic
{
    private int $id;

    private array $comments;

    /**
     * @param int $id
     * @param array $comments
     * @return static
     */
    public static function create(int $id, array $comments): self
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
}
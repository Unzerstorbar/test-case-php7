<?php

namespace Topic\Domain\Entity;

use DateTimeImmutable;

class Comment
{
    private int $id;

    private string $body;

    private DateTimeImmutable $createdAt;

    /**
     * @var Comment[]
     */
    private array $childComments;

    /**
     * @param int $id
     * @param string $body
     * @param DateTimeImmutable $createdAt
     * @param array $childComments
     * @return static
     */
    public static function create(int $id, string $body, DateTimeImmutable $createdAt, array $childComments): self
    {
        return new self($id, $body, $createdAt, $childComments);
    }

    private function __construct(int $id, string $body, DateTimeImmutable $createdAt, array $childComments)
    {
        $this->id            = $id;
        $this->body          = $body;
        $this->createdAt     = $createdAt;
        $this->childComments = $childComments;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return Comment[]
     */
    public function getChildComments(): array
    {
        return $this->childComments;
    }
}
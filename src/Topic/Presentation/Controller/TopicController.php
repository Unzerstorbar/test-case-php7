<?php

namespace Topic\Presentation\Controller;

use Topic\Domain\Entity\Topic;
use Topic\Infrastructure\Repository\TopicRepository;

class TopicController
{
    public static function create(): self
    {
        return new self();
    }

    public function getById(int $id): ?Topic
    {
        return TopicRepository::create()->getById($id);
    }
}

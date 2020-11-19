<?php

namespace Topic\Infrastructure\Repository;

use General\Infrastructure\Repository\Repository;
use Topic\Domain\Entity\Comment;
use Topic\Domain\Entity\Topic;

class TopicRepository extends Repository
{
    public function getById(int $id): Topic
    {
        $topic = Topic::create($id);
        $topic->setComments(CommentRepository::create()->getByTopic($topic));

        return $topic;

        return Topic::create(
            $id,
            array(
                Comment::create(
                    1,
                    'Первый текст',
                    new \DateTimeImmutable(),
                    array(
                        Comment::create(
                            3,
                            'Первый первый текст',
                            new \DateTimeImmutable(),
                            array(
                                Comment::create(
                                    5,
                                    'Первый первый первый текст',
                                    new \DateTimeImmutable(),
                                    array()
                                )
                            )
                        ),
                        Comment::create(
                            4,
                            'Первый второй текст',
                            new \DateTimeImmutable(),
                            array()
                        ),
                    )
                ),
                Comment::create(
                    2,
                    'Второй текст',
                    new \DateTimeImmutable(),
                    array()
                ),
            )
        );
    }
}

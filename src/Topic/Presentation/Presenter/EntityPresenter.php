<?php

namespace Topic\Presentation\Presenter;

use Closure;

abstract class EntityPresenter
{
    abstract protected static function toHtml(object $entity);

    public static function present(object $entity)
    {
        return static::toHtml($entity);
    }

    public static function presentCollection($entities)
    {
        foreach ($entities as $entity) {
            static::present($entity);
        }
    }
}
